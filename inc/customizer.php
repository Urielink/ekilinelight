<?php
/**
 * ekiline Theme Customizer.
 *
 * @package ekiline
 */

/** All custom options for Ekiline Theme 
 *  Handlers need sanitize after output
 *  https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 **/

function ekiline_theme_customizer( $wp_customize ) {

    // Behaviors for primary menu

        $wp_customize->add_setting(
            'ekiline_primarymenuSettings', array(
                    'default' => '0',
                    'sanitize_callback' => 'ekiline_sanitize_select'
                ) 
        );
        
        $wp_customize->add_control(
            'ekiline_primarymenuSettings', array(
                'type' => 'select',
                'label' => __( 'Primary menu settings', 'ekiline' ),
                'description' => __( 'Add behaviors for this menu, fix to top, fix to bottom or fixed with scroll', 'ekiline' ),
                'section' => 'menu_locations',
                'priority'    => 100,
                'choices' => array(
                    '0' => __( 'Default', 'ekiline' ),
                    '1' => __( 'Fixed top', 'ekiline' ),
                    '2' => __( 'Fixed bottom', 'ekiline' ),
                    '3' => __( 'Fix to scroll', 'ekiline' ),
                ),
            )
        );    
		
        $wp_customize->add_setting(
            'ekiline_primarymenuStyles', array(
                    'default' => '0',
                    'sanitize_callback' => 'ekiline_sanitize_select'
                ) 
        );

        $wp_customize->add_control(
            'ekiline_primarymenuStyles', array(
                'type' => 'select',
            	'section' => 'menu_locations',
            	'priority'    => 100,
            	'choices' => array(
                    '0' => __( 'Default', 'ekiline' ),
                	'1' => __( 'Right', 'ekiline' ),
                    '2' => __( 'Centered', 'ekiline' ),
                	'3' => __( 'Centered between', 'ekiline' ),
                	'4' => __( 'Centered around', 'ekiline' ),
                	'5' => __( 'Offcanvas', 'ekiline' ),
                	'6' => __( 'Top toggle', 'ekiline' ),
                    '7' => __( 'Modal', 'ekiline' ),
                    '8' => __( 'Modal from bottom', 'ekiline' ),
                	'9' => __( 'Modal from left', 'ekiline' ),
                	'10' => __( 'Modal from right', 'ekiline' ),
                ),
            )
        );  		       
  
}
add_action('customize_register', 'ekiline_theme_customizer');

/* Sanitize callbacks */

function ekiline_sanitize_checkbox( $checked ) {

    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function ekiline_sanitize_html( $html ) {
    return wp_filter_post_kses( $html );
}

function ekiline_sanitize_image( $image, $setting ) {

    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );

    $file = wp_check_filetype( $image, $mimes );

    return ( $file['ext'] ? $image : $setting->default );
}

function ekiline_sanitize_video( $video, $setting ) {

    $mimes = array(
        'asf|asx'       => 'video/x-ms-asf',
        'wmv'           => 'video/x-ms-wmv',
        'wmx'           => 'video/x-ms-wmx',
        'wm'            => 'video/x-ms-wm',
        'avi'           => 'video/avi',
        'divx'          => 'video/divx',
        'flv'           => 'video/x-flv',
        'mov|qt'        => 'video/quicktime',
        'mpeg|mpg|mpe'  => 'video/mpeg',
        'mp4|m4v'       => 'video/mp4',
        'ogv'           => 'video/ogg',
        'webm'          => 'video/webm',
        'mkv'           => 'video/x-matroska'
    );

    $file = wp_check_filetype( $video, $mimes );

    return ( $file['ext'] ? $video : $setting->default );
}


function ekiline_sanitize_number_range( $number, $setting ) {
    
    $number = absint( $number );

    $atts = $setting->manager->get_control( $setting->id )->input_attrs;

    $min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

    $max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

    $step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

    return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function ekiline_sanitize_select( $input, $setting ) {

    $input = sanitize_key( $input );

    $choices = $setting->manager->get_control( $setting->id )->choices;

    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

// esto es en caso de usar un select de pages.
function ekiline_sanitize_dropdown_pages( $page_id, $setting ) {
  $page_id = absint( $page_id );
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}