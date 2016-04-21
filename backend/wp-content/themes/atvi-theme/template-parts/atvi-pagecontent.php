<div class="page-content">
		<?php 
			if(wpmd_is_notphone()) { ?>
				<div class="container">
				<?php if ( function_exists('yoast_breadcrumb') ) 
					{yoast_breadcrumb('<div class="small" id="breadcrumbs"><p class="breadcrumbs-content">','</p></div>');} 
				?>
					<h1 class="title"><?php echo get_the_title() ?></h1>
					<hr>
					<div class="child-menu col-xs-12 col-sm-3">
						<div class="sub-menu">
							<h3 class="trigger-menu title">Menu</h3>
						</div>
						<?php echo wpb_list_child_pages() ?>
					</div>
					<div class="user-content col-xs-12 col-sm-9">
						<?php the_content(); ?>
					</div>
				</div>
		<?php } else { ?>
			<div class="child-menu mobile trigger-menu">
				<div class="sub-menu trigger clearfix">
					<h3 class="title col-xs-6">Menu</h3>
					<div class="arrow col-xs-6 text-right">
						<i class="fa fa-chevron-down" aria-hidden="true"></i>
					</div>
				</div>
				<?php echo wpb_list_child_pages() ?>
			</div>
			<?php if ( function_exists('yoast_breadcrumb') ) 
				{yoast_breadcrumb('<div class="small" id="breadcrumbs"><p class="breadcrumbs-content">','</p></div>');} 
			?>
			<div class="user-content col-xs-12 col-sm-9">
				<h1 class="title"><?php echo get_the_title() ?></h1>
				<hr />
				<?php the_content(); ?>
			</div>
		<?php } ?>

</div>