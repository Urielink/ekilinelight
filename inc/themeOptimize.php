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

if( is_login_page() || is_admin() || is_user_logged_in() ) return;


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Opcion 1
 * Imprimir estilos con javscript true / false.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

$optimizeCSS = true;

if( $optimizeCSS === true ){
    add_filter( 'style_loader_tag',  'ekiline_change_css_tag', 10, 4 );
    add_action( 'wp_enqueue_scripts', 'ekiline_css_localize' );
    add_action( 'wp_footer', 'ekiline_load_allCss_js', 100);
}

/* Inspeccionar estilos registrados */
// function inspect_styles() {
//     global $wp_styles;
//     print_r($wp_styles->queue);
// }
// add_action( 'wp_print_styles', 'inspect_styles' );

/* Decidir estilos para mantener integros */
function ekiline_choose_styles(){
    // $discardCss = array('login','bootstrap-4');
    $discard_styles = array(); 
    return $discard_styles;
}

/* Recopilar los estilos registrados */
function ekiline_wpqueued_styles(){
    // Estilos en el sistema
    global $wp_styles; 
    $all_styles = array();
    foreach( $wp_styles->queue as $csshandle ) {    	
        $all_styles[] = $csshandle;   
    } 
    return $all_styles;
}

/* Descartar estilos y filtrar para publicar */
function ekiline_filter_styles(){
    // Filtrar los estilos
    $load_css = array_diff( ekiline_wpqueued_styles(), ekiline_choose_styles() );
    $final_styles = $load_css;
    return $final_styles;
}

/* Accion 1: Transformar etiquetas de estilo en preloads, publicar */
    function ekiline_change_css_tag( $tag, $handle, $src  ) {
        foreach( ekiline_filter_styles() as $pre_style ) {
            if ( $pre_style === $handle ) {
                $tag = '<link rel="preload" as="style" href="' . esc_url( $src ) . '">'."\n";            
            }
        }
        return $tag;
    }
    // add_filter( 'style_loader_tag',  'ekiline_change_css_tag', 10, 4 );


/* Accion 2: Crear variables de cada estilo filtrado en js, publicar como dependencia de jquery */
function ekiline_styles_localize(){

    global $wp_styles; 
    $load_css_from = ekiline_filter_styles();        
    $the_styles = array();

    foreach( $load_css_from as $handler) {
        /* Crear diccionario: sobrescribir url de cada CSS en caso de solo ser relativa al sistema */
        $siteurl = get_site_url();
        $srcUrl = $wp_styles->registered[$handler]->src;
            $hasSiteurl = strpos($srcUrl, $siteurl);

        if ( $hasSiteurl === false ){
            $srcUrl = $siteurl . $srcUrl;
        } 

        $the_styles[] = array( 'id' => $handler, 'src' => $srcUrl, 'media' => $wp_styles->registered[$handler]->args );   

        // Deshabilitar estilos, si no requere preload: 
        wp_dequeue_style($handler);
    }               
    return $the_styles;        
}  

    function ekiline_css_localize(){
        wp_localize_script( 'jquery', 'allCss', ekiline_styles_localize() );     
    }
    // add_action( 'wp_enqueue_scripts', 'ekiline_css_localize' );


/* Accion 3: incorporar los estilos con js 
 * buscar la etiqueta de estilo en linea principal (ekiline-inline-style) y 
 * agregar antes.
 */
function ekiline_load_allCss_js(){ ?>
<script>
if ( allCss != null ){
    window.addEventListener('DOMContentLoaded', function () {
        loadStyles(allCss);
    });
}

function loadStyles(styles){
    var $ = jQuery.noConflict();
    var head = $('head');
    var wpcss = head.find('style[id="ekiline-inline-style"]'); 
    var cssinline = head.find('style:last');

    $.each( styles, function( key, value ) {                
        var linkCss = $('<link/>',{ 'rel':'stylesheet', 'id':value.id, 'href':value.src, 'media':value.media });            
        if ( wpcss.length ){ 
            wpcss.before( linkCss ); 
        } else if ( cssinline.length ){ 
            cssinline.before( linkCss ); 
        } else { 
            head.append( linkCss ); 
        }
    });		        
}
</script>
<?php }
// add_action( 'wp_footer', 'ekiline_load_allCss_js', 100);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Opcion 2
 * Modificar los scripts JS con atributo Defer / Async
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/* Inspeccionar scripts registrados */
// function inspect_scripts() {
//     global $wp_scripts;
//     print_r( $wp_scripts->queue );
// }
// add_action( 'wp_print_scripts', 'inspect_scripts' );

/* Recopilar los scripts registrados */
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
 * Sobrescribir la etiqueta con atributo Defer / Async uno por uno o en grupo.
 * https://developer.wordpress.org/reference/hooks/script_loader_src/
 * http://hookr.io/filters/script_loader_src/
 */

