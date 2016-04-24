<div class="container-fluid header-desktop">
	<div class="site-branding col-sm-2 col-md-3">
		<?php
		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<div class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<div class="site-title-logo">
						<img src="<?php echo get_template_directory_uri() . '/images/atvi_logo.png' ?>" alt="ATVI - Logo">
					</div>
				</a>
			</div>
		<?php
		endif;

		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description"><?php //echo $description; ?></p>
		<?php
		endif; ?>
	</div><!-- .site-branding -->
	<nav id="site-navigation" class="main-navigation col-sm-10 col-md-9" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'atvi-theme' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
</div>