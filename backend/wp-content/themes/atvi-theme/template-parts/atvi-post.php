<?php 

$get_id = $the_query->post->ID;
$get_category = get_the_category($get_id);
$category = esc_html( $get_category[0]->name);

?>

<div class="item-list col-xs-12 col-sm-6">
	<div class="item-list-container">
		<div class="item-list-thumbnail __hovertype-2">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('video_thumb', array('class' => 'img-responsive')); ?>
			</a>
		</div>
		<div class="item-list-title">
			<a href="<?php the_permalink(); ?>">
				<p class="title"><?php the_title(); ?></p>
			</a>
		</div>
		<div class="item-list-content">
			<?php 

				$content = get_the_content();
				$type = get_post_type();
				if ($content == true) {
					if($category == 'berita') {
						echo substr(get_the_excerpt(), 0, 200) . ' ...';
					} elseif($type == 'ai1ec_event') {
						echo substr(get_the_excerpt(), 0, 400) . ' ...';
					}
				}
				// dont display text on video
				
			?>
		</div>
	</div>
</div>