<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package atvi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mainbanner">
		<?php
			if(wpmd_is_phone()) {
				the_post_thumbnail('mainBanner_xs' );		
			} else {
				the_post_thumbnail('mainBanner_lg' );	
			}
		?>
	</div>
	<div class="page-content">
		<div class="container">
			
		<header class="entry-header">
			<div class="container">
			<?php

						if ( function_exists('yoast_breadcrumb') ) {
		 	yoast_breadcrumb('<div class="small" id="breadcrumbs"><p class="breadcrumbs-content">','</p></div>');} 

				
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php //atvi_theme_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
			<hr class="__nomarginbottom">
			</div>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<div class="container">
				
			
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'atvi-theme' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

			?>
			</div>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php //atvi_theme_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		</div>
	</div>

</article><!-- #post-## -->
