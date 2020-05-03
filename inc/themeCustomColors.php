<?php
/**
 * Custom Color CSS Bootstrap feature
 *
 * @package ekiline
 */

 /**
 * Agregar a customizer
 */

// Usar el contenido de home y frontpage
function ekiline_custom_color_controls( $wp_customize ) {

    //Guardar variabe CSS experimento
    $wp_customize->add_setting( 
        'ekiline_textarea_css', array(
            'capability' => 'edit_theme_options',
            'default' => __( '', 'ekiline' ),
            // 'sanitize_callback' => 'sanitize_textarea_field',
            'sanitize_callback' => 'wp_strip_all_tags',
            'transport' => 'refresh',
          ) 
    );
      
    $wp_customize->add_control( 
        'ekiline_textarea_css', array(
            // 'type' => 'textarea',
            'type' => 'hidden', // era textarea.
            'section' => 'colors_extended', // // Add a default or your own section
            // 'label' => __( 'Custom Text Area', 'ekiline' ),
            // 'description' => __( 'This is a custom textarea.', 'ekiline' ),
        ) 
    );    
	
}
add_action('customize_register', 'ekiline_custom_color_controls');

// 2. customizer-control.js
// registrar scripts: https://developer.wordpress.org/reference/functions/wp_localize_script/
function tuts_customize_control_js() {
    // wp_register_script( 'tuts_customizer_control', get_template_directory_uri() . '/assets/js/ekiline-themecustomizer.js', array('jquery'), null, true);
    // wp_localize_script( 'tuts_customizer_control', 'themeColors2', ekiline_themeColors() );
    // wp_enqueue_script( 'tuts_customizer_control' );
    wp_enqueue_script( 'tuts_customizer_control', get_template_directory_uri() . '/assets/js/ekiline-themecustomizer.js', array('jquery'), null, true );
}
// Este registra un script en los controles pero no puede manipular las variables entre customizer y el refresh.
add_action( 'customize_controls_enqueue_scripts', 'tuts_customize_control_js' ); 
// Este inicializador es importante, puede capturar el dato desde el refresh.
// add_action( 'customize_preview_init', 'tuts_customize_control_js' );

/**
 * Add color styling from theme
 */
function ekiline_styles_inline() {
	$ekilineTheme = get_theme_mod( 'ekiline_textarea_css', '/*add your colors*/');	
    echo '<style id="inlineek">' . $ekilineTheme . '</style>'. "\n";
}
add_action( 'wp_head', 'ekiline_styles_inline', 100);
