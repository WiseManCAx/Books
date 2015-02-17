<?php

print "<h2 class='title'>" . $this->section->title . "</h2>";

foreach ($this->categories as $category) { ?>

  <div class='category'>
    <div class='header'>
      <h3>
        <a href="<?php print $category->link; ?>"><?php print $category->title; ?></a>
      </h3>
    </div>
    <div class='description'>
      <?php print $category->description; ?>
    </div>
    <div class='metadata'>
      <?php print $category->numitems; ?> articles
    </div>
  </div>

<?php } ?>
