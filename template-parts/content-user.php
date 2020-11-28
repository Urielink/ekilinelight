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

	<header class="border-bottom pb-2">

		<?php // Page & post title. ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header>

	<?php the_content(); ?>

</article><!-- #post-## -->
