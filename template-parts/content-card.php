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
			
	<?php ekiline_thumbnail(); ?>

	<div class="card-body">

		<?php the_title( sprintf( '<h2 class="entry-title card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

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

	</div>

	<footer>	
		<small><?php ekiline_entry_footer(); ?></small>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->