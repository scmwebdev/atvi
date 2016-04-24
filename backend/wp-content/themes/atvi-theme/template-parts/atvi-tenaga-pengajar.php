<?php
	/*
	 * Template for tenaga pengajar
	 */

	$url = site_url();

?>
<div class="user-content col-xs-12 col-sm-9">
	<div class="item">

	<?php
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'post',
			'category_name' => 'pengajar',
			'posts_per_page' => 6,
			'order' => 'DESC',
			'paged' => $paged
		);

		$the_query = new WP_Query($args);

		if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 
		$role = get_field('role');
	?>

		<div class="item-list col-xs-12 __nopadding">
			<div class="item-list-photo col-xs-12 col-sm-4">
				<?php 
					if(has_post_thumbnail()) {
						the_post_thumbnail(); 
					} else { ?>
						<img class="img-responsive" src="<?php echo $url ?>/wp-content/uploads/2016/04/person_nothumbnail.png" alt="no thumbnail">
					<?php }
				?>
			</div>
			<div class="item-list-desc col-xs-12 col-sm-8">
				<div class="item-list-name"><?php the_title(); ?></div>
				<div class="item-list-exp __spacepad"><?php the_content(); ?></div>
			</div>
		</div>
	<?php 
		endwhile;
			if (function_exists(custom_pagination)) {
				custom_pagination($the_query->max_num_pages,"",$paged);
			} else {
				echo 'function does not exist!';
			}
		else:
	?>
	<article>
		<h1>Sorry...</h1>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	</article>

	<?php 
		endif;
		wp_reset_postdata();
	
	?>

	</div>
</div>