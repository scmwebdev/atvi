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
			<div class="widget-area col-xs-12 col-sm-4" id="more-info">
		        <?php dynamic_sidebar( 'more-info-widget-area' ); ?>
		    </div><!-- #more-info .widget-area -->

		    <div class="widget-area col-xs-12 col-sm-4" id="our-partners">
		        <?php dynamic_sidebar( 'our-partner-widget-area' ); ?>
		    </div><!-- #our-partners .widget-area -->

		    <div class="widget-area col-xs-12 col-sm-4" id="social-media">
		        <?php dynamic_sidebar( 'social-media-widget-area' ); ?>
		    </div><!-- #social-media .widget-area -->
		    <div class="copyright __right">
		    	<span><i class="fa fa-copyright" aria-hidden="true"></i></span>
		    	<span>Copyright ATVI 2016.</span>
		    </div>
		</div>
	</footer> 


	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
