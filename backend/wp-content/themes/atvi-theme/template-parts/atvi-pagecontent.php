<div class="user-content col-xs-12 col-sm-9 <?php echo (wpmd_is_notphone()) ? '' : 'mobile'; ?>">
	<?php 
		$slug = $post->post_name;
		if($slug == 'berita') {
			get_post_query(8, 4);
		} elseif ($slug == 'event') {
			get_events(4);
		} elseif($slug == 'video') {
			get_post_query(4, 4);
		} elseif ($slug == 'tenaga-pengajar') {
			get_template_part('template-parts/atvi', 'tenaga-pengajar');
		}
	?>
</div>