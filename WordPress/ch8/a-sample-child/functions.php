<?php 
/* this is my child themes functions */

function ddamstra_showGravatar($authordata, $size=100) {
	if ($size < 80 ) { $size = 80; }
	if ($size > 512) { $size = 512; }
	echo '<img alt="'.$authordata->display_name.'" src="http://www.gravatar.com/avatar/'.md5( strtolower($authordata->user_email)).'.jpg?s='.$size.'" >';
}
