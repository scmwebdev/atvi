<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Atvi Child Page 
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area atvi-contentpage <?php the_slug() ?>">
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
						$page = get_post(185); //tenaga pengajar
						$slug = $page->post_name; // get the page/post slug

						if(is_page(185)) {
							get_template_part('template-parts/atvi', $slug);
						} else {
							get_template_part('template-parts/atvi', 'pagecontent');
						}
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
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<div class="small" id="breadcrumbs"><p class="breadcrumbs-content">','</p></div>');
					}
					$page = get_post(185); //tenaga pengajar
					$slug = $page->post_name; // get the page/post slug

					if(is_page(185)) {
						get_template_part('template-parts/atvi', $slug);
					} else {
						get_template_part('template-parts/atvi', 'pagecontent');
					}
				}
				?>

			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>