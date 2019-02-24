<?php
/**
 * Quail functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Quail
 */

if ( ! function_exists( 'quail_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function quail_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Quail, use a find and replace
		 * to change 'quail' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'quail', get_template_directory() . '/languages' );

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

		add_image_size( 'quail-img-525-350' , 525 , 350 , array( 'center', 'top' ) );
		add_image_size( 'quail-img-585-500' , 585 , 500 , array( 'center', 'top' ) );
		add_image_size( 'quail-img-330-200' , 330 , 200 , array( 'center', 'top' ) );
		add_image_size( 'quail-img-250-380' , 250 , 380 , array( 'center', 'top' ) );
		add_image_size( 'quail-img-105-70' , 105 , 70 , array( 'center', 'top' ) );
		add_image_size( 'quail-img-46-54' , 46 , 54 , array( 'center', 'top' ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', 'quail' ),
			'secondary-menu' => esc_html__( 'Secondary', 'quail' ),
			'social-menu' => esc_html__( 'Social', 'quail' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'quail_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'width'      => 170,
			'height'       => 40,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for woocommerce.
		 *
		 */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		
	}
endif;
add_action( 'after_setup_theme', 'quail_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quail_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'quail_content_width', 640 );
}
add_action( 'after_setup_theme', 'quail_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function quail_scripts() {
	
	wp_enqueue_style( 'quail-font' , quail_get_font() , array(), '20151215' );

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '20151215' );

	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.min.css', array(), '20151215' );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '20151215' );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '20151215' );

    wp_enqueue_style('quail-style' , get_stylesheet_uri() , array() , '1.0.0' );

    wp_enqueue_style( 'quail-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0' );
    
    
	

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/flexslider.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/parallax.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'quail-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'quail-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.4', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quail_scripts' );

/**
 * loads javscript and css files in admin section.
 */
function quail_admin_enqueue($hook){
	if($hook == 'post.php' || $hook == 'post-new.php' || $hook == 'edit.php'){
		wp_enqueue_style( 'wp-color-picker');

		wp_enqueue_script( 'wp-color-picker');	

		wp_enqueue_style( 'greenturtle-mag-admin-style', get_template_directory_uri() . '/assets/admin/css/admin-style.css', array(), '1.0.4' );

	    wp_enqueue_script( 'quail-admin-script', get_template_directory_uri().'/assets/admin/js/scripts.js','', '1.0.4' , 'all' ); 
	}
	     
}
add_action( 'admin_enqueue_scripts' , 'quail_admin_enqueue' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Recommended plugins
 */
require get_template_directory() . '/inc/theme-recommended-plugins/recommended-plugins.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Theme functions
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Theme functions
 */
require get_template_directory() . '/inc/theme-sidebars/sidebars.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Demo Import
 */
require get_template_directory() . '/inc/theme-demo/one-click-demo-import.php';

if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {

	/* load widgets */
	require get_template_directory() . '/inc/theme-widgets/heading.php';
	require get_template_directory() . '/inc/theme-widgets/paragraph.php';
	require get_template_directory() . '/inc/theme-widgets/button.php';
	require get_template_directory() . '/inc/theme-widgets/card.php';
	require get_template_directory() . '/inc/theme-widgets/services.php';
	require get_template_directory() . '/inc/theme-widgets/testimonials.php';
	require get_template_directory() . '/inc/theme-widgets/team.php';
	require get_template_directory() . '/inc/theme-widgets/blog.php';
	require get_template_directory() . '/inc/theme-widgets/counter.php';
	require get_template_directory() . '/inc/theme-widgets/skillbar.php';


	/* pagebuilder setting extension */
	require get_template_directory() . '/inc/theme-page-builder/page-builder.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



