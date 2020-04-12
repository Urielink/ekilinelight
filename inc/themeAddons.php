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
 * No es necesario. Aún por definir.
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
 * Obtener categorias para pagina 404
 */
function ekiline_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'ekiline_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'ekiline_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so ekiline_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so ekiline_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in ekiline_categorized_blog.
 */
function ekiline_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'ekiline_categories' );
}
add_action( 'edit_category', 'ekiline_category_transient_flusher' );
add_action( 'save_post',     'ekiline_category_transient_flusher' );
