<?php

  require_once('switcher.php');

  if (isset($_GET['device_type'])) {
    setcookie('device_type', $_GET['device_type'], 0, '/');
  }
  
  $url = get_http_header('Referer', true, 'index.php');
  if (isset($_GET['url'])) {
    $url = $_GET['url'];
  }
  
  header("Location: $url");

?>