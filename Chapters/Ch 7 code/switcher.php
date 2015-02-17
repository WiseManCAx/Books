<?php

function get_device_type() {

  $base_domain = 'example.com';
  $domain = get_http_header('Host');
  
  if ($domain!=$base_domain) {
      
    foreach(array(
      'www'=>'desktop',
      'desktop'=>'desktop',
      'touch'=>'touch',
      'iphone'=>'touch',
      'android'=>'touch',
      'mobile'=>'mobile'
    ) as $sub=>$type) {
  
      if ($domain == "$sub.$base_domain") {
        $url = $_SERVER['REQUEST_URI'];
        if (isset($_SERVER['QUERY_STRING']) && $qs = $_SERVER['QUERY_STRING']) {
          $url .= "?$qs";
        }
        $url = urlencode($url);
        header("Location: http://$base_domain/redirect.php?device_type=$type&url=$url");
      }
    }
  }
  
  if (isset($_COOKIE['device_type'])) {
    $override = $_COOKIE['device_type'];
    if (in_array($override, array('desktop', 'touch', 'mobile'))) {
      return $override;
    }
  }

  if (request_is_mobile()) {
    $user_agent = strtolower(get_http_header('User-Agent'));
    if (preg_match("/(iPhone|Android)/i", $user_agent)) {
      return 'touch';
    }
    return 'mobile';
  }
  return 'desktop';
}


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

?>