<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package atvi
 */

$slug = $post->post_name;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mainbanner">
		<?php
			if(wpmd_is_phone()) {
				the_post_thumbnail('mainBanner_xs' );		
			} else {
				the_post_thumbnail('mainBanner_lg', array( 'class' => 'img-responsive __fullwidth') );	
			}
		?>
	</div>
	<div class="page-content">
		<div class="container">
			
		<header class="entry-header">

		 	<div class="small" id="breadcrumbs">
				<p class="breadcrumbs-content">
					<span><a href="<?php echo home_url() ?>">Home</a></span>
					<span> » </span>
					<span><a href="<?php echo home_url() . '/warta-berita'; ?>">Warta Berita</a></span>
					<span> » </span>
					<span><a href="<?php echo home_url() . '/warta-berita/event'; ?>">Event</a></span>
					<span> » </span>
					<span><a href="<?php echo home_url() . '/warta-berita/' . $slug; ?>"><?php the_title(); ?></a></span>
				</p>
			</div>

			<h1 class="entry-title title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'atvi-theme' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<hr>
		</footer><!-- .entry-footer -->
		</div>
	</div>

</article><!-- #post-## -->
