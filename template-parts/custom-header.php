<?php
/**
 * Custom header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ekiline
 */

?>

<?php if ( get_header_image() ) { ?>

<div id="custom_header_module" class="custom-header container">

	<div class="wp-block-cover has-background-dim-20 has-background-dim has-parallax bg-deep <?php echo ( ! get_theme_mod( 'ekiline_headerCustomWidth' ) ) ? 'alignfull px-0' : 'jumbotron'; ?>" style="background-image:url( '<?php echo esc_url( ekiline_header_image() ); ?>' );">

	<?php if ( get_theme_mod( 'ekiline_video' ) && is_front_page() ) { ?>
		<video class="wp-block-cover__video-background" autoplay="" muted="" loop="" src="<?php echo esc_url( get_theme_mod( 'ekiline_video' ) ); ?>" poster="<?php echo esc_url( ekiline_header_image() ); ?>"></video>
	<?php } ?>

		<div class="headline position-relative <?php echo ( ! get_theme_mod( 'ekiline_headerCustomWidth' ) ) ? 'container px-4' : 'w-100'; ?>">
			<p class="title display-4">
				<?php echo wp_kses_post( custom_header_content( 'title' ) ); ?>
			</p>
			<p class="lead">
				<?php echo wp_kses_post( custom_header_content( 'text' ) ); ?>
			</p>
		</div>
	</div>

</div>

<?php } ?>
