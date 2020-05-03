/* Ekiline for WordPress Theme, Copyright 2018 Uri Lazcano. Ekiline is distributed under the terms of the GNU GPL. http://ekiline.com */

jQuery(document).ready(function($){

// inicializar popovers

	$('[data-toggle="popover"]').popover();	
	$('.popover-dismiss').popover({
		trigger : 'focus'
	});
	$('[data-toggle="tooltip"]').tooltip();

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 
	 *	Botones individuales. 
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * **/			
    // Ajuste en dropdown de widgets dentro de navbar
	$('.dropdown-menu a.dropdown-toggle').on("click", function(e){
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