<?php
/**
 * MarcusThompson functions and definitions
 *
 * @package MarcusThompson
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'marcus_thompson_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function marcus_thompson_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MarcusThompson, use a find and replace
	 * to change 'marcus-thompson' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'marcus-thompson', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'marcus-thompson' ),
                'social' => __( 'Social Menu', 'marcus-thompson' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'marcus_thompson_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // marcus_thompson_setup
add_action( 'after_setup_theme', 'marcus_thompson_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function marcus_thompson_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'marcus-thompson' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
        
        register_sidebar( array(
                'name'          => __( 'Footer Widgets', 'marcus-thompson' ),
                'description'   => __( 'Footer widgets area appears in the footer of the site.', 'marcus-thompson' ),
                'id'            => 'sidebar-2',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
        ) );
}
add_action( 'widgets_init', 'marcus_thompson_widgets_init' );

/*
 * Add a portfolio custom post type.
 */
add_action('init', 'create_marcus_thompson_portfolio');
function create_marcus_thompson_portfolio() 
{
  $labels = array(
    'name' => _x('Portfolio', 'portfolio'),
    'singular_name' => _x('Portfolio', 'portfolio'),
    'add_new' => _x('Add New', 'portfolio'),
    'add_new_item' => __('Add New Portfolio Item'),
    'edit_item' => __('Edit Item'),
    'new_item' => __('New Item'),
    'view_item' => __('View Item'),
    'search_items' => __('Search Items'),
    'not_found' =>  __('No items found'),
    'not_found_in_trash' => __('No items found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array('title','editor','thumbnail')
  ); 
  register_post_type('portfolio',$args);
}


/**
 * Enqueue scripts and styles.
 */
function marcus_thompson_scripts() {
	wp_enqueue_style( 'marcus-thompson-style', get_stylesheet_uri() );
        
        wp_enqueue_style('marcus-thompson-content-sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css' );
        
        wp_enqueue_style( 'marcus-thompson-google-fonts', 'http://fonts.googleapis.com/css?family=Oswald:400,300,700|Open+Sans+Condensed:300,300italic,700' );
        
        wp_enqueue_style( 'marcus-thompson-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
        
        wp_enqueue_script( 'marcus-thompson-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20140914', true );
        
        wp_enqueue_script( 'marcus-thompson-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('marcus-thompson-superfish'), '20140914', true );

        wp_enqueue_script( 'marcus-thompson-hide-search', get_template_directory_uri() . '/js/hide-search.js', array('jquery'), '20140915', true );
        
	wp_enqueue_script( 'marcus-thompson-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
        
	wp_enqueue_script( 'marcus-thompson-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        
        wp_enqueue_script( 'marcus-thompson-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20140917', true );
        
        wp_enqueue_script( 'marcus-thompson-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('marcus-thompson-isotope'), '20140922', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'marcus_thompson_scripts' );

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
