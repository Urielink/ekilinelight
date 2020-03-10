<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */
 // Variables en contenido:
 // obtener el ID
	$itemId = get_post_type().'-'.get_the_ID();
 // mostrar el thumb de acuerdo al tipo de contenido	
	if ( is_home() || is_front_page() || is_archive() || is_search() ) $thumbShow = 'thumbnail'; else $thumbShow = '';
?>

<article id="<?php echo $itemId; ?>" <?php post_class();?>>

<header>
	
	<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

	<small class="entry-meta">
			<?php ekiline_posted_on(); ?>
	</small><!-- .entry-meta -->

</header>

    <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( $thumbShow, array( 'class' => 'img-thumbnail') ); ?>
        </a>        
    <?php } ?>	

	<?php
	    if( is_single() || is_page() ) {
	        the_content();
	    } else if ( is_home() || is_front_page() || is_archive() || is_search() ) {
			// En caso de que el cliente quiera recortar su texto de manera personalizada
		    if( strpos( $post->post_content, '<!--more-->' ) ) {
		        the_content();
		    } else {
		        the_excerpt();
		    }
	    }		
	?>
  
	<?php
	// En caso de que el contenido esté paginado
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekiline' ),
			'after'  => '</div>',
		) );
	?>	
	
<footer>	
	<small><?php ekiline_entry_footer(); ?></small>
</footer>

</article><!-- #post-## -->