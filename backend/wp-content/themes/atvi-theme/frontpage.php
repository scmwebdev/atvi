<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Frontpage
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area <?php echo get_the_title() ?>">
	<main id="main" class="site-main" role="main">
		<div class="carousel" id="atvi-carousel">
			<?php for($i = 1; $i <= 4; $i++) { 
				$slider =  ${'slider_'.$i} = get_field("slider_" . $i);
				if($slider) {
			?>
			<div class="carousel-slider-1 ?>">
					<img src="<?php echo $slider ?>" alt="">
				</div>

			<?php } else {
					echo '';
				} //endof if
			} //endof for
			?>
		</div>
		<div class="sub __spacepad">
			<div class="container">
				<div class="item">
				<?php for($i = 1; $i <= 6; $i++) { 
						$tagline =  ${'tagline_'.$i} = get_field("tagline_" . $i);
						$tagline_desc =  ${'tagline_desc_'.$i} = get_field("tagline_desc_" . $i);
						$tagline_img =  ${'tagline_img_'.$i} = get_field("tagline_img_" . $i);
				?>
					<div class="item-list col-xs-12 col-sm-4 __spacepad">
						<div class="item-list-container">
							<div class="item-list-icon">
								<img class="img-responsive" src="<?php echo $tagline_img; ?>" alt="">
							</div>
							<div class="item-list-desc">
								<div class="item-list-desc-button">
									<?php echo $tagline; ?>
								</div>
								<div class="item-list-desc-text">
									<?php echo $tagline_desc; ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>