<form method="post" action="<?php esc_attr_e(admin_url('options-general.php?page=addonchat&tab=permissions')); ?>">

	<p><?php _e('For each permission available for the AddonChat platform, you can choose a WordPress role that has access to it.  The defaults are sensible, but you can customize them as you see fit.  These settings only apply if you have enabled Remote Authentication.'); ?></p>

	<?php $permissions = $this->getPermissions(); ?>

	<?php foreach($this->_permission_Options as $section) { ?>

	<h3><?php esc_html_e($section['section']); ?></h3>
	<table class="form-table">
		<tbody>
			<?php foreach($section['permissions'] as $perm => $data) { ?>
			<tr>
				<th class="scope"><label for="addonchat-permissions-<?php echo $perm; ?>"><?php echo $data['name']; ?></label></th>
				<td>
					<select name="addonchat-permissions[<?php echo $perm; ?>]" id="addonchat-permissions-<?php echo $perm; ?>">
						<option <?php selected('disabled', $permissions[$perm]); ?> value="disabled"><?php _e('--DISABLED--'); ?>
						<option <?php selected('activate_plugins', $permissions[$perm]); ?> value="activate_plugins"><?php _e('Administrator'); ?></option>
						<option <?php selected('moderate_comments', $permissions[$perm]); ?> value="moderate_comments"><?php _e('Editor'); ?></option>
						<option <?php selected('edit_published_posts', $permissions[$perm]); ?> value="edit_published_posts"><?php _e('Author'); ?></option>
						<option <?php selected('edit_posts', $permissions[$perm]); ?> value="edit_posts"><?php _e('Contributor'); ?></option>
						<option <?php selected('read', $permissions[$perm]); ?> value="read"><?php _e('Subscriber'); ?></option>
					</select>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } ?>
	
	<h3><?php _e('Other Settings'); ?></h3>
	<p><?php _e('The following settings apply to all users, regardless of level.'); ?></p>
	<table class="form-table">
		<tbody>
			<?php foreach($this->_permission_NonBooleanOptions as $nbdata) { ?>
				<tr>
					<th scope="row"><label for="addonchat-permissions-non-boolean-<?php echo $nbdata['key']; ?>"><?php esc_html_e($nbdata['name']); ?></label></th>
					<td>
						<input type="text" name="addonchat-permissions[non-boolean][<?php echo $nbdata['key']; ?>]" id="addonchat-permissions-non-boolean-<?php echo $nbdata['key']; ?>" value="<?php esc_attr_e($permissions['non-boolean'][$nbdata['key']]); ?>" />
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<h3><?php _e('Pawn Color'); ?></h3>
	<table class="form-table">
		<tbody>
			<?php $levels = array('read' => __('Subscriber'), 'edit_posts' => __('Contributor'), 'edit_published_posts' => __('Author'), 'moderate_comments' => __('Editor'), 'activate_plugins' => __('Administrator')); ?>
			<?php foreach($levels as $key => $title) { ?>
				<tr>
					<th scope="row"><label for="addonchat-permissions-pawn-color-<?php echo $key; ?>"><?php esc_html_e($title); ?></label></th>
					<td>
						<select name="addonchat-permissions[pawn-color][<?php echo $key; ?>]" id="addonchat-permissions-pawn-color-<?php echo $key; ?>">
							<option <?php selected(0, $permissions['pawn-color'][$key]); ?> value="0"><?php _e('Blue'); ?></option>
							<option <?php selected(1, $permissions['pawn-color'][$key]); ?> value="1"><?php _e('Green'); ?></option>
							<option <?php selected(2, $permissions['pawn-color'][$key]); ?> value="2"><?php _e('Red'); ?></option>
							<option <?php selected(3, $permissions['pawn-color'][$key]); ?> value="3"><?php _e('Yellow'); ?></option>
							<option <?php selected(4, $permissions['pawn-color'][$key]); ?> value="4"><?php _e('White'); ?></option>
						</select>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<p class="submit">
		<?php wp_nonce_field('addonchat-set-permissions', 'addonchat-set-permissions-nonce'); ?>
		<input class="button button-primary" type="submit" name="addonchat-set-permissions" id="addonchat-set-permissions" value="<?php _e('Save Changes'); ?>" />
	</p>

</form>