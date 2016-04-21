<?php 
	if(wpmd_is_notphone()) { ?>
		<div class="user-content col-xs-12 col-sm-9">
			<?php the_content(); ?>
		</div>
<?php } else { ?>
	<div class="user-content mobile col-xs-12 col-sm-9">
		<h1 class="title"><?php echo get_the_title() ?></h1>
		<hr />
		<?php the_content(); ?>
	</div>
<?php } ?>