<div class="container-fluid">
	<div class="site-branding col-sm-6">
		atvi
	</div><!-- .site-branding -->
	<div class="menu-bar">
		bar
			<nav id="site-navigation" class="main-navigation col-sm-6" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'atvi-theme' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
	</div>

</div>