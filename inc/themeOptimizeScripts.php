<?php
/**
 * ekiline sort scripts.
 *
 * @package ekiline
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * 1) Controles: Mostrar estilos y scripts en el sistema
 * Customizer preview window reference, show styles and scripts handlers
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

function print_libs($kind,$ignore){
    if ( !$kind || !$ignore ) return;
    global $wp_styles,$wp_scripts;

    if ($kind == 'css'){
        $kind = $wp_styles;
    } elseif ($kind == 'js'){
        $kind = $wp_scripts;
    } else {
        return __('Something go wrong, check theme file.','ekiline');
    }

    $libs = $kind->queue;
    $filter = array_diff( $libs, $ignore );
        $libs = implode(',', $filter);
            return $libs;
}

/* Modulo en previsualizador */
    function print_styles_and_scripts_info(){
        if (!is_customize_preview()) return;
        //ignorar estilos o scripts de customizer
        $ignoreCss = array('admin-bar','customize-preview','wp-mediaelement');
        $ignoreJs = array('customize-preview','admin-bar','wp-mediaelement','mediaelement-vimeo','wp-playlist','customize-selective-refresh','customize-preview-widgets','customize-preview-nav-menus');
        //mostrar modulo html
            $html_action = '<div style="position:fixed;bottom:0px;left:0px;right:0px;z-index:100;">';
            $html_action .= '<a class="btn btn-sm btn-primary show-handlers" data-toggle="collapse" href="#collapseHandlers">'.__('Sort Scripts ','ekiline').'</a> ';
            $html_action .= '<div class="collapse" id="collapseHandlers" style="background:#eeeeee;color:#656a6f;padding:10px;">';
            $html_action .= '<small>'.__('Choose and copy handlers in customizer "Ekiline Sort Scripts" option','ekiline') . '</small><br>';
            $html_action .= __('Styles: ','ekiline') . '<code>' . print_libs( 'css', $ignoreCss ) . '</code><br>';
            $html_action .= __('Scripts: ','ekiline') . '<code>' . print_libs( 'js', $ignoreJs ) .'</code>';
            $html_action .= '</div></div>';
            echo $html_action;
    }
    add_action('wp_footer', 'print_styles_and_scripts_info',0);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * 2) Controles Customizer, campos para los estilos
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

