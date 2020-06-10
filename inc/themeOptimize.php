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

function ekiline_loadcss(){
    $optimizeCSS = true;
    if( $optimizeCSS != true ) return;
    wp_localize_script( 'ekiline-layout', 'allCss', ekiline_reloadCSS() ); 
    add_action( 'wp_footer', 'ekiline_loadAllCss', 100);
}
add_action( 'wp_enqueue_scripts', 'ekiline_loadcss' );


function ekiline_reloadCSS(){

    $params = null;
    
    global $wp_styles; 

        $allcss = array();
        foreach( $wp_styles->queue as $csshandle ) {    	
            $allcss[] = $csshandle;   
        } 
        /* Permitir la carga de estilos que tienen dependencia o prioridad, 
        * feature, crear una lista para seleccionar cada objeto.
        * $allowcss = array('photoswipe-default-skin','woocommerce-inline');
        */
            $allowcss = array();	
            $load_css = array_diff( $allcss, $allowcss );        
        
        $cssDic = array();
        foreach( $load_css as $handle) {

            /* Crear diccionario: 
            * sobrescribir url de cada CSS en caso de ser relativa al sistema.
            */

            $srcUrl = $wp_styles->registered[$handle]->src;
            $siteurl   = get_site_url();
                $hasSiteurl = strpos($srcUrl, $siteurl);

            if ($hasSiteurl === false){
                $srcUrl = get_site_url() . $wp_styles->registered[$handle]->src;
            } 

            $cssDic[] = array( 'id' => $handle, 'src' => $srcUrl, 'media' => $wp_styles->registered[$handle]->args );   

            //deshabilitar cada estilo
            wp_dequeue_style($handle);

        }   

        $params = $cssDic; 
                
        return $params;
        
}  






function ekiline_loadAllCss(){ ?>

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

<?php 
}


