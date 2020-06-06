<?php
/**
 * ekiline Theme Customizer.
 *
 * @package ekiline
 */

// Reemplazar la funcion de customizar fondo.
// https://developer.wordpress.org/reference/functions/add_theme_support/
// add_action( 'after_setup_theme', 'ekiline_remove_custom_background', 20 );
// function ekiline_remove_custom_background(){
	 // remove_theme_support( 'custom-background' ); 
// } 
 
/** 
 *  Los controladores del personalizador
 *  https://codex.wordpress.org/Theme_Customization_API
 *  https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data
 *  https://codex.wordpress.org/Data_Validation
 *  https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 **/

function ekiline_theme_customizer( $wp_customize ) {

// Identidad, logo en navbar
    $wp_customize->add_setting( 
        'ekiline_logo_max', array(
                'default' => '',
                'sanitize_callback' => 'absint'
        ) 
    );
    
// Logo personalizado
// https://developer.wordpress.org/reference/classes/WP_Customize_Cropped_Image_Control/	
	$wp_customize->add_control( 
		new WP_Customize_Cropped_Image_Control(
			$wp_customize, 'ekiline_logo_max', 
				array(
				    'label'         => __( 'Navbar brand', 'ekiline' ),
				    'description' => __( 'Show logo on menu (suggest 200x50px)', 'ekiline' ),
				    'section'       => 'title_tagline',
				    'settings' 		=> 'ekiline_logo_max',
				    'priority'      => 100,
				    'height'        => 50,
				    'width'         => 200,
				    'flex_height'   => true,
				    'flex_width'    => true,
				    'button_labels' => array(
				        'select'       => __( 'Select logo', 'ekiline' ),
				        'change'       => __( 'Change logo', 'ekiline' ),
				        'remove'       => __( 'Remove', 'ekiline' ),
				        'default'      => __( 'Default', 'ekiline' ),
				        'placeholder'  => __( 'No logo selected', 'ekiline' ),
				        'frame_title'  => __( 'Select logo', 'ekiline' ),
				        'frame_button' => __( 'Choose logo', 'ekiline' )
				    ),
				) 
		) 
	);	
	
// Usar favicon como identidad responsiva 
    $wp_customize->add_setting( 
        'ekiline_minilogo', array(
    				'default' => '',
    				'sanitize_callback' => 'ekiline_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
    	'ekiline_showFrontPageHeading', array(
    				'label'          => __( 'Replace navbar brand with site icon in small devices', 'ekiline' ),
    				'section'        => 'title_tagline',
    				'settings'       => 'ekiline_minilogo',
    				'type'           => 'checkbox',
	                'priority' 		 => 100
        )
    ); 
	
// Comportamientos Primary Menu
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
            'description' => __( 'Assign positions to the menu: top, fixed or bottom', 'ekiline' ),
            'section' => 'menu_locations',
            'priority'    => 100,
            'choices' => array(
                '0' => __( 'Default', 'ekiline' ),
                '1' => __( 'Fixed top', 'ekiline' ),
                '2' => __( 'Fixed bottom', 'ekiline' ),
                '3' => __( 'Fixed with scroll', 'ekiline' ),
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
            	'4' => __( 'Scroller', 'ekiline' ),
            	'5' => __( 'Offcanvas (responsive)', 'ekiline' ),
            	'6' => __( 'Top toggle', 'ekiline' ),
                '7' => __( 'Modal', 'ekiline' ),
                '8' => __( 'Modal from bottom', 'ekiline' ),
            	'9' => __( 'Modal from left', 'ekiline' ),
            	'10' => __( 'Modal from right', 'ekiline' ),
            ),
        )
    );  		       

    // Front page categories		
    $wp_customize->add_setting( 
        'ekiline_featuredcategories', array(
                    'default' => 0,
                    'transport'   => 'refresh',
                    'sanitize_callback' => 'ekiline_sanitize_multipleselect' 
        )
    );

    $wp_customize->add_control(
        new ekiline_controlMultipleSelect (
            $wp_customize, 'ekiline_featuredcategories', array(
                'settings' => 'ekiline_featuredcategories',
                'label'    => __( 'Featured category', 'ekiline' ),
                'section'  => 'static_front_page',
                'type'     => 'multiple-select',
                'choices' => ekiline_list_categories()
            )
        )
    );  

    // Page wide
    $wp_customize->add_section( 
        'ekiline_vista_section' , array(
            'title'       => __( 'Site view', 'ekiline' ),
            'priority'    => 120,
            'description' => __( 'Allow fullwidth of your website by content type: homepage, categories or single content', 'ekiline' ),
        ) 
    );

    // Layout control and full width    
    $iLayout = array();
        $iLayout[] = array( 'name'=>'Home', 'label' => __( 'Home and blog page', 'ekiline' ) );
        $iLayout[] = array( 'name'=>'Archive', 'label' => __( 'Categories and archive pages', 'ekiline' ) );
        $iLayout[] = array( 'name'=>'Single', 'label' => __( 'Entries and single pages', 'ekiline' ) );

        foreach($iLayout as $value) {

            $wp_customize->add_setting(
                'ekiline_disableSb' . $value['name'], array(
                        'default' => '0',
                        'sanitize_callback' => 'ekiline_sanitize_select'
                    ) 
            );

            $wp_customize->add_control(
                'ekiline_disableSb' . $value['name'], array(
                    'type' => 'select',
                    'label' => $value['label'],
                    'section' => 'ekiline_vista_section',
                    'choices' => array(
                        '0' => __( 'Enabled sidebars', 'ekiline' ),
                        '1' => __( 'Disable left', 'ekiline' ),
                        '2' => __( 'Disable right', 'ekiline' ),
                        '3' => __( 'Disable both', 'ekiline' ),   
                    ),
                )
            );   
            
            $wp_customize->add_setting(
                'ekiline_ancho' . $value['name'], array(
                        'default' => '',
                        'sanitize_callback' => 'ekiline_sanitize_checkbox'
                    ) 
                );
            
            $wp_customize->add_control(
                'ekiline_ancho' . $value['name'], array(
                    'type' => 'checkbox',
                    'label' => __( 'Show full width layout', 'ekiline' ),
                    'section' => 'ekiline_vista_section',
                )
            );   

        } 
    
    // List grid items
    
    $wp_customize->add_setting(
        'ekiline_Columns', array(
                'default' => '0',
                'sanitize_callback' => 'ekiline_sanitize_select'
            ) 
    );
    
    $wp_customize->add_control(
        'ekiline_Columns', array(
            'type' => 'select',
            'label' => __( 'Columns', 'ekiline' ),
            'description' => __( 'Show your lists in columns', 'ekiline' ),
            'section' => 'ekiline_vista_section',
            'choices' => array(
                '0' => __( 'Default', 'ekiline' ),
                '1' => __( '2 columns', 'ekiline' ),
                '2' => __( '3 columns', 'ekiline' ),
                '3' => __( '4 columns', 'ekiline' ),   
                '4' => __( 'Cards grid', 'ekiline' ),   
            ),
        )
    );      
  
}
add_action('customize_register', 'ekiline_theme_customizer');


/* Asegurar la informacion de cada campo antes de ingresa a la BD */

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

function ekiline_sanitize_dropdown_pages( $page_id, $setting ) {
  $page_id = absint( $page_id );
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

