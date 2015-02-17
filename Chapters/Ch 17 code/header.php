<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?php bloginfo('name'); wp_title('|'); ?></title>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/jquery-1.4.4.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/jquery.mobile-1.0a2.min.js"></script>
    <link href="<?php bloginfo('stylesheet_directory'); ?>/jquery.mobile-1.0a2.min.css" rel="stylesheet" />

  	<?php wp_head(); ?>
  </head>

  <body>
    <div data-role="page">

      <div data-role="header">
        <h1>
            <?php bloginfo('name'); ?>
        </h1>
        <a data-icon="grid" class="ui-btn-right"
          href="<?php print home_url('/'); ?>" rel="home">Home</a>
      </div>

      <div data-role="content">
