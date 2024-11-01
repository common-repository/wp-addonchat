<?php

if(!function_exists('addonchat_whos_chatting')) {
	//	function addonchat_whos_chatting() {
	//		global $AddonChat;
	//		$AddonChat->whosChatting();
	//	}
}

/**
 *
 * @param WP_User $user
 * @param $perm
 * @return unknown_type
 */
function addonchat_user_can_output($user, $perm) {
	if($perm == 'disabled') {
		echo 0;
	} else {
		echo $user->has_cap($perm) ? 1 : 0;
	}
}

function addonchat_user_cannot_output($user, $perm) {
	if($perm == 'disabled') {
		echo 0;
	} else {
		echo $user->has_cap($perm) ? 0 : 1;
	}
}

function addonchat_user_pawn_color($user) {
	global $AddonChat;
	$permissions = $AddonChat->getPermissions();
	if(is_array($permissions['pawn-color'])) {
		$colors = array_reverse($permissions['pawn-color']);
	} else {
		$colors = array();
	}

	foreach($colors as $perm => $color) {
		if($user->has_cap($perm)) {
			echo $color;
			return ;
		}
	}

	echo 0;
}
