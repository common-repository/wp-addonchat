scras.version = 2.1
user.usergroup.id = 0

user.uid                             = <?php echo $user->ID; ?>

user.usergroup.can_login             = <?php addonchat_user_can_output($user, $permissions['can_login']); ?>

user.usergroup.can_msg               = <?php addonchat_user_can_output($user, $permissions['can_msg']); ?>

user.usergroup.idle_kick             = <?php addonchat_user_can_output($user, $permissions['idle_kick']); ?>

user.usergroup.icon					 = <?php addonchat_user_pawn_color($user); ?>


user.usergroup.can_action            = <?php addonchat_user_can_output($user, $permissions['can_action']); ?>

user.usergroup.allow_pm              = <?php addonchat_user_can_output($user, $permissions['allow_pm']); ?>

user.usergroup.allow_room_create     = <?php addonchat_user_can_output($user, $permissions['allow_room_create']); ?>

user.usergroup.allow_avatars         = <?php addonchat_user_can_output($user, $permissions['allow_avatars']); ?>

user.usergroup.can_random            = <?php addonchat_user_can_output($user, $permissions['can_random']); ?>

user.usergroup.allow_bbcode          = <?php addonchat_user_can_output($user, $permissions['allow_bbcode']); ?>

user.usergroup.allow_color           = <?php addonchat_user_can_output($user, $permissions['allow_color']); ?>

user.usergroup.msg_scroll            = <?php addonchat_user_can_output($user, $permissions['msg_scroll']); ?>

user.usergroup.filter_shout          = <?php addonchat_user_cannot_output($user, $permissions['filter_shout']); ?>

user.usergroup.filter_profanity      = <?php addonchat_user_cannot_output($user, $permissions['filter_profanity']); ?>

user.usergroup.filter_word_replace   = <?php addonchat_user_cannot_output($user, $permissions['filter_word_replace']); ?>

user.usergroup.can_nick              = <?php addonchat_user_can_output($user, $permissions['can_nick']); ?>


user.usergroup.is_admin              = <?php addonchat_user_can_output($user, $permissions['is_admin']); ?>

user.usergroup.allow_html            = <?php addonchat_user_can_output($user, $permissions['allow_html']); ?>

user.usergroup.can_kick              = <?php addonchat_user_can_output($user, $permissions['can_kick']); ?>

user.usergroup.can_affect_admin      = <?php addonchat_user_can_output($user, $permissions['can_affect_admin']); ?>

user.usergroup.can_grant             = <?php addonchat_user_can_output($user, $permissions['can_grant']); ?>

user.usergroup.can_cloak             = <?php addonchat_user_can_output($user, $permissions['can_cloak']); ?>

user.usergroup.can_see_cloak         = <?php addonchat_user_can_output($user, $permissions['can_see_cloak']); ?>

user.usergroup.login_cloaked         = <?php addonchat_user_can_output($user, $permissions['login_cloaked']); ?>

user.usergroup.can_ban               = <?php addonchat_user_can_output($user, $permissions['can_ban']); ?>

user.usergroup.can_ban_subnet        = <?php addonchat_user_can_output($user, $permissions['can_ban_subnet']); ?>

user.usergroup.can_system_speak      = <?php addonchat_user_can_output($user, $permissions['can_system_speak']); ?>

user.usergroup.can_silence           = <?php addonchat_user_can_output($user, $permissions['can_silence']); ?>

user.usergroup.can_fnick             = <?php addonchat_user_can_output($user, $permissions['can_fnick']); ?>

user.usergroup.can_launch_website    = <?php addonchat_user_can_output($user, $permissions['can_launch_website']); ?>

user.usergroup.can_transfer          = <?php addonchat_user_can_output($user, $permissions['can_transfer']); ?>

user.usergroup.can_join_nopw         = <?php addonchat_user_can_output($user, $permissions['can_join_nopw']); ?>

user.usergroup.can_topic             = <?php addonchat_user_can_output($user, $permissions['can_topic']); ?>

user.usergroup.can_close             = <?php addonchat_user_can_output($user, $permissions['can_close']); ?>

user.usergroup.can_ipquery           = <?php addonchat_user_can_output($user, $permissions['can_ipquery']); ?>

user.usergroup.can_geo_locate        = <?php addonchat_user_can_output($user, $permissions['can_geo_locate']); ?>

user.usergroup.can_query_ether       = <?php addonchat_user_can_output($user, $permissions['can_query_ether']); ?>

user.usergroup.can_clear_screen      = <?php addonchat_user_can_output($user, $permissions['can_clear_screen']); ?>

user.usergroup.can_clear_history     = <?php addonchat_user_can_output($user, $permissions['can_clear_history']); ?>

user.usergroup.allow_img_tag         = <?php addonchat_user_can_output($user, $permissions['allow_img_tag']); ?>


user.usergroup.is_speaker            = <?php addonchat_user_can_output($user, $permissions['is_speaker']); ?>

user.usergroup.is_super_moderator    = <?php addonchat_user_can_output($user, $permissions['is_super_moderator']); ?>

user.usergroup.can_enable_moderation = <?php addonchat_user_can_output($user, $permissions['can_enable_moderation']); ?>

user.usergroup.is_unmoderated        = <?php addonchat_user_can_output($user, $permissions['is_unmoderated']); ?>


user.usergroup.allow_admin_console   = <?php addonchat_user_can_output($user, $permissions['allow_admin_console']); ?>

user.usergroup.can_view_transcripts  = <?php addonchat_user_can_output($user, $permissions['can_view_transcripts']); ?>

<?php foreach($permissions['non-boolean'] as $key => $value) { ?>

user.usergroup.<?php echo $key; ?>	 = <?php echo $value; ?>

<?php } ?>
