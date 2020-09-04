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

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<?php ekiline_navbar_menu( 'primary' ); ?>

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

<footer class="site-footer pt-4 pb-2 bg-dark text-white">
	<div class="container">
		<p>
			<?php
			/* translators: %1$s is replaced with date */
				printf( esc_html__( '&copy; Copyright %1$s. ', 'ekiline' ), esc_attr( date( 'Y' ) . ' ' . get_bloginfo( 'name', 'display' ) ) );
			/* translators: %1$s and %2$s are replaced with link url */
				printf( esc_html__( 'Proudly powered by %1$s and %2$s. ', 'ekiline' ), '<a href="' . esc_url( 'https://wordpress.org/' ) . '" target="_blank" rel="noopener">' . esc_html__( 'WordPress', 'ekiline' ) . '</a>', '<a href="' . esc_url( 'http://ekiline.com' ) . '" target="_blank" rel="noopener">' . esc_html__( 'Ekiline', 'ekiline' ) . '</a>' );
			?>
			<a class="goTop float-right" href="#top"><span>&uarr;</span><?php esc_html_e( 'Back', 'ekiline' ); ?></a>
		</p>
	</div>
</footer><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>
