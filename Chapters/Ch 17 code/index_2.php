<!doctype html>
<html>
  <head>
    <title><?php bloginfo('name'); wp_title('|'); ?></title>

    <link href="<?php bloginfo('stylesheet_directory'); ?>/lib/touch/resources/css/sencha-touch.css" rel="stylesheet"
      media="screen" type="text/css" />

    <script src="<?php bloginfo('stylesheet_directory'); ?>/lib/touch/sencha-touch.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/app.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/models/Category.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/models/Post.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/views/categories.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/views/posts.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/controllers/categories.js"
      type="text/javascript"></script>

    <script src="<?php bloginfo('stylesheet_directory'); ?>/app/controllers/posts.js"
      type="text/javascript"></script>
        padding: 1em;


    <style>

      .x-docked-left {
        border-right:1px solid #999;
      }

      .x-panel-body p {
        padding: 0.5em;
      }

      .x-panel-body h2 {
        padding: 0.4em;
        font-size:1.25em;
        font-weight:bold;
      }

    </style>

  </head><body></body>
</html>
