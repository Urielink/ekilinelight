<?php
/**
 * ekiline functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ekiline
 * 
 * get_stylesheet_directory()
 */

/*
* reemplazar una busqueda directo en la consulta search.
* es útil para reemplazar busquedas de palabras negativas.
*/

// function replace_search( $query_object ) {

//     if( $query_object->is_search() ) {
//         // con esto reemplaza el string y una palabra específica después de "s="
//         $raw_search = $query_object->query['s'];
//         $replacement = str_replace( 'block', 'html', $raw_search );
//         if( $replacement ) {
//             $query_object->set( 's', $replacement );
//         }
//     }

// }
// add_action( 'parse_query', 'replace_search' );

function advanced_search_query($query) {

    if( $query->is_search() ) {

        $cat = ( ( ! empty( $_GET['cat'] ) ) ? $_GET['cat'] : '' );
        $type = ( ( ! empty( $_GET['type'] ) ) ? $_GET['type'] : '' );        

        // print_r( $cat );
        // print_r( $type );
        $categories = array($cat,$type);
        // var_dump( $categories );

        // Oficial: https://developer.wordpress.org/reference/hooks/pre_get_posts/
        // Operadores AND, OR, etc: https://developer.wordpress.org/reference/classes/wp_query/
        // este array incluye la busqueda "IN" de categorias seleccionadas.
        $query->set( 'cat', $categories ); 

    }

}
add_action('pre_get_posts', 'advanced_search_query');



function newSearchForm(){

// https://www.wpbeginner.com/wp-tutorials/how-to-limit-search-results-for-specific-post-types-in-wordpress/
// https://www.wpbeginner.com/wp-tutorials/how-to-use-multiple-search-forms-in-wordpress/
// https://wordpress.stackexchange.com/questions/239760/modifying-searchform-php-and-search-php-to-have-two-kinds-of-searches
// !! https://www.wpexplorer.com/limit-wordpress-search/
// https://developer.wordpress.org/reference/functions/wp_dropdown_categories/

    $ciudades = array(
        'name' => 'cat',
        'show_option_all' => __( 'Todos los estados', 'ekiline' ),
        'show_count'       => 1,
        'hierarchical'       => 1,
        'orderby'          => 'name',
        'hide_empty'	=> 0, 
        // 'child_of' => 9,
        'class' => 'postform form-control cat',
        'echo' => 1,
        'selected' => ( ( ! empty( $_GET['cat'] ) ) ? $_GET['cat'] : '' )
    ); 				
    $tipo = array(
        'name' => 'type',
        'show_option_all' => __( 'Todos los tipos', 'ekiline' ),
        'show_count'       => 1,
        'hierarchical'       => 1,
        'orderby'          => 'name',
        'hide_empty'	=> 0, 
        // 'child_of' => 33,
        'class' => 'postform form-control type',
        'echo' => 1,
        'selected' => ( ( ! empty( $_GET['type'] ) ) ? $_GET['type'] : '' )
    ); 					
?>

<form method="get" action="<?php bloginfo('url'); ?>" class="row no-gutters p-2 bg-dark">
    <div class="form-group col-md-4 m-0">
        <?php wp_dropdown_categories($ciudades); ?>
    </div>
    <div class="form-group col-md-4 m-0">
        <?php wp_dropdown_categories($tipo); ?>
    </div>
    <div class="col-md-4 m-0">
        <div class="input-group">
            <input type="text" value="<?php get_search_query() ;?>" class="form-control" name="s" id="s" />
            <div class="input-group-prepend">
                <input type="submit" value="buscar" class="btn btn-primary" />
            </div>
        </div>
    </div>
</form>	

<?php

}
