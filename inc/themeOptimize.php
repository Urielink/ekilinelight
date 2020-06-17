<?php
/**
 * ekiline orrganize scripts.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package ekiline
 */

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

/**
 * paso 1) Optimizar el llamdo de los estilos.
 */

$optimizeCSS = true;

if( $optimizeCSS === true && ! is_login_page() && ! is_admin() && ! is_user_logged_in() ){
    add_filter( 'style_loader_tag',  'ekiline_change_tag', 10, 4 );
    add_action( 'wp_enqueue_scripts', 'ekiline_print_localize' );
    add_action( 'wp_footer', 'ekiline_load_allCss_js', 100);
}

/**
 * Decidir que estilos pueden permanecer y que otros no.
 */

// function inspect_styles() {
//     global $wp_styles;
//     print_r($wp_styles->queue);
// }
// add_action( 'wp_print_styles', 'inspect_styles' );

    function ekiline_choose_styles(){
        // $discardCss = array('login','bootstrap-4');
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
            * sobrescribir url de cada CSS en caso de solo ser relativa al sistema.
            */

            $siteurl = get_site_url();
            $srcUrl = $wp_styles->registered[$handler]->src;
                $hasSiteurl = strpos($srcUrl, $siteurl);

            if ( $hasSiteurl === false ){
                $srcUrl = $siteurl . $srcUrl;
            } 

            $the_styles[] = array( 'id' => $handler, 'src' => $srcUrl, 'media' => $wp_styles->registered[$handler]->args );   

            // Para deshabilitar estilos, es posible que no se necesite: 
            wp_dequeue_style($handler);

        }   
                
        return $the_styles;
        
}  
function ekiline_print_localize(){
    // wp_localize_script( 'ekiline-layout', 'allCss', ekiline_styles_localize() );     
    wp_localize_script( 'jquery', 'allCss', ekiline_styles_localize() );     
}
// add_action( 'wp_enqueue_scripts', 'ekiline_print_localize' );


