<?php

echo $before_widget;
if ($title) {
	echo $before_title . $title . $after_title;
}

if(!empty($members)) { echo '<ul>'; }
foreach($members as $name) {
	?><li><?php esc_html_e($name); ?></li><?php
}
if(!empty($members)) { echo '</ul>'; }

echo $after_widget;