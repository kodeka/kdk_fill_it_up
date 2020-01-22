<?php
/*
 * Plugin Name:  Fill It Up (by Kodeka)
 * Plugin URI:   https://github.com/kodeka/kdk_fill_it_up
 * Description:  Dummy content & user generator for WordPress
 * Version:      1.0.3
 * Author:       Kodeka
 * Author URI:   https://kodeka.io
 * License:      GNU/GPL https://www.gnu.org/copyleft/gpl.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

define('FILLITUP_DIR', plugin_dir_path(__FILE__));

class FillItUp
{
    public function __construct()
    {
        add_action('init', array(
            $this,
            'init'
        ));

        add_action('admin_init', array(
            $this,
            'adminInit'
        ));

        add_action('admin_menu', array(
            $this,
            'adminMenu'
        ));

        add_action('admin_enqueue_scripts', array(
            $this,
            'adminEnqueueScripts'
        ));

        add_action('wp_ajax_ajax', array(
            $this,
            'ajax'
        ));
    }

    public function init()
    {
        load_plugin_textdomain('kdk_fill_it_up', false, dirname(plugin_basename(__FILE__)).'/languages/');
    }

    public function adminMenu()
    {
        // Options page menu link
        add_options_page('Fill It Up', 'Fill It Up', 'manage_options', 'fillitup-options', array(
            $this,
            '_settings'
        ));
        add_menu_page('Fill It Up', 'Fill It Up', 'manage_options', 'fillitup/admin/index.php', '', 'data:image/svg+xml;base64,'.base64_encode(file_get_contents(FILLITUP_DIR.'admin/assets/images/fillitup.svg')));
        add_submenu_page('fillitup/admin/index.php', 'Generator', 'Generator', 'manage_options', 'fillitup/admin/index.php');
        add_submenu_page('fillitup/admin/index.php', 'Settings', 'Settings', 'manage_options', 'options-general.php?page=fillitup-options');
    }

    public function _settings()
    {
        echo '<div class="wrap"><h2>'.__('Settings for Fill It Up', 'kdk_fill_it_up').'</h2><form method="post" action="options.php">';
        settings_fields('basic');
        do_settings_sections('fillitup-section');
        submit_button();
        echo '<p>'.__('Hint: make sure the remote URL ends in .json - it would be awesome if you had a look at the <a href="https://github.com/kodeka/kdk_fill_it_up">documentation</a> as well :)', 'kdk_fill_it_up').'</p></form></div>';
    }

    public function adminInit()
    {
        register_setting('basic', 'definitionsUrl');

        add_settings_section('section', '', array(
            $this,
            '_section'
        ), 'fillitup-section');

        add_settings_field('definitionsUrl', 'Data Definitions URL', array(
            $this,
            'definitions_url_callback'
        ), 'fillitup-section', 'section');
    }

    /**
     * Print the Section text
     */
    public function _section()
    {
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function definitions_url_callback()
    {
        $value = get_option('definitionsUrl');
        printf('<input type="text" id="definitionsUrl" name="definitionsUrl" value="%s" size="100" />', esc_attr($value));
    }

    public function adminEnqueueScripts()
    {
        $screen = get_current_screen();
        if ($screen->id == 'fillitup/admin/index' || $screen->id == 'settings_page_fillitup-options') {
            wp_enqueue_script('fillitup', plugins_url('/fillitup/admin/assets/js/fillitup.js'), array('jquery'), '1.0.3');
            wp_enqueue_style('fillitup', plugins_url('/fillitup/admin/assets/css/fillitup.css'), array(), '1.0.3');
        }
    }

    public function ajax()
    {
        require FILLITUP_DIR.'admin/index.php';
        die ;
    }
}

$instance = new FillItUp();
