<?php
/**
 * Metaetiquetas del tema || Meta
 *
 * @package ekiline
 */

function ekiline_meta_description() {
    // la descripcion general, default: is_home()
    $descHead = get_bloginfo( "description" );
    // si es pagina o post
    if ( is_singular() ) {
        global $post;
        if ( $post->post_content ){
            $pExtract = wp_trim_words( strip_shortcodes( $post->post_content ), 24, '...' );
            if ( $pExtract ){
                $descHead = $pExtract;
            }
        }
    }
    // si es archivo o categoria
    if ( is_archive() ) {
        if ( category_description() ){
            $descHead = strip_tags(category_description());
        } 
    }
    echo '<meta name="description" content="' . $descHead . '" />' . "\n";
}
add_action( 'wp_head', 'ekiline_meta_description', 0 , 0);



// Permitir el uso de etiquetas en pages // add tag support to pages
function tags_support_all() {
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'tags_support_all');

// Incluir todas // ensure all tags are included in queries
function tags_support_query($wp_query) {
    if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}
add_action('pre_get_posts', 'tags_support_query');


function ekiline_meta_keywords() {
    // etiqueta por default
    $keywords = '';

    if( is_single() || is_page() ) {

        global $post;    
        $tags = get_the_tags($post->ID);
        
        if($tags) {            
            foreach($tags as $tag) :
                $sep = (empty($keywords)) ? '' : ', ';
                $keywords .= $sep . $tag->name;
            endforeach;
            $keywords = $keywords;
        }
        
    } elseif ( is_tag() ){
        $keywords = single_tag_title( "", false );
    } elseif ( is_archive() ){
        $keywords = single_cat_title("", false);
    } elseif ( is_home() || is_front_page() ){

        $tags = get_tags();
        if($tags) {        
            $i=0;    
            foreach($tags as $tag) :
                $sep = (empty($keywords)) ? '' : ', ';
                $keywords .= $sep . $tag->name;

                $i++;
                if($i==10) break;                
            endforeach;
            $keywords = $keywords;
        }

    } 

    if ($keywords){
        echo '<meta name="keywords" content="' . $keywords . '" />' . "\n";
    }

}
add_action( 'wp_head', 'ekiline_meta_keywords', 0 , 0);


/**
 * Metadatos en plantilla de contenido, header y footer.
*/


if ( ! function_exists( 'ekiline_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function ekiline_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
        }
    
        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );
        
        //ekiline, mejor elazamos al mes
        $archive_year  = get_the_time('Y');
        $archive_month = get_the_time('m');
        $timelink = get_month_link( $archive_year, $archive_month );    
    
        $posted_on = sprintf(
            esc_html_x( 'Posted on %s', 'post date', 'ekiline' ),
            //'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
            '<a href="' . esc_url( $timelink ) . '" rel="bookmark">' . $time_string . '</a>'
        );
    
        $byline = sprintf(
            esc_html_x( 'by %s', 'post author', 'ekiline' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );
    
        echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    
    }

endif;
    
if ( ! function_exists( 'ekiline_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function ekiline_entry_footer() {
    
        edit_post_link(
            sprintf(
                /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'ekiline' ) . '<span class="fa fa-pencil-alt"></span>',
                the_title( '<span class="screen-reader-text">"', '"</span> ', false )
            ),
            '<span class="edit-link float-right">','</span>'
        );
            
        // Show category and tag text for singles.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ',  ', 'ekiline' ) );
            if ( $categories_list && ekiline_categorized_blog() ) {
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ekiline' ) . '</span> ', $categories_list ); // WPCS: XSS OK.
            }
    
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ',  ', 'ekiline' ) );
            if ( $tags_list ) {
                printf( '<br/><span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ekiline' ) . '</span> ', $tags_list ); // WPCS: XSS OK.
            }
        }
        
        // Mostrar etiquetas en páginas.
        if ( is_page() ) {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ',  ', 'ekiline' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ekiline' ) . '</span> ', $tags_list ); // WPCS: XSS OK.
            }
        }   
    
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link( esc_html__( 'Leave a comment', 'ekiline' ), esc_html__( '1 Comment', 'ekiline' ), esc_html__( '% Comments', 'ekiline' ) );
            echo '</span> ';
        }
    
    
    }
    
endif;
    
    /**
     * Returns true if a blog has more than 1 category.
     *
     * @return bool
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