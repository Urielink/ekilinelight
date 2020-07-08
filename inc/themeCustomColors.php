<?php
/**
 * Custom Color CSS Bootstrap feature
 *
 * @package ekiline
 */

 /**
 * 1. Customizer, controles para cada color.
 */

function ekiline_custom_color_controls( $wp_customize ) {

    // Colores, reemplazar el controlador de color de fondo.
    $wp_customize->remove_control('background_color');	// se remueve el controlador.

    // Colores, agregar un panel con subsecciones: 
    // https://developer.wordpress.org/themes/customize-api/customizer-objects/
    $wp_customize->add_panel(
        'ekiline_ThemeColors', array(
            'title' => __( 'Colors', 'ekiline' ),
            'description' => __( 'Customize the Bootstrap color palette and use the CSS classes set in your design. Or adjust the colors per item.', 'ekiline' ),
            'priority' => 30,
        ) 
    );

        $wp_customize->add_section(
            'colors' , array(
                'title' => __( 'Customize the Bootstrap color palette', 'ekiline' ),
                'panel' => 'ekiline_ThemeColors',
            ) 
        );

        $wp_customize->add_section(
            'colors_extended' , array(
                'title' => __( 'Customize colors per item', 'ekiline' ),
                'panel' => 'ekiline_ThemeColors',
            ) 
        );

    
// Colores base
    $colors = array();
        //pagina
        $colors[] = array( 'slug'=>'back_color', 'default' => '#ffffff', 'label' => __( 'Background color and text', 'ekiline' ), 'description' => '', 'priority' => 20, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'text_color', 'default' => '#333333', 'label' => '', 'description' => '', 'priority' => 20, 'section'=>'colors_extended' );
        // contenedor main
        $colors[] = array( 'slug'=>'main_color', 'default' => '#f8f9fa', 'label' => '', 'description' => __( 'Color on main container', 'ekiline' ), 'priority' => 20, 'section'=>'colors_extended' );
        //navbar
        $colors[] = array( 'slug'=>'menu_color', 'default' => '#343a40', 'label' => __( 'Navbar background', 'ekiline' ), 'description' => '', 'priority' => 30, 'section'=>'colors_extended' );
        //footer-bar
        $colors[] = array( 'slug'=>'fbar_color', 'default' => '#6c757d', 'label' => __( 'Bottom bar', 'ekiline' ), 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'fbartxt_color', 'default' => '#ffffff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'fbarlks_color', 'default' => '#007bff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        //footer
        $colors[] = array( 'slug'=>'footer_color', 'default' => '#343a40', 'label' => __( 'Footer', 'ekiline' ), 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'ftext_color', 'default' => '#ffffff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'flinks_color', 'default' => '#007bff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        //bootstrap
        $colors[] = array( 'slug'=>'b4_primary', 'default' => '#007bff', 'label' => '', 'description' => __( 'Change Bootstrap color palette and use default classes', 'ekiline' ) . __('<br><code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-primary</code>', 'ekiline' ), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_secondary', 'default' => '#6c757d', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-secondary</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_success', 'default' => '#28a745', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-success</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_danger', 'default' => '#dc3545', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-danger</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_warning', 'default' => '#ffc107', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-warning</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_info', 'default' => '#17a2b8', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-info</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_light', 'default' => '#f8f9fa', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-light</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_dark', 'default' => '#343a40', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-dark</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );	

    	
    foreach($colors as $color){
        // add settings
        $wp_customize->add_setting(
        		$color['slug'], array( 
        				'default' => $color['default'], 
        				'type' => 'option', 
        				'capability' => 'edit_theme_options',
        				'sanitize_callback' => 'sanitize_hex_color',
                        'transport'   => 'refresh'
				)
		);

        // add controls
        $wp_customize->add_control(
        		new WP_Customize_Color_Control(
        				$wp_customize, $color['slug'], 
        				array( 'label' => $color['label'], 
                				'description' => $color['description'], 
        						'section' => $color['section'], 
                                'settings' => $color['slug'],
                                'priority' => $color['priority']
						) ) 
		);
    }
    
    // Bootstrap inverse menu
    $wp_customize->add_setting( 
        'ekiline_inversemenu', array(
    				'default' => '',
                    'sanitize_callback' => 'ekiline_sanitize_checkbox',
        )
    );
        
        $wp_customize->add_control(
            'ekiline_inversemenu', array(
                        'label'          => __( 'Use light navbar', 'ekiline' ),
                        'description'    => '',
                        'section'        => 'colors_extended',
                        'settings'       => 'ekiline_inversemenu',
                        'type'           => 'checkbox',
                        'priority'       => 30,
            )
        );  
    

    //input para guardar css con colores generados desde script 
    $wp_customize->add_setting( 
        'ekiline_textarea_css', array(
            'capability' => 'edit_theme_options',
            'default' => '',
            'sanitize_callback' => 'wp_strip_all_tags',
            'transport' => 'refresh',
          ) 
    );
        
        $wp_customize->add_control( 
            'ekiline_textarea_css', array(
                'type' => 'hidden',
                'section' => 'colors_extended',
            ) 
        );    
	
}
add_action('customize_register', 'ekiline_custom_color_controls');

/**
 * 2. Regsitro de script auxiliar en personalizador.
 */
function ekiline_themecustomizer_js() {
    wp_enqueue_script( 'ekiline-themecustomizer', get_template_directory_uri() . '/assets/js/ekiline-themecustomizer.min.js', array('jquery'), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'ekiline_themecustomizer_js' ); 


/**
 * 3. Estilos especificos por objeto de la pagina: 
 * main, menu, footerbar y footer.
 */
function ekiline_page_elements() {

    $ekilineLmnt = '';

    $ekilineLmnt .= ( get_option('main_color') != '#f8f9fa' ) ? '#primary{background-color:'. get_option('main_color') .';}' : '' ;
    $ekilineLmnt .= ( get_option('menu_color') != '#343a40' ) ? '#primarySiteNavigation.navbar{background-color:'. get_option('menu_color') .'!important;}' : '' ;

    if( get_option('fbar_color') != '#6c757d' ||  get_option('fbartxt_color') != '#ffffff'){
        $fbBk = ( get_option('fbar_color') != '#6c757d' ) ? 'background-color:'. get_option('fbar_color') .'!important;' : '' ;
        $fbTc = ( get_option('fbartxt_color') != '#ffffff' ) ? 'color:'. get_option('fbartxt_color') .'!important;' : '' ;
            $ekilineLmnt .= '.footer-bar{'. $fbBk . $fbTc .'}';
    }

    $ekilineLmnt .= ( get_option('fbarlks_color') != '#007bff' ) ? '.footer-bar a{color:'. get_option('fbarlks_color') .'!important}' : '' ;

    if( get_option('footer_color') != '#343a40' ||  get_option('ftext_color') != '#ffffff' ){
        $fooBk = ( get_option('footer_color') != '#343a40' ) ? 'background-color:'. get_option('footer_color') .'!important;' : '' ;
        $fooTc = ( get_option('ftext_color') != '#ffffff' ) ? 'color:'. get_option('ftext_color') .'!important;' : '' ;
            $ekilineLmnt .= '.site-footer{'. $fooBk . $fooTc .'}';
    }

    $ekilineLmnt .= ( get_option('flinks_color') != '#007bff' ) ? '.site-footer a{color:'. get_option('flinks_color') .'!important}' : '' ;
    
    return $ekilineLmnt;
}

/* 
 * 4. Sobreescribir el uso de background image
 * Override background image.
 * https://codex.wordpress.org/Custom_Backgrounds
 * https://developer.wordpress.org/reference/functions/_custom_background_cb/
 */

function ekiline_custom_background_cb() {
    // $background is the saved custom image, or the default image.
    $background = set_url_scheme( get_background_image() );
 
    // $color is the saved custom color.
    // A default has to be specified in style.css. It will not be printed here.
    // $color = get_background_color(); // se reemplaza por el establecido con bootstrap.
    $color = get_option('back_color');
 
    if ( get_theme_support( 'custom-background', 'default-color' ) === $color ) {
        $color = false;
    }
 
    // $style = $color ? "background-color: #$color;" : '';
    $style = $color ? "background-color: $color;" : '';
 
    if ( $background ) {
        $image = ' background-image: url("' . esc_url_raw( $background ) . '");';
 
        // Background Position.
        $position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
        $position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );
 
        if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
            $position_x = 'left';
        }
 
        if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
            $position_y = 'top';
        }
 
        $position = " background-position: $position_x $position_y;";
 
        // Background Size.
        $size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );
 
        if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
            $size = 'auto';
        }
 
        $size = " background-size: $size;";
 
        // Background Repeat.
        $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
 
        if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
            $repeat = 'repeat';
        }
 
        $repeat = " background-repeat: $repeat;";
 
        // Background Scroll.
        $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
 
        if ( 'fixed' !== $attachment ) {
            $attachment = 'scroll';
        }
 
        $attachment = " background-attachment: $attachment;";
 
        $style .= $image . $position . $size . $repeat . $attachment;
        
    }

    return 'body.custom-background{'. trim( $style ) .'}';
}

