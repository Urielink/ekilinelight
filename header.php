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
<html <?php language_attributes(); //ekiline_schema();?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<meta name="description" content="<?php //ekiline_description(); ?>" />
		<meta name="keywords" content="<?php //ekiline_keywords(); ?> " />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>
