<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */
?>

<article id="<?php echo ekiline_post_id();?>" <?php post_class();?>>

<header>
		
	<?php the_title(); ?>

	<small class="entry-meta">
			<?php ekiline_posted_on(); ?>
	</small><!-- .entry-meta -->

</header>
	
	<?php ekiline_thumbnail(); ?>

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

	<?php ekiline_entry_footer(); ?>
	
</footer>

</article><!-- #post-## -->