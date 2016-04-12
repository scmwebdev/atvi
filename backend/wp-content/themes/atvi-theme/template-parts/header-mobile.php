<div class="header-mobile">
	<div class="site-branding col-xs-6 __spacepad">
		<?php
		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
		endif; ?>
	</div><!-- .site-branding -->
	<div class="col-xs-6 menu-trigger __spacepad">
		<div>
			<i class="fa fa-bars fa-lg" aria-hidden="true"></i>
		</div>
	</div>
	<nav id="site-navigation" class="main-navigation col-xs-12" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
</div>