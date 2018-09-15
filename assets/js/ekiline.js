/* Ekiline for WordPress Theme, Copyright 2018 Uri Lazcano. Ekiline is distributed under the terms of the GNU GPL. http://ekiline.com */

jQuery(document).ready(function($){

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 
	 *	Sidebars ocultar mostrar 
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * **/			

	    // Sidebar izquierdo mostrar ocultar
		$('#primary').on('click',function(e) {
	    	e.preventDefault();
	        $(this).toggleClass('col-md-9 col-md-12', 'col-md-9');
	        $('#secondary').toggleClass('col-md-3 d-md-none','col-md-3');
	        $('#third').toggleClass('col-md-3 d-md-none','col-md-3');
		});     

		$('#secondary').on('click',function(e) {
	    	e.preventDefault();
	        $(this).toggleClass('col-md-3 d-md-none','col-md-3');
	        $('#primary').toggleClass('col-md-9 col-md-12', 'col-md-12');
		});     

		$('#third').on('click',function(e) {
	    	e.preventDefault();
	        $(this).toggleClass('col-md-3 d-md-none','col-md-3');
	        $('#primary').toggleClass('col-md-9 col-md-12', 'col-md-12');
		});     
	

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 
	 *	Botones individuales. 
	 * 
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * **/			
			
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