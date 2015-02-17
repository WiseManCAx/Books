<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN' 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html>
  <head>
    <title>HTTP Headers</title>
  </head>
  <body>
    <h1>HTTP Headers</h1>
    <?php

      function request_is_mobile() {
        if (get_http_header('X-Wap-Profile')!='' || get_http_header('Profile')!='') {
          return true;
        }
        if (stripos(get_http_header('Accept'), 'wap') !== false) {
          return true;
        }
        $user_agent = strtolower(get_http_header('User-Agent'));
        $ua_prefixes = array(
          'w3c ', 'w3c-', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq',
          'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco',
          'eric', 'hipt', 'htc_', 'inno', 'ipaq', 'ipod', 'jigs', 'kddi', 'keji',
          'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'lg/u', 'maui', 'maxo', 'midp',
          'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki',
          'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage',
          'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-',
          'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
          'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi',
          'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );
        if (in_array(substr($user_agent, 0, 4), $ua_prefixes)) {
          return true;
        }
        $ua_keywords = array(
          'android', 'blackberry', 'hiptop', 'ipod', 'lge vx', 'midp', 
          'maemo', 'mmp', 'netfront', 'nintendo DS', 'novarra', 'openweb',
          'opera mobi', 'opera mini', 'palm', 'psp', 'phone', 'smartphone',
          'symbian', 'up.browser', 'up.link', 'wap', 'windows ce'
        );
        if (preg_match("/(" . implode("|", $ua_keywords) . ")/i", $user_agent)) {
          return true;
        }
        return false;
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

      print "User-Agent: " . get_http_header('User-Agent');
      print "<br />Is mobile: " . (request_is_mobile() ? 'True' : 'False');

    ?>
  </body>
</html>