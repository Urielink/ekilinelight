<?php
/**
* Template Name: No sidebars fullwidth
*
* @package WordPress
* @subpackage ekiline
*
*/
get_header(); ?>

<main id="primary" class="container-fluid">

	<?php dynamic_sidebar( 'content-w1' ); ?>

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;
		?>

	<?php dynamic_sidebar( 'content-w2' ); ?>

	<?php comments_template( '/template-parts/comments.php' ); ?>

</main><!-- #primary -->

<?php get_footer(); ?>
