<?php
/**
 * Custom Header feature
 *
 * @package ekiline
 */

 /**
 * Agregar a customizer
 */

// Usar el contenido de home y frontpage
function ekiline_custom_header_controls( $wp_customize ) {

	// Colores, reemplazar el controlador de color de fondo.
	$wp_customize->remove_control('header_textcolor');	// se remueve el controlador.
	$wp_customize->remove_control('display_header_text');	// No es necesario ocultar los textos.

	// Colores
	$colors = array();
    $colors[] = array( 'slug'=>'chdr_color', 'default' => '#000000', 'label' => __( 'Colors', 'ekiline' ), 'description' => __( 'Transparency color', 'ekiline' ), 'priority' => 20, 'section'=>'header_image' );
    $colors[] = array( 'slug'=>'chdrtxt_color', 'default' => '#6c757d', 'label' => '', 'description' => __( 'Text color', 'ekiline' ), 'priority' => 20, 'section'=>'header_image' );
    $colors[] = array( 'slug'=>'chdrlks_color', 'default' => '#007bff', 'label' => '', 'description' => __( 'Links color', 'ekiline' ), 'priority' => 20, 'section'=>'header_image' );
    	
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
        						'section' => $color['section'], 
                                'settings' => $color['slug'],
                                'priority' => $color['priority']
						) ) 
		);
	}	
	
	// Mostrar datos Home/Blog
	$wp_customize->add_setting( 
		'ekiline_headerCustomText', array(
					'default' => '',
					'sanitize_callback' => 'ekiline_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control(
		'ekiline_headerCustomText', array(
					'label'          => __( 'If Post Page is assigned (Homepage Settings), show page title.', 'ekiline' ),
					'description'    => '',
					'section'        => 'header_image',
					'settings'       => 'ekiline_headerCustomText',
					'type'           => 'checkbox',
					'priority'       => 30,
		)
	);  

	// Controlar el ancho del header
	$wp_customize->add_setting( 
		'ekiline_headerCustomWidth', array(
					'default' => '',
					'sanitize_callback' => 'ekiline_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control(
		'ekiline_headerCustomWidth', array(
					'label'          => __( 'Narrow header (jumbotron)', 'ekiline' ),
					'description'    => '',
					'section'        => 'header_image',
					'settings'       => 'ekiline_headerCustomWidth',
					'type'           => 'checkbox',
					'priority'       => 30,
		)
	);  

	// Altura de header    
    $wp_customize->add_setting( 
        'ekiline_range_header', array( 
    			'default' => '40',
    			'sanitize_callback'  => 'ekiline_sanitize_number_range'
        )
    );

    $wp_customize->add_control( 
        'ekiline_range_header', array(
        		'type'        => 'range',
        		'priority'    => 40,
        		'section'     => 'header_image',
        		'label'       => __( 'Header image height', 'ekiline' ),
        		'description' => __( 'Extend the image to fill the entire screen', 'ekiline' ),
        		'input_attrs' => array(
        				'min'   => 40,
        				'max'   => 100,
        				'step'  => 10,
        		),
	       ) 
   );    	

	// Video
    $wp_customize->add_setting( 
            'ekiline_video', array(
                    'default' => '',
                    'sanitize_callback' => 'ekiline_sanitize_video'
            )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Upload_Control( 
            $wp_customize, 'ekiline_video', 
                array(
            		'label'    => __( 'Front Page video', 'ekiline' ),
                	'description' => __( 'Recommended formats: MP4, WEBM or OGV, your header image conserves as poster', 'ekiline' ),
            		'section'  => 'header_image',
            		'settings' => 'ekiline_video',
                    'priority'    => 10,
                )
            ) 
    );    
	
}
add_action('customize_register', 'ekiline_custom_header_controls');

 /**
 * Controladores con callback: ekiline_custom_header_style()
 * https://developer.wordpress.org/themes/functionality/custom-headers/
 */
function ekiline_custom_header_setup() {
	
	add_theme_support( 'custom-header',
		apply_filters( 'ekiline_custom_header_args',
			array(
				'default-image'      => '', // se registra posteriormente.
				'default-text-color' => '000000',
				'width'              => '',
				'height'             => '',
				'flex-height'        => true,
				// 'wp-head-callback'   => 'ekiline_custom_header_style',
			)
		)
	);
	// registrar una imagen default.
		register_default_headers( array(
			'default-image' => array(
				'url'           => get_parent_theme_file_uri('/assets/img/ekiline-pattern.png'),
				'thumbnail_url' => get_parent_theme_file_uri('/assets/img/ekiline-pattern.png'),
				'description'   => __( 'Default header image', 'ekiline' ),
			),
		) );   	
}
add_action( 'after_setup_theme', 'ekiline_custom_header_setup' );

 /**
 * Cancelar callback: ekiline_custom_header_style(), aparecerá en el header.
 * Por las caracteristicas del tema, lo agrupamos en themeCustomColors.php
 */

	function ekiline_custom_header_style() {
		if ( !get_header_image() ) return;

		$hdrBkc = get_option('chdr_color','#000000');
		$hdrTxtc = get_option('chdrtxt_color','#6c757d');
		$hdrLksc = get_option('chdrlks_color','#007bff');
		
		$rangeHead = get_theme_mod('ekiline_range_header');
			if ( $rangeHead == '0' ) $rangeHead = '30';
	
		$hdrStyle = '.custom-header.container .wp-block-cover, .custom-header.container .wp-block-cover.has-background-dim::before{ background-color:'. esc_attr( $hdrBkc ) .'; min-height:' . $rangeHead . 'vh;align-items:flex-end; }';
		$hdrStyle .= '.custom-header.container .display-4.font-italic, .custom-header.container p { color:'. esc_attr( $hdrTxtc ) .' !important; }';
		$hdrStyle .= '.custom-header.container a { color:'. esc_attr( $hdrLksc ) .' !important; }';
		$hdrStyle .= '.custom-header.container > .alignfull { margin-left: calc( -100vw / 2 + 100% / 2 - 9px); margin-right: calc( -100vw / 2 + 100% / 2 - 9px); width: 100vw; }';
		$hdrStyle .= '.custom-header.container .wp-block-cover.has-background-dim::before{z-index: 0;opacity: .3 !important;}';
		$hdrStyle .= '@media only screen and (max-width:576px){ .custom-header.container > .alignfull { margin-left: calc( -100vw / 2 + 100% / 2 ); margin-right: calc( -100vw / 2 + 100% / 2); } }';
		$hdrStyle .= '@keyframes bgresize { 0% { background-size: 130%; } 100% { background-size: 120%; } }';
		$hdrStyle .= '.bg-deep, .wp-block-cover.bg-deep{ animation: bgresize 5s ease; background-position: 50% 50%; background-repeat: no-repeat; background-size: 120%; }';
		$hdrStyle .= '@media only screen and (max-width:960px){ @keyframes bgresize { 0% { background-size: 170vh; } 100% { background-size: 140vh; } } .bg-deep, .wp-block-cover.bg-deep{ background-size: 140vh;} }';
		$hdrStyle .= '@media only screen and (min-width:960px){ .custom-header.container .wp-block-cover{ background-image: url("'.ekiline_header_image('full').'") !important; } }';
		// return $hdrStyle;
		echo $hdrStyle;

	}
	add_action('group_inline_css', 'ekiline_custom_header_style', 4);


/**
 * Clases CSS de apoyo en body_class().
 * https://developer.wordpress.org/reference/functions/body_class/
 */
function ekiline_customHeaderCss( $classes ) {
	if ( !get_header_image() ) return $classes;	
	global $post;
	$classes[] = 'has-custom-header';
	return $classes;
}
add_filter( 'body_class', 'ekiline_customHeaderCss' );

/**
 * Crear un header dinamico y personalizable.
 * the_header_image_tag() : llama la etiqueta completa.
 * header_image(); : llama la url.
 * https://developer.wordpress.org/reference/functions/get_header_image/
 * https://developer.wordpress.org/reference/functions/header_image/
 * https://developer.wordpress.org/reference/functions/the_header_image_tag/
 **/

function ekiline_header_image($size = null){

	$size = ( $size != '' ) ? $size : 'medium_large'; //false; 
	$url = get_header_image();	

	/* 
	* Multiples dimensiones de un attachment
	* https://developer.wordpress.org/reference/functions/wp_get_attachment_image_srcset/
	* $url = wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'medium', null );
	* Tamaño medio (thumbnail,medium,medium_large,large,full)
	* https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
	* otra documentacion: https://premium.wpmudev.org/blog/wordpress-image-sizes/
	*/

	/* Condicion: en caso de ser la imagen de muestra, o ser una imagen nueva */	
	if( get_header_image() != get_parent_theme_file_uri('/assets/img/ekiline-pattern.png') ){
		$url = wp_get_attachment_image_url( get_custom_header()->attachment_id, $size, false, '' );
	}

	/* Condicion: si es una entrada o pagina */	
	if( is_singular() && !is_front_page() || is_home() || is_front_page() ){		
		global $post;
		$url = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( $post->ID, $size ) : $url ;
	}

	return $url;	
}

function custom_header_content($contentType = null){

    $custom_header_title = get_bloginfo( 'name' );
    $custom_header_text = get_bloginfo( 'description' );

        if ( is_front_page() && get_theme_mod('ekiline_headerCustomText') ){
            global $post;
            $custom_header_title = get_the_title();
			$custom_header_text = ekiline_content_out_the_loop() . '<br>';
        } 
            
        if ( is_home() ){
            if( get_theme_mod('ekiline_headerCustomText') ){
                $custom_header_title = get_the_title( get_option('page_for_posts', true) );
                    $contentfield = get_post_field( 'post_content', get_option('page_for_posts') );
						$custom_header_text = wp_trim_words( $contentfield, 24 );
						//Si existe un punto antes cortar
						$punto = strpos( $custom_header_text, '.' );
						if ($punto){
							$custom_header_text = substr( $custom_header_text, 0, strpos( $custom_header_text, '.' ) ) . '.';
						} 

            } else {
				$custom_header_title = '<a href="' . esc_url( get_the_permalink() ) . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
				$custom_header_text = ekiline_content_out_the_loop()  . '<br>';
					$custom_header_text .= '<small>'.ekiline_notes('categories') . ' | ' . ekiline_notes('tags') . '</small>';
            }
        }

        if ( is_singular() && !is_front_page() ){
			$custom_header_title = get_the_title();
				$addCategories = ( !is_page() ) ? ' | ' . ekiline_notes('categories') : '';
				$custom_header_text = '<small>'. ekiline_notes('author') . $addCategories . '</small>';
        }

        if( is_archive() || is_category() ){
            $custom_header_title = get_the_archive_title();
            $custom_header_text = '';
            if ( get_the_archive_description() ){
                $content = get_the_archive_description();
                    $custom_header_text .= wp_strip_all_tags( substr( $content, 0, strpos( $content, '.' ) ) ) . '<br>';
            }
					$custom_header_text .= '<small>'.ekiline_notes('categories') . ' | ' . ekiline_notes('tags') . '</small>';
        }

        if( is_search() ){
			global $wp_query;
            $custom_header_title = sprintf( esc_html__( '%s results found.', 'ekiline' ), $wp_query->found_posts );
            $custom_header_text =  sprintf( esc_html__( 'Search Results for: %s', 'ekiline' ), get_search_query() );
        }

        if( is_404() ){
            $custom_header_title =  esc_html__( 'It looks like nothing was found at this location.', 'ekiline' );
            $custom_header_text = esc_html__( 'Maybe try one of the links below or a search?', 'ekiline' );
        } 
        
    if ($contentType == 'title'){
        $contentType = $custom_header_title;
    } else if ($contentType == 'text'){
        $contentType = $custom_header_text;
    }

    return $contentType;    
}