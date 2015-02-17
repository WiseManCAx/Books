<?php get_header();?>
<div id="wrap" class="container_12">
<div id="main-container" class="grid_8">
<?php if(have_posts()):?><?php while(have_posts()):the_post();?>

<div class="post"> 
<h2 class="post-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2><!--post-title--> 
<div class="post-content">
<h3 class="tagline"><?php echo get('tagline'); ?></h3>
<?php the_content();?>
</div><!--post-content-->
<?php wp_link_pages('before=<div id="page-links">Page&after=</div>'); ?>
</div><!--post-->
<?php edit_post_link('Edit This','<div class="edit-me-links">','</div>');?>
<?php endwhile;?>
<?php endif;?>
</div><!--main-container-->
<?php get_sidebar();?>
</div><!--wrap-->
<?php get_footer();?>
