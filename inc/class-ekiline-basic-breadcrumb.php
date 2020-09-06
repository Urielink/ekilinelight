<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package ekiline
 */

/**
 * Mejora, breadcrumb como widgtet.
 * Referencia: https://codex.wordpress.org/Widgets_API
 * Referencia: https://www.cssigniter.com/extending-wordpress-core-3rd-party-widgets/
 */
class Ekiline_Basic_Breadcrumb extends WP_Widget {

	/**
	 * Setup de widget
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'Ekiline_Basic_Breadcrumb',
			'description' => __( 'Show breadcrumb module (Ekiline)', 'ekiline' ),
		);
		parent::__construct( 'Ekiline_Basic_Breadcrumb', __( 'Breadcrumb Nav', 'ekiline' ), $widget_ops );
	}

	/**
	 * Contenido de widget
	 *
	 * @param array $args envelope of item.
	 * @param array $instance the widget.
	 */
	public function widget( $args, $instance ) {
		/**
		 * Para sobrescribir un widget, en este caso ekiline, agrega opciones css y tipo de mestreo,
		 * entonces es necesario llamar un widget, obteniendo su id y llamando el dato que necesitamos.
		 */
		global $wp_registered_widgets;
		$widget_id  = $args['widget_id'];
		$widget_obj = $wp_registered_widgets[ $widget_id ];
		$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		$widget_num = $widget_obj['params'][0]['number'];
		$css_style  = $widget_opt[ $widget_num ]['css_style'];

		$args = array(
			'before_widget' => '<nav id="' . $args['widget_id'] . '" class="' . $css_style . ' widget ' . $args['widget_id'] . '">',
			'after_widget'  => '</nav>',
		);

		// Widget con nuevos datos.
		echo wp_kses_post( $args['before_widget'] );
		echo wp_kses_post( create_breadcrumb() );
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Opciones en admin
	 *
	 * @param array $instance The widget options.
	 */
	public function form( $instance ) {
		// outputs the options form on admin.
		return $instance;
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 * @param array $old_instance The previous options.
	 *
	 * @return array function has no return statement.
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved.
		return $new_instance;
	}
}

/**
 * Register widget
 */
function ekiline_breadcrumb_register_widgets() {
	register_widget( 'Ekiline_Basic_Breadcrumb' );
}
add_action( 'widgets_init', 'ekiline_breadcrumb_register_widgets' );

/**
 * Breadcrumb elements
 */
function create_breadcrumb() {

	if ( is_home() || is_front_page() ) {
		return;
	}

	$breadcrumb = '<li class="breadcrumb-item home"><a href="' . home_url() . '"> ' . __( 'Home', 'ekiline' ) . ' </a></li><!--.home-->';

	if ( is_page() || is_single() ) {

		if ( is_attachment() ) {
			// variables para los attachments.
			$attach_post   = get_post( get_the_ID() );
			$attach_url    = get_permalink( $attach_post->post_parent );
			$attach_parent = get_the_title( $attach_post->post_parent );

			// si es un adjunto, muestra el titulo de donde viene.
			$breadcrumb .= '<li class="breadcrumb-item single-attachment"><a href="' . $attach_url . '" title="Volver a  ' . $attach_parent . '" rel="gallery">' . $attach_parent . '</a></li><!--.single-attachment--><li class="breadcrumb-item single-category-child">';

		} elseif ( is_page() ) {

			/**
			 * Si es pagina y tiene herencia, padres.
			 * info: https://wordpress.stackexchange.com/questions/140362/wordpress-breadcrumb-depth
			 */

			// 1) Se llama la variable global para hacer un loop de paginas.
			global $post;
			// 2) confirmamos si tiene herencia, si no brinca al final (3).
			if ( $post->post_parent ) {
				// Se llama al padre de esta página.
				$parent_id = $post->post_parent;
				// Establezco mi variable para crear una lista de las paginas superirores.
				$breadcrumbs = array();
				// Doy formato los items de este array.
				while ( $parent_id ) {
					$page          = get_page( $parent_id );
					$breadcrumbs[] = '<li class="breadcrumb-item post-parent"><a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li><!--.post-parent-->';
					$parent_id     = $page->post_parent;
				}
				// Organizo el array para que el orden sea inverso.
				$breadcrumbs = array_reverse( $breadcrumbs );
				// Creo un loop por cada loop.
				foreach ( $breadcrumbs as $crumb ) {
					$breadcrumb .= $crumb;
				}
				// Cierro el HTML.
				$breadcrumb .= '<li class="breadcrumb-item post-childB">';
			} else {
				// 3) Final de loop
				$breadcrumb .= '<li class="breadcrumb-item post-childA">';
			}
		} elseif ( is_single() ) {

			$cats = get_the_category( get_the_ID() );
			$cat  = array_shift( $cats );

			// En caso de woocommerce.
			if ( class_exists( 'woocommerce' ) && get_post_type( get_the_ID() ) !== 'product' ) {
				$breadcrumb .= '<li class="breadcrumb-item single-category">' . get_category_parents( $cat, true, '</li><!--.single-category--><li class="breadcrumb-item single-category-child">' );
			} else {
				$breadcrumb .= '<li class="breadcrumb-item single-category">';
			}
		}
		// en caso de no tener titulo.
		if ( ! get_the_title() ) {
			$breadcrumb .= __( '&not;&not;', 'ekiline' ) . '</li><!--.single-category-child.post-child-->';
		} else {
			$breadcrumb .= the_title( '', '</li><!--.single-category-child.post-child-->', false );
		}
	}

	if ( is_archive() ) {
		// Referencia: https://developer.wordpress.org/reference/functions/get_the_archive_title/.
		$title = '';
		if ( is_category() ) {

			$catname = single_term_title( '', false );
			$catid   = get_cat_ID( $catname );
			// diferenciar si hay categorías padre.
			// Referencia: https://wordpress.stackexchange.com/questions/11267/check-is-category-parent-or-not-from-its-id/.
			$catobj = get_category( $catid );
			// auxiliar para mostrar solo el padre.
			$parentobj = $catobj->parent;

			if ( $catobj->category_parent > 0 ) {
				// este muestra toda una lista.
				$breadcrumb .= '<li class="breadcrumb-item category-parent">' . get_category_parents( $parentobj, true, '</li><!--.category-parent--><li class="breadcrumb-item category-child">' ) . $catname;
			} else {
				$breadcrumb .= '<li class="breadcrumb-item category-child">' . get_category_parents( $catid, false, '' );
			}
		} elseif ( is_tag() ) {
			$title = '<li class="breadcrumb-item tag">' . single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<li class="breadcrumb-item author"><span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = '<li class="breadcrumb-item year">' . get_the_date( 'Y' );
		} elseif ( is_month() ) {
			$title = '<li class="breadcrumb-item month">' . get_the_date( 'F Y' );
		} elseif ( is_day() ) {
			$title = '<li class="breadcrumb-item day">' . get_the_date( 'F j, Y' );
		} elseif ( is_post_type_archive() ) {
			$title = '<li class="breadcrumb-item ptArchive">' . post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$tax   = get_taxonomy( get_queried_object()->taxonomy );
			$title = '<li class="breadcrumb-item tax">' . single_term_title( '', false );
		}

		$breadcrumb .= $title . '</li><!--.category-child.tag.author.year.month.day.ptArchive.tax-->';

	}

	if ( is_search() ) {
		$breadcrumb .= '<li class="breadcrumb-item search">' . __( 'Search ', 'ekiline' ) . '</li><!--.search-->';
	}

	if ( is_404() ) {
		$breadcrumb .= '<li class="breadcrumb-item 404">' . __( 'Not found ', 'ekiline' ) . '</li><!--.404-->';
	}

	echo wp_kses_post( '<ul class="breadcrumb">' . $breadcrumb . '</ul>' );

}
