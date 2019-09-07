<?php
/**
 * ekiline Theme Customizer.
 *
 * @package ekiline
 */

// Reemplazar la funcion de customizar fondo.
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
    				'label'          => __( 'Use site icon as responsive navbar brand', 'ekiline' ),
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
	
// Colores, reemplazar el controlador de color de fondo.
	$wp_customize->remove_control('background_color');	// se remueve el controlador.
	
// Colores base
    $colors = array();
    $colors[] = array( 'slug'=>'back_color', 'default' => '#ffffff', 'label' => __( 'Background color', 'ekiline' ), 'description' => '' );
    $colors[] = array( 'slug'=>'text_color', 'default' => '#333333', 'label' => __( 'Text color', 'ekiline' ), 'description' => '' );
    // $colors[] = array( 'slug'=>'links_color', 'default' => '#007bff', 'label' => '', 'description' => '' );
    // $colors[] = array( 'slug'=>'footer_color', 'default' => '#eeeeee', 'label' => __( 'Footer background and text', 'ekiline' ), 'description' => '' );
    // $colors[] = array( 'slug'=>'ftext_color', 'default' => '#333333', 'label' => '', 'description' => '' );
    // $colors[] = array( 'slug'=>'menu_color', 'default' => '', 'label' => __( 'Navbar background', 'ekiline' ), 'description' => __( 'Choose a base color, add second color for make a gradient', 'ekiline' ) );
    // $colors[] = array( 'slug'=>'menu_gradient', 'default' => '', 'label' => '', 'description' => '' );
    	
    foreach($colors as $color){
        // add settings
        $wp_customize->add_setting(
        		$color['slug'], array( 
        				'default' => $color['default'], 
        				'type' => 'option', 
        				'capability' => 'edit_theme_options',
        				'sanitize_callback' => 'sanitize_hex_color' 
				)
		);

        // add controls
        $wp_customize->add_control(
        		new WP_Customize_Color_Control(
        				$wp_customize, $color['slug'], 
        				array( 'label' => $color['label'], 
                				'description' => $color['description'], 
        						'section' => 'colors', 
        						'settings' => $color['slug'] 
						) ) 
		);
    }
    
    // Bootstrap inverse menu
    $wp_customize->add_setting( 
        'ekiline_inversemenu', array(
    				'default' => '',
    				'sanitize_callback' => 'ekiline_sanitize_checkbox'
        )
    );
    
    $wp_customize->add_control(
    	'ekiline_inversemenu', array(
    				'label'          => __( 'Inverse navbar', 'ekiline' ),
    				'description'    => __( 'Change background from lighten to darken', 'ekiline' ),
    				'section'        => 'colors',
    				'settings'       => 'ekiline_inversemenu',
    				'type'           => 'checkbox'
        )
    );  
	
	// Bootstrap theme colors
    $BColors = array();
    $BColors[] = array( 'slug'=>'b4_primary', 'default' => '#007bff', 'label' => __( 'Custom bootstrap theme', 'ekiline' ), 'description' => __( 'Change Bootstrap color palette and use default classes', 'ekiline' ) . __('<br><code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-primary</code>','ekiline') );
	    $BColors[] = array( 'slug'=>'b4_secondary', 'default' => '#6c757d', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-secondary</code>', 'ekiline') );
	    $BColors[] = array( 'slug'=>'b4_success', 'default' => '#28a745', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-success</code>', 'ekiline') );
	    $BColors[] = array( 'slug'=>'b4_danger', 'default' => '#dc3545', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-danger</code>', 'ekiline') );
	    $BColors[] = array( 'slug'=>'b4_warning', 'default' => '#ffc107', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-warning</code>', 'ekiline') );
	    $BColors[] = array( 'slug'=>'b4_info', 'default' => '#17a2b8', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-info</code>', 'ekiline') );
	    $BColors[] = array( 'slug'=>'b4_light', 'default' => '#f8f9fa', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-light</code>', 'ekiline') );
	    $BColors[] = array( 'slug'=>'b4_dark', 'default' => '#343a40', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-dark</code>', 'ekiline') );	
    	
    foreach($BColors as $color){
        // add settings
        $wp_customize->add_setting(
        		$color['slug'], array( 
        				'default' => $color['default'], 
        				'type' => 'option', 
        				'capability' => 'edit_theme_options',
        				'sanitize_callback' => 'sanitize_hex_color' 
				)
		);

        // add controls
        $wp_customize->add_control(
        		new WP_Customize_Color_Control(
        				$wp_customize, $color['slug'], 
        				array( 'label' => $color['label'], 
                				'description' => $color['description'], 
        						'section' => 'colors', 
        						'settings' => $color['slug'] 
						) ) 
		);
    }	  	
  
}
add_action('customize_register', 'ekiline_theme_customizer');

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