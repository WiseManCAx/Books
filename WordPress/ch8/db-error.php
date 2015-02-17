<?php
//error_reporting(’E_ERROR’);
mail(’developers@mysite.com’,’WP SQL Connection Issue on ‘.$_SERVER[’HTTP_HOST’],
	’This is an automated message from the wordpress custom db error message file.’);
?>
<html>
<head>
<title>Temporarily Unavailable</title>
<style>
body {
	background-color: #000;
}
#wrapper {
	width: 600px;
	height: 300px;
	margin: 2em auto 0;
	border: 4px solid #666;
	background-color: #fff;
	padding: 0 2em;
}
p {
	font-size: larger;
}
</style>
</head>
<body>
<div id="wrapper">
  <center>
	<!-- /* This is the generic database error page that will be shown when a fatal
db connection issue arises */ -->
	<h1><?php echo $_SERVER[’HTTP_HOST’]; ?> is Temporarily Unavailable</h1>
	<p>The webmaster has been alerted. Please try again later.</p>
  </center>
</div>
</body>
</html>
