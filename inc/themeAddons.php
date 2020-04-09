<?php
/**
 * Objetos agregados || Theme addons
 *
 * Modulos extra para el tema.
 * Extra Modules for theme enhancement.
 *  
 * @package ekiline
 */

/**
 * Extender la información de la pagina blog
 * https://developer.wordpress.org/reference/functions/is_home/
 **/

function ekiline_addBlogPageContent(){
	if ( is_singular() ) return;
	
	$archiveTitle = get_the_archive_title();
	$archiveContent = get_the_archive_description();
	$custom = false;

	if ( is_home() && $custom != ''){
		$archiveTitle = get_the_title( get_option('page_for_posts', true) );
		$archiveContent = get_post_field( 'post_content', get_option('page_for_posts') );
	} 
	
	echo '<header class="page-header">
				<h1 class="page-title">'. $archiveTitle .'</h1>
				<div class="archive-description">'. $archiveContent .'</div>
			</header><!-- .page-header -->';	
}
// index.php - ekiline_showBlogPageContent().


/**
 * Crear un header dinamico y personalizable.
 **/

function ekiline_addCoverHeader(){

	$url = 'http://localhost/wpdev/ekiline/wp-content/uploads/2008/06/dsc04563.jpg';
	$title = 'no title';
	$content = 'no content';
	$meta = 'no meta';
	$custom = false; // mostrar el titulo de la pagina blog.

	if ( is_home() || is_front_page() ){
		$title = get_bloginfo( 'name' );
		$content = get_bloginfo( 'description' );
		$meta = ekiline_notes('copyright');
	}

	if ( is_home() && $custom != '' ){
		//$url = get_the_post_thumbnail_url( get_option('page_for_posts'), 'medium' );
		$title = get_the_title( get_option('page_for_posts', true) ) . ' el blog';
			$contentfield = get_post_field( 'post_content', get_option('page_for_posts') );
		$content = wp_trim_words( $contentfield, 20, '...' );
		$meta = '';
	}

	if( is_singular() && !is_front_page() || is_front_page() && $custom != '' ){
		global $post;
		if( has_post_thumbnail() ){
			$url = get_the_post_thumbnail_url();
		}
		$title = get_the_title() . ' pagina o entrada';
		$content = wp_trim_words( $post->post_content, 10, '...' );
		$meta = ekiline_notes('author');
			if( is_single() ) $meta .= ' , '. ekiline_notes('categories');
	} 
	
	if ( is_archive() || is_category() ){
		$title = get_the_archive_title() . ' archivo, categoria';
		$content = get_the_archive_description();
		//no meta
	}
	if ( is_search() ){
		global $wp_query;
		$title = sprintf( esc_html__( 'Search Results for: %s', 'ekiline' ), '<span>' . get_search_query() . '</span>' );
		$content = sprintf( esc_html__( '%s results found.', 'ekiline' ), $wp_query->found_posts );
		//no meta
	}
?>

<div class="wp-block-cover xhas-background-dim-20 xhas-background-dim has-parallax alignfull" 
	style="background-image:url(<?php echo $url; ?>);height:10vh;color:#fff;margin-top:0px;margin-bottom:0px;flex-direction:column;">

	<h1><?php echo $title; ?></h1>
	<p class="wp-block-cover-text"><?php echo $content; ?></p>        
	<p class="entry-meta small"><?php echo $meta; ?></p>        

</div>

<!-- <div class="wp-block-cover has-background-dim aligncenter" style="height:100vh;color:#fff;margin-top:0px;margin-bottom:0px;">
    <video class="wp-block-cover__video-background" autoplay="" muted="" loop="" src="http://localhost/wpdev/ekiline/wp-content/uploads/2013/12/2014-slider-mobile-behavior.mov"></video>
    <p class="wp-block-cover-text">Compare the video and image blocks.<br>This block is centered.</p>
</div> -->

<?php }

// header.php ekiline_addCoverHeader().
