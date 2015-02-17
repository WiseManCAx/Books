<h2 class='title'>Welcome to our site!</h2>

<?php

$dispatcher	=& JDispatcher::getInstance();
JPluginHelper::importPlugin('content');

foreach ($this->items as $item) {

  $results = $dispatcher->trigger('onPrepareContent', array (& $item, & $item->params, 0));

  $item->link = JRoute::_(
    ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid)
  );

  ?>

  <div class='article'>
    <div class='header'>
      <h3>
        <a href="<?php print $item->link; ?>"><?php print $item->title; ?></a>
      </h3>
    </div>
    <div class='introtext'>
      <?php print $item->introtext; ?>
      <?php if ($item->readmore) {
        print " <a href='" . $item->link . "'>Read more</a>";
      } ?>
    </div>
    <div class='metadata'>
      <?php print $item->created; ?> by <?php print $item->author; ?>
    </div>
  </div>

<?php }

?>
