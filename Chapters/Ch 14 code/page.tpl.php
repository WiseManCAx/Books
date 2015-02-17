<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN'
 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title><?php print $head_title; ?></title>
    <?php print $head; ?>
    <?php print $styles; ?>
  </head>
  <body>

    <?php print $header; ?>

    <div id='header'>
      <?php if ($logo) { ?>
        <img class='logo' src='<?php print $logo; ?>' />
      <?php } ?>
      <?php if ($site_name) { ?>
        <h1>
          <a href='<?php print $base_path; ?>'><?php print $site_name; ?></a>
        </h1>
      <?php } ?>
      <?php print $site_slogan; ?>
    </div>

    <div class='menu primary'>
      <?php print theme('links', $primary_links); ?>
    </div>
    <div class='menu secondary'>
      <?php print theme('links', $secondary_links); ?>
    </div>


    <?php print $above; ?>

    <div id='main'>
      <?php print $tabs; ?>
      <?php print $content; ?>
    </div>

    <?php print $below; ?>

    <div id='footer'>
      <?php print $footer_message; ?>
      <div id='copyright'>
        Copyright <?php print gmdate('Y'); ?>
      </div>
    </div>

    <?php print $footer; ?>

    <?php print $closure; ?>
  </body>
</html>