/* Seleccionar scripts y asignar atributo */
function ekiline_choose_scripts(){
    $selected_scripts = array(); 
        // $selected_scripts[] = array( 'handle'=>'wp-embed', 'attr' => 'defer');
        $selected_scripts[] = array( 'handle'=>'jquery-core', 'attr' => 'defer');
        $selected_scripts[] = array( 'handle'=>'jquery-migrate', 'attr' => 'defer');
        $selected_scripts[] = array( 'handle'=>'google_gtagjs', 'attr' => 'async');
        return $selected_scripts;
}

/* Accion 1: Transformar etiquetas individuales con nuevo atributo, publicar */
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
    // add_filter('script_loader_tag', 'override_scripts', 10, 2);


/* Accion 2: Si los scripts se modifican en grupo, asignar atributo asyn/defer/null a todos los scripts, 
 * anular la publicacion de scripts individuales y publicar */

function defer_or_async_group(){    
    $choice = ''; // defer | async | null 
    return $choice;
}

    function add_new_attribute($tag, $handle) {
        
        $scripts_to_change = ekiline_wpqueued_scripts();
        $newAttr = defer_or_async_group();
        
        foreach($scripts_to_change as $new_script) {
            if ($new_script === $handle) {
                return str_replace(' src', ' '.$newAttr.'="'.$newAttr.'" src', $tag);
            }
        }

        return $tag;

    }
    // add_filter('script_loader_tag', 'add_new_attribute', 10, 2);

if( ekiline_choose_scripts() != null && !defer_or_async_group() ){
    add_filter('script_loader_tag', 'override_scripts', 10, 2);
} else if( defer_or_async_group() ) {
    add_filter('script_loader_tag', 'add_new_attribute', 10, 2);
}
    


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Opcion 3: Imprimir script decalarados al vuelo.
 * JS on the fly
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

function ekiline_discard_scripts(){
    // $selected_scripts = array('jquery','jquery-core','ekiline-bundle','ekiline-layout','google_gtagjs'); 
    $selected_scripts = array('jquery','google_gtagjs'); 
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
        // wp_dequeue_script($handler);

    }   
            
    return $the_scripts;
    
}  

    function ekiline_js_localize(){
        //loclizar script como dependencia de jquery.
        wp_localize_script( 'jquery', 'allJss', ekiline_scripts_localize() );     
    }
    // add_action( 'wp_enqueue_scripts', 'ekiline_js_localize' );


/* Prueba para dependencias OK
function add_styles_scripts(){
	// Add script if neede
    // wp_enqueue_script('handler', get_stylesheet_directory_uri() . '/.../theScript.js', array('jquery'), null, true);    
    $inline_js = 'console.log("estilo en linea")';//'jQuery(function($){  });';
	wp_add_inline_script('ekiline-layout', $inline_js);
}
add_action('wp_enqueue_scripts', 'add_styles_scripts');
*/


/* Accion Transformar scripts en preloads, publicar */
    function ekiline_change_js_tag( $tag, $handle, $src  ) {

        global $wp_scripts; 
        foreach( ekiline_filter_scripts() as $pre_script ) {
            if ( $pre_script === $handle ) {
                // $tag = '<link rel="preload" as="script" href="' . esc_url( $src ) . '">'."\n".$tag;
                $patterns = array('/<script src=/','/><\/script>/');
                // $replacements = array('<!-- script src=','></script -->');//opcion comentado
                // $replacements = array('<link rel="preload" as="script" href=','/>');//opcion preload
                $replacements = array('<!-- link rel="preload" as="script" href=','/ -->');//opcion preload comentado
                $tag = preg_replace($patterns, $replacements, $tag);         
            }
        }
        return $tag;
        
    }
    // add_filter( 'script_loader_tag',  'ekiline_change_js_tag', 10, 4 );


/* 
 * Accion: incorporar los scripts con jquery mediante get 
 */
function ekiline_load_allJss_js(){ ?>
<script>

if ( allJss != null ){
    window.addEventListener('DOMContentLoaded', function () {
        // loadScripts(allJss); //random
        loadScriptsOrdered(allJss,0); //ordenada
    });
}

function loadScripts(scripts){
    var $ = jQuery.noConflict();
    $.each( scripts, function( key, value ) {
        $.getScript( value.src );
    });
}

function loadScriptsOrdered(scripts,i) {
    var $ = jQuery.noConflict();
    if (i < scripts.length) {
        $.getScript(scripts[i].src, function () {
            //console.log('Loaded: ' + scripts[i].src);
            i++;
            loadScriptsOrdered(scripts,i);
        });
    }
}

</script>
<?php }
// add_action( 'wp_footer', 'ekiline_load_allJss_js', 100);

    $on_the_fly_js = true;

    if( $on_the_fly_js === true ){
        add_action( 'wp_enqueue_scripts', 'ekiline_js_localize' );
        add_filter( 'script_loader_tag',  'ekiline_change_js_tag', 10, 4 );
        add_action( 'wp_footer', 'ekiline_load_allJss_js', 100);
    }



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Opcion 4
 * Todos los scripts al footer / All scripts to footer
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

$footerAllScripts = true;

if( $footerAllScripts === true ){
    add_action('after_setup_theme', 'footer_enqueue_scripts');
}
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
