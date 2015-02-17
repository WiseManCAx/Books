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

      $mobileDevice = Mobi_Mtld_DA_Api::getProperty($tree, $user_agent, 'mobileDevice');

      print "Device is mobile: " . $mobileDevice;


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