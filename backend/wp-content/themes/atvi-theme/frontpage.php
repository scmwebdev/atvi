<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Frontpage
 * @package atvi
 */

// store the image in a variable
$slider_1 = get_field("slider_1");
$slider_1_text = get_field("slider_1_text");
$slider_2 = get_field("slider_2");
$slider_2_text = get_field("slider_2_text");
$slider_3 = get_field("slider_3");
$slider_3_text = get_field("slider_3_text");
$slider_4 = get_field("slider_4");
$slider_4_text = get_field("slider_4_text");

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="carousel" id="atvi-carousel">
			<?php if($slider_1) { ?>
				<div class="carousel-slider-1 ?>">
					<img src="<?php echo $slider_1 ?>" alt="">
				</div>
			<?php } else {
				echo '';
			} ?>
			<?php if($slider_2) { ?>
				<div class="carousel-slider-2 ?>">
					<img src="<?php echo $slider_2 ?>" alt="">
				</div>
			<?php } else {
				echo '';
			} ?>
			<?php if($slider_3) { ?>
				<div class="carousel-slider-3 ?>">
					<img src="<?php echo $slider_3 ?>" alt="">
				</div>
			<?php } else {
				echo '';
			} ?>
			<?php if($slider_4) { ?>
				<div class="carousel-slider-4 ?>">
					<img src="<?php echo $slider_4 ?>" alt="">
				</div>
			<?php } else {
				echo '';
			} ?>
			
				
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>