/* Ekiline for WordPress Theme, Copyright 2018 Uri Lazcano. Ekiline is distributed under the terms of the GNU GPL. http://ekiline.com */

jQuery(document).ready(function($){

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 
	 *	Botones individuales. 
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * **/			
    // Ajuste en dropdown de widgets dentro de navbar
	// $('.navbar-nav > .dropdown > .dropdown-menu').on('click', function(e){
		// e.stopPropagation();
	// });
	$('.dropdown-menu a').on("click", function(e){
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

	/* scroll suave en botón de footer */
	$('.goTop').click(function() {
	  $('html, body').animate({ 
	  	scrollTop:0 }, 'slow');		
	});

}); 			