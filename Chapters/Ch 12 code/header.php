<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN'
 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title><?php bloginfo('name'); wp_title('|'); ?></title>
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" media="screen" type="text/css" />
  	<?php wp_head(); ?>
  </head>
  <body>
    <div id='header'>
      <h1>
        <a href="<?php print home_url('/'); ?>" rel="home">
          <?php bloginfo('name'); ?>
        </a>
      </h1>
      <?php bloginfo('description'); ?>
    </div>
    
    <?php
      $menu = wp_nav_menu('depth=1&echo=0');
      $menu = preg_replace('/<\/?ul>/', '', $menu);
      $menu = preg_replace('/(<\/?)li/', '$1span', $menu);
      print $menu;
    ?>

    <div id='main'>