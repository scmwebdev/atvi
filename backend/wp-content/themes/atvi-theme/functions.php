<?php
/**
 * atvi functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package atvi
 */

if ( ! function_exists( 'atvi_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function atvi_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on atvi, use a find and replace
	 * to change 'atvi-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'atvi-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support('thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'atvi-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'atvi_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'atvi_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function atvi_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'atvi_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'atvi_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function atvi_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'atvi-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'atvi-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//More Info - Footer
    register_sidebar( array(
        'name' => __( 'More Info - Footer', 'Atvi' ),
        'id' => 'more-info-widget-area',
        'description' => __( 'More Info Widget Area', 'Atvi' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    //Our Partner - Footer
    register_sidebar( array(
        'name' => __( 'Our Partner - Footer', 'Atvi' ),
        'id' => 'our-partner-widget-area',
        'class' => '',
        'description' => __( 'Our Partner Widget Area', 'Atvi' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    //Social Media - Footer
    register_sidebar( array(
        'name' => __( 'Social Media - Footer', 'Atvi' ),
        'id' => 'social-media-widget-area',
        'class' => '',
        'description' => __( 'Social Media Widget Area', 'Atvi' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

}
add_action( 'widgets_init', 'atvi_theme_widgets_init' );

// // Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
// add_action( 'widgets_init', 'tutsplus_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function atvi_theme_scripts() {
	wp_enqueue_style( 'atvi-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'atvi-js', get_template_directory_uri() . '/main.js', array(), '', true );

	// wp_enqueue_script( 'atvi-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	// wp_enqueue_script( 'atvi-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'atvi_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* ==================================================================
 * Additional Image Sizes
 * ================================================================== */

add_image_size( 'mainBanner_lg', 1920, 600, true);
add_image_size( 'mainBanner_md', 992, 400, true);
add_image_size( 'mainBanner_xs', 600, 600, true);
add_image_size( 'video_thumb', 500, 250, hard);
add_image_size( 'logo', 200, 200, hard);

/* ==================================================================
 * Display child pages list
 * ================================================================== */

function wpb_list_child_pages() { 

global $post; 
if ( is_page() && $post->post_parent )
  $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
else
  $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
if ( $childpages ) {
  $string = '<ul class="content-list list-parent nodots no-padding-left no-margin-left">' . $childpages . '</ul>';
}
return $string;
}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');

/* ==================================================================
 * Add the_slug() function
 * ================================================================== */

function the_slug($echo=true){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}

/* ==================================================================
 * Custom Pagination
 * ================================================================== */

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo '<nav class="custom-pagination col-xs-12 text-center __spacepad">';
      //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}


/* ==================================================================
 * Get Post Query
 * ================================================================== */

function get_post_query($cat, $maxPost, $postType = 'post') {

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  $args = array( 
    'cat'             => $cat,
    'post_type'       => $postType,
    'posts_per_page'  => $maxPost,
    'order'           => 'DESC',
    'paged'           => $paged
  );
  $the_query = new WP_Query( $args );
  // The Loop
  if ( $the_query->have_posts() ) {
    echo '<div class="item item-post">';
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      get_template_part( 'template-parts/atvi', 'post' );
    }
    echo '</div>';
    if (function_exists(custom_pagination)) {
      custom_pagination($the_query->max_num_pages,"",$paged);
    } else {
      echo 'function does not exist!';
    }
  } else {
    echo 'Maaf, tidak ada post!';
  }
  wp_reset_postdata();
}

function get_events($maxPost) {

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;  
  $args = array( 
    'post_type'       => 'ai1ec_event',
    'posts_per_page'  => $maxPost,
    'order'           => 'DESC',
    'paged'           => $paged
  );
  $the_query = new WP_Query( $args );
  // The Loop
  if ( $the_query->have_posts() ) {
    echo '<div class="item item-post">';
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      get_template_part( 'template-parts/atvi', 'post' );
    }
    echo '</div>';
    if (function_exists(custom_pagination)) {
      custom_pagination($the_query->max_num_pages,"",$paged);
    } else {
      echo 'function does not exist!';
    }
  } else {
    echo 'Maaf, tidak ada post!';
  }
  wp_reset_postdata();
}

function get_latest($content, $maxPost) {
  // $args;
  if ($content == 'berita') {
    $args = array( 
      'cat'             => 8,
      'posts_per_page'  => $maxPost,
      'order'           => 'DESC',
    );
  } elseif ($content == 'event') {
    $args = array( 
      'post_type'       => 'ai1ec_event',
      'posts_per_page'  => $maxPost,
      'order'           => 'DESC',
    );
  }

  $the_query = new WP_Query( $args );

  // The Loop
  if ( $the_query->have_posts() ) {
    echo '<div class="item item-post">';
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      get_template_part( 'template-parts/atvi', 'latest' );
    }
    echo '</div>';
  } else {
    echo 'Maaf, tidak ada post!';
  }
  wp_reset_postdata();
}

/* ==================================================================
 * Get Main Banner
 * ================================================================== */

function main_carousel() {

  for($i = 1; $i <= 4; $i++) { 
    $slider =  ${'slider_'.$i} = get_field("slider_" . $i);
    $slider_url =  ${'slider_'.$i.'_url'} = get_field("slider_" . $i.'_url');

    if ($slider) {
      echo '<div class="carousel clearfix" id="atvi-carousel">';
        echo '<div class="carousel-slider-' . $i . '>';

        if(wpmd_is_phone()) {
          echo '<a href="'. $slider_url .'">';
          echo wp_get_attachment_image( $slider, 'mainBanner_xs' );
          echo '</a>';
        } else {
          echo '<a href="'. $slider_url .'">';
          echo wp_get_attachment_image( $slider, 'mainBanner_lg' );
          echo '</a>';  
        }
        echo '</div';
      echo '</div';
    }

  } //endfor

}

function main_featured() {

  (wpmd_is_phone()) ? the_post_thumbnail('mainBanner_xs') : the_post_thumbnail('mainBanner_lg') ;
}
