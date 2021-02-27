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
				// console.log($(this).children());
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
	// transformarCarrusel('.carousel-multiple');

});


window.transformarCarruselNativo = function(carrusel){

	// Si no hay carrusel cancelar todo.
	var loaditem = document.querySelector(carrusel);
	if ( !loaditem || 0 < loaditem.getElementsByTagName('figure').length ) {
		return;
	}

	// Funcion envoltorio (Wrapper).
	function envolver(fuente,col){
		// console.log(fuente)
		var hijos = fuente.children;
		// var padre = fuente.parentNode;//prueba
		// crear envoltorio
		var wrapper = document.createElement('figure');
			wrapper.className = 'col-md-' + col;
		// envolver los hijos.
		for (var i = hijos.length - 1; i >= 0; i--) {
			// padre.appendChild(hijos[i]);//prueba
			wrapper.appendChild(hijos[i]);
		};
		fuente.appendChild(wrapper);
	}

	// Si hay carrusel,
	var siCarruseles = document.querySelectorAll(carrusel);

	// // Cuantos son.
	// console.log('cuantosson');
	// console.log(siCarruseles.length);

	// Modificar cada uno
	Array.prototype.forEach.call(siCarruseles, function(unCarrusel, i){

		// // objeto e indice.
		// console.log('quees');
		// console.log(unCarrusel);
		// console.log('contar');
		// console.log(i);

		// Vistas, columnas y grupo.
		var params = [ ['x2','6','0'],['x3','4','1'],['x4','3','2'],['x6','2','4'] ];
		var view, item;
		// Envoltorio extra para agrupar.
		for ( var i = 0; i < params.length; i++ ) {
			// //atributos por clase.
			// console.log(params[i][0]);
			if ( unCarrusel.classList.contains(params[i][0]) ) {
				item = params[i][1];
				view = params[i][2];
			}
		}

		// //resultado de seleccion por carrusel
		// console.log(item);
		// console.log(view);

		// // Carrusel padre.
		// console.log(unCarrusel);

		// Items para envoltorio.
		hijosCarrusel = unCarrusel.querySelectorAll('.carousel-item');

		// Carrusel hijo.
		// console.log(hijosCarrusel);

		// Envoltorio por item.
		Array.prototype.forEach.call(hijosCarrusel, function(el,i){
			envolver(el,item);
		});

		// Loop grupos.
		Array.prototype.forEach.call(hijosCarrusel, function(el, i){
			// Copiar el primer slide y agregarlo.
			var next = el.nextElementSibling;
			if ( !next ) {
				next = el.parentNode.children[0];
			}

			// Elemento siguiente.
			// console.log(next);

			// Elemento siguiente clonar.
			// console.log(next.children[0]);
			// console.log(el.parentNode.children[i]);

			var firstChildClone = next.children[0].cloneNode(true);
			var firstChildSet = el.parentNode.children[i];
			firstChildSet.appendChild(firstChildClone);

			// Agrupar slides (view).
			// console.log(view)

			for ( var i=0;i<view;i++ ) {
				next = next.nextElementSibling;
				if ( !next ) {
					next = el.parentNode.children[0];
				}
				firstChildClone = next.children[0].cloneNode(true);
				firstChildSet.appendChild(firstChildClone);
			}

		});
	});
};
transformarCarruselNativo('.carousel-multiple');