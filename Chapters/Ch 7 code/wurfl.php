<?xml version='1.0' encoding='UTF-8'?>
<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN' 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>
<html>
  <head>
    <title>WURFL</title>
  </head>
  <body>
    <h1>WURFL</h1>
    <?php

      require_once '../lib/wurfl/Application.php';
      $wurflManagerFactory = new WURFL_WURFLManagerFactory(
        new WURFL_Configuration_XmlConfig('../lib/wurfl_resources/wurfl-config.xml')
      );
      $wurflManager = $wurflManagerFactory->create();	
      
      
      $device = $wurflManager->getDeviceForHttpRequest($_SERVER);
      
      
      print "Device is mobile: " . $device->getCapability("is_wireless_device");

    ?>
  </body>
</html>