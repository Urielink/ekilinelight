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

		<?php the_title(); ?>

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

	<footer class="card-footer">	

		<?php ekiline_entry_footer(); ?>
		
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->