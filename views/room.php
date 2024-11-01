<script type="text/javascript">
/* <![CDATA[ */
var addonchat = { server: <?php echo preg_replace('/[^0-9]/', '', $server); ?>, id: <?php echo $id; ?>, width:"<?php echo $width; ?>", height:"<?php echo $height; ?>", language:"en" }
<?php if(is_user_logged_in() && $autologin) { $currentuser = wp_get_current_user(); ?>
var addonchat_param = { autologin: true, username: '<?php esc_attr_e($currentuser->user_login); ?>', password: '<?php esc_attr_e($currentuser->user_pass) ?>', login_prompt_after_autologin: true }
<?php } ?>

/* ]]> */
</script>
<script type="text/javascript" src="http://<?php echo $server; ?>/chat.js"></script>
<noscript><?php _e('To enter this chat room, please enable JavaScript in your web browser. This <a href="http://www.addonchat.com/">Chat Software</a> requires Java: <a href="http://www.java.com/">Get Java Now</a>'); ?></noscript>

<?php if($popup) { ?>
<p><a href="http://<?php echo $server; ?>/chat.php?id=<?php echo $id; ?>" onclick="window.open('http://<?php echo $server; ?>/chat.php?fs&id=<?php echo $id; ?>', 'addonchat','width=620,height=440,status=no,scrollbars=no,menubar=no,resizable=yes'); return false"><?php _e('Open in New Window'); ?></a></p>
<?php } ?>