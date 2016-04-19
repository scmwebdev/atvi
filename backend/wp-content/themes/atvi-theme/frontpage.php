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
			<div class="carousel-slider-<?php echo $i; ?>">
				<img src="<?php echo $slider ?>" alt="">
			</div>

			<?php } else {
					echo '';
				} //endof if
			} //endof for
			?>
		</div>
		<div class="highlight __spacepad">
			<div class="container">
				<div class="item clearfix">
				<?php for($i = 1; $i <= 6; $i++) { 
					$tagline =  ${'tagline_'.$i} = get_field("tagline_" . $i);
					$tagline_desc =  ${'tagline_desc_'.$i} = get_field("tagline_desc_" . $i);
					$tagline_img =  ${'tagline_img_'.$i} = get_field("tagline_img_" . $i);
				?>
				<div class="item-list col-xs-6 col-sm-4 __spacepad">
					<div class="item-list-container clearfix">
						<div class="item-list-icon col-xs-12 col-sm-4">
							<img class="img-responsive" src="<?php echo $tagline_img; ?>" alt="">
						</div>
						<div class="item-list-desc col-xs-12 col-sm-8">
							<div class="item-list-desc-title">
								<h3 class="title"><?php echo $tagline; ?></h3>
							</div>

							<?php if(wpmd_is_notdevice()) { ?>
							<div class="item-list-desc-text">
								<p class="__nomarginbottom"><?php echo $tagline_desc; ?></p>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="penjurusan __spacepad">
			<div class="container">
				<div class="item clearfix">
					<?php 
						$jurusan1_text = get_field('jurusan_1');
						$jurusan1_img = get_field('jurusan_1_img');
						$jurusan2_text = get_field('jurusan_2');
						$jurusan2_img = get_field('jurusan_2_img');
					?>

					<div class="item-list col-xs-6 __spacepad">
						<div class="item-list-container">
							<div class="item-list-icon">
								<?php echo file_get_contents($jurusan1_img); ?>
								<!-- <img class="img-responsive" src="<?php echo $jurusan1_img; ?>" alt="<?php echo $jurusan1_text; ?>"> -->
							</div>
							<div class="item-list-desc">
								<h2><?php echo $jurusan1_text; ?></h2>
							</div>
						</div>
					</div>

					<div class="item-list col-xs-6 __spacepad">
						<div class="item-list-container">
							<div class="item-list-icon">
							<?php echo file_get_contents($jurusan2_img); ?>
								<!-- <img class="img-responsive" src="<?php echo $jurusan2_img; ?>" alt="<?php echo $jurusan2_text; ?>"> -->
							</div>
							<div class="item-list-desc">
								<h2><?php echo $jurusan2_text; ?></h2>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>