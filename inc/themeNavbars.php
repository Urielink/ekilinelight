<?php
/**
 * Los menus preestablecidos
 * Default menus top and primary
 *
 * @package ekiline
 */


/**
 * Agregar logotipo a menu
 * Adding logo image to navbar-brand:
 **/
 
function logoTheme() {
    //variables de logotipo
    $logoHor = get_theme_mod( 'ekiline_logo_max' );
    $logoIcono = get_site_icon_url();
    
    if ( $logoHor && !$logoIcono ) {
        echo '<img class="img-fluid" src="' . $logoHor . '" alt="' . get_bloginfo( 'name' ) . '"/>';
    } elseif ( !$logoHor && $logoIcono ) {
        echo '<img class="brand-icon" src="' . $logoIcono . '" alt="' . get_bloginfo( 'name' ) . '"/>' . get_bloginfo( 'name' );
    } elseif ( $logoHor && $logoIcono ) {
        echo '<img class="img-fluid d-none d-md-block" src="' . $logoHor . '" alt="' . get_bloginfo( 'name' ) . '"/>
        <span class="d-block d-md-none"><img class="brand-icon" src="' . $logoIcono . '" alt="' . get_bloginfo( 'name' ) . '"/>' . get_bloginfo( 'name' ) . '</span>';
    } else {
        echo get_bloginfo( 'name' );
    } 
}


/**
 * Todos los menus
 * Se complementa con acciones preestablecidas en customizer.php
 * Works with customizer.php
 **/

function ekilineNavbar(){

	if ( !has_nav_menu( 'primary' ) ) return; 
		
		// invertir color (class css)
        $inverseMenu = 'navbar-light bg-light ';
		if( true === get_theme_mod('ekiline_inversemenu') ) : $inverseMenu = 'navbar-dark bg-dark ';  endif;

		// clase auxiliar alineación de items, transformar a header.
		$headNav = '';
		$navHelper = '';
        $navAlign = ''; 
		$modalCss = '';
		// variables para boton modal
		$dataToggle = 'collapse';
		$dataTarget = '#navbar-collapse-primary';				
						
		// Variables por cada tipo de menu: configurcion y distribucion de menu	    						
		$actions = get_theme_mod('ekiline_primarymenuSettings');
		$styles = get_theme_mod('ekiline_primarymenuStyles'); 
		
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
		if ($styles == '0') {
		    $navAlign = 'mr-auto ';
	    } else if ($styles == '1') {
	        $navAlign = 'ml-auto '; 
	    } else if ($styles == '2') {
			$navHelper = ' justify-content-md-center';
			$headNav = ' flex-md-column';
	    } else if ($styles == '3') {
			$navHelper = ' justify-content-md-between w-100';
			$headNav = ' flex-md-column';
	    } else if ($styles == '4') {
			$navHelper = ' justify-content-md-around w-100';
			$headNav = ' flex-md-column';
	    } else if ($styles == '5') {
	    	$modalCss = 'modal fade';
			$dataToggle = 'modal'; $dataTarget = '#navModal';
	    } else if ($styles == '6') {
	    	$modalCss = 'modal fade move-from-bottom';
			$dataToggle = 'modal'; $dataTarget = '#navModal';
	    } else if ($styles == '7') {
			$modalCss = 'modal fade left-aside';
			$dataToggle = 'modal'; $dataTarget = '#navModal';
	    } else if ($styles == '8') {
			$modalCss = 'modal fade right-aside';
			$dataToggle = 'modal'; $dataTarget = '#navModal';
	    } 	    		
		// Clases css para mostrar el boton del modal
		$expand = 'navbar-expand-md ';
		if ( $styles >= '5'){ $expand = ' '; }

		// Clases reunidas para <nav>
		$navClassCss = 'navbar '. $inverseMenu . $expand . 'primary-navbar ' . $navAction;

?>

			<nav id="site-navigation-primary"  class="<?php echo $navClassCss;?>">
			
		    	<div class="container<?php echo $headNav; ?>">
		
		            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php logoTheme(); ?></a>
											
		            <button class="navbar-toggler collapsed" type="button" data-toggle="<?php echo $dataToggle; ?>" data-target="<?php echo $dataTarget; ?>">
		      			<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button>
		            
		            <?php if ( $styles <= '4'){ ?> 

			        <div id="navbar-collapse-primary" class="collapse navbar-collapse primary<?php echo $navHelper;?>">

					<?php if ( get_bloginfo( 'description' ) ) { ?> 
					<span class="navbar-text d-none d-md-block"><?php echo get_bloginfo( 'description' ); ?></span> 
					<?php } ?>


			    	        <?php wp_nav_menu( array(
			        	                'menu'              => 'primary',
			        	                'theme_location'    => 'primary',
			        	                'depth'             => 2,
			        	                'container'         => '',
		                                'container_class'   => '',
		                                'container_id'      => '',
			        	                'menu_class'        => 'navbar-nav ' . $navAlign,
			        	                'menu_id'           => 'primary-inner-menu',
			                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
			        	                'walker'            => new WP_Bootstrap_Navwalker()
			    	                ) ); ?>
		        	
			        </div>
			       		            	
		            <?php } else {
		            	add_action( 'wp_footer', 'ekiline_modalMenuBottom', 0 );						
		            } ?>


		    	</div><!-- .container --> 
		    	
			</nav><!-- .site-navigation -->        

	<?php 

}

/*
 * Fragmento para crear un menu con madal
 */

function ekiline_modalMenuBottom(){
	/*tipos de animacion: .zoom, .newspaper, .move-horizontal, .move-from-bottom, .unfold-3d, .zoom-out, .left-aside, .right-aside */
	$modalCss = '';
	switch ( get_theme_mod('ekiline_primarymenuStyles') ) {
	    case 5 : $modalCss = 'modal fade'; break;
	    case 6 : $modalCss = 'modal fade move-from-bottom'; break;
	    case 7 : $modalCss = 'modal fade left-aside'; break;
	    case 8 : $modalCss = 'modal fade right-aside'; break;
	}?>
	
<div id="navModal" class="<?php echo $modalCss;?>" tabindex="-1" role="dialog" aria-labelledby="navModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="navModalLabel"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <?php wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'modal-body',
                'container_id'      => '',
                'menu_class'        => 'navbar-nav',
                'menu_id'           => 'modal-menu',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker()
            ) ); ?>
    			
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php }
//add_action( 'wp_footer', 'ekiline_modalMenuBottom', 0 );