/* 
 * 5. incluir los estilos CSS de Customizer 
 * https://developer.wordpress.org/reference/functions/wp_custom_css_cb/
 * https://codex.wordpress.org/Function_Reference/is_customize_preview
 * En caso de ocuparlo, se cancela el uso de la etiqueta.
 */

function ekiline_custom_css_cb() {
    //1) remover los estilos css que se modifican en customizer para agruparlos en una sola cadena.
    remove_action('wp_head', 'wp_custom_css_cb', 101);
        //2) y permitir su ejecución solo en el preview.
        if ( is_customize_preview() ) {
            add_action('wp_head', 'wp_custom_css_cb', 101);
        }

    $cstmStyles = wp_get_custom_css();
    $cstmStyles = str_replace( array("\r","\n") , "" , $cstmStyles );
    $cstmStyles = strip_tags( $cstmStyles );

        if ( $cstmStyles && !is_customize_preview() ) :
            return $cstmStyles;
        endif;
}


/* 
 * Integrar todos los estilos css en wp_head.
 * https://developer.wordpress.org/reference/functions/wp_add_inline_style/
 */
function ekiline_get_all_styles(){
    $groupStyles = '';
    $groupStyles .= get_theme_mod( 'ekiline_textarea_css' ); //de mi script js.
    $groupStyles .= ekiline_page_elements(); // de los elementos
    $groupStyles .= ekiline_custom_background_cb(); // de custom background
    $groupStyles .= ekiline_custom_header_style(); // de custom header
        $groupStyles .= ekiline_custom_css_cb(); // de custom CSS
    return $groupStyles;
}

    /* 
    * Imprimir estilos en customizer
    * dependencia: functions.php  wp_enqueue_style( 'ekiline-style', get_stylesheet_uri() );
    * posibles manejadores: bootstrap-4, layout, ekiline-style o un nuevo CSS
    */
    function ekiline_css_groupMethod(){
        if ( !is_customize_preview() ) return;        
        wp_add_inline_style( 'ekiline-style', ekiline_get_all_styles() );
    }
    add_action( 'wp_enqueue_scripts', 'ekiline_css_groupMethod' );

    /* 
    * Imprimir estilos en el front
    */
    function ekiline_css_inlineHeadMethod(){
        if ( is_customize_preview() ) return;
        $type_attr = current_theme_supports( 'html5', 'style' ) ? ' ' : ' type="text/css" ';
        echo '<style' . $type_attr . 'id="ekiline-inline-style">' . strip_tags( ekiline_get_all_styles() ) . '</style>' . "\n";
    }
    add_action( 'wp_head', 'ekiline_css_inlineHeadMethod', 100);


/* 
 * Estilos básicos, above the fold.
 * Obtener los estilos de un css e imprimirlos en el head, 
 * debe aparecer al principio de cualquier css (0).
 */
function ekiline_above_fold_styles(){
    // de estilos
    $file = get_template_directory_uri() . '/assets/css/afterfold.css';
    $file = wp_remote_get($file);
    $data = wp_remote_retrieve_body( $file );
    // quitar comentarios: 
        $data = preg_replace('#/\*.*?\*/#s', '', $data);  
    // quitar saltos de linea y convertir en un string
        $data = str_replace( array("\r","\n") , "" , $data );
    // html5
        $type_attr = current_theme_supports( 'html5', 'style' ) ? ' ' : ' type="text/css" ';
        echo "\n".'<style' . $type_attr . 'id="ekiline-atf">' . strip_tags( $data ) .'</style>' . "\n";
}
add_action( 'wp_head', 'ekiline_above_fold_styles', 0);
