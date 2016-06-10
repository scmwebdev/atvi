<?php
/**
 * Template for display the frontpage of the website
 * Template Name: Frontpage 
 * @package atvi
 */

get_header(); ?>
<div id="primary" class="content-area clearfix <?php echo get_the_title() ?> frontpage">
	<main id="main" class="site-main clearfix" role="main">
		<?php (has_post_thumbnail()) ? main_featured() : get_main_banner(); ?>
		<div class="segment highlight spacepad-15">
			<div class="container">
				<div class="segment-header">
					<h2 class="title">ATVI</h2>
					<p class="lead">ATVI senantiasa menyambut hangat kehadiran para generasi calon insan televisi masa depan untuk bergabung bersama di <span class="slogan">"Kampus Broadcast Sebenarnya".</span></p>
				</div>
				<div class="segment-content">
				<?php for($i = 1; $i <= 6; $i++) { 
					$tagline =  ${'tagline_'.$i} = get_field("tagline_" . $i);
					$tagline_desc =  ${'tagline_desc_'.$i} = get_field("tagline_desc_" . $i);
					$tagline_img =  ${'tagline_img_'.$i} = get_field("tagline_img_" . $i);
				?>
				<div class="item-list col-xs-6 col-sm-4">
					<div class="item-list-container clearfix">
						<div class="item-list-icon col-xs-12 col-sm-4">
							<img class="img-responsive" src="<?php echo $tagline_img; ?>" alt="">
						</div>
						<div class="item-list-desc col-xs-12 col-sm-8">
							<div class="item-list-desc-title">
								<div class="title"><?php echo $tagline; ?></div>
							</div>

							<?php if(wpmd_is_notdevice()) { ?>
							<div class="item-list-desc-text">
								<p class="no-margin-bottom"><?php echo $tagline_desc; ?></p>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<div class="segment penjurusan spacepad-15">
			<div class="container">
				<div class="segment-header">
					<h2 class="title">Penjurusan</h2>
					<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ornare mollis erat, eu sollicitudin ligula sollicitudin eget.</p>
				</div>
				<div class="segment-content clearfix">
					<?php 
						$jurusan1_text = get_field('jurusan_1');
						$jurusan1_img = get_field('jurusan_1_img');
						$jurusan2_text = get_field('jurusan_2');
						$jurusan2_img = get_field('jurusan_2_img');
					?>

					<div class="item-list col-xs-12 col-sm-6 spacepad-15">
						<div class="item-list-container">
							<div class="item-list-icon">
								<?php echo file_get_contents($jurusan1_img); ?>
							</div>
							<div class="item-list-desc">
								<h2><?php echo $jurusan1_text; ?></h2>
							</div>
						</div>
					</div>

					<div class="item-list col-xs-12 col-sm-6 spacepad-15">
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
		<div class="segment spacepad-15" id="warta-berita">
			<div class="<?php echo (wpmd_is_notdevice()) ? 'container' : ' '; ?> spacepad">
				<div class="segment-header warta-berita-header">
					<h2 class="title">Berita & Event Terbaru ATVI</h2>
					<ul class="nav nav-tabs nav-justified no-spacepad-side" id="warta-berita-controller">
					  <li role="presentation" data-warta="news" class="active"><a>Berita</a></li>
					  <li role="presentation" data-warta="events"><a>Events</a></li>
					</ul>
				</div>
				<div class="segment-content warta-berita-post">
					<div class="container">
						<div class="post-latest clearfix toggled" id="atvi-news">
							<?php get_latest('berita', 4); ?>
							<div class="atvi-btn __view-btn __view-btn-all">
								<a href="<?php echo home_url() . '/warta-berita/berita/'?>" class="btn btn-primary" role="button">Lihat lebih lanjut</a>
							</div>
						</div>
						<div class="post-latest clearfix" id="atvi-events">
							<?php get_latest('event', 4); ?>
							<div class="atvi-btn __view-btn __view-btn-all">
								<a href="<?php echo home_url() . '/warta-berita/event/'?>" class="btn btn-primary" role="button">Lihat lebih lanjut</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- <div class="video video-latest spacepad-15">
			<div class="container">
				<h2 class="title text-center">Latest Video</h2>
				<div class="item clearfix spacepad-15">
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
				<div class="atvi-btn __view-btn __view-btn-all">
						<a href="<?php echo home_url() . '/warta-berita/video/'?>" class="btn btn-primary" role="button">Lihat lebih lanjut</a>
					</div>
			</div>
		</div>
		<div class="message spacepad-15">
			<div class="container">
				<h2 class="title text-center">Pesan dari Direktur</h2>
				<div class="message-container clearfix spacepad-15">
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
		<div class="warta-berita spacepad-15">
			<div class="container">
				
			</div>
		</div>
		<div class="testimonial spacepad-15">
			<div class="container">
				
			</div>
		</div> -->
	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>