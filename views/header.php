<div class="themes-php">
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2 class="nav-tab-wrapper" id="addonchat-settings-header-line">
			<a href="<?php esc_attr_e(admin_url('options-general.php?page=addonchat&tab=settings')); ?>" class="nav-tab <?php if(empty($_GET['tab']) || $_GET['tab'] == 'settings') { echo 'nav-tab-active'; } ?>"><?php _e('Settings'); ?></a>
			
			<?php if(empty($settings['account-id'])) { ?>
			<a href="<?php esc_attr_e(admin_url('options-general.php?page=addonchat&tab=account')); ?>" class="nav-tab <?php if($_GET['tab'] == 'account') { echo 'nav-tab-active'; } ?>"><?php _e('New Account'); ?></a>
			<?php } ?>
			
			<?php if('yes' == $settings['use-remote-authentication']) { ?>
			<a href="<?php esc_attr_e(admin_url('options-general.php?page=addonchat&tab=permissions')); ?>" class="nav-tab <?php if($_GET['tab'] == 'permissions') { echo 'nav-tab-active'; } ?>"><?php _e('RAC Settings'); ?></a>
			<?php } ?>
		</h2>

		<?php if(!empty($this->_cached_Error)) { ?>
		<div id="addonchat-account-not-created-message" class="error fade"><p><?php printf(__('<strong>Account could not be created</strong>: %s'), $this->_cached_Error); ?></p></div>
		<?php } ?>

		<?php if(!empty($this->_cached_SettingsError)) { ?>
		<div id="addonchat-settings-not-saved-message" class="error fade"><p><?php printf(__('<strong>Settings could not be saved</strong>: %s'), $this->_cached_SettingsError); ?></p></div>
		<?php } ?>

		<?php if($_GET['new-account'] == 'true') { ?>
		<div id="addonchat-account-created-message" class="updated fade">
			<p><strong><?php _e('New account created.'); ?></strong></p>
			<p><?php printf(__('You can now <a href="%s">login</a> using your chosen email address and password.  You are current using the <strong>Free</strong> edition of AddonChat.  If you wish to make use of all WordPress integration features, please upgrade to the <strong>Professional Plus</strong> edition.'), 'http://addonchat.com'); ?></p>
		</div>
		<?php } ?>


		<form autocomplete="off" method="post" action="<?php esc_attr_e(add_query_arg(array('updated' => null, 'new-account' => null))); ?>">
			<div id="addonchat-content">
