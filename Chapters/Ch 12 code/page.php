<?php get_header(); ?>

<?php the_post(); ?>

<div class='post'>

  <div class='header'>
    <?php the_post_thumbnail(array(32, 32), 'class=thumbnail'); ?>
    <h3><?php the_title(); ?></h3>
  </div>
  
  <div class='content'>
    <?php the_content(); ?>
  </div>

</div>

<?php get_footer(); ?>