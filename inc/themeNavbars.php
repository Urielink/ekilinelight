<?php
/**
 * Navegacion principal || Default menu
 *
 * @package ekiline
 */


/**
 * Agregar logotipo a menu
 * Adding logo image to navbar-brand:
 **/
 
function logoTheme() {
    //variables de logotipo
    $logoIcono = get_theme_mod( 'ekiline_minilogo' ); //get_site_icon_url();
    $logoHor = wp_get_attachment_url( get_theme_mod( 'ekiline_logo_max' ) );

    if ( $logoHor && !$logoIcono ) {
		echo '<img class="img-fluid" src="' . esc_url($logoHor) . '" alt="' . esc_html(get_bloginfo( 'name' )) . '" loading="lazy"/>';
    } elseif ( !$logoHor && $logoIcono ) {
		echo '<img class="brand-icon" src="' . esc_url(get_site_icon_url()) . '" alt="' . esc_html(get_bloginfo( 'name' )) . '" loading="lazy"/>
			' . esc_html(get_bloginfo( 'name' )) ;
    } elseif ( $logoHor && $logoIcono ) {
		echo '
		<img class="img-fluid d-none d-md-block" src="' . esc_url($logoHor) . '" alt="' . esc_html(get_bloginfo( 'name' )) . '" loading="lazy"/>
		<span class="d-block d-md-none">
			<img class="brand-icon" src="' . esc_url(get_site_icon_url('150')) . '" alt="' . esc_html(get_bloginfo( 'name' )) . '" loading="lazy"/>
			' . esc_html(get_bloginfo( 'name' )) . '
		</span>';
    } else {
        echo esc_html(get_bloginfo( 'name' ));
	} 
}

/**
 * Clases CSS de apoyo en body_class().
 * https://developer.wordpress.org/reference/functions/body_class/
 */
// function ekiline_hideTextNavsCss( $classes ) {
// 	if ( ! display_header_text() ) return $classes;	
// 	global $post;
// 	$classes[] = 'hide-nav-description';
// 	return $classes;
// }
// add_filter( 'body_class', 'ekiline_hideTextNavsCss' );

/**
 * Todos los menus
 * Se complementa con acciones preestablecidas en customizer.php
 * Works with customizer.php
 **/

function ekilineNavbar($navPosition){

	if ( !has_nav_menu( $navPosition ) ) return; 
		
		// invertir color (class css)
		$inverseMenu = ( true === get_theme_mod('ekiline_inversemenu') ) ? 'navbar-light bg-light ' : 'navbar-dark bg-dark ' ;

		// clase auxiliar alineación de items, transformar a header.
        $navAlign = '';
		$headNav = '';
		$navHelper = '';
		$modalCss = '';
		// variables para boton modal
		$dataToggle = 'collapse';
		$dataTarget = $navPosition.'NavMenu';				
		$expand = 'navbar-expand-md ';
		$togglerBtn = 'navbar-toggler collapsed';
						
		// Variables por cada tipo de menu: configurcion y distribucion de menu	    						
		$actions = get_theme_mod('ekiline_'.$navPosition.'menuSettings');
		$styles = get_theme_mod('ekiline_'.$navPosition.'menuStyles'); 
		
		//Clases css por configuración de menu
		if ($actions == '0') {
		    $navAction = 'static-top';
	    } elseif ($actions == '1') {
	        $navAction = 'fixed-top'; 
	    } elseif ($actions == '2') {
	        $navAction = 'fixed-bottom'; 
	    } elseif ($actions == '3') {
	        $navAction = 'navbar-sticky'; 
	    }	

		//Clases css por estilo de menu
		switch ($styles) {
		    case 0 : $navAlign = ' mr-auto'; break;
		    case 1 : $navAlign = ' ml-auto'; break;
		    case 2 : $navHelper = ' justify-content-md-center'; $navAlign = ' justify-content-md-center'; $headNav = ' flex-md-column'; break;
		    case 3 : $navHelper = ' justify-content-md-between w-100'; $navAlign = ' justify-content-md-between w-100'; $headNav = ' flex-md-column'; break;
			// case 4 : $navHelper = ' justify-content-md-around w-100'; $navAlign = ' justify-content-md-around w-100'; $headNav = ' flex-md-column'; break;
			case 4 : $navHelper = ' nav-scroller w-100 show'; $navAlign = ' nav flex-row'; $headNav = ' flex-md-column'; break;
		    case 5 : $navHelper = ' offcanvas '.$inverseMenu; $navAlign = ' ml-auto'; break;
		    case 6 : $navHelper = ' order-first'; $expand = ' '; break;
		    case 7 : $modalCss = 'modal fade'; break;
		    case 8 : $modalCss = 'modal fade move-from-bottom'; break;
		    case 9 : $modalCss = 'modal fade left-aside'; break;
		    case 10 : $modalCss = 'modal fade right-aside'; break;
		}
				   		
		// Clases css para mostrar el boton del modal
		if ( $styles >= '7'){
			 $expand = ' '; 
			 $dataToggle = 'modal';
			 $dataTarget = $navPosition.'NavModal';
			 $togglerBtn = 'modal-toggler navbar-toggler collapsed';
		}

		// Clases reunidas para <nav>
		$navClassCss = 'navbar '. $inverseMenu . $navPosition . '-navbar ' . $expand . $navAction;
		// Clases reunidas para .navbar-collapse
		$collapseCss = 'collapse navbar-collapse ' . $navHelper;

?>

			<header id="<?php echo esc_attr($navPosition);?>SiteNavigation"  class="<?php echo esc_attr($navClassCss);?>">
			
		    	<div class="container<?php echo esc_attr($headNav); ?>">

		            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php logoTheme(); ?></a>
		            
					<?php if( get_bloginfo( 'description' ) ) { ?>
					<span class="navbar-text d-none d-md-block site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></span> 
					<?php }?>

		            <button class="<?php echo esc_attr($togglerBtn);?>" type="button" data-toggle="<?php echo esc_attr($dataToggle); ?>" data-target="#<?php echo esc_attr($dataTarget); ?>" aria-label="Toggle navigation">
		      			<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		            
	            <?php if ( $styles <= '6'){ ?> 

			        <div id="<?php echo esc_attr($dataTarget);?>" class="<?php echo esc_attr($collapseCss);?>">

					<?php if ( $styles == '5' ){ ?>
						<button class="<?php echo esc_attr($togglerBtn);?>" type="button" data-toggle="<?php echo esc_attr($dataToggle); ?>" data-target="#<?php echo esc_attr($dataTarget); ?>" aria-label="Toggle navigation">
			      			<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
						</button>
					<?php }?>

			    	        <?php wp_nav_menu( array(
			        	                'menu'              => $navPosition,
			        	                'theme_location'    => $navPosition,
			        	                // 'depth'             => 2, // en caso de restringir la profundidad
			        	                'container'         => '',
		                                'container_class'   => '',
		                                'container_id'      => '',
			        	                'menu_class'        => 'navbar-nav' . $navAlign,
			        	                'menu_id'           => $navPosition . 'MenuLinks',
			                            'fallback_cb'       => 'EkilineNavFallback',
			        	                'walker'            => new EkilineNavMenu()
			    	                ) ); ?>
		        	
			        </div>
			       		            	
	            <?php } ?>


		    	</div><!-- .container --> 
		    	
			</header><!-- .site-navigation -->       
			
	            <?php if ( $styles >= '7'){
		            	ekiline_modalMenuBottom($navPosition);
	            }?>
	<?php 

}

