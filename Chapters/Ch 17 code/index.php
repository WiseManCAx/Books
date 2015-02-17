<?php get_header(); ?>

<ul data-role="listview">

  <?php $title = wp_title('', false); if ($title) {
    print "<li data-role='list-divider' class='title'>$title</li>";
  } ?>

  <?php while (have_posts()) { the_post(); ?>

    <li>
      <h3>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h3>
      <p>
        <?php the_excerpt(); ?>
      </p>
      <p>
        <?php the_date(); ?> by <?php the_author(); ?>
      </p>
    </li>

  <?php } ?>

</ul>

<?php if ($wp_query->max_num_pages > 1) { ?>
  <br /><div data-role="controlgroup" data-type="horizontal" class="ui-grid-a">

    <?php print str_replace(
      '<a ', '<a class="ui-block-a" data-role="button"',
      get_previous_posts_link('Previous')
    ); ?>

    <?php print str_replace(
      '<a ', '<a class="ui-block-b" data-role="button"',
      get_next_posts_link('Next')
    ); ?>

  </div></p>
<?php } ?>

<?php get_footer(); ?>
