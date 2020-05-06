<?php
/**
 * Custom Color CSS Bootstrap feature
 *
 * @package ekiline
 */

 /**
 * Busqueda por medio de filtros
 * https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
 */

// limitar la busqueda solo a posts.
function searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        // $query->set('post_type',array('post','page'));
        $query->set('post_type',array('post'));
    } 
    return $query;
}
add_filter('pre_get_posts','searchfilter');


?>

<?php if ( is_home() || is_archive() ){?>

    <?php $ciudades = array(
            'show_option_none' => __( 'Ciudad', 'ekiline' ),
            'show_count'       => 1,
            'hierarchical'       => 1,
            'orderby'          => 'name',
            'hide_empty'	=> 0, 
            'child_of' => 45,
            'class' => 'postform form-control',
        );?>
    <?php $ocss = array(
            'show_option_none' => __( 'Tipo', 'ekiline' ),
            'show_count'       => 1,
            'hierarchical'       => 1,
            'orderby'          => 'name',
            'hide_empty'	=> 0, 
            'child_of' => 44,
            'class' => 'postform form-control',
    );?>
    
    <form method="get" action="<?php bloginfo('url'); ?>" class="bg-dark">
        <fieldset class="input-group p-4">
            <input class="form-control" placeholder="Buscar…" type="text" name="s" value="" maxlength="50" required="required"/>
            <?php wp_dropdown_categories($ciudades); ?>
            <?php wp_dropdown_categories($ocss); ?>
            <button type="submit" class="btn btn-primary">Search</button>
        </fieldset>
    </form>
    
<?php } ?>
