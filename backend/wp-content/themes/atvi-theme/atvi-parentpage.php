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
			<div class="page-content">
				<?php if(wpmd_is_notphone()) { ?>
				<div class="container">
					<?php if ( function_exists('yoast_breadcrumb') ) 
						{yoast_breadcrumb('<div class="small" id="breadcrumbs"><p class="breadcrumbs-content">','</p></div>');} 
					?>
					<h1 class="title"><?php echo get_the_title() ?></h1>
					<hr>
					<div class="child-menu col-xs-12 col-sm-3">
						<div class="sub-menu">
							<h4 class="trigger-menu title">Menu</h4>
						</div>
						<?php echo wpb_list_child_pages() ?>
					</div>
					<?php 
						get_template_part('template-parts/atvi', 'pagecontent'); 
					?>
				</div>
				<?php } else { ?>
				<div class="child-menu mobile trigger-menu">
					<div class="sub-menu trigger clearfix">
						<h3 class="title col-xs-6">Menu</h3>
						<div class="arrow col-xs-6 text-right">
							<i class="fa fa-chevron-down" aria-hidden="true"></i>
						</div>
					</div>
					<?php echo wpb_list_child_pages() ?>
				</div>
				<?php 
					get_template_part('template-parts/atvi', 'pagecontent');
				}
				?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>