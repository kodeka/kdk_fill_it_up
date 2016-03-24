<div class="wrap">
	<h2 class="plugin-title">Fill It Up</h2>
	<div id="fillitup-form-container">
		<p><?php _e('Mass generate dummy content and users in WordPress', 'jw_fillitup'); ?></p>
		<form method="post" id="fillitup-generate-form">
		<table class="form-table">
			<tr>
				<th scope="row"><label><?php _e('Post Type', 'jw_fillitup'); ?></label></th>
				<td>
					<select name="type">
						<?php foreach ($postTypes as $postType): ?>
						<option value="<?php echo $postType->name; ?>"><?php echo $postType->label; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Items to generate', 'jw_fillitup'); ?></label></th>
				<td><input type="number" name="total" min="1" step="1" value="20" /></td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Generate images', 'jw_fillitup'); ?></label></th>
				<td><input type="checkbox" name="images" value="1" checked="checked" /></td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Generate image galleries', 'jw_fillitup'); ?></label></th>
				<td><input type="checkbox" name="galleries" value="1" checked="checked" /></td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Generate videos', 'jw_fillitup'); ?></label></th>
				<td><input type="checkbox" name="videos" value="1" checked="checked" /></td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php _e('Generated items author', 'jw_fillitup'); ?></label>
				</th>
				<td>
					<label><input type="radio" name="author" value="self" checked="checked" /><?php _e('Yourself', 'jw_fillitup'); ?></label>
					<label><input type="radio" name="author" value="random" /><?php _e('Random users (set # below)', 'jw_fillitup'); ?></label>
				</td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Number of random users to generate', 'jw_fillitup'); ?></label></th>
				<td><input type="number" name="users" min="0" step="1" value="0" /></td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Which role should we apply to generated users?', 'jw_fillitup'); ?></label></th>
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
		<?php submit_button(__('Generate', 'jw_fillitup')); ?>
		</form>
	</div>
	<div id="fillitup-progress-container" style="display:none;">
		<p><b><?php _e('Please do not leave this page until the process has finished...', 'jw_fillitup'); ?></b></p>
		<div id="fillitup-percentage">0%</div>
	    <div id="fillitup-status">
	        <div id="fillitup-status-bar"></div>
	    </div>
    </div>
    <div id="fillitup-completed-message" style="display:none;">
    	<h3><?php _e('Success!', 'jw_fillitup'); ?></h3>
    	<a href="admin.php?page=fillitup/admin/index.php" class="button button-primary"><?php _e('Back to Fill It Up', 'jw_fillitup'); ?></a> <?php _e('or', 'jw_fillitup'); ?> <a id="fillitup-start-over-button" href="#" class="button button-primary"><?php _e('Start Over', 'jw_fillitup'); ?></a>
    	<img id="fillitup-success-img" src="//cdn.joomlaworks.org/fillitup/gifs/sam_rockwell_yeah.gif" alt="Success!" />
    </div>
	<div id="fillItUpAdminFooter">
		<a target="_blank" href="http://www.joomlaworks.net/fill-it-up">Fill It Up v1.0.1</a> | Copyright &copy; 2006-<?php echo date('Y'); ?> <a target="_blank" href="http://www.joomlaworks.net/">JoomlaWorks Ltd.</a>
	</div>
</div>
