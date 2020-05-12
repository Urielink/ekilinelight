<?php
/**
 * ekiline functions and definitions.
 *
 * @link https://infinite-scroll.com/options.html
 *
 * @package ekiline
 */

 
/**
 * Registrar y agregar infinite-scroll.js
**/

function script_InfiniteScroll(){
    wp_register_script( 'infinite_scrolling', get_stylesheet_directory_uri().'/inc/infinite-scroll.pkgd.min.js', array('jquery'), null, true );
    if( is_singular() ) return;
    wp_enqueue_script('infinite_scrolling');        
}
// add_action('wp_enqueue_scripts', 'script_InfiniteScroll');

/**
 * Inicializar
**/
function init_InfiniteScroll() {
if ( is_singular() ) return; 
$cols = ( get_theme_mod('ekiline_Columns') >= 1 ) ? '#viewcolumns' : '#infiniteScrollcontent';
?>
	<script>
        jQuery(document).ready(function($){
            $('<?php echo $cols; ?>').infiniteScroll({
                // options
                path: '#page-navigation .pagination .page-item a.next.page-link',
                append: 'article.post',
                history: false,
                    // button: '.view-more-button', // si se quiere cargar con botones scrollThreshold debe ser falso.
                    // scrollThreshold: false, // distancia en pixeles al acercarse al final false / n1+
                    scrollThreshold: 100, // distancia en pixeles al acercarse al final false / n1+
                hideNav: '#page-navigation .pagination', // ocultar la paginacion
                status: '.page-load-status', // mensajes
            }); 
        });
	</script>
<?php 
}
// add_action( 'wp_footer', 'init_InfiniteScroll', 100 );


/**
 * agregar el marcado.
**/
function ekiline_InfiniteScroll(){
    if ( is_singular() ) return; ?>

    <div id="infiniteScrollcontent"></div>
    <div class="text-center w-100">			
        <!--a href="#viewmorebutton" id="viewmorebutton" class="view-more-button btn btn-primary">Ver más</a-->
        <div class="page-load-status text-primary" style="display: none;">
            <p class="infinite-scroll-request p-5"><img src="<?php echo get_stylesheet_directory_uri().'/inc/ajax-loader.gif';?>"/> Cargando...</p>
            <p class="infinite-scroll-last">Fin de contenido</p>
            <p class="infinite-scroll-error">No hay más que mostrar</p>
        </div>		
    <div>

<?php }

/**
 * Incluir el marcado en plantilla index con relación a archive:
 * echo ekiline_InfiniteScroll();
**/

/**
 * Scroll infinito
 * Incluir la funcion en functions.php
 */
// require get_stylesheet_directory() . '/inc/infinityScroll.php';