<?php
/**
 * Template part for displaying archive data.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */
?>

<?php if ( is_singular() ) return; ?>


<?php the_archive_title('<h1>','</h1>'); ?>

<div>
	
	<?php if ( is_category() ) { ?>

		<?php echo category_description(); ?>

	<?php } else if ( is_author() ) { ?>
		<?php
		/**
		 * Obtener los datos del autor.
		 * https://developer.wordpress.org/reference/functions/get_the_author_meta/ 
		 **/	
		?>

		<p>
			<?php echo nl2br( get_the_author_meta('description') ); ?>
		</p>

		<p>
			<?php echo __( 'User: ', 'ekiline' ) . get_the_author_meta( 'nickname' ); // to get  nicename ?>						
			<br> <?php echo __( 'Email: ', 'ekiline' ) . get_the_author_meta( 'email' ); // to get  email ?>						
			<br> <?php echo __( 'Web: ', 'ekiline' ) . get_the_author_meta( 'url' ); // to get  url ?>						
		</p>
		
	<?php } ?>

</div>