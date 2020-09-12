/* Ekiline for WordPress Theme, Copyright 2018 Uri Lazcano. Ekiline is distributed under the terms of the GNU GPL. http://ekiline.com */
jQuery(document).ready(function( $ ) {

	/**
	 * Addons Ekiline
	 */

    /* Ajuste en dropdown de widgets dentro de navbar */
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e){
	    $(this).next('ul').toggle();
	    e.stopPropagation();
	    e.preventDefault();
	  });

	/* animar el boton del menu modal */
	$('.modal-toggler').on('click',function(){
		$(this).removeClass('collapsed');
	});
		$('.modal-nav').on('hidden.bs.modal', function(){
			$('.modal-toggler').addClass('collapsed');
		});

	/* cambiar el tamaño de una ventana modal */
	$( '.modal-resize' ).click(function(){
		$( '.modal-open' ).toggleClass('modal-full');
		$( this ).find('span:first-child').toggleClass('float-right');
	});

	/* scroll suave en botón de footer */
	$('.goTop').click(function() {
	  $('html, body').animate({ scrollTop:0 }, 'slow');
	});

	/* Navegacion con scroll */
	if ( $('#primarySiteNavigation.navbar-sticky').length > 0 ) {
		var last_scroll_top = 0;
		$(window).on('scroll', function() {
			scroll_top = $(this).scrollTop();
			if( scroll_top < last_scroll_top ) {
				$('#primarySiteNavigation.navbar-sticky').removeClass('scrolled-down').addClass('scrolled-up');
			} else {
				$('#primarySiteNavigation.navbar-sticky').removeClass('scrolled-up').addClass('scrolled-down');
			}
			last_scroll_top = scroll_top;
		});
	}

	/**
	 * Bootstrap
	 */

	/* inicializar popovers y tooltips */
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

});