function ekiline_reload_libraries( $wp_customize ) {

// Ekiline Sort Scripts
    $wp_customize->add_section( 
        'ekiline_reload_libraries' , array(
            'title'       => __( 'Ekiline Sort Scripts', 'ekiline' ),
            'priority'    => 120,
            'description' => __( 'Sort your CSS Styles and JS Scripts', 'ekiline' ),
        ));    

// Enviar estilos al footer
    $wp_customize->add_setting( 
        'ekiline_scripts_at_footer', array(
    				'default' => '',
                    'sanitize_callback' => 'ekiline_sanitize_checkbox',
        )
    );
        
        $wp_customize->add_control(
            'ekiline_scripts_at_footer', array(
                        'label'          => __( 'Move all scripts at end of page', 'ekiline' ),
                        'description'    => '',
                        'section'        => 'ekiline_reload_libraries',
                        'settings'       => 'ekiline_scripts_at_footer',
                        'type'           => 'checkbox',
                        'priority'       => 100,
            )
        );  


    $type = array('css','js');

    foreach($type as $kind) {

        $field_name = 'ekiline_' . $kind . '_handler_array';
        $field_label = sprintf( esc_html__( 'Comma separated %1$s handlers', 'ekiline' ), $kind );

        // Campos de manejadores para llenar
        $wp_customize->add_setting(
            $field_name, array(
                    'default' => '',
                    'transport' => 'postMessage',//'refresh',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

        $wp_customize->add_control(
            $field_name, array(
                'type' => 'text',
                'label' => $field_label,
                'section' => 'ekiline_reload_libraries',
            ));   

        // Opciones por cada manejador registrado    
        $libraries = ctmzr_array_handlers( $kind );

        if($libraries){

            $choices = array(
                '0' => __( 'No changes', 'ekiline' ),
                '1' => __( 'javascript load', 'ekiline' )
            );
                if ($kind == 'js'){
                    $choices = array(
                        '0' => __( 'No changes', 'ekiline' ),
                        '1' => __( 'async', 'ekiline' ),
                        '2' => __( 'defer', 'ekiline' ),
                        '3' => __( 'defer & async', 'ekiline' ),
                        '4' => __( 'javascript load', 'ekiline' )
                    );
                }

            foreach($libraries as $handler) {
                // ID Ejemplo: ekiline_sortcss_bootstrap-4
                $library_field_name = 'ekiline_' . $kind . '_' . $handler;
                $wp_customize->add_setting(
                    $library_field_name , array(
                            'default' => '0',
                            'sanitize_callback' => 'sanitize_text_field',
                        ));
                $wp_customize->add_control(
                    $library_field_name , array(
                        'type' => 'select',
                        // 'label' => $kind,
                        'description' => $handler ,
                        'section' => 'ekiline_reload_libraries',
                        'choices' => $choices,
                    ));   
            } 
        }

    }
}
add_action( 'customize_register', 'ekiline_reload_libraries' );

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * 3) Filtros:
 * Obtener cada libreria, registrada en el campo de customizer.
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Indice de librerias segun descritos por el usuario
function ctmzr_array_handlers($kind = null){
    $handlers = get_theme_mod( 'ekiline_'.$kind.'_handler_array' );
    if ($handlers){
        $handlers_ar = explode(',', $handlers);
        return $handlers_ar;
    }
}
    // Por cada libreria, obtener la opcion de customizer
    function ctmzr_handlers_options($kind = null){
        $libs = ctmzr_array_handlers($kind);
        $item = '';
        $itemChange = array();
        if( $libs ){
            foreach($libs as $value) {
                $item = get_theme_mod( 'ekiline_'.$kind.'_'.$value );
                    $itemChange[] = array( 'handler' => $value , 'option' => $item );
            }
            // $itemChange = json_encode($itemChange);
            return $itemChange;
        }
    }

/* Comprobacion de arrays: 
    function agregar_scripts(){ ?>
    <script id="note">
    // console.log('<?php // echo json_encode( ctmzr_array_handlers('css') );?>');
    // console.log('<?php // echo json_encode(ctmzr_handlers_options('css'));?>');
    // console.log('<?php // echo json_encode( ctmzr_array_handlers('js') );?>');
    // console.log('<?php // echo json_encode(ctmzr_handlers_options('js'));?>');
    </script>
    <?php }
    add_action('wp_head', 'agregar_scripts');
*/

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 4) Control para ejecucion:
 * Solo cuando el usuario no sea administrador
 * Execute only in frontend, when user logged out.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}
if( is_login_page() || is_admin() || is_user_logged_in() ) return;


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 * 5) Modificaciones en librerias CSS:
 * Change CSS tags and load method
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Ejecutar solo cuando exista informacion en el campo
if ( get_theme_mod( 'ekiline_css_handler_array' ) != '' ){
    add_filter( 'style_loader_tag',  'ekiline_change_css_tag', 10, 4 ); // 5.1
    add_action( 'wp_enqueue_scripts', 'ekiline_css_localize' ); // 5.2
    add_action( 'wp_footer', 'ekiline_load_allCss_js', 100); // 5.3
}

/* Accion 5.1: Transformar etiquetas de estilo en preloads, publicar */
function ekiline_change_css_tag( $tag, $handle, $src  ) {
    foreach( ctmzr_handlers_options('css') as $pre_style ) {
        if ( $pre_style['handler'] === $handle && $pre_style['option'] === '1' ) {
            $tag = '<link rel="preload" as="style" href="' . esc_url( $src ) . '">'."\n";            
        }
    }
    return $tag;
}
// add_filter( 'style_loader_tag',  'ekiline_change_css_tag', 10, 4 );

    /* Accion 5.2: Crear variables de cada estilo filtrado en js, publicar como dependencia de jquery */
    function ekiline_styles_localize(){
        
        global $wp_styles; 
        $load_css_from = ctmzr_handlers_options('css');   
        $the_styles = array();

        foreach( $load_css_from as $pre_style) {
            $getHandler = $pre_style['handler'];
            $getOption = $pre_style['option'];

            if ( $getOption === '1' ) {
            /* Crear diccionario: sobrescribir url de cada CSS en caso de solo ser relativa al sistema */
                $siteurl = get_site_url();
                $srcUrl = $wp_styles->registered[ $getHandler ]->src;
                    $hasSiteurl = strpos($srcUrl, $siteurl);

                if ( $hasSiteurl === false ){
                    $srcUrl = $siteurl . $srcUrl;
                } 

                $the_styles[] = array( 'id' => $getHandler, 'src' => $srcUrl, 'media' => $wp_styles->registered[ $getHandler ]->args );   
            }

        }               
        return $the_styles;        
    }  

    function ekiline_css_localize(){
        wp_localize_script( 'jquery', 'allCss', ekiline_styles_localize() );     
    }
    // add_action( 'wp_enqueue_scripts', 'ekiline_css_localize' );


