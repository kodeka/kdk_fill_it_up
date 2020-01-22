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

?>

<div class="wrap">
    <h2 class="plugin-title">Fill It Up</h2>
    <div id="fillitup-form-container">
        <p><?php _e('Mass generate dummy content and users in WordPress', 'kdk_fill_it_up'); ?></p>
        <form method="post" id="fillitup-generate-form">
        <table class="form-table">
            <tr>
                <th scope="row"><label><?php _e('Post Type', 'kdk_fill_it_up'); ?></label></th>
                <td>
                    <select name="type">
                        <?php foreach ($postTypes as $postType): ?>
                        <option value="<?php echo $postType->name; ?>"><?php echo $postType->label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Items to generate', 'kdk_fill_it_up'); ?></label></th>
                <td><input type="number" name="total" min="1" step="1" value="20" /></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Generate images', 'kdk_fill_it_up'); ?></label></th>
                <td><input type="checkbox" name="images" value="1" checked="checked" /></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Generate image galleries', 'kdk_fill_it_up'); ?></label></th>
                <td><input type="checkbox" name="galleries" value="1" checked="checked" /></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Generate videos', 'kdk_fill_it_up'); ?></label></th>
                <td><input type="checkbox" name="videos" value="1" checked="checked" /></td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Generated items author', 'kdk_fill_it_up'); ?></label>
                </th>
                <td>
                    <label><input type="radio" name="author" value="self" checked="checked" /><?php _e('Yourself', 'kdk_fill_it_up'); ?></label>
                    <label><input type="radio" name="author" value="random" /><?php _e('Random users (set # below)', 'kdk_fill_it_up'); ?></label>
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Number of random users to generate', 'kdk_fill_it_up'); ?></label></th>
                <td><input type="number" name="users" min="0" step="1" value="0" /></td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Which role should we apply to generated users?', 'kdk_fill_it_up'); ?></label></th>
                <td>
                    <select name="role">
                        <?php wp_dropdown_roles('editor'); ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="hidden" name="offset" value="1" />
        <input type="hidden" name="definitions" value="" />
        <?php wp_nonce_field(); ?>
        <?php submit_button(__('Generate', 'kdk_fill_it_up')); ?>
        </form>
    </div>
    <div id="fillitup-progress-container" style="display:none;">
        <p><b><?php _e('Please do not leave this page until the process has finished...', 'kdk_fill_it_up'); ?></b></p>
        <div id="fillitup-percentage">0%</div>
        <div id="fillitup-status">
            <div id="fillitup-status-bar"></div>
        </div>
    </div>
    <div id="fillitup-completed-message" style="display:none;">
        <h3><?php _e('Success!', 'kdk_fill_it_up'); ?></h3>
        <a href="admin.php?page=kdk_fill_it_up/admin/index.php" class="button button-primary"><?php _e('Back to Fill It Up', 'kdk_fill_it_up'); ?></a> <?php _e('or', 'kdk_fill_it_up'); ?> <a id="fillitup-start-over-button" href="#" class="button button-primary"><?php _e('Start Over', 'kdk_fill_it_up'); ?></a>
        <img id="fillitup-success-img" src="<?php echo plugins_url(); ?>/kdk_fill_it_up/admin/assets/images/sam_rockwell_yeah.gif" alt="Success!" />
    </div>
    <div id="fillItUpAdminFooter">
        <a target="_blank" href="https://github.com/kodeka/kdk_fill_it_up">Fill It Up v1.0.3</a> | Copyright &copy; 2018-<?php echo date('Y'); ?> <a target="_blank" href="https://kodeka.io">Kodeka OÜ</a>.
    </div>
</div>
