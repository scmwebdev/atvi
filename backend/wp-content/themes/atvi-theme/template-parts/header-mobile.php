<div class="header-mobile">
	<div class="site-branding __left __spacepad">
		<?php
		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
		endif; ?>
	</div><!-- .site-branding -->
	<div class="site-menu __right __spacepad">
		<div class="menu-trigger">
			<i class="fa fa-bars fa-lg" aria-hidden="true"></i>
		</div>
	</div>
	<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="main-navigation-closebtn menu-trigger">
				<i class="fa fa-times fa-3x" aria-hidden="true"></i>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

	</nav>
</div>