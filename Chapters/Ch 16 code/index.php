<?php
  defined( '_JEXEC' ) or die( 'Restricted access' );

  $head_data = ($this->getHeadData());
  $head_data['scripts'] = array();
  $head_data['links'] = array();
  $this->setHeadData($head_data);

?><?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN'
 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <jdoc:include type="head" />

    <link rel="stylesheet" type="text/css" href="<?php
      print $this->baseurl . "templates/" . $this->template . "/css/template.css"
    ?>" />

  </head>
  <body>
    <div id='header'>
      <h1>
        <a href='<?php print $this->baseurl; ?>/'><?php print $mainframe->getCfg('sitename'); ?></a>
      </h1>
    </div>

    <jdoc:include type="modules" name="above" />

    <div id='main'>
      <jdoc:include type="component" />
    </div>

    <jdoc:include type="modules" name="below" />

    <div id='footer'>
      Copyright <?php print gmdate('Y'); ?>
    </div>
  </body>
</html>
