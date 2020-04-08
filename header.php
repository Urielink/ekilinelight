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
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>
			
<?php dynamic_sidebar( 'toppage-w1' );?>				

<?php ekilineNavbar('primary'); ?> 

<?php // get_template_part( 'template-parts/global-header' );?>

<?php
/**
 * 
 * abril 7, pruebas y ajustes en funciones de directorio, resulta que, si deseo incorporar un header al sitio, el marcado debe cambiar.
 * global-header, cuenta con todo lo necesario. Hay que refactorizar.
 * **** Prestar especial cuidado a la obtención de titulos.
 * themeElements, se ajustaron unas clases.
 * themeNavbars, se añadio un h2, quizá no es necesario. Pero solo para verificar de momento.
 * **** Colusion 1
 * Siguiendo el orden de bootstrap, el navbar es el header.
 * - entonces no se necesita tener un cover como header.
 * - en tal caso entonces ese cover es un elemento complementario, gráfico del articulo, pero no debiera restar prioridad sino añadir valor.
 */

?> 