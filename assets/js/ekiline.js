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
		var last_scroll_top = 0, scroll_top;
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

	/* Ekiline: carrusel extendido */
	// function transformarCarrusel(carrusel){
	// cambiar la declaracion, para poder hacer uso en el editor .
	window.transformarCarrusel = function(carrusel){

		// Condiciones si no hay carrusel,
		// O saber que ya fue intervenido, no hacer nada.
		if ( 0 === $(carrusel).length || 0 < $(carrusel).find('figure').length ) {
			return;
		}

		$(carrusel).each(function(){

			// Vistas, columnas y grupo.
			var params = [ ['x2','6','0'],['x3','4','1'],['x4','3','2'],['x6','2','4'] ];
			var view, item;
			// Envoltorio extra para agrupar.
			for ( var i = 0; i < params.length; i++ ) {
				if ( $(this).hasClass( params[i][0] ) ){
					item = params[i][1];
					view = params[i][2];
				}
			}
			// Items envoltorio.
			$(this).find('.carousel-item').each(function(){
				$(this).children().wrapAll('<figure class="col-md-' + item + '">','</figure>');
			});
			// Loop grupos.
			$(this).find( '.carousel-item').each(function(){
				// Copiar el primer slide y agregarlo.
				var next = $(this).next();
				if ( !next.length ) {
					next = $(this).siblings(':first');
				}
				next.children(':first-child').clone().appendTo( $(this) );
				// Agrupar slides (view).
				for ( var i=0;i<view;i++ ) {
					next = next.next();
					if ( !next.length ) {
						next = $(this).siblings(':first');
					}
					next.children(':first-child').clone().appendTo( $(this) );
				}
			});

		});

	}
	transformarCarrusel('.carousel-multiple');

	// /* Auxiliar para el admin */
	// var isAdmin = $('.wp-admin.block-editor-page');

	// if ( 0 < $(isAdmin).length ){
	// 	console.log('si es admin');
	// 		// ejecutar script al refresh, despues de 2 segundos.
	// 		// averiguar como invocar desde editor.
	// 		setTimeout( function(){
	// 			// validar que exista carrusel.
	// 			var hasCarousel = $('.carousel-multiple');

	// 			if ( 0 < $(hasCarousel).length ){
	// 				console.log('si tiene carrusel');
	// 				transformarCarrusel('.carousel-multiple');
	// 			} else {
	// 				console.log('no tiene carrusel');
	// 			}

	// 			// $( ".carousel-multiple" ).one('click',function() {
	// 			// 	transformarCarrusel('.carousel-multiple');
	// 			// });

	// 		}, 2000 );
	// } else {
	// 	console.log('no es admin');
	// }

});
