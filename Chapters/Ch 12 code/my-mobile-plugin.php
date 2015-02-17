<?php
/*
Plugin Name: My Mobile Plugin
Description: Made by reading Chapter 12.
Author: Me
Version: 1.0 
*/

define("MOBILE_THEME", 'my_mobile_theme');

add_filter('stylesheet', 'mmp_stylesheet');
function mmp_stylesheet($stylesheet) {
  if (request_is_mobile()) {
    return MOBILE_THEME;
  }
  return $stylesheet;
}

add_filter('template', 'mmp_template');
function mmp_template($template) {
  if (request_is_mobile()) {
    return MOBILE_THEME;
  }
  return $template;
}

add_filter('the_content', 'mmp_the_content');
function mmp_the_content($content) {
  return (
    resize_images(
      paginate(
        remove_tags(
          $content
        )
      )
    )
  );
}

add_filter('the_excerpt', 'mmp_the_excerpt');
function mmp_the_excerpt($excerpt) {
  return remove_tags($excerpt);
}

function remove_tags($string) {
  if (request_is_mobile()) {
    $remove_tags = "/\<\/?(marquee|frame|iframe|object|embed)[^>]*\>/Usi";
    $string = preg_replace($remove_tags, "", $string);
    $remove_scripts = "/\<script.*\<\/script\>/Usi";
    $string = preg_replace($remove_scripts, "", $string);
  }
  return $string;
}

function paginate($string) {
  if (request_is_mobile()) {
    $pages = array();
    $page = '';
    foreach(split('<p>', $string) as $paragraph) {
      $page_length = strlen($page);
      if($page_length > 0 && $page_length + strlen($paragraph) > 2000) {
        $pages[] = $page;
        $page = '';
      }
      $page .= "<p>$paragraph";
    }

    $current_page = 0;
    if(isset($_GET['mmp_page']) && is_numeric($current_page = $_GET['mmp_page'])) {
      if ($current_page < 0) {
        $current_page = 0;
      }
      if ($current_page > sizeof($pages)) {
        $current_page = sizeof($pages);
      }
    }
    $string = $pages[$current_page];
    if ($current_page < sizeof($pages) - 1) {
      $next = add_query_arg('mmp_page', ($current_page+1));
      $string .= "<a href='$next'>Next</a>";
    }
  }
  return $string;
}

function resize_images($string) {
  $tinysrc = "http://i.tinysrc.mobi/x90/";
  if (request_is_mobile()) {
    $images = '/\<img(.* src=\")([^"]*)(\".*) width=\"\d+\" height=\"\d+\" \/>/Usi';
    $string = preg_replace($images, "<img$1$tinysrc$2$3/>", $string);
  }
  return $string;
}


function request_is_mobile() {
  global $_request_is_mobile;
  if (!isset($_request_is_mobile)) {
    $_request_is_mobile = _request_is_mobile();
  }
  return $_request_is_mobile;
}

function _request_is_mobile() {
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
//

?>