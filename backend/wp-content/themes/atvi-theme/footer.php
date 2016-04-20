<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package atvi
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="widget-area">
		        <?php dynamic_sidebar( 'more-info-widget-area' ); ?>
		    </div><!-- .first .widget-area -->
		</div>
	</footer> 


	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
