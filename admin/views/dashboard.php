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
