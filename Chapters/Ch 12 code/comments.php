<?php if (have_comments()) {
  print "<h3>Comments on this post:</h3>";  
  wp_list_comments('style=div');
}
print comment_form();
?>
