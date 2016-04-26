<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Frontpage 
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area <?php echo get_the_title() ?> frontpage">
	<main id="main" class="site-main clearfix" role="main">
		<div class="carousel" id="atvi-carousel">
			<?php for($i = 1; $i <= 4; $i++) { 
				$slider =  ${'slider_'.$i} = get_field("slider_" . $i);
				if($slider) {
			?>
			<div class="carousel-slider-<?php echo $i; ?>">
				<?php
					if(wpmd_is_phone()) {
						echo wp_get_attachment_image( $slider, 'mainBanner_xs' );		
					} else {
						echo wp_get_attachment_image( $slider, 'mainBanner_lg' );	
					}
				?>
			</div>

			<?php } else {

					// return false;
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
			<hr>
			</div>
		</div>
		<div class="penjurusan __spacepad">
			<div class="container">
				<h2 class="title text-center">Penjurusan</h2>
				<div class="item clearfix">
					<?php 
						$jurusan1_text = get_field('jurusan_1');
						$jurusan1_img = get_field('jurusan_1_img');
						$jurusan2_text = get_field('jurusan_2');
						$jurusan2_img = get_field('jurusan_2_img');
					?>

					<div class="item-list col-xs-12 col-sm-6 __spacepad">
						<div class="item-list-container">
							<div class="item-list-icon">
								<?php echo file_get_contents($jurusan1_img); ?>
							</div>
							<div class="item-list-desc">
								<h2><?php echo $jurusan1_text; ?></h2>
							</div>
						</div>
					</div>

					<div class="item-list col-xs-12 col-sm-6 __spacepad">
						<div class="item-list-container">
							<div class="item-list-icon">
							<?php echo file_get_contents($jurusan2_img); ?>
							</div>
							<div class="item-list-desc">
								<h2><?php echo $jurusan2_text; ?></h2>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="events __spacepad">
			<div class="container">
				<h2 class="title text-center">Warta Berita</h2>
				<div class="__spacepad" id="atvi-events">
					<div class="item">
					<?php

						$args = array(
								"post_type" => "ai1ec_event"
						);

						// The Query
						$event = new WP_Query( $args );

						// The Loop
						if ( $event->have_posts() ) {
							while ( $event->have_posts() ) {
								$event->the_post();
								get_template_part( 'template-parts/atvi', 'events' );
							}
						} else {
							// no posts found
						}
						/* Restore original Post Data */
						wp_reset_postdata();
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="video video-latest __spacepad">
			<div class="container">
				<h2 class="title text-center">Latest Video</h2>
				<div class="item clearfix __spacepad">
					<?php
						$args = array(
								'posts_per_page' => 6,
								'category' => 4
							);
						$videoPost = get_posts($args);

						foreach($videoPost as $post) {
							setup_postdata($post);
							$count_posts = wp_count_posts();
					?>
					<div class="item-list">
						<a href="<?php the_permalink(); ?>">
							<div class="item-list-img">
								<?php the_post_thumbnail('video_thumb'); ?>
							</div>
							<div class="item-list-title clearfix">
								<span><?php the_title(); ?></span>
							</div>
						</a>
					</div>
					<?php }
						wp_reset_postdata();
					?>
				</div>
				<div class="readmore col-xs-12">
					<button type="button" class="btn btn-primary">Click here for more</button>
				</div>
			</div>
		</div>
		<div class="message __spacepad">
			<div class="container">
				<h2 class="title text-center">Pesan dari Direktur</h2>
				<div class="message-container clearfix __spacepad">
					<div class="message-photo col-xs-12 col-sm-4">
						<div class="wrap">
							<?php 
								$photo = get_field('message_img');
								echo '<img class="img-responsive" src="'. $photo .'" alt="director">';
							?>
						</div>
					</div>
					<div class="message-text col-xs-12 col-sm-8">
						<?php 
							$message = get_field('message');
							echo $message;
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="warta-berita __spacepad">
			<div class="container">
				
			</div>
		</div>
		<div class="testimonial __spacepad">
			<div class="container">
				
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>