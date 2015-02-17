<?php get_header(); ?>

<?php the_post(); ?>

<?php $title = wp_title('', false); if ($title) { ?>
  <ul data-role="listview">
    <li data-role='list-divider' class='title'><?php print $title; ?></li>
    <li><?php the_date(); ?> by <?php the_author(); ?>.</li>
  </ul>
<?php } ?>

<p>
  <small>
    <?php $cats = get_the_category_list(', '); if ($cats) {
      print "<br/>Categories: $cats";
    } ?>
    <?php $tags = get_the_tag_list('', ', '); if ($tags) {
      print "<br/>Tagged: $tags";
    } ?>
  </small>
</p>

<?php the_content(); ?>

<?php comments_template(); ?>

<?php get_footer(); ?>
