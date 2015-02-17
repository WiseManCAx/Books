<?php get_header(); ?>

<?php the_post(); ?>

<div class='post'>

  <div class='header'>
    <?php the_post_thumbnail(array(32, 32), 'class=thumbnail'); ?>
    <h3><?php the_title(); ?></h3>
  </div>
  
  <div class='metadata'>
    <?php the_date(); ?> by <?php the_author(); ?>.
    <?php $cats = get_the_category_list(', '); if ($cats) {
      print "<br/>Categories: $cats";
    } ?>
    <?php $tags = get_the_tag_list('', ', '); if ($tags) {
      print "<br/>Tagged: $tags";
    } ?>
  </div>

  <div class='content'>
    <?php the_content(); ?>
  </div>

</div>

<?php comments_template(); ?>

<?php get_footer(); ?>