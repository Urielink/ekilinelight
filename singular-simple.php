<?php
/**
 * Template Name: Simple page
 *
 * Plantilla basica con formato, sin titulo, sin widgets, sin comentarios.
 * Basic template with format, no title, no widgets, no comments.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package WordPress
 * @subpackage ekiline
 */

get_header();
?>

<main id="primary" class="<?php echo esc_attr( ekiline_width_control() ); ?>">

		<?php
		while ( have_posts() ) :

			the_post();
			?>

				<article <?php post_class(); ?>>

				<?php the_content(); ?>

				</article><!-- #post-## -->

			<?php
		endwhile;
		?>

</main><!-- #primary -->

<?php get_footer(); ?>
