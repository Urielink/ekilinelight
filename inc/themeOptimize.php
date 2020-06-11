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

$optimizeCSS = true;
if( $optimizeCSS === true ){
    add_filter( 'style_loader_tag',  'ekiline_change_tag', 10, 4 );
    add_action( 'wp_enqueue_scripts', 'ekiline_print_localize' );
    add_action( 'wp_footer', 'ekiline_load_allCss_js', 100);
}

/**
 * Optimizar el llamdo de los estilos.
 * Decidir que estilos pueden permanecer y que otros no.
 */

    function ekiline_choose_styles(){
        // $discardCss = array('bootstrap-4');
        $discard_styles = array(); 
        return $discard_styles;
    }

    function ekiline_wpqueued_styles(){
        // Estilos en el sistema
        global $wp_styles; 
        $all_styles = array();
        foreach( $wp_styles->queue as $csshandle ) {    	
            $all_styles[] = $csshandle;   
        } 
        return $all_styles;
    }

    function ekiline_filter_styles(){
        // Filtrar los estilos
        $load_css = array_diff( ekiline_wpqueued_styles(), ekiline_choose_styles() );
        $final_styles = $load_css;
        return $final_styles;
    }

/**
 * Transformar etiquetas de estilo en preloads
 */

function ekiline_change_tag( $tag, $handle, $src  ) {
    foreach( ekiline_filter_styles() as $pre_style ) {
        if ( $pre_style === $handle ) {
            $tag = '<link rel="preload" as="style" href="' . esc_url( $src ) . '">'."\n";            
        }
    }
    return $tag;
}
// add_filter( 'style_loader_tag',  'ekiline_change_tag', 10, 4 );


/**
 * Crear variables de cada estilo filtrado en js.
 */
function ekiline_styles_localize(){

        global $wp_styles; 
        $load_css_from = ekiline_filter_styles();        
        $the_styles = array();

        foreach( $load_css_from as $handler) {

            /* Crear diccionario: 
            * sobrescribir url de cada CSS en caso de ser relativa al sistema.
            */

            $srcUrl = $wp_styles->registered[$handler]->src;
            $siteurl   = get_site_url();
                $hasSiteurl = strpos($srcUrl, $siteurl);

            if ($hasSiteurl === false){
                $srcUrl = get_site_url() . $wp_styles->registered[$handler]->src;
            } 

            $the_styles[] = array( 'id' => $handler, 'src' => $srcUrl, 'media' => $wp_styles->registered[$handler]->args );   

            // Para deshabilitar estilos: wp_dequeue_style($handler);

        }   
                
        return $the_styles;
        
}  
function ekiline_print_localize(){
    wp_localize_script( 'ekiline-layout', 'allCss', ekiline_styles_localize() );     
}
// add_action( 'wp_enqueue_scripts', 'ekiline_print_localize' );


function ekiline_load_allCss_js(){ ?>
    <script>
    jQuery(document).ready( function($){
        // variable php
        if ( allCss != null ){
            var obj = allCss;	
            // crear un estilo por cada ruta extríada.
            
            $.each( obj, function( key, value ) {
                        
                var head = $('head');
                var wpcss = head.find('style[id="ekiline-inline-style"]'); 
                var cssinline = head.find('style:last');
                var ultimocss = head.find('link[rel="stylesheet"]:last');
                var linkCss = $('<link/>',{ 'rel':'stylesheet', 'id':value.id, 'href':value.src, 'media':value.media });
            
                // En caso de de encontrar una etiqueta de estilo ó link ó nada inserta el otro estilo css, 
            
                    if (wpcss.length){ 
                        wpcss.before(linkCss); 
                    } else if (cssinline.length){ 
                        cssinline.before(linkCss); 
                    } else if (ultimocss.length){ 
                        ultimocss.before(linkCss); 
                    } else { 
                        head.append(linkCss); 
                    }		
                                
            });				                
        }	            
    });     
    </script>
<?php }
// add_action( 'wp_footer', 'ekiline_load_allCss_js', 100);



/*** otros métodos que ayudan ***/

/* 
 * Defer / Async scripts.
 * https://developer.wordpress.org/reference/hooks/script_loader_src/
 * http://hookr.io/filters/script_loader_src/
 */

function add_defer_attribute($tag, $handle) {
    // add script handles to the array below
    $scripts_to_defer = array( 'popper-script', 'bootstrap-script', 'ekiline-swipe', 'ekiline-layout' );
    
    foreach($scripts_to_defer as $defer_script) {
       if ($defer_script === $handle) {
          return str_replace(' src', ' defer="defer" src', $tag);
       }
    }
    return $tag;
 }
 add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);


 function add_async_attribute($tag, $handle) {
    // add script handles to the array below
    $scripts_to_async = array();
    
    foreach($scripts_to_async as $async_script) {
       if ($async_script === $handle) {
          return str_replace(' src', ' async="async" src', $tag);
       }
    }
    return $tag;
 }
 add_filter('script_loader_tag', 'add_async_attribute', 10, 2);




/*
$optimizeCSS = false;
function ekiline_B4F() {
    $cssB4f = '';
    echo '<style type="text/css" id="b4f">' . $cssB4f . '</style>' . "\n";
}

if ( $optimizeCSS == true && ! is_customize_preview() ){

    function footer_enqueue_scripts() {
        remove_action('wp_head', 'wp_print_scripts');
        remove_action('wp_head', 'wp_print_head_scripts', 9);
        remove_action('wp_head', 'wp_enqueue_scripts', 1);
        remove_action('wp_head', 'wp_custom_css_cb', 101); // remove wordpress custom styles
        remove_action( 'wp_head', 'ekiline_css_inlineHeadMethod', 100);  // themeCustomColors remove styles.
    
        print_late_styles();
        add_action('wp_footer', 'wp_print_scripts', 5);
        add_action('wp_footer', 'wp_enqueue_scripts', 5);
        add_action('wp_footer', 'wp_print_head_scripts', 5);
        add_action( 'wp_enqueue_scripts', 'ekiline_css_groupMethod' ); //add ekiline styles.
        // add_action( 'wp_head', 'ekiline_B4F', 90);

    }
    add_action('after_setup_theme', 'footer_enqueue_scripts');

}
*/