function ekiline_load_allCss_js(){ ?>
    <script>
    window.addEventListener('load', function () {

        jQuery(document).ready( function($){
            // variable php
            if ( allCss != null ){

                var obj = allCss;	
                
                $.each( obj, function( key, value ) {
                            
                    var head = $('head');
                    var wpcss = head.find('style[id="ekiline-inline-style"]'); 
                    var cssinline = head.find('style:last');
                    var ultimocss = head.find('link[rel="stylesheet"]:last');
                    var linkCss = $('<link/>',{ 'rel':'stylesheet', 'id':value.id, 'href':value.src, 'media':value.media });
                
                    // En caso de de encontrar una etiqueta de estilo imprimir
                
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

    });
    </script>
<?php }
// add_action( 'wp_footer', 'ekiline_load_allCss_js', 100);



/* 
 * Optimizar el llamado de cada Script JS
 */

/* 
 * Defer / Async scripts uno por uno y en grupo.
 * https://developer.wordpress.org/reference/hooks/script_loader_src/
 * http://hookr.io/filters/script_loader_src/
 */

// function inspect_scripts() {
//     global $wp_scripts;
//     print_r( $wp_scripts->queue );
// }
// add_action( 'wp_print_scripts', 'inspect_scripts' );

function ekiline_wpqueued_scripts(){
    // Scripts en el sistema
    global $wp_scripts; 
    $all_scripts = array();
    foreach( $wp_scripts->queue as $jshandle ) {    	
        $all_scripts[] = $jshandle;   
    } 
    return $all_scripts;
}

/**
 * 1) Si los scripts se modifican uno a uno.
 */
function ekiline_choose_scripts(){
    $selected_scripts = array(); 
        // $selected_scripts[] = array( 'handle'=>'ekiline-layout', 'attr' => 'async');
        // $selected_scripts[] = array( 'handle'=>'ekiline-bundle', 'attr' => 'defer');
        $selected_scripts[] = array( 'handle'=>'jquery-core', 'attr' => 'defer');
        $selected_scripts[] = array( 'handle'=>'wp-embed', 'attr' => 'defer');
        return $selected_scripts;
}

    function override_scripts($tag, $handle) {

        foreach( ekiline_choose_scripts() as $new_script ) {

            if ( $new_script['handle'] === $handle ) {

                if( $new_script['attr'] === 'defer' ){
                    return str_replace(' src', ' defer="defer" src', $tag);
                } else if ( $new_script['attr'] === 'async' ){
                    return str_replace(' src', ' async="async" src', $tag);
                }

            }

        }

        return $tag;

    }

    // if( ekiline_choose_scripts() != null && ! is_login_page() && ! is_admin() && ! is_user_logged_in() ){    
    //     add_filter('script_loader_tag', 'override_scripts', 10, 2);
    // }

/**
 * 2) Si los scripts se modifican en grupo.
 */
function add_new_attribute($tag, $handle) {

    $defer_all_scripts = false;
    $async_all_scripts = false;
    
    $scripts_to_change = ekiline_wpqueued_scripts();
    $newAttr = '';
    
    if( $defer_all_scripts && !$async_all_scripts){
        $newAttr = 'defer="defer"';
    } else if( $async_all_scripts && !$defer_all_scripts ) {
        $newAttr = 'async="async"';
    }

    foreach($scripts_to_change as $new_script) {
        if ($new_script === $handle) {
            return str_replace(' src', ' '. $newAttr .' src', $tag);
        }
    }

    return $tag;

}

    // if( ! is_login_page() && ! is_admin() && ! is_user_logged_in() ){    
    //     add_filter('script_loader_tag', 'add_new_attribute', 10, 2);
    // }

    $defer_all_scripts = false;
    $async_all_scripts = false;

    if( ! is_login_page() && ! is_admin() && ! is_user_logged_in() ){  

        if( ekiline_choose_scripts() != null && !$defer_all_scripts && !$async_all_scripts ){
            add_filter('script_loader_tag', 'override_scripts', 10, 2);
        } else if( $defer_all_scripts || $async_all_scripts ) {
            add_filter('script_loader_tag', 'add_new_attribute', 10, 2);
        }

    }    





/* 
 * paso 2) Todos los scripts al footer
 * All scripts to footer
 */

$footerAllScripts = true;

if( $footerAllScripts === true && ! is_login_page() && ! is_admin() && ! is_user_logged_in() ){

    function footer_enqueue_scripts() {

    /**
     * Emojis al footer
     * Otra solución: https://desarrollowp.com/blog/tutoriales/mover-los-scripts-al-footer-wordpress/
     */
        $emojiDetect = 'print_emoji_detection_script';
        $emojiStyles = 'print_emoji_styles';
            remove_action('wp_head', $emojiDetect, 7);
            add_action('wp_footer', $emojiDetect, 20);
            remove_action('wp_print_styles', $emojiStyles);
            add_action('wp_head', $emojiStyles,110);

    /**
     * Combinar estilos superior inferior.
     * Otra solución: https://desarrollowp.com/blog/tutoriales/mover-los-scripts-al-footer-wordpress/
     */
            /**
             * Prints scripts in document head that are in the $handles queue.
             * https://developer.wordpress.org/reference/functions/wp_print_scripts/
             */
            // remove_action('wp_head', 'wp_print_scripts');
            // add_action('wp_footer', 'wp_print_scripts', 5);

            /**
             * Esta orden, traspasa los scripts al footer
             * Prints the script queue in the HTML head on the front end.
             * https://developer.wordpress.org/reference/functions/wp_print_head_scripts/
             */            
            remove_action('wp_head', 'wp_print_head_scripts', 9);
            add_action('wp_footer', 'wp_print_head_scripts', 5);//orden principal

            /**
             * Estilos CSS y Scripts en general, los elimina y envia al footer, no es una buena opcion.
             * Fires when scripts and styles are enqueued.
             * https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
             */            
            // remove_action('wp_head', 'wp_enqueue_scripts', 1);
            // add_action('wp_footer', 'wp_enqueue_scripts', 5);

            // print_late_styles();


    }
    add_action('after_setup_theme', 'footer_enqueue_scripts');

}


/**
 * Script para agregar posts externos con oEmbed 
 * embed posts from remote WordPress sites into your own WordPress site, via oEmbed
 * ¿aplicar solo en posts o paginas?
 */

// function my_deregister_scripts(){
//     if ( !is_singular() ) return;
//     wp_deregister_script( 'wp-embed' );
// }
// add_action( 'wp_footer', 'my_deregister_scripts' );







/**
 * paso 3) Imprimir script decalarados al vuelo.
 */

function ekiline_discard_scripts(){
    // $selected_scripts = array('jquery','jquery-core','ekiline-bundle','ekiline-layout'); 
    $selected_scripts = array('jquery'); 
    return $selected_scripts;
}

function ekiline_filter_scripts(){
    // Filtrar los estilos
    $load_jss = array_diff( ekiline_wpqueued_scripts(), ekiline_discard_scripts() );
    $final_scripts = $load_jss;
    return $final_scripts;
}

/**
 * Crear variables de cada estilo filtrado en js.
 * NOTA: Localize si funciona, pero la dependencia de scripts es un tema a revisar.
 */
function ekiline_scripts_localize(){

    global $wp_scripts; 
    $load_jss_from = ekiline_filter_scripts();        
    $the_scripts = array();

    foreach( $load_jss_from as $handler) {

        /* Crear diccionario: 
        * sobrescribir url de cada CSS en caso de solo ser relativa al sistema.
        */

        $siteurl = get_site_url();
        $srcUrl = $wp_scripts->registered[$handler]->src;
            $hasSiteurl = strpos($srcUrl, $siteurl);

        if ( $hasSiteurl === false ){
            $srcUrl = $siteurl . $srcUrl;
        } 

        $the_scripts[] = array( 'id' => $handler, 'src' => $srcUrl );   

        // Para deshabilitar estilos, es posible que no se necesite: 
        wp_dequeue_script($handler);

    }   
            
    return $the_scripts;
    
}  

function ekiline_print_localizejs(){
    // wp_localize_script( 'wp-embed', 'allJss', ekiline_scripts_localize() );     
    wp_localize_script( 'jquery', 'allJss', ekiline_scripts_localize() );     
}
add_action( 'wp_enqueue_scripts', 'ekiline_print_localizejs' );



function add_styles_scripts(){
	// Add script in the footer
    // wp_enqueue_script('pretty-photo', get_stylesheet_directory_uri() . '/.../jquery.prettyPhoto.js', array('jquery'), NULL, true);
    
    // wp_enqueue_script('jquery');	// este lo invocamos en functions.php

    $inline_js = 'console.log("hola hola")';//'jQuery(function($){ $("a[rel^=\'prettyPhoto\']").prettyPhoto(); });';
	wp_add_inline_script('ekiline-layout', $inline_js);
}
add_action('wp_enqueue_scripts', 'add_styles_scripts');


function ekiline_load_allJss_js(){ ?>
    <script>
    window.addEventListener('load', function () {

        jQuery(document).ready( function($){
            // variable php
            if ( allJss != null ){

                var obj = allJss;	
                
                $.each( obj, function( key, value ) {
                    $.getScript( value.src );
                });				                
            }	            
        });     

    });
    </script>
<?php }
add_action( 'wp_footer', 'ekiline_load_allJss_js', 100);

