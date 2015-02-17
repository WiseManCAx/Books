<?php get_header(); ?>

<?php $title = wp_title('', false); if ($title) {
  print "<h2 class='title'>$title</h2>";
} ?>

<?php while (have_posts()) { the_post(); ?>

  <div class='post'>

    <div class='header'>
      <?php the_post_thumbnail(array(32, 32), 'class=thumbnail'); ?>
      <h3>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h3>
    </div>

    <div class='excerpt'>
      <?php the_excerpt(); ?>
    </div>

    <div class='metadata'>
      <?php the_date(); ?> by <?php the_author(); ?>
    </div>

  </div>

<?php } ?>

<?php if ($wp_query->max_num_pages > 1) { ?>
  <div id="pager">
    <?php previous_posts_link('Previous'); ?>
    <?php next_posts_link('Next'); ?>
  </div>
<?php } ?>

<?php get_footer(); ?>