<?php

require_once '../../lib/da/Api.php';
$tree = Mobi_Mtld_DA_Api::getTreeFromFile("../../lib/da_resources/deviceatlas.json");
$user_agent = get_http_header('User-agent');

$device_group = device_group($tree, $user_agent);
$touch_screen = device_property($tree, $user_agent, 'touchScreen', 0);

function device_group($tree, $user_agent) {
  if (device_property($tree, $user_agent, 'mobileDevice', 0)) {
    $default_width=160;
  } else {
    $default_width=640;
  }
  $width = device_property($tree, $user_agent, 'displayWidth', $default_width);
  if ($width < 241) {
    return 'limited';
  } elseif ($width < 321) {
    return 'narrow';
  } elseif ($width < 481) {
    return 'medium';
  } else {
    return 'wide';
  }
}

function device_property($tree, $user_agent, $property, $default) {
  try {
    $value = Mobi_Mtld_DA_Api::getProperty($tree, $user_agent, $property);
    if (is_null($value)) {
      $value = $default;
    }
  } catch (Exception $e) {
    $value = $default;
  }
  return $value;
}

function get_http_header($name, $original_device=true, $default='') {
  if ($original_device) {
    $original = get_http_header("X-Device-$name", false);
    if ($original!=='') {
      return $original;
    }
  }
  $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
  if (isset($_SERVER[$key])) {
    return $_SERVER[$key];
  }
  return $default;
}

?><!DOCTYPE html> 
<html> 
 <head> 
  <title>Welcome</title> 
  <link rel="stylesheet" type="text/css" href="basic.css" media="all"/>
  <link rel="stylesheet" type="text/css" href="<?php print $device_group;?>.css" media="all"/>
  <?php if ($touch_screen) { ?>
    <meta name="viewport" content="
      width=device-width,
      initial-scale=1.0,
      minimum-scale=1.0,
      maximum-scale=1.0,
      user-scalable=false
    " />
  <?php } ?>
 </head> 
 <body> 
  <?php if (device_property($tree, $user_agent, 'mobileDevice', 0)) { ?>
    <div class='call_to_action'>
      Call us now on <a href='tel:555-1234-567'>555-1234-567</a>!
    </div>
  <?php } ?>
  <h1>Welcome, <?php print $device_group;?> browser</h1>
  <div id="menu"> 
   <a href="index.php">Home</a>
   <a href="page1.php">Page 1</a>
   <a href="page2.php">Page 2</a>
  </div>
  <div id="content">
    <p>
     <img src="lisa.jpg" alt="The Mona Lisa"/>
    </p>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras a nisi lorem.
    </p>
    <p>
      Praesent sagittis sollicitudin fermentum. Nunc elementum, lorem a dignissim volutpat, dolor enim sodales tellus, non ornare lorem ipsum at ligula.
    </p>
    <p>
      Curabitur rhoncus ipsum et velit posuere condimentum sodales ante malesuada. Proin quis nulla id urna rutrum porta. Donec vel tortor non felis dapibus euismod.
    </p>
    <p>
      Donec sodales tristique auctor. Sed facilisis tincidunt ipsum, sit amet pretium diam malesuada vel.
    </p>
  </div>
 </body> 
</html>
