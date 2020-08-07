<?php
/**
* Metaetiquetas del tema || Meta tags
*
* @package ekiline
*/


/**
* Meta descripcion
**/

function ekiline_meta_description() {
	// la descripcion general, default: is_home()
	$desc_head = get_bloginfo( 'description' );
	// si es pagina o post
	if ( is_singular() ) {
		global $post;
		if ( $post->post_content ) {
			$pExtract = wp_trim_words( strip_shortcodes( $post->post_content ), 24, '...' );
			if ( $pExtract ) {
				$desc_head = $pExtract;
			}
		}
	}
	// si es archivo o categoria
	if ( is_archive() ) {
		if ( category_description() ) {
			$desc_head = strip_tags( category_description() );
		} else {
			$cat = get_the_category();
			if ( $cat ) {
				$cat_count = $cat[0]->count;
				/* translators: %1$s is replaced with post count and %2$s is asigned to title */
				$desc_head = sprintf( __( 'There are %1$s entries related to %2$s', 'ekiline' ), $cat_count, strip_tags( get_the_archive_title() ) );
			}
		}
	}

	return $desc_head;
}

function ekiline_print_meta_description() {
	echo '<meta name="description" content="' . esc_attr( ekiline_meta_description() ) . '" />' . "\n";
}
add_action( 'wp_head', 'ekiline_print_meta_description', 0, 0 );


/**
* Meta KeyWords, extender, permitirlas en la páginas.
* meta keywords, extend this to use in pages.
**/

function tags_support_all() {
	// phpcs:ignore WPThemeReview.PluginTerritory.ForbiddenFunctions.plugin_territory_register_taxonomy_for_object_type
	register_taxonomy_for_object_type( 'post_tag', 'page' );
}
add_action( 'init', 'tags_support_all' );

// Incluir todas // ensure all tags are included in queries
function tags_support_query( $wp_query ) {
	if ( $wp_query->get( 'tag' ) ) {
		$wp_query->set( 'post_type', 'any' );
	}
}
add_action( 'pre_get_posts', 'tags_support_query' );


function ekiline_meta_keywords() {
	// etiqueta por default
	$keywords = '';

	if ( is_single() || is_page() ) {

		global $post;
		$tags = get_the_tags( $post->ID );

		if ( $tags ) {
			foreach ( $tags as $tag ) :
				$sep       = ( empty( $keywords ) ) ? '' : ', ';
				$keywords .= $sep . $tag->name;
			endforeach;
			$keywords = $keywords;
		}
	} elseif ( is_tag() ) {

		$keywords = single_tag_title( '', false );

	} elseif ( is_archive() ) {

		$keywords = single_cat_title( '', false );

	} elseif ( is_home() || is_front_page() ) {

		$tags = get_tags();
		if ( $tags ) {
			$i = 0;
			foreach ( $tags as $tag ) :
				$sep       = ( empty( $keywords ) ) ? '' : ', ';
				$keywords .= $sep . $tag->name;

				$i++;
				if ( $i === 10 ) {
					break;
				}
			endforeach;
			$keywords = $keywords;
		}
	}

	if ( $keywords ) {
		return $keywords;
	}

}

function ekiline_print_meta_keywords() {
	echo '<meta name="keywords" content="' . esc_attr( ekiline_meta_keywords() ) . '" />' . "\n";
}
add_action( 'wp_head', 'ekiline_print_meta_keywords', 0, 0 );


/**
* Meta Image url, extender para redes sociales.
* meta image url, extend this to use in socialmedia.
**/
function ekiline_meta_image() {

	$img_url = wp_get_attachment_url( get_theme_mod( 'ekiline_logo_max' ) );
	if ( get_header_image() ) {
		$img_url = get_header_image();
	}

	if ( is_singular() && ! is_front_page() || is_home() || is_front_page() ) {
		global $post;
		$img_url = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( $post->ID, 'medium_large' ) : $img_url;
	}

	return $img_url;

}


/**
* Meta social, itemprop, twitter y facebook.
**/
function metaSocial() {
	global $wp;
	$metaSocial = '';

	$metaTitle       = get_bloginfo( 'name' );
	$metaDescription = ekiline_meta_description();
	$metaImages      = ekiline_meta_image();
	$twSocial        = 'twitter.com';
	$metaType        = 'website';
	$currentUrl      = home_url( add_query_arg( array(), $wp->request ) ); //global $wp

	//Google
	$metaSocial .= '<meta itemprop="name" content="' . $metaTitle . '">' . "\n";
	$metaSocial .= '<meta itemprop="description" content="' . $metaDescription . '">' . "\n";
	$metaSocial .= '<meta itemprop="image" content="' . $metaImages . '">' . "\n";
	//twitter
	$metaSocial .= '<meta name="twitter:card" content="summary">' . "\n";
	$metaSocial .= '<meta name="twitter:site" content="' . $twSocial . '">' . "\n";
	$metaSocial .= '<meta name="twitter:title" content="' . $metaTitle . '">' . "\n";
	$metaSocial .= '<meta name="twitter:description" content="' . $metaDescription . '">' . "\n";
	$metaSocial .= '<meta name="twitter:creator" content="' . $twSocial . '">' . "\n";
	$metaSocial .= '<meta name="twitter:image" content="' . $metaImages . '">' . "\n";
	//facebook
	$metaSocial .= '<meta property="og:title" content="' . $metaTitle . '"/>' . "\n";
	$metaSocial .= '<meta property="og:type" content="' . $metaType . '"/>' . "\n";
	$metaSocial .= '<meta property="og:url" content="' . $currentUrl . '"/>' . "\n";
	$metaSocial .= '<meta property="og:image" content="' . $metaImages . '"/>' . "\n";
	$metaSocial .= '<meta property="og:description" content="' . $metaDescription . '"/>' . "\n";
	$metaSocial .= '<meta property="og:site_name" content="' . $metaTitle . '"/>' . "\n";

	$allowed_html = array(
		'meta' => array(
			'itemprop' => array(),
			'content'  => array(),
			'name'     => array(),
			'property' => array(),
		),
	);
	echo wp_kses( $metaSocial, $allowed_html );

}

add_action( 'wp_head', 'metaSocial', 1 );
