<?php 
	if(wpmd_is_notphone()) { ?>
		<div class="user-content col-xs-12 col-sm-9">
			<h1 class="title"><?php echo get_the_title() ?></h1>
			<hr>

			<?php 
				$slug = $post->post_name;
				if($slug == 'berita') {

					//grab post with berita category
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'cat' 				=> 8,
						'post_type' 		=> 'post',
						'posts_per_page'	=> '4',
						'order'			 	=> 'DESC',
						'paged' 			=> $paged
					);
					// The Query
					$the_query = new WP_Query( $args );

					// The Loop
					if ( $the_query->have_posts() ) {
						echo '<div class="item item-post">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/atvi', 'post' );
						}
						echo '</div>';
						if (function_exists(custom_pagination)) {
							custom_pagination($the_query->max_num_pages,"",$paged);
						} else {
							echo 'function does not exist!';
						}
					} else {
						echo 'Maaf, tidak ada post!';
					}
					wp_reset_postdata();

				} elseif($slug == 'calendar') {
					
					//grab post with berita category
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'post_type'			=> 'ai1ec_event',
						'posts_per_page'	=> '4',
						'order' 			=> 'DESC',
						'paged' 			=> $paged
					);
					// The Query
					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) {
						echo '<div class="item item-post">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/atvi', 'post' );
						}
						echo '</div>';
						if (function_exists(custom_pagination)) {
							custom_pagination($the_query->max_num_pages,"",$paged);
						} else {
							echo 'function does not exist!';
						}
					} else {
						echo 'Maaf, tidak ada post!';
					}
					wp_reset_postdata();

				} elseif($slug == 'tenaga-pengajar') {
					get_template_part('template-parts/atvi', 'tenaga-pengajar');
				} elseif($slug == 'video') {

					//grab post with berita category
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'cat' 				=> 4,
						'post_type' 		=> 'post',
						'posts_per_page'	=> '4',
						'order' 			=> 'DESC',
						'paged' 			=> $paged
					);
					// The Query
					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) {
						echo '<div class="item item-post">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/atvi', 'post' );
						}
						echo '</div>';
						if (function_exists(custom_pagination)) {
							custom_pagination($the_query->max_num_pages,"",$paged);
						} else {
							echo 'function does not exist!';
						}
					} else {
						echo 'Maaf, tidak ada post!';
					}
					wp_reset_postdata();

				} else {
					the_content();
				}
				
			?>
		</div>
<?php } else { ?>
	<div class="user-content mobile col-xs-12 col-sm-9">
		<h1 class="title"><?php echo get_the_title() ?></h1>
		<hr />
		<?php 
				$slug = $post->post_name;
				if($slug == 'berita') {

					//grab post with berita category
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'cat' 				=> 8,
						'post_type' 		=> 'post',
						'posts_per_page'	=> '4',
						'order'			 	=> 'DESC',
						'paged' 			=> $paged
					);
					// The Query
					$the_query = new WP_Query( $args );

					// The Loop
					if ( $the_query->have_posts() ) {
						echo '<div class="item item-post">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/atvi', 'post' );
						}
						echo '</div>';
						if (function_exists(custom_pagination)) {
							custom_pagination($the_query->max_num_pages,"",$paged);
						} else {
							echo 'function does not exist!';
						}
					} else {
						echo 'Maaf, tidak ada post!';
					}
					wp_reset_postdata();

				} elseif($slug == 'calendar') {
					
					//grab post with berita category
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'post_type'			=> 'ai1ec_event',
						'posts_per_page'	=> '4',
						'order' 			=> 'DESC',
						'paged' 			=> $paged
					);
					// The Query
					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) {
						echo '<div class="item item-post">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/atvi', 'post' );
						}
						echo '</div>';
						if (function_exists(custom_pagination)) {
							custom_pagination($the_query->max_num_pages,"",$paged);
						} else {
							echo 'function does not exist!';
						}
					} else {
						echo 'Maaf, tidak ada post!';
					}
					wp_reset_postdata();

				} elseif($slug == 'tenaga-pengajar') {
					get_template_part('template-parts/atvi', 'tenaga-pengajar');
				} elseif($slug == 'video') {

					//grab post with berita category
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$args = array( 
						'cat' 				=> 4,
						'post_type' 		=> 'post',
						'posts_per_page'	=> '4',
						'order' 			=> 'DESC',
						'paged' 			=> $paged
					);
					// The Query
					$the_query = new WP_Query( $args );
					// The Loop
					if ( $the_query->have_posts() ) {
						echo '<div class="item item-post">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/atvi', 'post' );
						}
						echo '</div>';
						if (function_exists(custom_pagination)) {
							custom_pagination($the_query->max_num_pages,"",$paged);
						} else {
							echo 'function does not exist!';
						}
					} else {
						echo 'Maaf, tidak ada post!';
					}
					wp_reset_postdata();

				} else {
					the_content();
				}
				
			?>
	</div>
<?php } ?>