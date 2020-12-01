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

	<?php // Page & post title. ?>
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>

	<?php the_content(); ?>

	<?php ekiline_link_pages(); ?>

</article><!-- #post-## -->
