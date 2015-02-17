<div class="comment">
  <?php if ($picture || $title) { ?>
    <div class='header'>
      <?php print $picture; ?>
      <h3><?php print $title; ?></h3>
    </div>
  <?php } ?>
  <div class='metadata'>
    <?php print $date; ?> by <?php print $author; ?>
  </div>
  <div class='content'>
    <?php print $content; ?>
  </div>
  <?php if ($links) { ?>
    <div class='metadata'>
      <?php print $links; ?>
    </div>
  <?php } ?>
</div>