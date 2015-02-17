<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class plgContentRewriter extends JPlugin {

  function onPrepareContent(&$article, &$params, $limitstart) {
    global $mainframe;
    if ($mainframe->getTemplate() == MOBILE_TEMPLATE) {
      $article->introtext=rewrite($article->introtext);
      $article->text=rewrite($article->text);
    }
  }

}

function rewrite($string) {
  return resize_images(
          remove_tags(
            $string
          )
        );
}



function remove_tags($string) {
  $remove_tags = "/\<\/?(marquee|frame|iframe|object|embed)[^>]*\>/Usi";
  $string = preg_replace($remove_tags, "", $string);
  $remove_scripts = "/\<script.*\<\/script\>/Usi";
  $string = preg_replace($remove_scripts, "", $string);
  return $string;
}

function resize_images($string) {
  $host = "http://" . $_SERVER['HTTP_HOST'];
  $tinysrc = "http://i.tinysrc.mobi/x90/";
  $tinysrc = "http://localhost:8087/x90/";
  preg_match_all('/\<img.*>/Usi', $string, $images);
  foreach ($images[0] as $image) {
    $new_image = preg_replace('/(width|height)=[\'"]\d+[\'"]/', '', $image);
    $new_image = preg_replace('/src=[\'"](http:\/\/[^\'"]*)[\'"]/', "src='$tinysrc$1'", $new_image);
    $new_image = preg_replace('/src=[\'"](\/[^\'"]*)[\'"]/', "src='$tinysrc$host$1'", $new_image);
    $string = str_replace($image, $new_image, $string);
  }
  return $string;
}

?>
