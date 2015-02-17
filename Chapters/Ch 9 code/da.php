<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN' 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html>
  <head>
    <title>DeviceAtlas</title>
  </head>
  <body>
    <h1>DeviceAtlas</h1>
<?php

require_once '../lib/da/Api.php';
$tree = Mobi_Mtld_DA_Api::getTreeFromFile("../lib/da_resources/deviceatlas.json");
$user_agent = get_http_header('User-agent');

print "Browser is group: " . device_group($tree, $user_agent);

function device_group($tree, $user_agent) {
  if (!device_property($tree, $user_agent, 'mobileDevice', 0)) {
    return null;
  }
  if (device_property($tree, $user_agent, 'touchScreen', 0)) {
    return 'A';
  }
  if (device_property($tree, $user_agent, 'markup.xhtmlBasic10', 0)) {
    return 'B';
  }
  if (device_property($tree, $user_agent, 'markup.xhtmlMp10', 0)) {
    return 'C';
  }
  if (device_property($tree, $user_agent, 'markup.wml1', 0)) {
    return 'D';
  }
  return 'E';
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

?>
  </body>
</html>