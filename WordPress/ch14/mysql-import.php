<?php
//set database connection info for database to import
$hostname = "localhost";
$username = "USERNAME";
$password = "PASSWORD";
$sourcedb = "DATABASE"; // database to import from
$sourcetable = "stories"; // table that stores posts to import
$sourcecomments = "comment"; // table that stores comments to import
//set database connection info for WordPress database
$destdb = "WORDPRESS-DATABASE"; // WordPress database
$wp_prefix = "wp_"; // WordPress table prefix
//database connection
$db_connect = @mysql_connect($hostname, $username, $password)
	or die("Fatal Error: ".mysql_error());
mysql_select_db($sourcedb, $db_connect);
$srcresult = mysql_query("select * from $sourcetable", $db_connect)
	or die("Fatal Error: ".mysql_error());// used to generate the dashed titles in the URLs
function sanitize($title) {
	$title = strtolower($title);
	$title = preg_replace('/&.+?;/', '', $title); // kill entities
	$title = preg_replace('/[ ˆ a-z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', ' ', $title);
	$title = str_replace(' ', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');
	return $title;
}
while ($myrow = mysql_fetch_array($srcresult))
{
	//generate post title
	$my_title = mysql_escape_string($myrow['title']);
	//generate post content
	$my_content = mysql_escape_string($myrow['content']);
	//generate post permalink
	$myname = mysql_escape_string(sanitize($my_title));
	//generate SQL to insert data into WordPress
	$sql = "INSERT INTO '" . $wp_prefix . "posts'
		(
			'ID' ,
			'post_author' ,
			'post_date' ,
			'post_date_gmt' ,
			'post_content' ,
			'post_title' ,
			'post_name' ,
			'post_category' ,
			'post_excerpt' ,
			'post_status' ,
			'comment_status' ,
			'ping_status' ,
			'post_password' ,
			'to_ping' ,
			'pinged' ,
			'post_modified' ,
			'post_modified_gmt' ,
			'post_content_filtered' ,
			'post_parent',
			'post_type' )
VALUES
(
	'$myrow[sid]',
	'1',
	'$myrow[time]',
	'0000-00-00 00:00:00',
	'$my_content',
	'$my_title',
	'$myname',
	'$myrow[category]',
	'',
	'publish',
	'open',
	'open',
	'',
	'',
	'',
	'$myrow[time]',
	'0000-00-00 00:00:00',
	'',
	'0',
	'post' );";
mysql_select_db($destdb, $db_connect);
//execute query
mysql_query($sql, $db_connect);
// load the ID of the post we just inserted
$sql = "select MAX(ID) from " . $wp_prefix . "posts";
$getID = mysql_query($sql, $db_connect);
$currentID = mysql_fetch_array($getID);
$currentID = $currentID['MAX(ID)'];
// retreive all associated post comments
$mysid = $myrow["pn_sid"];
mysql_select_db($sourcedb, $db_connect);
$comments = mysql_query("select * from "
	.$sourcecomments. " where pn_sid = $mysid", $db_connect);
//import post comments in WordPress
while ($comrow = mysql_fetch_array($comments))
{
	$myname = mysql_escape_string($comrow['pn_name']);
	$myemail = mysql_escape_string($comrow['pn_email']);
	$myurl = mysql_escape_string($comrow['pn_url']);
	$myIP = mysql_escape_string($comrow['pn_host_name']);
	$mycomment = mysql_escape_string($comrow['pn_comment']);
	$sql = "INSERT INTO '" . $wp_prefix . "comments'
		(
			'comment_ID' ,
			'comment_post_ID' ,
			'comment_author' ,
			'comment_author_url' ,
			'comment_author_IP' ,
			'comment_date' ,
			'comment_date_gmt' ,
			'comment_content' ,
			'comment_karma' ,
			'comment_approved' ,
			'user_id' )
VALUES
(
	'',
	'$currentID',
	'$myname',
	'$myemail',
	'$myurl',
	'$myIP',
	'$comrow[date]',
	'0000-00-00 00:00:00',
	'$mycomment',
	'0',
	'1',
	'0'
);";
if ($submit)
{
	mysql_select_db($destdb, $db_connect);
	mysql_query($sql, $db_connect)
		or die("Fatal Error: ".mysql_error());
}
}
}
//Update comment count
mysql_select_db($destdb, $db_connect);
$tidyresult = mysql_query("select * from $wp_prefix" . "posts", $db_connect)
	or die("Fatal Error: ".mysql_error());
while ($myrow = mysql_fetch_array($tidyresult))
{
	$mypostid=$myrow['ID'];
	$countsql="select COUNT(*) from $wp_prefix" . "comments"
		. " WHERE 'comment_post_ID' = " . $mypostid;
	$countresult=mysql_query($countsql) or die("Fatal Error: ".mysql_error());
	$commentcount=mysql_result($countresult,0,0);
	$countsql="UPDATE '" . $wp_prefix . "posts'
		SET 'comment_count' = '" . $commentcount .
		"' WHERE 'ID' = " . $mypostid . " LIMIT 1";
	$countresult=mysql_query($countsql) or die("Fatal Error: ".mysql_error());
}
