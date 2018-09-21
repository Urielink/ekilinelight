<?php
/**
 * ekiline functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ekiline
 */


if ( ! function_exists( 'ekiline_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ekiline_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ekiline, use a find and replace
	 * to change 'ekiline' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ekiline', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'ekiline' )
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
	add_theme_support( 'custom-background', apply_filters( 'ekiline_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // ekiline_setup
add_action( 'after_setup_theme', 'ekiline_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
 
function ekiline_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ekiline_content_width', 600 );
}
add_action( 'after_setup_theme', 'ekiline_content_width', 0 );

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
    wp_enqueue_script( 'ekiline-layout', get_template_directory_uri() . '/assets/js/ekiline.js', array('jquery'), '20151226', true  );
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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/themeNavbars.php';
require get_template_directory() . '/inc/ekiline-navwalker.php';


/**
 * Theming: 
 * Orden de columnas, semantica. // Columns and order
 **/
function mainCols($tag){
	if (!is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2')) return;
	if ($tag == 'open'){ echo '<div id="maincolumns" class="row mx-0 container mx-auto px-0">';
	} elseif ($tag == 'close'){ echo '</div><!-- #maincolumns -->'; }
}
function orderCols($css){
	// if (!is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2')) return;
	$cssMain = 'container';
	if (is_active_sidebar( 'sidebar-1') || is_active_sidebar( 'sidebar-2')) {
	// sidebars.
		$sbL = is_active_sidebar( 'sidebar-1');
		$sbR = is_active_sidebar( 'sidebar-2');
	// orden de columnas.	
		$cssMain = 'col-md-6 order-md-2';
		$cssLeft = ' col-md-3 order-md-1';
		$cssRight = ' col-md-3 order-md-3';	
	// aparicion de columnas
		if( $sbL && !$sbR ){
			$cssMain = 'col-md-9 order-md-2';
			$cssLeft = ' col-md-3 order-md-1';
		} elseif ( !$sbL && $sbR ){
			$cssMain = 'col-md-9';
			$cssRight = ' col-md-3';	
		}
	}	
// imprimir
	if ($css == 'main') echo $cssMain;
	if ($css == 'left') echo $cssLeft;
	if ($css == 'right') echo $cssRight;
}
 
 
/**
 * Theming: 
 * Paginacion para listados
 * Paginate links
 * @link https://codex.wordpress.org/Function_Reference/paginate_links
 * @link https://brinidesigner.com/wordpress-custom-pagination-for-bootstrap/
 **/

function ekiline_archive_pagination() {
    
    global $wp_query;
    $big = 999999999;
    $pagination = '';
    
    $pages = paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format' => '?page=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_next' => false,
                'type' => 'array',
                'prev_next' => TRUE,
                'prev_text' => __( '&larr; Previous', 'ekiline' ),
                'next_text' => __( 'Next &rarr;', 'ekiline' ),
            ));
            
    if (is_array($pages)) {
        
        $current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');        
        $pagination .= '<nav id="page-navigation" class="d-flex justify-content-center w-100" aria-label="Page navigation"><ul class="pagination">';
        
        foreach ($pages as $i => $page) {

            $page = str_replace( 'page-numbers', 'page-link', $page );			
			
            if ($current_page == 1 && $i == 0) {                
                $pagination .= "<li class='page-item active'>$page</li>";                
            } else {                
                if ($current_page != 1 && $current_page == $i) {                    
                    $pagination .= "<li class='page-item active'>$page</li>";                    
                } else {                    
                    $pagination .= "<li class='page-item'>$page</li>";                    
                }
            }
            
        }
        
        $pagination .= '</ul></nav>';
        
    }
    
    echo $pagination;
   
}
