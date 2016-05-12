<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Atvi Kontak Kami Page 
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area atvi-contentpage <?php echo get_the_title() ?>">
	<main id="main" class="site-main clearfix" role="main">
		<div class="gmap">
			<?php
				$gmap = get_field('google_map');
				echo '<div class="overlay" onClick="style.pointerEvents=\'none\'"></div>';
				echo $gmap;
			?>
		</div>
			<div class="page-content">
				<?php if(wpmd_is_notphone()) { ?>
				<div class="container">
					<?php if ( function_exists('yoast_breadcrumb') ) 
						{yoast_breadcrumb('<div class="small" id="breadcrumbs"><p class="breadcrumbs-content">','</p></div>');} 
					?>
					<?php 
						//get_template_part('template-parts/atvi', 'pagecontent'); 
					?>
					<div class="user-content">
						<h1 class="title"><?php the_title() ?></h1>
						<hr>
						<div class="contact-form col-xs-12 col-sm-8">
							<?php echo do_shortcode('[wpforms id="284"]'); ?>
						</div>
						<div class="address col-xs-12 col-sm-4">
							<div class="wrapper">
								<?php  the_content(); ?> 
							</div>
							
						</div>
					</div>
				</div>
				<?php } else { 
				
					get_template_part('template-parts/atvi', 'pagecontent');
				}
				?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>