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

	<header>

		<?php if ( is_singular() ) { ?>

			<?php // Page & post title. ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<p class="entry-meta small mark">
				<?php
					/* translators: %s is replaced with author link */
					printf( esc_html_x( 'Written by %s', 'post authors', 'ekiline' ), wp_kses_post( get_the_author_posts_link() ) );
				?>

				<?php
					/* translators: %s is replaced with post date */
					printf( esc_html_x( 'Posted on %s', 'post date', 'ekiline' ), wp_kses_post( '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" rel="bookmark">' . get_the_time( __( 'F j, Y', 'ekiline' ) ) . '</a>' ) );
				?>

				<?php
					/* translators: %s is replaced with modification date */
					printf( esc_html__( 'Updated on %s', 'ekiline' ), wp_kses_post( get_the_modified_date( __( 'F j, Y', 'ekiline' ) ) ) );
				?>

				<?php
					printf( wp_kses_post( comments_popup_link( __( 'No comments yet', 'ekiline' ), __( '1 Comment', 'ekiline' ), __( '% Comments', 'ekiline' ), 'comments-link', __( 'Comments are closed.', 'ekiline' ) ) ) );
				?>

			</p><!-- .entry-meta -->



		<?php } else { ?>

			<?php // Archive, list titles. ?>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '" title="' . get_the_title() . '">', '</a></h2>' ); ?>

		<?php } ?>

	</header>

	<?php the_post_thumbnail( ekiline_thumbnail( 'size' ), ekiline_thumbnail( 'css' ) ); ?>

	<?php the_content(); ?>

	<?php ekiline_link_pages(); ?>

<?php if ( is_singular() ) { ?>
	<footer>
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
	</footer>
<?php } ?>

</article><!-- #post-## -->
