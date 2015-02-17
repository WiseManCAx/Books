<?php

print "<h2 class='title'>" . $this->category->title . "</h2>";

$dispatcher	=& JDispatcher::getInstance();
JPluginHelper::importPlugin('content');

foreach ($this->getItems() as $item) {

  $results = $dispatcher->trigger('onPrepareContent', array (& $item, & $item->params, 0));

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

print $this->pagination->getPagesLinks();

?>
