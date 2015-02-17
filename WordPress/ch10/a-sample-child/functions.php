<?php 
/* this is my child themes functions */

function ddamstra_showGravatar($authordata, $size=100) {
	if ($size < 80 ) { $size = 80; }
	if ($size > 512) { $size = 512; }
	echo '<img alt="'.$authordata->display_name.'" src="http://www.gravatar.com/avatar/'.md5( strtolower($authordata->user_email)).'.jpg?s='.$size.'" >';
}

function ddamstra_getLatestTweet($twitterUser = "mirmillo") {
	$url = "http://twitter.com/statuses/user_timeline/$twitterUser.xml?count=1";
	$xml = new SimpleXMLElement(file_get_contents($url));
	$status = $xml->status->text;
	return $status;;
}
