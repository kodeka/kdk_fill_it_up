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
    <div id="poststuff">
        <div id="col-container" class="metabox-holder">
            <div id="col-right">
                <div class="fillItUpContainer col-wrap">
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th><?php _e('System Information', 'kdk_fill_it_up'); ?></th>
                                <th><?php _e('Credits', 'kdk_fill_it_up'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fillItUpInformation">
                                    <table class="adminlist table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php _e('Check', 'kdk_fill_it_up'); ?></th>
                                                <th><?php _e('Result', 'kdk_fill_it_up'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong><?php _e('PHP Version', 'kdk_fill_it_up'); ?></strong></td>
                                                <td><?php echo $this->info['php']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong><?php _e('GD Image Library', 'kdk_fill_it_up'); ?></strong></td>
                                                <td><?php echo ($this->info['gd'])? $this->info['gd'] : JText::_('Disabled', 'kdk_fill_it_up'); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong><?php _e('Memory Limit', 'kdk_fill_it_up'); ?></strong></td>
                                                <td><?php echo $this->info['memory']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="fillItUpCredits">
                                    <table class="adminlist table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php _e('Provider', 'kdk_fill_it_up'); ?></th>
                                                <th><?php _e('Version', 'kdk_fill_it_up'); ?></th>
                                                <th><?php _e('Type', 'kdk_fill_it_up'); ?></th>
                                                <th><?php _e('License', 'kdk_fill_it_up'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a target="_blank" href="https://github.com/fzaninotto/Faker">Faker</a></td>
                                                <td>1.5.0</td>
                                                <td><?php _e('PHP class', 'kdk_fill_it_up'); ?></td>
                                                <td><?php _e('MIT', 'kdk_fill_it_up'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="col-left">
                <div class="postbox col-wrap">
                    <h2><?php _e('About', 'kdk_fill_it_up'); ?></h2>
                    <div class="inside">
                        <?php _e('Fill It Up is a simple tool you can use to mass generate dummy content & users for your WordPress website. By using Fill It Up you speed up the initial development process until actual, proper content is in place.', 'kdk_fill_it_up'); ?>
                    </div>
                </div>
                <a href="admin.php?page=kdk_fill_it_up/admin/index.php&amp;view=posts" class="button button-primary button-large"><?php _e('Generate content & users', 'kdk_fill_it_up'); ?></a>
            </div>
            <div class="clr"></div>
        </div>
        <div id="fillItUpAdminFooter">
            <a target="_blank" href="https://github.com/kodeka/kdk_fill_it_up">Fill It Up v1.0.3</a> | Copyright &copy; 2018-<?php echo date('Y'); ?> <a target="_blank" href="https://kodeka.io">Kodeka OÜ</a>.
        </div>
    </div>
</div>
