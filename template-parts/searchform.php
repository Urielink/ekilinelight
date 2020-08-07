<?php
/**
* Formulario de Búsqueda.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package ekiline
*/
?>

<form role="search" method="get" id="searchform" class="searchform my-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search">
		<?php
			/* translators: %s is replaced by searchquery */
			echo esc_html__( 'Search Results for: %s', 'ekiline' );
		?>
	</label>
	<div class="input-group">
		<input class="form-control" type="search" value="<?php echo get_search_query(); ?>" id="search" name="s" placeholder="<?php echo esc_attr__( 'Search Results for:', 'ekiline' ); ?>"/>
		<div class="input-group-append">
			<button class="btn btn-secondary" type="submit" id="searchsubmit"><span>&orarr;</span>
			<?php echo esc_html__( 'Search', 'ekiline' ); ?></button>
		</div>
	</div>
</form>