/*
 * Fragmento para crear un menu con madal
 */
function ekiline_modalMenuBottom($navPosition){
	/*tipos de animacion: .zoom, .newspaper, .move-horizontal, .move-from-bottom, .unfold-3d, .zoom-out, .left-aside, .right-aside */
	$modalId = $navPosition.'NavModal';
	$modalCss = '';
	switch ( get_theme_mod('ekiline_'.$navPosition.'menuStyles') ) {
	    case 7 : $modalCss = 'modal fade modal-nav'; break;
	    case 8 : $modalCss = 'modal fade move-from-bottom modal-nav'; break;
	    case 9 : $modalCss = 'modal fade left-aside modal-nav'; break;
	    case 10 : $modalCss = 'modal fade right-aside modal-nav'; break;
	}?>
	
<div id="<?php echo esc_attr($modalId);?>" class="<?php echo esc_attr($modalCss);?>" tabindex="-1" role="dialog" aria-labelledby="navModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h3 class="modal-title" id="navModalLabel"><?php // echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
		</button>
	  </div> -->
      <div class="modal-body navbar-light bg-light">
	  
	  	<div class="btn-group float-right">
			<button type="button" class="modal-resize btn btn-sm btn-outline-secondary" aria-label="Modal size">
				<span>&leftarrow;</span>
				<span>&rightarrow;</span>
			</button>					
			<button type="button" class="navbar-toggler m-0 btn btn-sm btn-outline-secondary" data-dismiss="modal" aria-label="Close">
				<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
			</button>
		</div>

      	<div class="navbar p-0">

		<?php if( get_bloginfo( 'description' ) ) { ?>
			<span class="navbar-text site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></span> 
		<?php }?>
		        
	    <?php wp_nav_menu( array(
	                'menu'              => $navPosition,
	                'theme_location'    => $navPosition,
	                // 'depth'             => 2, // en caso de restringir la profundidad
	                'container'         => 'div',
	                'container_class'   => 'navbar-collapse collapse show',
	                'container_id'      => '',
	                'menu_class'        => 'navbar-nav',
	                'menu_id'           => 'modal-menu',
	                'fallback_cb'       => 'EkilineNavFallback',
	                'walker'            => new EkilineNavMenu()
				) ); ?>				
		  </div>

	  </div>
	  
      <!--div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div-->
    </div>
  </div>
</div><!-- #<?php echo esc_attr($modalId);?> -->

<?php }
// add_action( 'wp_footer', 'ekiline_modalMenuBottom', 0, 1 );

function EkilineNavFallback() {
if ( is_user_logged_in() ) $link = '/wp-admin/nav-menus.php'; else $link = '/wp-login.php';
$link = home_url(null,$link);
  ?>
  <ul id="SetNavMenu" class="navbar-nav mr-auto">
  	<li class="nav-item">
  		<a class="nav-link" href="<?php echo esc_url($link); ?>"><?php esc_html_e('Assign a menu!', 'ekiline'); ?></a>		
	</li>
  </ul>
  <?php
} // EkilineNavFallback