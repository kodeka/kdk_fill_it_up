<?php
/**
 * @version    1.0.x
 * @package    Fill It Up
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class FillItUpViewPosts
{
	public $layout = 'posts';

	public function display()
	{
		$native = array();
		$native[] = get_post_type_object('post');
		$native[] = get_post_type_object('page');

		$args = array(
			'public' => true,
			'_builtin' => false
		);
		$custom = get_post_types($args, 'objects');

		$postTypes = array_merge($native, $custom);

		$layout = WP_PLUGIN_DIR.'/fillitup/admin/layouts/'.$this->layout.'.php';
		ob_start();
		include $layout;
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}

}
