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
								<th><?php _e('System Information', 'jw_fillitup'); ?></th>
								<th><?php _e('Credits', 'jw_fillitup'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="fillItUpInformation">
								<table class="adminlist table-striped">
									<thead>
										<tr>
											<th><?php _e('Check', 'jw_fillitup'); ?></th>
											<th><?php _e('Result', 'jw_fillitup'); ?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong><?php _e('PHP Version', 'jw_fillitup'); ?></strong></td>
											<td><?php echo $this->info['php']; ?></td>
										</tr>
										<tr>
											<td><strong><?php _e('GD Image Library', 'jw_fillitup'); ?></strong></td>
											<td><?php echo ($this->info['gd'])? $this->info['gd'] : JText::_('Disabled', 'jw_fillitup'); ?></td>
										</tr>
										<tr>
											<td><strong><?php _e('Memory Limit', 'jw_fillitup'); ?></strong></td>
											<td><?php echo $this->info['memory']; ?></td>
										</tr>
									</tbody>
								</table>
								</td>
								<td class="fillItUpCredits">
										<table class="adminlist table-striped">
												<thead>
														<tr>
																<th><?php _e('Provider', 'jw_fillitup'); ?></th>
																<th><?php _e('Version', 'jw_fillitup'); ?></th>
																<th><?php _e('Type', 'jw_fillitup'); ?></th>
																<th><?php _e('License', 'jw_fillitup'); ?></th>
														</tr>
												</thead>
												<tbody>
														<tr>
																<td><a target="_blank" href="https://github.com/fzaninotto/Faker">Faker</a></td>
																<td>1.5.0</td>
																<td><?php _e('PHP class', 'jw_fillitup'); ?></td>
																<td><?php _e('MIT', 'jw_fillitup'); ?></td>
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
					<h2><?php _e('About', 'jw_fillitup'); ?></h2>
					<div class="inside">
						<?php _e('Fill It Up is a simple tool you can use to mass generate dummy content & users for your WordPress website. By using Fill It Up you speed up the initial development process until actual, proper content is in place.', 'jw_fillitup'); ?>
					</div>
				</div>
				<a href="admin.php?page=fillitup/admin/index.php&amp;view=posts" class="button button-primary button-large"><?php _e('Generate content & users', 'jw_fillitup'); ?></a>
			</div>
		</div>
		<div id="fillItUpAdminFooter">
			<a target="_blank" href="https://github.com/kodeka/kdk_fill_it_up">Fill It Up v1.0.2</a> | Copyright &copy; 2018-<?php echo date('Y'); ?> <a target="_blank" href="https://kodeka.io">Kodeka OÜ</a>.
		</div>
	</div>
</div>
