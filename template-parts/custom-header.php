<?php
/**
* Custom header.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package ekiline
*/
if ( !get_header_image() ) return;
?>

<div class="custom-header container">

	<div class="wp-block-cover has-background-dim-20 has-background-dim has-parallax rounded bg-deep <?php echo ( get_theme_mod( 'ekiline_headerCustomWidth' ) != '' ) ? '' : 'alignfull'; ?>" style="background-image:url( '<?php echo esc_url( ekiline_header_image() ); ?>' );">

	<?php if ( get_theme_mod( 'ekiline_video' ) && is_front_page() ) {?>
		<video class="wp-block-cover__video-background" autoplay="" muted="" loop="" src="<?php echo esc_url(get_theme_mod( 'ekiline_video' ) );?>" poster="<?php echo esc_url( ekiline_header_image() ); ?>"></video>
	<?php } ?>

		<div class="col-md-6 px-0 mx-auto text-center">
			<p class="title display-4">
				<?php echo wp_kses_post( custom_header_content( 'title' ) ); ?>
			</p>
			<p class="lead">
				<?php echo wp_kses_post( custom_header_content( 'text' ) ); ?>
			</p>
		</div>
	</div>

</div>
