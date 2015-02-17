<div class='node'>

  <?php if ($page) { ?>

    <div class='header'>
      <?php print $picture; ?>
      <h3><?php print $title; ?></h3>
    </div>
    <div class='metadata'>
      <?php print $date; ?> by <?php print $name; ?>
      <?php if ($terms) { ?>
        <br/>Filed under: <?php print $terms; ?>
      <?php } ?>
    </div>
    <div class='content'>
      <?php print $content; ?>
    </div>
    <?php if ($links) { ?>
      <div class='metadata'>
        <?php print $links; ?>
      </div>
    <?php } ?>

  <?php } else { ?>

    <div class='header'>
      <?php print $picture; ?>
      <h3>
        <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
      </h3>
    </div>
    <div class='excerpt'>
      <?php print $content; ?>
    </div>
    <div class='metadata'>
      <?php print $date; ?> by <?php print $name; ?>
    </div>

  <?php } ?>

</div>
