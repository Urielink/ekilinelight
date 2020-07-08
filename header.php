<?php
/**
 * El header de ekiline contiene las metaetiquetas escenciales, el resto se incorporan
 * con funciones: Analytics, Searchconsole y las redes sociales. Sucede lo mismo con estilos y scripts.
 * De ese modo solo modificas el controlador de metaetiquetas.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @package ekiline
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ekiline_schema();?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>
<?php wp_body_open(); ?>	
			
<?php dynamic_sidebar( 'toppage-w1' );?>				

<?php ekilineNavbar('primary'); ?> 

<?php get_template_part( 'template-parts/custom-header' ); ?>
