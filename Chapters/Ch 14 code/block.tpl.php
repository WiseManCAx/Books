<div class="block">
  <?php if ($block->subject) { ?>
    <div class='header'>
      <h3><?php print $block->subject; ?></h3>
    </div>
  <?php } ?>
  <div class="content">
    <?php print $block->content ?>
  </div>
</div>