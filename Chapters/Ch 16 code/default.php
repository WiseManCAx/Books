<div class='article'>
  <div class='header'>
    <h3>
      <?php print $this->article->title; ?>
    </h3>
  </div>
  <div class='metadata'>
    <?php print $this->article->created; ?> by <?php print $this->article->author; ?>
    <br/>Filed under:
    <a href=' <?php print JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)); ?>'>
      <?php print $this->article->section; ?>
    </a> /
    <a href=' <?php print JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)); ?>'>
      <?php print $this->article->category; ?>
    </a>
  </div>
  <div class='content'>
    <?php print $this->article->text; ?>
  </div>
</div>
