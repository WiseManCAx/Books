<?php get_header() ?>
<div id="container_container">
	<div id="container">
		<div id="content">
	        <div id="random_feature">
	            <div id="previous" class="previous"><a href="#"><img alt="Previous" src="<?php bloginfo('template_directory');?>/img/previous.png"/></a></div>
            	<div id="feature-content">
                		<?php         
						$my_query = new WP_Query("category_name=Features&showposts=4&orderby=rand");
					
						while ($my_query->have_posts()) : $my_query->the_post();
								//print_r($post);
								echo '<div id="feature-'.$post->ID.'" class="slide" title="' . $post->post_title .'">';
								//alt="'. htmlentities(get_post_meta($post->ID,'desc',true)).'"

									echo '<div class="feature-post-content">'. $post->post_content .'</div>';
								echo "</div>\n";
						endwhile; 
						?>
                </div>
                <div id="next" class="next"><a href="#"><img alt="Next" src="<?php bloginfo('template_directory');?>/img/next.png"/></a></div>
                <table id="feature-nav-table" cellpadding="0" cellspacing="0" border="0"><tr><td valign="middle">
                <ul id="feature-nav"> </ul>
                </td></tr></table>
            </div>

<?php 
/* give admin a create post button */
						if ( current_user_can('edit_posts') ) { ?>
	
	<div class="clearer"></div>
	<div class="admin"><strong>Admin</strong>:  <a href="<?php bloginfo('home'); ?>/wp-admin/post-new.php">New Post</a> | <a href="/wp-admin/page-new.php">New Page</a> | <a href="/wp-admin/link-add.php">New Link</a> | <a href="/wp-admin/">Site Admin</a></div><div class="clearer"></div>
<?php 
}
?>



<?php 		
global $more;
global $is_single;
$more = 0; 
$is_single = 0;
if (is_home()) {  
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts("cat=-3&paged=$paged&showposts=3");   
}

?>
<div class="clearer"></div>
<div id="blocks"><div>
<?php while (have_posts() ) : the_post() ?>

			<div id="post-<?php the_ID() ?>" class="block <?php //sandbox_post_class() ?>">
				<h2><a href="<?php the_permalink() ?>" title="<?php printf( __('Permalink to %s', 'sandbox'), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				<div class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php unset($previousday); printf( __( '%1$s &#8211; %2$s', 'sandbox' ), the_date( '', '', '', false ), get_the_time() ) ?></abbr></div>
				<div class="entry-content">
<?php the_content('<span class="meta-nav">Read More &raquo;</span>') ?>

				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sandbox' ) . '&after=</div>') ?>
				</div>
				<div class="entry-meta">
					<span class="author vcard"><?php printf( __( 'By %s', 'sandbox' ), '<a class="url fn n" href="' . get_author_link( false, $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( __( 'View all posts by %s', 'sandbox' ), $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></span>
					<span class="meta-sep">|</span>
					<span class="cat-links"><?php printf( __( 'Posted in %s', 'sandbox' ), get_the_category_list(', ') ) ?></span>
					<span class="meta-sep">|</span>
					<?php the_tags( __( '<span class="tag-links">Tagged ', 'sandbox' ), ", ", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
<?php edit_post_link( __( 'Edit', 'sandbox' ), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Comments (0)', 'sandbox' ), __( 'Comments (1)', 'sandbox' ), __( 'Comments (%)', 'sandbox' ) ) ?></span>
				</div>
                <?php edit_post_link( __( 'Edit', 'sandbox' ), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>" ) ?>
			</div><!-- .post -->

<?php comments_template() ?>

<?php endwhile; ?>

          <div class="clearer"></div>
</div></div>
   	   
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
</div> <?php /* end container container */ ?>

<script type="text/javascript">
<!--
	jQuery(function($) {
		/*
		$('#more, #pagepicker h3').click( function(){ 
				$('ul#morepages').slideToggle();

				if($('#more').html() == 'Show More Areas'){
					$('#more').html('Show Less Areas');
				} else { 
					$('#more').html('Show More Areas');
				}

				return false;
		});
		*/
		$('#feature-content').cycle({ 
			fx:    'scrollHorz', 
			speed:  500,  //time the transition lasts
			timeout: 10000, //time between transitions
			pause: 1, //stop the show on mouseover
			random: 0, //random order (our mysql does this already)
			delay: -1000, //delay before show starts first transition
			next:   '#next', 
			prev:   '#previous',
			pager: "#feature-nav",
			autostop:       true, // true to end slideshow after X transitions (where X == slide count) 
			autostopCount: 100,      // number of transitions (optionally used with autostop to define X) 
			// callback fn that creates a thumbnail to use as pager anchor 
		    pagerAnchorBuilder: function(idx, slide) { 
				// return selector string for existing anchor 
				// slide.attributes.alt.value
				//slide.childNodes[0].childNodes[0].alt 
				var desc = jQuery('#'+slide.id+' div img:first').attr("title");
		        return '<li><a href="#">'+slide.title+'</a><div class="controlsdesc">'+ desc +'</div></li>'; 
			} 
		 });


    }); 
	

//-->
</script>
<?php get_footer() ?>