/* 
 * Accion 5.3: incorporar los estilos con js 
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
        var wpcss = head.find('style[id="ekiline-style-inline-css"]'); 
        var cssinline = head.find('style:last');
    
        $.each( styles, function( key, value ) {                
            var linkCss = $('<link/>',{ 'rel':'stylesheet', 'id':value.id, 'href':value.src, 'media':value.media });   
            //console.log( value.id + ' ' + value.src );
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
 *
 * 6) Modificaciones en librerias JS:
 * Change JS tags and load method
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// Ejecutar solo cuando exista informacion en el campo
if ( get_theme_mod( 'ekiline_js_handler_array' ) != '' ){
    add_filter('script_loader_tag', 'override_scripts', 10, 2); // 6.1
    add_action( 'wp_enqueue_scripts', 'ekiline_js_localize' ); // 6.2
    add_filter( 'script_loader_tag',  'ekiline_change_js_tag', 10, 4 ); //6.3
    add_action( 'wp_footer', 'ekiline_load_allJss_js', 100); //6.4
}

 /* Accion 6.1: Transformar etiquetas individuales con nuevo atributo, publicar */
 function override_scripts($tag, $handle) {

    $load_jss_from = ctmzr_handlers_options('js');

    foreach( $load_jss_from as $new_script ) {
        if ( $new_script['handler'] === $handle ) {

            if ( $new_script['option'] === '1' ){
                return str_replace(' src', ' async="async" src', $tag);
            } else if( $new_script['option'] === '2' ){
                return str_replace(' src', ' defer="defer" src', $tag);
            } else if( $new_script['option'] === '3' ){
                return str_replace(' src', ' async="async" defer="defer" src', $tag);
            } 

        }
    }
    return $tag;
}
// add_filter('script_loader_tag', 'override_scripts', 10, 2);

/**
 * Accion 6.2: Crear variables de cada estilo filtrado en js.
 * NOTA: Localize si funciona, pero la dependencia de scripts es un tema a revisar.
 */
function ekiline_scripts_localize(){

    global $wp_scripts; 
    $load_jss_from = ctmzr_handlers_options('js');       
    $the_scripts = array();

    foreach( $load_jss_from as $handler) {
        $getHandler = $handler['handler'];
        $getOption = $handler['option'];

        /* Crear diccionario: 
        * sobrescribir url de cada JS en caso de solo ser relativa al sistema.
        */
        if ( $getOption === '4' ) {

            $siteurl = get_site_url();
            $srcUrl = $wp_scripts->registered[$getHandler]->src;
                $hasSiteurl = strpos($srcUrl, $siteurl);

            if ( $hasSiteurl === false ){
                $srcUrl = $siteurl . $srcUrl;
            } 

            $the_scripts[] = array( 'id' => $getHandler, 'src' => $srcUrl );   

        }
        // Para deshabilitar estilos, es posible que no se necesite: 
        // wp_dequeue_script($getHandler);

    }   
            
    return $the_scripts;
    
}  

    function ekiline_js_localize(){
        //loclizar script como dependencia de jquery.
        wp_localize_script( 'jquery', 'allJss', ekiline_scripts_localize() );     
    }
    // add_action( 'wp_enqueue_scripts', 'ekiline_js_localize' );

/* Accion 6.3: Transformar scripts en preloads, publicar */
function ekiline_change_js_tag( $tag, $handle, $src  ) {

    global $wp_scripts;
    $load_jss_from = ctmzr_handlers_options('js');
 
    foreach( $load_jss_from as $pre_script ) {
        if ( $pre_script['handler'] === $handle && $pre_script['option'] === '4' ) {
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
 * Accion 6.4: incorporar los scripts con jquery mediante get 
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



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * 7 Todos los scripts al footer / All scripts to footer
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

if( get_theme_mod('ekiline_scripts_at_footer') === true ){
    add_action('after_setup_theme', 'footer_enqueue_scripts');
}
function footer_enqueue_scripts() {
/**
 * Emojis al footer
 */
    $emojiDetect = 'print_emoji_detection_script';
    $emojiStyles = 'print_emoji_styles';
        remove_action('wp_head', $emojiDetect, 7);
        add_action('wp_footer', $emojiDetect, 20);
        remove_action('wp_print_styles', $emojiStyles);
        add_action('wp_head', $emojiStyles,110);

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
