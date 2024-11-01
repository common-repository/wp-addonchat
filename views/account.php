<?php $posted = stripslashes_deep($_POST['addonchat-account']); ?>

<p><?php printf(__('Don\'t have an <a href="%s">AddonChat</a> account yet?  Fill out the following form to register for a free chat room today!  Items marked with a <span class="addonchat-mandatory">*</span> are mandatory.'), 'http://addonchat.com'); ?></p>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><label for="addonchat-account-email"><?php _e('Email <span class="addonchat-mandatory">*</span>'); ?></label></th>
			<td>
				<input class="regular-text" type="text" name="addonchat-account[email]" id="addonchat-account-email" value="<?php esc_attr_e($posted['email']); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-account-password"><?php _e('Password <span class="addonchat-mandatory">*</span>'); ?></label></th>
			<td>
				<input class="regular-text" type="password" name="addonchat-account[password]" id="addonchat-account-password" value="<?php esc_attr_e($posted['password']); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-account-password-verify"><?php _e('Password (Confirm) <span class="addonchat-mandatory">*</span>'); ?></label></th>
			<td>
				<input class="regular-text" type="password" name="addonchat-account[password-verify]" id="addonchat-account-password-verify" value="<?php esc_attr_e($posted['password-verify']); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-account-web-site"><?php _e('Web Site URL <span class="addonchat-mandatory">*</span>'); ?></label></th>
			<td>
				<input class="regular-text" type="text" name="addonchat-account[web-site]" id="addonchat-account-web-site" value="<?php if(empty($posted['web-site'])) { ?>http://<?php } else { esc_attr_e($posted['web-site']); } ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-account-chat-room-title"><?php _e('Chat Room Title <span class="addonchat-mandatory">*</span>'); ?></label></th>
			<td>
				<input class="regular-text" type="text" name="addonchat-account[chat-room-title]" id="addonchat-account-chat-room-title" value="<?php esc_attr_e($posted['chat-room-title']); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-account-first-name"><?php _e('First Name'); ?></label></th>
			<td>
				<input class="regular-text" type="text" name="addonchat-account[first-name]" id="addonchat-account-first-name" value="<?php esc_attr_e($posted['first-name']); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="addonchat-account-last-name"><?php _e('Last Name'); ?></label></th>
			<td>
				<input class="regular-text" type="text" name="addonchat-account[last-name]" id="addonchat-account-last-name" value="<?php esc_attr_e($posted['last-name']); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Terms of Use <span class="addonchat-mandatory">*</span>'); ?></th>
			<td>
				<label for="addonchat-account-terms-of-use">
					<input type="checkbox" name="addonchat-account[terms-of-use]" id="addonchat-account-terms-of-use" value="yes" <?php if($posted['terms-of-use'] == 'yes') { ?>checked="checked"<?php } ?> />
					<span class="addonchat-mandatory"><strong><?php _e('Yes'); ?></strong></span>, <?php printf(__('I agree to the <a target="_blank" href="%s">Terms of Use</a>'), 'http://addonchat.com/terms.html'); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Age Verification <span class="addonchat-mandatory">*</span>'); ?></th>
			<td>
				<label for="addonchat-account-age-verification">
					<input type="checkbox" name="addonchat-account[age-verification]" id="addonchat-account-age-verification" value="yes" <?php if($posted['age-verification'] == 'yes') { ?>checked="checked"<?php } ?> />
					<span class="addonchat-mandatory"><strong><?php _e('Yes'); ?></strong></span>, <?php printf(__('I am 13 years of age or older.')); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Send Updates'); ?></th>
			<td>
				<label for="addonchat-account-informed">
					<input type="checkbox" name="addonchat-account[informed]" id="addonchat-account-informed" value="yes" <?php if($posted['informed'] == 'yes') { ?>checked="checked"<?php } ?> />
					<span class="addonchat-mandatory"><strong><?php _e('Yes'); ?></strong></span>, <?php printf(__('please keep me informed of produce updates and new services.')); ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>

<p class="submit">
	<?php wp_nonce_field('addonchat-create-new-account', 'addonchat-create-new-account-nonce'); ?>
	<input type="submit" class="button button-primary" name="addonchat-create-new-account" id="addonchat-create-new-account" value="<?php _e('Create Account'); ?>" />
</p>