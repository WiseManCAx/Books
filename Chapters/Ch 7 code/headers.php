<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN' 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html>
  <head>
    <title>HTTP Headers</title>
  </head>
  <body>
    <h1>HTTP Headers</h1>
    <?php

      //foreach ($_SERVER as $key=>$value) {
      //  print "$key: $value<br/>";
      //}

      //foreach ($_SERVER as $key=>$value) {
      //  if (substr($key, 0, 5)=='HTTP_') {
      //    print "$key: $value<br/>";
      //  }
      //}

      //function get_http_header($name, $default='') {
      //  $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
      //  if (isset($_SERVER[$key])) {
      //    return $_SERVER[$key];
      //  }
      //  return $default;
      //}

      function get_http_header($name, $original_device=true, $default='') {
        if ($original_device) {
          $original = get_http_header("X-Device-$name", false);
          if ($original!='') {
            return $original;
          }
        }
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($_SERVER[$key])) {
          return $_SERVER[$key];
        }
        return $default;
      }

      print "User-Agent: " . get_http_header('User-Agent');
            
    ?>
  </body>
</html>