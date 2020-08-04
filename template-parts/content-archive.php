<?php
/**
* Template part for displaying archive, category or author data.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package ekiline
*/
?>

<?php if ( is_singular() ) return; ?>

<?php
/*
* Mostrar diversos formatos en cada listado, segun el tipo (pagina de entradas, categoria o las entradas de autor).
*/
?>

<h1 class="archive-title">
	<?php echo wp_kses_post( ( is_home() && ! is_front_page() ) ? get_the_title( get_option( 'page_for_posts', true) ) : get_the_archive_title() ) ; ?>
</h1>

	<?php if ( is_home() && ! is_front_page() ) { ?>

		<div>
			<?php echo wp_kses_post( get_post_field( 'post_content', get_option( 'page_for_posts' ) ) ); ?>
		</div>

	<?php } else if ( is_category() ) { ?>

		<div> <?php echo category_description(); ?> </div>

	<?php } else if ( is_author() ) { ?>
		<?php
		/**
		 * Obtener los datos del autor.
		 * https://developer.wordpress.org/reference/functions/get_the_author_meta/
		 **/
		?>
		<div>

			<p>
				<?php echo wp_kses_post( nl2br( get_the_author_meta( 'description' ) ) ); ?>
			</p>

			<p>
				<?php echo wp_kses_post( __( 'User: ', 'ekiline' ) . get_the_author_meta( 'display_name' ) ); // to get selected name ?>
				<br> <?php echo wp_kses_post( __( 'Email: ', 'ekiline' ) . get_the_author_meta( 'email' ) ); // to get  email ?>
				<br> <?php echo wp_kses_post( __( 'Web: ', 'ekiline' ) . get_the_author_meta( 'url' ) ); // to get  url ?>
			</p>

		</div>

	<?php } ?>
