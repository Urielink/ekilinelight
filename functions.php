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

	// Permitir uso de HTML5 en formularios y marcado simple. // Switch default core markup for search form, comment form, and comments
	$htmlDef = array('search-form','comment-form','comment-list','gallery','caption','script', 'style');
	add_theme_support( 'html5', $htmlDef );

	// Formatos de entradas // Enable support for Post Formats.
	$postDef = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	add_theme_support( 'post-formats', $postDef );

	// Color e imagen de fondo // Set up the WordPress core custom background feature. https://developer.wordpress.org/reference/functions/add_theme_support/
	$backDef = array( 'default-image' => '', 'default-color' => 'ffffff', 'wp-head-callback' => 'ekiline_custom_background_cb', );
	add_theme_support( 'custom-background', $backDef );	
	
    // Actualizacion de widgets en el personalizador // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Menú, Ekiline solo necesita uno: ekilineNavbar('primary') // This theme uses ekilineNavbar('primary') as one location.
	register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'ekiline' )
    ) );	

    // Gutenberg: alineaciones a todo lo ancho.
    add_theme_support( 'align-wide' );
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
        
// Widgets between content and footer
register_sidebar( array(
    'name'          => esc_html__( 'Bottom aside', 'ekiline' ),
    'id'            => 'footer-w2',
    'description'   => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
) );   
    
// Footer widgets
    register_sidebar( array(
        'name'          => esc_html__( 'Footer', 'ekiline' ),
        'id'            => 'footer-w1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

// Widgets at top of content
    register_sidebar( array(
        'name'          => esc_html__( 'Top before all content', 'ekiline' ),
        'id'            => 'toppage-w1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p>',
        'after_title'   => '</p>',
    ) );   

// Widget in content
    register_sidebar( array(
        'name'          => esc_html__( 'In page top content', 'ekiline' ),
        'id'            => 'content-w1',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="lead font-weight-bold widget-title">',
        'after_title'   => '</p>',
    ) );

        register_sidebar( array(
        'name'          => esc_html__( 'In page bottom content', 'ekiline' ),
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
    // estilos
    wp_enqueue_style( 'bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4', 'all' );
	wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/ekiline.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'ekiline-style', get_stylesheet_uri() );
        // test
        // wp_deregister_style( array('wp-block-library','bootstrap-4','layout','ekiline-style') );
        // remove_action( 'wp_head', 'ekiline_css_inlineHeadMethod', 100);
    // scripts
    wp_enqueue_script('jquery');
 	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '4' );
    //wp_enqueue_script( 'ekiline-swipe', get_template_directory_uri() . '/assets/js/carousel-swipe.min.js', array('jquery'), '20150716' );
    wp_enqueue_script( 'ekiline-layout', get_template_directory_uri() . '/assets/js/ekiline.js', array('jquery'), '20151226' );
    // comentarios
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
    }			
}
add_action( 'wp_enqueue_scripts', 'ekiline_scripts', 0 );

/**
 * Ekiline no require jquery_migrate.
 */
function remove_jquery_migrate($scripts){
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
            // verificar dependencias
            if ($script->deps) {
                $script->deps = array_diff($script->deps, array( 'jquery-migrate' ));
            }
    }
}
add_action('wp_default_scripts', 'remove_jquery_migrate');

/**
 * Ekiline adiciones.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/themeNavbars.php';
require get_template_directory() . '/inc/themeNavwalker.php';
require get_template_directory() . '/inc/themeLayout.php';
require get_template_directory() . '/inc/themeElements.php';
require get_template_directory() . '/inc/themeMeta.php';
require get_template_directory() . '/inc/themeFeaturedCategories.php';
require get_template_directory() . '/inc/themeCustomHeader.php';
require get_template_directory() . '/inc/themeCustomColors.php';
require get_template_directory() . '/inc/themeOptimize.php';
require get_template_directory() . '/inc/widgetOptions.php';
require get_template_directory() . '/inc/widgetBreadcrumb.php';
