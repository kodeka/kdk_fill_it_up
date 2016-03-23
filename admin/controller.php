<?php
/**
 * @version    1.0.x
 * @package    Fill It Up
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
	exit ;

class FillItUpController
{

	public function execute($task)
	{
		if (!$task)
		{
			$task = 'display';
		}
		$task = strtolower($task);
		if (method_exists($this, $task))
		{
			return $this->$task();
		}
		else
		{
			status_header(404);
			return false;
		}

	}

	public function display()
	{
		$name = isset($_GET['view']) ? $_GET['view'] : 'dashboard';
		if (file_exists(FILLITUP_DIR.'admin/views/'.$name.'.php'))
		{
			require FILLITUP_DIR.'admin/views/'.$name.'.php';
			$class = 'FillItUpView'.ucfirst($name);
			$view = new $class();
			$view->display();
		}
	}

	public function definitions()
	{
		// Get URL
		$url = get_option('definitionsUrl');
		if (trim($url) === '')
		{
			status_header(409);
			_e('Make sure a data definitions URL has been set in settings', 'jw_fillitup');
			return false;
		}

		// Download definitions
		$response = wp_remote_get($url, array('timeout' => 30, 'sslverify' => false));
		if (is_wp_error($response))
		{
			$error = 'Could not fetch definitions file: '.$url.'. Error: '.$response->get_error_message();
			/// Fallback to file_get_contents wp_remote_get has issues with SSLv3 from cdn.joomlaworks.org
			$response = array('body' => @file_get_contents($url));
			if(!$response['body'])
			{
				status_header(500);
				_e($error);
				return false;
			}
		}

		$json = json_decode($response['body']);

		// Get filesystem
		WP_Filesystem();
		global $wp_filesystem;

		// Download and extract images
		foreach ($json as $entry)
		{
			$url = $entry->images;
			$archive = wp_remote_get($url, array('timeout' => 30, 'sslverify' => false));
			if (is_wp_error($archive))
			{
				$error = 'Could not fetch archive of images: '.$url.'. Error: '.$archive->get_error_message();
				// Fallback to file_get_contents wp_remote_get has issues with SSLv3 from cdn.joomlaworks.org
				$archive = array('body' => @file_get_contents($url));
				if(!$archive['body'])
				{
					status_header(500);
					_e($error);
					return false;
				}
			}
			$uploadDirectory = wp_upload_dir();
			$archiveFileName = basename($url);
			$archiveFileName = wp_unique_filename($uploadDirectory['path'], $archiveFileName);
			$zip = $uploadDirectory['path'].'/'.$archiveFileName;
			file_put_contents($zip, $archive['body']);
			$folder = uniqid('fillitup');
			$target = $uploadDirectory['path'].DIRECTORY_SEPARATOR.$folder;
			$result = wp_mkdir_p($target);
			if (!$result)
			{
				status_header(500);
				_e('Could not create the required directories', 'jw_fillitup');
				return false;
			}
			$result = unzip_file($zip, $target);
			$wp_filesystem->delete($zip);
			if (is_wp_error($result))
			{
				status_header(500);
				_e($result->get_error_message());
				return false;
			}
			$entry->images = $uploadDirectory['subdir'].DIRECTORY_SEPARATOR.$folder;
		}

		// Pass definitions to the output
		echo json_encode($json);
		return true;

	}

	public function generate()
	{

		check_ajax_referer();

		// Get definitions
		$definitions = json_decode(stripslashes($_POST['definitions']));

		// Check that definitions is a valid object
		if (!is_array($definitions) || count($definitions) === 0)
		{
			status_header(409);
			_e('Invalid data definitions', 'jw_fillitup');
			return false;
		}

		// Get type
		$type = $_POST['type'];

		// Get generator flags
		$imagesFlag = isset($_POST['images']) && $_POST['images'];
		$videosFlag = isset($_POST['videos']) && $_POST['videos'];
		$galleriesFlag = isset($_POST['galleries']) && $_POST['galleries'];
		$authorFlag = $_POST['author'];

		// Check post type existance
		if (!post_type_exists($type))
		{
			status_header(409);
			_e('Invalid post type', 'jw_fillitup');
			return false;
		}

		// Get total
		$total = (int)$_POST['total'];

		// Get offset
		$offset = (int)$_POST['offset'];

		// Get users generate number
		$users = (int)$_POST['users'];

		// Users role
		$role = $_POST['role'];

		// If it's the first post generate the categories and users first
		if ($offset == 1)
		{
			$this->generateCategories($definitions);
			if($users) {
				$this->generateUsers($users, $role);
			}
		}

		// Get generator
		require_once FILLITUP_DIR.'admin/lib/autoload.php';
		$generator = Faker\Factory::create();

		// Init data
		$row = array('post_type' => $type, 'post_status' => 'publish');
		$category = $this->getRandomCategory($definitions);

		// Title
		if (post_type_supports($type, 'title'))
		{
			$row['post_title'] = $generator->sentence(rand(3, 6));
		}

		// Content
		if (post_type_supports($type, 'editor'))
		{
			$row['post_content'] = '<p>'.implode('</p><p>', $generator->paragraphs(rand(1, 4))).'</p>';
			$row['post_content'] .= '<!--more-->';
			$row['post_content'] .= '<p>'.implode('</p><p>', $generator->paragraphs(rand(2, 6))).'</p>';
			if ($galleriesFlag)
			{
				$row['post_content'] .= '<h3>Image Gallery</h3>'.$this->getRandomGallery($category);
			}
			if ($videosFlag)
			{
				$row['post_content'] .= '<h3>Video</h3>'.PHP_EOL.$this->getRandomMedia($category).PHP_EOL;
			}
		}

		// Author
		if (post_type_supports($type, 'author') && $authorFlag == 'random')
		{
			$row['post_author'] = $this->getRandomUser();
		}

		// Excerpt
		if (post_type_supports($type, 'excerpt'))
		{

		}

		// Trackbacks
		if (post_type_supports($type, 'trackbacks'))
		{

		}

		// Comments
		if (post_type_supports($type, 'comments'))
		{

		}

		// Revisions
		if (post_type_supports($type, 'revisions'))
		{

		}

		// Page attributes
		if (post_type_supports($type, 'page-attributes'))
		{

		}

		// Post formats
		if (post_type_supports($type, 'post-formats'))
		{

		}

		// Taxonomies
		$taxonomies = get_object_taxonomies($type, 'names');
		$args = array('orderby' => 'name', 'order' => 'ASC', 'hide_empty' => true, 'exclude' => array(), 'exclude_tree' => array(), 'include' => array(), 'number' => '', 'fields' => 'all', 'slug' => '', 'parent' => '', 'hierarchical' => true, 'child_of' => 0, 'get' => '', 'name__like' => '', 'description__like' => '', 'pad_counts' => false, 'offset' => '', 'search' => '', 'cache_domain' => 'core');

		$terms = get_terms($taxonomies, $args);

		// See http://codex.wordpress.org/Function_Reference/wp_insert_post
		$postId = wp_insert_post($row);

		// Set category
		wp_set_post_terms($postId, $category->id, 'category');

		// Set tags
		$tags = $this->getRandomTags($category);
		wp_set_post_terms($postId, $tags, 'post_tag');

		// Thumbnail
		if (post_type_supports($type, 'thumbnail') && $imagesFlag)
		{
			$image = $this->getRandomImage($category);
			$result = wp_remote_get($image, array('timeout' => 30, 'sslverify' => false));
			if (is_wp_error($result))
			{
				$error = 'Could not fetch sample image: '.$image.'. Error: '.$result->get_error_message();
				// Fallback to file_get_contents wp_remote_get has issues with SSLv3 from cdn.joomlaworks.org
				$result = array('body' => @file_get_contents($image));
				if(!$result['body'])
				{
					status_header(500);
					_e($error);
					return false;
				}
			}
			$buffer = $result['body'];
			$basename = basename($image);
			$uploadDirectory = wp_upload_dir();
			$filename = wp_unique_filename($uploadDirectory['path'], $basename);
			$target = $uploadDirectory['path'].'/'.$filename;
			file_put_contents($target, $buffer);

			$filetype = wp_check_filetype($target);
			$title = $filename;
			$content = '';
			if ($exif = @wp_read_image_metadata($target))
			{
				if (trim($exif['title']))
				{
					$title = $exif['title'];
				}

				if (trim($exif['caption']))
				{
					$content = $exif['caption'];
				}
			}
			$url = $uploadDirectory['baseurl'].'/'.$category->images.'/'.$filename;
			$attachment = array('post_mime_type' => $filetype['type'], 'guid' => $url, 'post_parent' => $postId, 'post_title' => $title, 'post_content' => $content, );
			$thumbnailId = wp_insert_attachment($attachment, $target, $postId);
			if (!is_wp_error($thumbnailId))
			{
				wp_update_attachment_metadata($thumbnailId, wp_generate_attachment_metadata($thumbnailId, $target));
				add_post_meta($postId, '_thumbnail_id', $thumbnailId);
			}
		}

		// If it's the last post perform clean up
		if ($offset == $total)
		{
			WP_Filesystem();
			global $wp_filesystem;
			$uploadDirectory = wp_upload_dir();
			foreach ($definitions as $definition)
			{
				if (trim($definition->images) != '')
				{
					$wp_filesystem->delete($uploadDirectory['basedir'].$definition->images, true);
				}
			}
		}

		$response = new stdClass;
		$response->offset = $offset;
		$response->definitions = $definitions;
		echo json_encode($response);

	}

	private function generateUsers($count, $role)
	{
		require_once FILLITUP_DIR.'admin/lib/autoload.php';
		$generator = Faker\Factory::create();
		for ($i = 0; $i < $count; $i++)
		{
			$user_id = wp_create_user($generator->userName, $generator->password, $generator->email);
			if($user_id) {
				$name = $generator->name;
				wp_update_user(array('ID' => $user_id, 'nickname' => $name, 'display_name' => $name));
				$user = new WP_User( $user_id );
 				$user->set_role($role);
			}
		}
	}

	private function getRandomUser()
	{
		global $wpdb;
		$rows = $wpdb->get_results('SELECT ID FROM '.$wpdb->users.' ORDER BY RAND() LIMIT 1');
		return $rows[0]->ID;
	}

	private function generateCategories(&$definitions)
	{
		foreach ($definitions as $category)
		{
			$category->id = wp_create_category($category->name);
		}
	}

	private function getRandomCategory($definitions)
	{
		$key = array_rand($definitions);
		return $definitions[$key];
	}

	private function getRandomTags($category)
	{
		return array_rand(array_flip($category->tags), 3);
	}

	private function getRandomMedia($category)
	{
		return $category->media[array_rand($category->media)];
	}

	private function getRandomGallery($category)
	{
		return $category->galleries[array_rand($category->galleries)];
	}

	private function getRandomImage($category)
	{
		$uploadDirectory = wp_upload_dir();
		$images = glob($uploadDirectory['basedir'].$category->images.'/*.{jpg,jpeg,JPG,JPEG}', GLOB_BRACE);
		return $uploadDirectory['baseurl'].$category->images.'/'.basename($images[array_rand($images)]);
	}

}
