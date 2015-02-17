<?php

require_once('switcher.php');
$browser_type = get_device_type();


function theme($section, $argument='') {
  global $browser_type;
  $theme_function = "theme_{$section}_{$browser_type}";
  if (function_exists($theme_function)) {
    call_user_func($theme_function, $argument);
  }
}

function theme_header_desktop($title) {
  print <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>$title</title>
  <link rel="stylesheet" type="text/css" href="desktop.css">
 </head>
 <body>
  <div id="page">
   <div id="sidebar">
END;
  theme('sidebar');
  print <<<END
    <ul class="menu">
     <li><a href='redirect.php?device_type=touch'>Touch version</a></li>
     <li><a href='redirect.php?device_type=mobile'>Mobile version</a></li>
    </ul>
   </div>
   <div id="content">
    <h1>$title</h1>
END;
}

function theme_sidebar_desktop() {
  print <<<END
    <ul class="menu">
     <li><a href="index.php">Home</a></li>
     <li><a href="page1.php">Page 1</a></li>
     <li><a href="page2.php">Page 2</a></li>
    </ul>
END;
}

function theme_footer_desktop() {
  print <<<END
   </div>
  </div>
 </body>
</html>
END;
}

#--------------------------------

function theme_header_touch($title) {
  print <<<END
<!DOCTYPE html>
<html>
 <head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <title>$title</title>
  <link rel="stylesheet" type="text/css" href="../../lib/iwebkit/css/style.css">
  <link rel="stylesheet" type="text/css" href="touch.css">
 </head>
 <body>
  <div id="topbar" class="transparent">
   <div id="title">$title</div>
  </div>
END;
  theme('sidebar');
  print <<<END
  <div id="content">
   <ul class="pageitem">
    <li class="textbox">
END;
}

function theme_sidebar_touch() {
  print <<<END
<div id="tributton">
 <div class="links">
  <a href="index.php">Home</a><a href="page1.php">Page 1</a><a href="page2.php">Page 2</a>
 </div>
</div>
END;
}

function theme_footer_touch() {
  print <<<END
    </li>
   </ul>
   <ul class="pageitem">
    <li class="textbox"><a href='redirect.php?device_type=desktop'>Desktop version</a></li>
    <li class="textbox"><a href='redirect.php?device_type=mobile'>Mobile version</a></li>
   </ul>
  </div>
 </body>
</html>
END;
}

#--------------------------------

function theme_header_mobile($title) {
  print <<<END
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"
 "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>$title</title>
  <link rel="stylesheet" type="text/css" href="mobile.css"/>
 </head>
 <body>
  <h1>$title</h1>
END;
}

function theme_sidebar_mobile() {
  return theme_sidebar_desktop();
}

function theme_footer_mobile() {
  theme('sidebar');
  print <<<END
  <ul class='menu'>
   <li><a href='redirect.php?device_type=desktop'>Desktop version</a></li>
   <li><a href='redirect.php?device_type=touch'>Touch version</a></li>
  </ul>
 </body>
</html>
END;
}


?>
