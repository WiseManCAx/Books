<?php

function my_mobile_theme_links(
  $links, $attributes = array('class' => 'links')
) {
  $html_links = array();
  foreach ($links as $key => $link) {
    $html_links[] = l($link['title'], $link['href'], $link);
  }
  return join(' | ', $html_links);
}
