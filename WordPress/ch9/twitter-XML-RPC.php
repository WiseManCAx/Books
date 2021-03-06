<?php 
// change this to your twitter user
$twitterUser = "mirmillo";
$url = "http://twitter.com/statuses/user_timeline/$twitterUser.xml";
$xml = new SimpleXMLElement(file_get_contents($url));
// make sure this path is correct based on where you put this file
include('../../../wp-includes/class-IXR.php');
// change this URL to match your site
$client = new IXR_Client('http://localhost/wordpress/xmlrpc.php');
foreach ($xml->status as $status)
{
	/* set up the post - there are many more keys you can include */
	$content['title'] = "Tweet from $status->created_at";
	$content['description'] = "<p>".$status->text."</p>";
	/* post the tweet */
	$client->query('metaWeblog.newPost', '', 'admin', 'password', $content, true);
	if ($client->message->faultString)
	{
		echo "Failure - ".$client->message->faultString."<br />";
	} else {
		echo "Success - ".$status->text."<br />";
	}
} 
