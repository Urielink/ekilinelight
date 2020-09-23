<?php
/**
 * Template part for displaying posts in search page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */

?>

<article class="bg-white border rounded p-2 mb-2 media">

	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-thumbnail mr-3' ) ); ?>
	</a>

	<div class="media-body">

		<?php the_title( '<h2 class="entry-title mb-0"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">', '</a></h2>' ); ?>

		<?php the_excerpt(); ?>

	</div>

</article><!-- #post-## -->
