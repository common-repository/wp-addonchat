<?php
/*
 Plugin Name: WP-AddonChat
 Plugin URI: http://www.addonchat.com
 Description: WP-AddonChat allows for the simple and painless integration of AddonInteractive's popular AddonChat software into your WordPress site.
 Author: Nick Ohrn of Plugin-Developer.com
 Version: 2.0.0
 Author URI: http://www.plugin-developer.com/
 */

if(!class_exists('AddonChat')) {
	class AddonChat {

		var $_cached_Error = null;
		var $_cached_SettingsError = null;

		var $_option_AddonChatSettings = '_addonchat_settings';
		var $_option_AddonChatSettingsDefaults = array();

		var $_option_AddonChatPermissions = '_addonchat_permission_settings';
		var $_option_AddonChatPermissionsDefaults = array();

		var $_permission_NonBooleanOptions = array(
			array('key' => 'post_delay', 'name' => 'Time Delay between Messages', 'default' => '0'),
			array('key' => 'max_msg_length', 'name' => 'Maximum Message Length (chars)', 'default' => '1000'),
		);
		var $_permission_Options = array(
			array(
				'section' => 'General',
				'permissions' => array(
					'can_login' => array('permission' => 'read', 'name' => 'Can Login'),
					'can_msg' => array('permission' => 'read', 'name' => 'Can Message'),
				),
			),
			array(
				'section' => 'Non-Administrative',
				'permissions' => array(
					'can_action' => array('permission' => 'read', 'name' => 'Can Send Action Messages'),
					'allow_pm' => array('permission' => 'read', 'name' => 'Permit Private Messages'),
					'allow_room_create' => array('permission' => 'moderate_comments', 'name' => 'Allow Creation of New Rooms'),
					'allow_avatars' => array('permission' => 'read', 'name' => 'Allow User to Select Avatar'),
					'can_random' => array('permission' => 'moderate_comments', 'name' => 'Permit the Use of <code>/roll</code>'),
					'allow_bbcode' => array('permission' => 'read', 'name' => 'Allow Use of BBCode'),
					'allow_code' => array('permission' => 'read', 'name' => 'Allow Use of Color'),
					'msg_scroll' => array('permission' => 'read', 'name' => 'Enable Message Scroll-Back'),
					'filter_shout' => array('permission' => 'edit_posts', 'name' => 'Apply Shout Filter Below This Level', 'descending' => true),
					'filter_profanity' => array('permission' => 'edit_posts', 'name' => 'Apply Profanity Filter Below This Level', 'descending' => true),
					'filter_word_replace' => array('permission' => 'edit_posts', 'name' => 'Apply Word Replace Filters Below This Level', 'descending' => true),
					'can_nick' => array('permission' => 'read', 'name' => 'Permit User To Use <code>/nick</code>'),
				),
			),
			array(
				'section' => 'Administrative',
				'permissions' => array(
					'is_admin' => array('permission' => 'activate_plugins', 'name' => 'Define as Administrator'),
					'allow_html' => array('permission' => 'activate_plugins', 'name' => 'Allow HTML Content in Messages'),
					'can_kick' => array('permission' => 'activate_plugins', 'name' => 'Permission to Kick Other Users'),
					'can_affect_admin' => array('permission' => 'activate_plugins', 'name' => 'Can Affect Other Administrators'),
					'can_grant' => array('permission' => 'activate_plugins', 'name' => 'Can Grant Administrator Priveleges'),
					'can_cloak' => array('permission' => 'activate_plugins', 'name' => 'Can Cloak Themselves'),
					'can_see_cloak' => array('permission' => 'activate_plugins', 'name' => 'Can See Cloaked Users'),
					'login_cloaked' => array('permission' => 'activate_plugins', 'name' => 'Log In Cloaked'),
					'can_ban' => array('permission' => 'activate_plugins', 'name' => 'Can Ban IP Addresses'),
					'can_ban_subnet' => array('permission' => 'activate_plugins', 'name' => 'Can Ban Class C IP Addresses'),
					'can_system_speak' => array('permission' => 'activate_plugins', 'name' => 'Can Speak As System User'),
					'can_silence' => array('permission' => 'activate_plugins', 'name' => 'Can Silence Other Users'),
					'can_fnick' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Use <code>/fnick</code>'),
					'can_launch_website' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Launch Websites for Other Users'),
					'can_transfer' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Transfer Users to Another Room'),
					'can_join_nopw' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Join Password Protected Rooms Freely'),
					'can_topic' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Set Room Topics'),
					'can_close' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Close Rooms'),
					'can_ipquery' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Query IP Addresses of Other Users'),
					'can_geo_locate' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Query Geographic Location of Other Users'),
					'can_query_ether' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Query Ether'),
					'can_clear_screen' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Clear Screens of Other Users'),
					'can_clear_history' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Clear Recent Room History'),
					'allow_img_tag' => array('permission' => 'activate_plugins', 'name' => 'Permit Use of BBCode IMG Tag'),
				),
			),
			array(
				'section' => 'Enterprise',
				'permissions' => array(
					'is_speaker' => array('permission' => 'activate_plugins', 'name' => 'Define as Guest Speaker'),
					'is_super_moderator' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Moderate Events'),
					'can_enable_moderation' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Enable Room Moderation'),
					'is_unmoderated' => array('permission' => 'activate_plugins', 'name' => 'Permit User to Send Unmoderated Messages'),
				),
			),
		);

		function AddonChat() {
			$this->addActions();
			$this->addFilters();
			$this->addShortcodes();
			$this->initializeDefaults();
		}

		function addActions() {
			add_action('admin_init', array(&$this, 'processAdministrativeActions'));
			add_action('admin_menu', array(&$this, 'addAdministrativeInterfaceItems'));
			add_action('parse_request', array(&$this, 'showRemoteAuthenticationSystemData'));
		}

		function addFilters() {

		}

		function addShortcodes() {
			add_shortcode('addonchat', array(&$this, 'shortcode'));
		}

		function initializeDefaults() {
			global $content_width;

			$width = $content_width;
			if(empty($width)) {
				$width = 600;
			}

			$this->_option_AddonChatSettingsDefaults = array(
				'height' => 425,
				'height-type' => 'pixels',
				'width' => $width,
				'width-type' => 'pixels'
			);

			foreach($this->_permission_Options as $section) { foreach($section['permissions'] as $key => $data) {
				$this->_option_AddonChatPermissionsDefaults[$key] = $data['permission'];
			} }
			
			foreach($this->_permission_NonBooleanOptions as $nbdata) {
				$this->_option_AddonChatPermissionsDefaults['non-boolean'][$nbdata['key']] = $nbdata['default'];
			}
		}

		/// CALLBACKS

		function addAdministrativeInterfaceItems() {
			$slug = add_options_page(__('AddonChat'), __('AddonChat'), 'manage_options', 'addonchat', array(&$this, 'displaySettingsPage'));

			add_action('admin_print_styles-'.$slug, array(&$this, 'enqueueResources'));
		}

		function enqueueResources() {
			wp_enqueue_script('addonchat-admin', plugins_url('resources/admin.js', __FILE__), array('jquery'));
			wp_enqueue_style('addonchat-admin', plugins_url('resources/admin.css', __FILE__));
		}

		function processAdministrativeActions() {
			$data = stripslashes_deep($_POST);

			if(isset($data['save-addonchat-settings']) && is_array($data['addonchat']) && wp_verify_nonce($data['save-addonchat-settings-nonce'], 'save-addonchat-settings')) {
				$results = $this->processSettingsSave($data['addonchat']);

				if(true === $results) {
					wp_redirect(admin_url('options-general.php?page=addonchat&tab=settings&updated=true'));
					exit();
				} else {
					$this->_cached_SettingsError = $results['error'];
				}
			}

			if(isset($data['addonchat-create-new-account']) && is_array($data['addonchat-account']) && wp_verify_nonce($data['addonchat-create-new-account-nonce'], 'addonchat-create-new-account')) {
				$results = $this->processSignup($data['addonchat-account']);

				if(true === $results) {
					wp_redirect(admin_url('options-general.php?page=addonchat&tab=settings&new-account=true'));
					exit();
				} else {
					$this->_cached_Error = $results['error'];
				}
			}

			if(isset($data['addonchat-set-permissions']) && is_array($data['addonchat-permissions']) && wp_verify_nonce($data['addonchat-set-permissions-nonce'], 'addonchat-set-permissions')) {
				$permissions = $data['addonchat-permissions'];

				$this->savePermissions($permissions);

				wp_redirect(admin_url('options-general.php?page=addonchat&tab=permissions&updated=true'));
			}
		}

		function shortcode($atts, $content) {
			$settings = $this->getSettings();

			$atts = shortcode_atts(
			array(
					'width' => $settings['width'],
					'width-type' => $settings['width-type'],
					'height' => $settings['height'],
					'height-type' => $settings['height-type']
			), $atts);

			$id = $settings['account-id'];

			$width = $atts['width-type'] == 'percent' ? "{$atts['width']}%" : $atts['width'];
			$height = $atts['height-type'] == 'percent' ? "{$atts['height']}%" : $atts['height'];

			$popup = $settings['new-window'] == 'yes';
			$server = $settings['server'];
			
			$autologin = $settings['automatic-login'] == 'yes';
			$rac = $settings['use-remote-authentication'] == 'yes';

			include('views/room.php');
		}

		function showRemoteAuthenticationSystemData() {
			$data = stripslashes_deep($_REQUEST);
			if(isset($data['addonchat_remote_authentication']) && $data['addonchat_remote_authentication'] == 1) {
				header("Content-type: text/plain");

				$data = $this->compensateForIncorrectlyConstructedUrls($data);
				$permissions = $this->getPermissions();
				
				$user = $this->getRACUser($data['username'], $data['password']);

				if(is_wp_error($user)) {
					include('views/ras-blocked.php');
				} else {
					include('views/ras.php');
				}

				exit();
			}
		}

		/// DISPLAY CALLBACKS

		function displaySettingsPage() {
			$settings = $this->getSettings();

			include('views/header.php');
			switch($_GET['tab']) {
				case 'account':
					include('views/account.php');
					break;
				case 'permissions':
					include('views/permissions.php');
					break;
				case 'settings':
				default:
					include('views/settings.php');
					break;
			}
			include('views/footer.php');
		}

		/// SETTINGS

		function attemptToRetrieveLegacySettings() {
			$settings = array();

			$room = get_option('addonchat_room_id');
			if(!empty($room)) {
				$settings['account-id'] = $room;
			}
			delete_option('addonchat_room_id');

			$remote = get_option('addonchat_use_ras');
			if(!empty($remote) && $remote == 'yes') {
				$settings['use-remote-authentication'] = 'yes';
			}
			delete_option('addonchat_use_ras');

			$guest = get_option('addonchat_enable_guest');
			if(!empty($guest) && $guest == 'yes') {
				$settings['guest-access'] = 'yes';
			}
			delete_option('addonchat_enable_guest');

			$height = get_option('addonchat_default_height');
			if(!empty($height) && is_numeric($height)) {
				$settings['height'] = absint($height);
			}
			delete_option('addonchat_default_height');

			$width = get_option('addonchat_default_width');
			if(!empty($width) && is_numeric($width)) {
				$settings['width'] = absint($width);
			}
			delete_option('addonchat_default_width');

			$new = get_option('addonchat_display_newwindow');
			if(!empty($new) && $new == 'yes') {
				$settings['new-window'] = 'yes';
			}
			delete_option('addonchat_display_newwindow');

			$server = get_option('addonchat_server_id');
			if(!empty($server)) {
				$settings['server'] = $server;
			}
			delete_option('addonchat_server_id');

			delete_option('addonchat_password');

			$this->saveSettings($settings);

			return $settings;
		}

		function filterSettings($settings) {
			$settings = array_map('trim', $settings);
			$settings['account-id'] = preg_replace('/SC-?/', '', $settings['account-id']);

			if(!is_numeric($settings['height'])) {
				unset($settings['height']);
				unset($settings['height-type']);
			} else {
				$settings['height'] = absint($settings['height']);
				if($settings['height-type'] == 'percent') {
					$settings['height'] = $settings['height'] <= 100 ? $settings['height'] : 100;
				}
			}

			if(!is_numeric($settings['width'])) {
				unset($settings['width']);
				unset($settings['width-type']);
			} else {
				$settings['width'] = absint($settings['width']);
				if($settings['width-type'] == 'percent') {
					$settings['width'] = $settings['width'] <= 100 ? $settings['width'] : 100;
				}
			}

			$settings = array_map('trim', $settings);

			return $settings;
		}

		function getSettings() {
			$settings = wp_cache_get($this->_option_AddonChatSettings);

			if(!is_array($settings)) {
				$settings = get_option($this->_option_AddonChatSettings, false);
				if(!is_array($settings)) {
					$settings = $this->attemptToRetrieveLegacySettings();
				}
				$settings = wp_parse_args($settings, $this->_option_AddonChatSettingsDefaults);

				wp_cache_set($this->_option_AddonChatSettings, $settings, null, time() + 24*60*60);
			}

			return $settings;
		}

		function saveSettings($settings) {
			if(is_array($settings)) {
				$settings = wp_parse_args($settings, $this->_option_AddonChatSettingsDefaults);
				update_option($this->_option_AddonChatSettings, $settings);
				wp_cache_set($this->_option_AddonChatSettings, $settings, null, time() + 24*60*60);
			}
		}

		/// PERMISSIONS

		function getPermissions() {
			$permissions = wp_cache_get($this->_option_AddonChatPermissions);

			if(!is_array($permissions)) {
				$permissions = get_option($this->_option_AddonChatPermissions, false);
				$permissions = wp_parse_args($permissions, $this->_option_AddonChatPermissionsDefaults);
				wp_cache_set($this->_option_AddonChatPermissions, $permissions, null, time() + 24*60*60);
			}

			return $permissions;
		}

		function savePermissions($permissions) {
			if(is_array($permissions)) {
				$permissions = wp_parse_args($permissions, $this->_option_AddonChatPermissionsDefaults);
				update_option($this->_option_AddonChatPermissions, $permissions);
				wp_cache_set($this->_option_AddonChatPermissions, $permissions, null, time() + 24*60*60);
			}
		}

		/// UTILITY

		function checkRemoteServerForSettingsSave($password, $account, $ras, $changeRas = false) {
			$return = array();

			$md5pw = md5($password);

			$args = array('id' => $account, 'md5pw' => $md5pw);
			$url = add_query_arg($args, 'http://clientx.addonchat.com/queryaccount.php');
			$response = wp_remote_get($url);
			if(is_wp_error($response)) {
				return array('error' => __('A connection to the AddonInteractive server could not be created.'));
			} else {
				$body = wp_remote_retrieve_body($response);
				$lines = $this->convertLinesToArray($body);
				if(empty($lines)) {
					return array('error' => __('A connection to the AddonInteractive server could not be created.'));
				} elseif($lines[0] == -1) {
					return array('error' => __('The password and account id combination was rejected by the AddonInteractive servers.'));
				} else {
					$server = $lines[0] == 0 ? $lines[6] : $lines[7];
					$return['server'] = $server;

					$port = $lines[0] == 0 ? $lines[7] : $lines[8];
					$return['port'] = $port;
				}
			}

			if($changeRas) {
				if('yes' == $ras) {
					$args['rasurl'] = urlencode(add_query_arg(array('addonchat_remote_authentication'=>1), site_url('/')));
				} else {
					$args['unset'] = 1;
				}
				$url = add_query_arg($args, 'http://clientx.addonchat.com/setras.php');
				$response = wp_remote_get($url);
				if(is_wp_error($response)) {
					return array('error' => __('A connection to the AddonInteractive server could not be created.'));
				} else {
					$body = wp_remote_retrieve_body($response);
					$lines = $this->convertLinesToArray($body);

					if(1 == $lines[0]) {
						$return['use_remote_authentication'] = $ras == 'yes' ? 'yes' : '';
					} else {
						return array('error' => sprintf(__('Could not modify remote authentication: %s'), $lines[1]));
					}
				}
			}

			return $return;
		}

		function compensateForIncorrectlyConstructedUrls($data) {
			if(false !== ($pos = strpos($data['addonchat_remote_authentication'], '?'))) {
				$data['username'] = substr($data['addonchat_remote_authentication'], $pos + 10);
			}

			return $data;
		}

		function convertLinesToArray($string) {
			$results = array();

			$lines = split( "\n", $string );
			foreach( $lines as $line ) {
				if( ( $trimmed = trim( $line ) ) != '' ) {
					$results[] = $trimmed;
				}
			}

			return $results;
		}

		function getErrorMessage($code) {
			switch( $code ) {
				case 100:
					return __('Not 13 years of age or older.');
				case 101:
					return __('Does not agree with Terms &amp; Conditions.');
				case 102:
					return __('Invalid email address specified.');
				case 103:
					return __('Invalid web site specified.');
				case 104:
					return __('Weak password specified.');
				case 105:
					return __('Account already exists with this email.  Please <a href="http://adonchat.com/login.php">login</a>.');
				case 106:
					return __('Passwords did not match.');
				case 110:
					return __('Unknown error.');
				case 200:
				case 201:
				case 202:
					return __('Internal error.');
			}
		}
		
		function getRACUser($username, $password) {
			$user = wp_authenticate_username_password(null, $username, $password);
			if(is_wp_error($user)) {
				global $wpdb; // encrypted case
				$userid = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->users} WHERE user_login = %s AND user_pass = %s", $username, $password));
				if(!empty($userid)) {
					$user = new WP_User($userid);
				} 
			}
			
			return $user;
		}

		function processSettingsSave($data) {
			$settings = $this->getSettings();

			$new = $this->filterSettings($data);

			if(($new['account-id'] != $settings['account-id']) && !empty($new['account-id']) && empty($new['password'])) {
				return array('error' => __('You must enter your password if you are changing your Account ID.'));
			} elseif(($new['use-remote-authentication'] != $settings['use-remote-authentication']) && empty($new['password'])) {
				return array('error' =>__('You must enter your password to enable or disable remote authentication.'));
			} elseif(!empty($new['password'])) {
				$server = $this->checkRemoteServerForSettingsSave($new['password'], $new['account-id'], $new['use-remote-authentication'], $new['use-remote-authentication'] != $settings['use-remote-authentication']);
				if(isset($server['error'])) {
					return $server;
				} elseif(isset($server['server'])) {
					$new['server'] = $server['server'];
					$new['port'] = $server['port'];
				}
			}

			$this->saveSettings($new);
			return true;
		}

		function processSignup($data) {
			$args = array(
				'email' => urlencode($data['email']),
				'password' => urlencode($data['password']),
				'password_verify' => urlencode($data['password-verify']),
				'website' => urlencode($data['web-site']),
				'terms' => urlencode($data['terms-of-use']),
				'age' => urlencode($data['age-verification']),
				'informed' => urlencode($data['informed']),
				'chat_title' => urlencode($data['chat-room-title']),
				'firstname' => urlencode($data['first-name']),
				'lastname' => urlencode($data['last-name'])
			);
			$url = add_query_arg($args, 'http://www.addonchat.com/rsignup.php');

			$response = wp_remote_get($url);
			if(is_wp_error($response)) {
				return array('error' => $response->get_error_message());
			} else {
				$body = wp_remote_retrieve_body($response);
				$lines = $this->convertLinesToArray($body);


				if(1 == $lines[0]) {
					$settings = $this->getSettings();
					$settings['account-id'] = $lines[2];
					$settings['use-remote-authentication'] = '';
					$this->saveSettings($settings);
					return true;
				} else {
					return array('error' => $this->getErrorMessage($lines[1]));
				}
			}
		}

		/// TEMPLATE TAG DELEGATES

	}

	global $AddonChat;
	$AddonChat = new AddonChat;

	include('lib/template-tags.php');
	include('widget/wp-addonchat-widget.php');
}