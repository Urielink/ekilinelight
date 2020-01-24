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