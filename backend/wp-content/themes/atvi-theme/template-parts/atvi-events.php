<div class="item-list col-xs-12 col-sm-4">
	<div class="item-list-container">
		<div class="item-list-thumbnail">
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
			<?php echo substr(get_the_excerpt(), 0, 400) . ' ...'?>
		</div>
	</div>


</div>
