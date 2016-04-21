<?php 
	$photo = get_field('pengajar_img');
	$name = get_field('pengajar_name');
	$role = get_field('pengajar_role');
?>

<div class="item">
	<div class="item-list col-xs-12 col-sm-4">
		<div class="item-list-photo">
			<img class="img-responsive __fullwidth" src="<?php echo $photo; ?>" alt="<?php echo $name; ?>">
		</div>
		<div class="item-list-desc __spacepad">
			<div class="item-list-name"><?php echo $name; ?><div>
			<div class="item-list-role"><?php echo $role; ?><div>
		</div>
	</div>
</div>