<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */

?>

<?php
if ( is_search() ) {
	get_template_part( 'template-parts/content', 'search' );
	return;
}
?>

<article <?php post_class(); ?>>

	<?php the_post_thumbnail( ekiline_img( 'size' ), [ 'class' => ekiline_img( 'css' ) ] ); ?>

	<div class="card-body">

		<?php the_title( '<h2 class="entry-title card-title"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">', '</a></h2>' ); ?>

		<?php the_content(); ?>

	</div>

	<footer class="card-footer">
		<p class="entry-meta small mark">
			<?php
			if ( ! is_page() || get_the_category_list() !== '' ) {
				/* translators: %s is replaced with category title */
				printf( esc_html__( 'Categories: %s', 'ekiline' ), wp_kses_post( get_the_category_list( ', ' ) ) );
			}

			if ( get_the_tag_list() !== '' ) {
				/* translators: %s is replaced with tags */
				printf( esc_html__( 'Tags: %s', 'ekiline' ), wp_kses_post( get_the_tag_list( '', ', ' ) ) );
			}
			?>
		</p><!-- .entry-meta -->
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
