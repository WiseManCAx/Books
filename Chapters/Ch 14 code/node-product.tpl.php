<div class='node'>

  <?php if ($page) { ?>

<div class='header'>
  <?php print $picture; ?>
  <h3><?php print $title; ?> - now only <?php print $node->field_price[0]['value']; ?></h3>
</div>
<div class='metadata'>
  <?php print $date; ?> by <?php print $name; ?>
  <?php if ($terms) { ?>
    <br/>Filed under: <?php print $terms; ?>
  <?php } ?>
</div>
<div class='content'>
  <?php print $node->content['body']['#value']; ?>
  Made in <?php print $node->field_origin[0]['value']; ?>
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
        <a href="<?php print $node_url; ?>"><?php print $title; ?></a> - now only <?php print $node->field_price[0]['value']; ?>
      </h3>
    </div>
    <div class='excerpt'>
      <?php print $node->content['body']['#value']; ?>
    </div>
    <div class='metadata'>
      <?php print $date; ?> by <?php print $name; ?>
    </div>

  <?php } ?>

</div>
