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
	<div class="page-content">
		<header class="entry-header">
			<div class="container">
				<?php
					$video = get_field(video_url);
					echo $video;
				?>
			</div>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<div class="container">
				<h1 class="title"><?php echo the_title(); ?></h1>
				<div class="user-content">
					<?php echo the_content(); ?>
				</div>
			</div>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php //atvi_theme_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		</div>
	</div>

</article><!-- #post-## -->
