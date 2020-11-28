<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */

?>

<article <?php post_class(); ?>>

	<?php
	if ( ! get_header_image() ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	}
	?>

	<?php the_content(); ?>

</article><!-- #post-## -->
