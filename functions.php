<?php
/**
 * ekiline functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package ekiline
 */

function ekiline_setup() {
	// Traducciones // Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'ekiline', get_template_directory() . '/languages' );

	// Lector RSS // Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Metadatos: Titulo. // Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Permitir miniaturas // Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Permitir uso de HTML5 en formularios. // Switch default core markup for search form, comment form, and comments
	$htmlDef = array('search-form','comment-form','comment-list','gallery','caption');
	add_theme_support( 'html5', $htmlDef );

	// Formatos de entradas // Enable support for Post Formats.
	$postDef = array('aside','image','video','quote','link');
	add_theme_support( 'post-formats', $postDef );

	// Color e imagen de fondo // Set up the WordPress core custom background feature.
	$backDef = array( 'default-image' => '', 'default-color' => 'ffffff' );
	add_theme_support( 'custom-background', $backDef );	
	
    // Actualizacion de widgets en el personalizador // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Menú, Ekiline solo necesita uno: ekilineNavbar('primary') // This theme uses ekilineNavbar('primary') as one location.
	register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'ekiline' )
	) );	
}
add_action( 'after_setup_theme', 'ekiline_setup' );

/**
 * Establecer el ancho de objetos (imagenes).
 * @link https://codex.wordpress.org/Content_Width#Adding_Theme_Support
 * @link https://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 * @link https://wycks.wordpress.com/2013/02/14/why-the-content_width-wordpress-global-kinda-sucks/
 * Heredar la medida de /wp-admin/options-media.php.
 */
if ( ! isset( $content_width ) ) $content_width = '';

/**
 * Registrar widgets y sus areas // Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
  
function ekiline_widgets_init() {
        	
// Default sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Left sidebar', 'ekiline' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
// Right sidebar
    register_sidebar( array(
        'name'          => esc_html__( 'Right sidebar', 'ekiline' ),
        'id'            => 'sidebar-2',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
		
// Footer widgets
    register_sidebar( array(
        'name'          => esc_html__( 'Footer widgets', 'ekiline' ),
        'id'            => 'footer-w1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

// Widgets at top of content
    register_sidebar( array(
        'name'          => esc_html__( 'Top first over all content', 'ekiline' ),
        'id'            => 'toppage-w1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p>',
        'after_title'   => '</p>',
    ) );   

// Widget in content
    register_sidebar( array(
        'name'          => esc_html__( 'In page at top of content', 'ekiline' ),
        'id'            => 'content-w1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="lead font-weight-bold widget-title">',
        'after_title'   => '</p>',
    ) );

        register_sidebar( array(
        'name'          => esc_html__( 'In page at bottom of content', 'ekiline' ),
        'id'            => 'content-w2',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="lead font-weight-bold widget-title">',
        'after_title'   => '</p>',
    ) );
               	
}
add_action( 'widgets_init', 'ekiline_widgets_init' );

/**
 * Estilos CSS // Javascript // Js con argumentos
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link https://developer.wordpress.org/reference/functions/wp_script_add_data/
 */
 
function ekiline_scripts() {	
    wp_enqueue_style( 'bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4', 'all' );
	wp_enqueue_style( 'ie10-viewport-bug-workaround', get_template_directory_uri() . '/assets/css/ie10-viewport-bug-workaround.min.css', array(), '1', 'all' );
		wp_style_add_data( 'ie10-viewport-bug-workaround', 'conditional', 'gte IE 8' );	
	wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/ekiline.css', array(), '1.0', 'all' );	
	wp_enqueue_style( 'ekiline-style', get_stylesheet_uri() );	        
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), '5.0.6', 'all' ); 
    // wp_enqueue_style( 'google-font', $gfont, array(), '0.0.0', 'all' );         
    if( !is_admin() ){
        wp_dequeue_script('jquery');
        wp_dequeue_script('jquery-core');
        wp_dequeue_script('jquery-migrate');
        wp_enqueue_script('jquery', false, array(), false, true);
        wp_enqueue_script('jquery-core', false, array(), false, true);
        wp_enqueue_script('jquery-migrate', false, array(), false, true);          
     }        	
	wp_enqueue_script( 'popper-script', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1', true  );
 	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4', true  );
    wp_enqueue_script( 'ekiline-swipe', get_template_directory_uri() . '/assets/js/carousel-swipe.min.js', array('jquery'), '20150716', true  );
//Desde aquí los scripts de Ekiline se agrupan en bloque.
    wp_enqueue_script( 'ekiline-layout', get_template_directory_uri() . '/assets/js/ekiline.js', array('jquery'), '20151226', true  );
    	wp_localize_script( 'ekiline-layout', 'themeColors', ekiline_themeColors() );
    wp_enqueue_script( 'ekiline-theme', get_template_directory_uri() . '/assets/js/ekiline-theme.js', array('jquery'), '20190817', true  );
    
	// wp_enqueue_script( 'ie10-vpbugwkrnd', get_template_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.min.js' );
		// wp_script_add_data( 'ie10-vpbugwkrnd', 'conditional', 'gte IE 8' );
	// wp_enqueue_script( 'html5shiv', '//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js' );
		// wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	// wp_enqueue_script( 'respond', '//oss.maxcdn.com/respond/1.4.2/respond.min.js' );
		// wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}			
}
add_action( 'wp_enqueue_scripts', 'ekiline_scripts', 0 );

/**
 * Ekiline optimizacion, emojis al footer
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
add_action('wp_footer', 'print_emoji_detection_script', 20);
remove_action('wp_print_styles', 'print_emoji_styles');
add_action('wp_head', 'print_emoji_styles',20); 

/**
 * Ekiline adiciones.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/themeNavbars.php';
require get_template_directory() . '/inc/themeNavwalker.php';
require get_template_directory() . '/inc/themeElements.php';
require get_template_directory() . '/inc/themeMeta.php';


