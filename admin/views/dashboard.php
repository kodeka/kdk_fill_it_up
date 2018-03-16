<?php
/**
 * @version    1.0.x
 * @package    Fill It Up
 * @author     JoomlaWorks https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2018 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class FillItUpViewDashboard
{
    public $layout = 'dashboard';

    public function display()
    {
        $info = array();
        $info['php'] = phpversion();
        if (extension_loaded('gd')) {
            $gdinfo = gd_info();
            $info['gd'] = $gdinfo['GD Version'];
        } else {
            $info['gd'] = false;
        }
        $info['memory'] = ini_get('memory_limit');
        $this->info = $info;

        $layout = FILLITUP_DIR.'admin/layouts/'.$this->layout.'.php';
        ob_start();
        include $layout;
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
