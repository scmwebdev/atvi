<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Atvi Child Page 
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area atvi-contentpage <?php echo get_the_title() ?>">
	<main id="main" class="site-main clearfix" role="main">
		<div class="mainbanner">
			<?php
				global $post;
				$parents = get_post_ancestors( $post->ID );
				/* Get the ID of the 'top most' Page if not return current page ID */
				$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
				if(has_post_thumbnail( $id )) {
					if(wpmd_is_phone()) {
						echo get_the_post_thumbnail( $id, 'mainbanner_xs');
					} else {
						echo get_the_post_thumbnail( $id, 'mainbanner_lg');	
					}
				}
			?>
		</div>
		<?php get_template_part('template-parts/atvi', 'pagecontent') ?>
		

		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>