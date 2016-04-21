<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Atvi Parent Page 
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area atvi-contentpage <?php echo get_the_title() ?>">
	<main id="main" class="site-main clearfix" role="main">
		<div class="mainbanner">
			<?php
				if(wpmd_is_phone()) {
					the_post_thumbnail('mainBanner_xs' );		
				} else {
					the_post_thumbnail('mainBanner_lg' );	
				}
			?>
		</div>
		<?php get_template_part('template-parts/atvi', 'pagecontent') ?>

		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>