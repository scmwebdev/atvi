<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package atvi
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<section class="__fullsegment __relative">
			<div class="container">
				<section class="error-404 not-found ">
					<header class="page-header __spacepad clearfix vcenter">
						<div class="col-xs-12 col-sm-3 text-center">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						</div>
						<div class="col-xs-12 col-sm-9">
							<h1 class=" page-title"><?php esc_html_e( 'Uh oh! Page yang anda cari tidak ada', 'atvi-theme' ); ?></h1>
							<p>Pastikan anda menulis URL dengan benar atau click button dibawah untuk kembali ke home atau kembali ke halaman sebelumnya</p>
							<div class="error-404-btn">
								<a title="Kembali ke halaman sebelumnya">
									<button type="button" class="btn btn-primary back-btn">Back</button>
								</a>
								<a href="<?php echo get_home_url(); ?>" title="Kembali ke homepage">
									<button type="button" class="btn btn-primary">Home</button>
								</a>
							</div>
						</div>
						
					</header><!-- .page-header -->
				</section><!-- .error-404 -->
			</div>

		</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
