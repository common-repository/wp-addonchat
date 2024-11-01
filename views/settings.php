<p><?php printf(__('The use of the WP-AddonChat plugin requires that you have a valid <a target="_blank" href="%s">AddonChat</a> account.  If you don\'t you can easily <a href="%s">sign up</a> for one.'), 'http://addonchat.com/', admin_url('options-general.php?page=addonchat&tab=account')); ?></p>

<h3><?php _e('Chat Room'); ?></h3>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><label for="addonchat-account-id"><?php _e('AddonChat Account ID'); ?></label></th>
			<td>
				<input class="regular-text" type="text" name="addonchat[account-id]" id="addonchat-account-id" value="<?php esc_attr_e($settings['account-id']); ?>" /><br />
				<small><?php _e('In your account panel look for the account number formatted <code>SC-######</code>. Enter the number in this field.'); ?></small>
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-password"><?php _e('AddonChat Password'); ?></label></th>
			<td>
				<input class="regular-text" type="password" name="addonchat[password]" id="addonchat-password" value="" /><br />
				<small><?php _e('If you are changing the account settings in this section, you <strong>must</strong> enter your password.'); ?></small>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Remote Authentication'); ?></th>
			<td>
				<label for="addonchat-use-remote-authentication">
					<input type="checkbox" <?php checked($settings['use-remote-authentication'], 'yes'); ?> name="addonchat[use-remote-authentication]" id="addonchat-use-remote-authentication" value="yes" />
					<?php _e('I want to enable the remote authentication system so my existing WordPress users have access to my AddonChat chat room.'); ?>
				</label>
			</td>
		</tr>
		<tr id="addonchat-guest-access-container">
			<th scope="row"><?php _e('Guest Access'); ?></th>
			<td>
				<label for="addonchat-guest-access">
					<input type="checkbox" <?php checked($settings['guest-access'], 'yes'); ?> name="addonchat[guest-access]" id="addonchat-guest-access" value="yes" />
					<?php _e('I want to allow anyone to log in to my chat room, not just WordPress users.'); ?>
				</label>
			</td>
		</tr>
		<tr id="addonchat-automatic-login-container">
			<th scope="row"><label for="addonchat-automatic-login"><?php _e('Automatic Login'); ?></label></th>
			<td>
				<label>
					<input type="checkbox" <?php checked($settings['automatic-login'], 'yes'); ?> name="addonchat[automatic-login]" id="addonchat-automatic-login" value="yes" />
					<?php _e('Automatically log a user into the chat applet if they are logged in to WordPress.'); ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>

<h3><?php _e('General'); ?></h3>
<table class="form-table">
	<tr>
		<th scope="row"><label for="addonchat-height"><?php _e('Default Height'); ?></label></th>
		<td>
			<input class="small-text" type="text" name="addonchat[height]" id="addonchat-height" value="<?php esc_attr_e($settings['height']); ?>" />
			<select name="addonchat[height-type]" id="addonchat-height-type">
				<option <?php selected($settings['height-type'], 'pixels'); ?> value="pixels"><?php _e('Pixels'); ?></option>
				<option <?php selected($settings['height-type'], 'percent'); ?> value="percent"><?php _e('Percent'); ?></option>
			</select>
			<br />
			<small><?php _e('The default height of the AddonChat applet.'); ?></small>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="addonchat-width"><?php _e('Default Width'); ?></label></th>
		<td>
			<input class="small-text" type="text" name="addonchat[width]" id="addonchat-width" value="<?php esc_attr_e($settings['width']); ?>" />
			<select name="addonchat[width-type]" id="addonchat-width-type">
				<option <?php selected($settings['width-type'], 'pixels'); ?> value="pixels"><?php _e('Pixels'); ?></option>
				<option <?php selected($settings['width-type'], 'percent'); ?> value="percent"><?php _e('Percent'); ?></option>
			</select>
			<br />
			<small><?php _e('The default width of the AddonChat applet.'); ?></small>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Chat Popup'); ?></th>
		<td>
			<label for="addonchat-new-window">
				<input type="checkbox" <?php checked($settings['new-window'], 'yes'); ?> name="addonchat[new-window]" id="addonchat-new-window" value="yes" />
				<?php _e('I want a link to appear underneath the chat applet that allows users to open the applet in a new window.'); ?>
			</label>
		</td>
	</tr>
</table>

<p class="submit">
	<input type="hidden" name="addonchat[server]" id="addonchat-server" value="<?php esc_attr_e($settings['server']); ?>" />
	<input type="hidden" name="addonchat[port]" id="addonchat-port" value="<?php esc_attr_e($settings['port']); ?>" />
	<?php wp_nonce_field('save-addonchat-settings', 'save-addonchat-settings-nonce'); ?>
	<input type="submit" class="button button-primary" name="save-addonchat-settings" id="save-addonchat-settings" value="<?php _e('Save Changes'); ?>" />
</p>