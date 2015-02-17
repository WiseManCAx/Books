<?php
  print implode("|", $header);
  foreach ($rows as $row) {
    print "<br />";
    print implode("|", $row);
  }
?>
