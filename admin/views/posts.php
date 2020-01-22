<?php
/**
 * @version    1.x
 * @package    Fill It Up (Plugin)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
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

        $layout = FILLITUP_DIR.'admin/layouts/'.$this->layout.'.php';
        ob_start();
        include $layout;
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
