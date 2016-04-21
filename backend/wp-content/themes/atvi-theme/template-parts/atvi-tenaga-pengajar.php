<?php 
	$photo = get_field('pengajar_img');
	$name = get_field('pengajar_name');
?>

<div class="item">
	<div class="item-list col-xs-12 col-sm-4">
		<div class="item-list-photo">
			<img class="img-responsive __fullwidth" src="<?php echo $photo; ?>" alt="<?php echo $name; ?>">
		</div>
		<div class="item-list-name __spacepad">
			<p class="lead"><?php echo $name; ?></p>
		</div>
	</div>
</div>