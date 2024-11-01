<?php

if(!class_exists('AddonChat_Whos_Chatting_Widget')) {
	class AddonChat_Whos_Chatting_Widget extends WP_Widget {
		function AddonChat_Whos_Chatting_Widget() {
			$widget_ops = array('classname' => 'wp-addonchat-whos-chatting', 'description' => __( 'A list of usernames of people currently chatting in your chat room.'));
			$this->WP_Widget('pages', __('AddonChat Who\'s Chatting'), $widget_ops);
		}

		/// CALLBACKS

		function widget($args, $instance) {
			extract( $args );

			$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
			$members = $this->getChattingMembers();

			include('views/widget.php');
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);

			return $instance;
		}

		function form($instance) {
			//Defaults
			$instance = wp_parse_args( (array) $instance, array('title' => 'Who\'s Chatting'));
			$title = esc_attr($instance['title']);

			include('views/controls.php');
		}

		/// UTILITY

		function getChattingMembers() {
			global $AddonChat;
			$settings = $AddonChat->getSettings();

			if(!isset($settings['port']) || !isset($settings['server']) || !isset($settings['account-id'])) {
				return array();
			}


			$url = add_query_arg(array('id'=>$settings['account-id'], 'md5pw' => md5($settings['password']), 'plain' => 1, 'port' => $settings['port']), "http://{$settings['server']}/scwho.php");

			$return = array();
			$response = wp_remote_get($url);
			if(!is_wp_error($response)) {
				$body = wp_remote_retrieve_body($response);
				$lines = $AddonChat->convertLinesToArray($body);
				foreach($lines as $line) {
					$person = split("\t", $line);
					$return[] = $person[1];
				}
			}

			return $return;
		}
	}
}

add_action('widgets_init', create_function('', 'register_widget("AddonChat_Whos_Chatting_Widget");'));