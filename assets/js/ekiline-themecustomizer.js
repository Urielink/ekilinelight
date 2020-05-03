/* Ekiline for WordPress Theme, Copyright 2018 Uri Lazcano. Ekiline is distributed under the terms of the GNU GPL. http://ekiline.com */


/* Ekiline for WordPress Theme, Copyright 2018 Uri Lazcano. Ekiline is distributed under the terms of the GNU GPL. http://ekiline.com */

jQuery(document).ready(function($){

//1) este refresca al escribir	
	// wp.customize( 'ekiline_textarea_css', function( value ) {
	// 	value.bind( function( newval ) {

//2) este refresca al cambio en un selector...	
		// wp.customize( 'back_color', 'ekiline_textarea_css', function( field1, field2 ) {
		//  field1.bind( function( value ) {

//3) Entonces hacemos un loop que detectce algun cambio en los colores...	
			var colors = ['back_color','text_color','main_color','menu_color','fbar_color','fbartxt_color','fbarlks_color','footer_color','ftext_color','flinks_color','b4_primary','b4_secondary','b4_success','b4_danger', 'b4_warning','b4_info','b4_light','b4_dark'];
			$.each( colors, function( key, value ) {
				wp.customize( value, 'ekiline_textarea_css', function( field1, field2 ) {
					field1.bind( function( value ) {

/* --------------------------------------- 
	Inicia el ejerciocio original de colores.
-----------------------------------------*/						

	//pagina		
	   var bgColor = wp.customize.value('back_color')();
	   var txColor = wp.customize.value('text_color')();
	   var mainColor = wp.customize.value('main_color')();
   //navbar
	   var bgNvColor = wp.customize.value('menu_color')();
   //footer
	   var bgFtColor = wp.customize.value('fbar_color')();
	   var txFtColor = wp.customize.value('fbartxt_color')();
	   var aFtColor = wp.customize.value('fbarlks_color')();
   //footer-bar
	   var FbColor = wp.customize.value('footer_color')();
	   var txFbColor = wp.customize.value('ftext_color')();
	   var aFbColor = wp.customize.value('flinks_color')();
   //bootstrap
	   var colPri = wp.customize.value('b4_primary')();
	   var colSec = wp.customize.value('b4_secondary')();
	   var colSuc = wp.customize.value('b4_success')();
	   var colDan = wp.customize.value('b4_danger')();
	   var colWar = wp.customize.value('b4_warning')();
	   var colInf = wp.customize.value('b4_info')();
	   var colLig = wp.customize.value('b4_light')();
	   var colDak = wp.customize.value('b4_dark')();
	   
	   //console.log( bgColor, txColor, bgNvColor, bgFtColor, txFtColor, colPri, colSec, colSuc, colDan, colWar, colInf, colLig, colDak )

	   // funcion que genera varios tonos.

		   //// $('#tmpstyle').remove(); resetear estilo.			

		   // Bajar el tono para hover
		   var aHColor = HexAHslvar(colPri, 0, 0, -10);
		   var btnPriHBdc = HexAHslvar(colPri, 0, 0, -15);
		   var btnPriNotBdc = HexAHslvar(colPri, 0, 0, -20);
		   var btnPriFocBx = hexToRgbA(HexAHslvar(colPri, 0, 0, 35));
		   var btnPriFocHBx = hexToRgbA(HexAHslvar(colPri, 0, 0, 10));
			   //transparencias en alertas
			   var altPriBg = hexToRgbA(HexAHslvar(colPri, 0, 0, 40));
			   var altPriTx = hexToRgbA(HexAHslvar(colPri, 0, 0, -20));
			   var altPriLk = hexToRgbA(HexAHslvar(colPri, 0, 0, -35));

		   var aSecHColor = HexAHslvar(colSec, 0, 0, -10);
		   var btnSecHBdc = HexAHslvar(colSec, 0, 0, -15);
		   var btnSecNotBdc = HexAHslvar(colSec, 0, 0, -20);
		   var btnSecFocBx = hexToRgbA(HexAHslvar(colSec, 0, 0, 35));
		   var btnSecFocHBx = hexToRgbA(HexAHslvar(colSec, 0, 0, 10));
			   //transparencias en alertas
			   var altSecBg = hexToRgbA(HexAHslvar(colSec, 0, 0, 40));
			   var altSecTx = hexToRgbA(HexAHslvar(colSec, 0, 0, -20));
			   var altSecLk = hexToRgbA(HexAHslvar(colSec, 0, 0, -35));

		   var aSucHColor = HexAHslvar(colSuc, 0, 0, -10);
		   var btnSucHBdc = HexAHslvar(colSuc, 0, 0, -15);
		   var btnSucNotBdc = HexAHslvar(colSuc, 0, 0, -20);
		   var btnSucFocBx = hexToRgbA(HexAHslvar(colSuc, 0, 0, 35));
		   var btnSucFocHBx = hexToRgbA(HexAHslvar(colSuc, 0, 0, 10));
			   //transparencias en alertas
			   var altSucBg = hexToRgbA(HexAHslvar(colSuc, 0, 0, 40));
			   var altSucTx = hexToRgbA(HexAHslvar(colSuc, 0, 0, -20));
			   var altSucLk = hexToRgbA(HexAHslvar(colSuc, 0, 0, -35));

		   var aDanHColor = HexAHslvar(colDan, 0, 0, -10);
		   var btnDanHBdc = HexAHslvar(colDan, 0, 0, -15);
		   var btnDanNotBdc = HexAHslvar(colDan, 0, 0, -20);
		   var btnDanFocBx = hexToRgbA(HexAHslvar(colDan, 0, 0, 35));
		   var btnDanFocHBx = hexToRgbA(HexAHslvar(colDan, 0, 0, 10));
			   //transparencias en alertas
			   var altDanBg = hexToRgbA(HexAHslvar(colDan, 0, 0, 40));
			   var altDanTx = hexToRgbA(HexAHslvar(colDan, 0, 0, -40));
			   var altDanLk = hexToRgbA(HexAHslvar(colDan, 0, 0, -55));

		   var aWarHColor = HexAHslvar(colWar, 0, 0, -10);
		   var btnWarHBdc = HexAHslvar(colWar, 0, 0, -15);
		   var btnWarNotBdc = HexAHslvar(colWar, 0, 0, -20);
		   var btnWarFocBx = hexToRgbA(HexAHslvar(colWar, 0, 0, 35));
		   var btnWarFocHBx = hexToRgbA(HexAHslvar(colWar, 0, 0, 10));
			   //transparencias en alertas
			   var altWarBg = hexToRgbA(HexAHslvar(colWar, 0, 0, 40));
			   var altWarTx = hexToRgbA(HexAHslvar(colWar, 0, 0, -20));
			   var altWarLk = hexToRgbA(HexAHslvar(colWar, 0, 0, -35));

		   var aInfHColor = HexAHslvar(colInf, 0, 0, -10);
		   var btnInfHBdc = HexAHslvar(colInf, 0, 0, -15);
		   var btnInfNotBdc = HexAHslvar(colInf, 0, 0, -20);
		   var btnInfFocBx = hexToRgbA(HexAHslvar(colInf, 0, 0, 35));
		   var btnInfFocHBx = hexToRgbA(HexAHslvar(colInf, 0, 0, 10));
			   //transparencias en alertas
			   var altInfBg = hexToRgbA(HexAHslvar(colInf, 0, 0, 40));
			   var altInfTx = hexToRgbA(HexAHslvar(colInf, 0, 0, -20));
			   var altInfLk = hexToRgbA(HexAHslvar(colInf, 0, 0, -35));

		   var aLigHColor = HexAHslvar(colLig, 0, 0, -10);
		   var btnLigHBdc = HexAHslvar(colLig, 0, 0, -15);
		   var btnLigNotBdc = HexAHslvar(colLig, 0, 0, -20);
		   var btnLigFocBx = hexToRgbA(HexAHslvar(colLig, 0, 0, 35));
		   var btnLigFocHBx = hexToRgbA(HexAHslvar(colLig, 0, 0, 10));
			   //transparencias en alertas
			   var altLigBg = hexToRgbA(HexAHslvar(colLig, 0, 0, 40));
			   var altLigTx = hexToRgbA(HexAHslvar(colLig, 0, -40, -20));
			   var altLigLk = hexToRgbA(HexAHslvar(colLig, 0, -40, -35));

		   var aDakHColor = HexAHslvar(colDak, 0, 0, -10);
		   var btnDakHBdc = HexAHslvar(colDak, 0, 0, -15);
		   var btnDakNotBdc = HexAHslvar(colDak, 0, 0, -20);
		   var btnDakFocBx = hexToRgbA(HexAHslvar(colDak, 0, 0, 35));
		   var btnDakFocHBx = hexToRgbA(HexAHslvar(colDak, 0, 0, 10));
			   //transparencias en alertas
			   var altDakBg = hexToRgbA(HexAHslvar(colDak, 0, 0, 40));
			   var altDakTx = hexToRgbA(HexAHslvar(colDak, 0, 0, -20));
			   var altDakLk = hexToRgbA(HexAHslvar(colDak, 0, 0, -35));
			   
		   //transparencia en bordes y textos
		   var nvLigBrdTxc = hexToRgbA(colDak,.9);					
		   var nvLigNvTxc = hexToRgbA(colDak,.5);
		   var nvLigNvHTxc = hexToRgbA(colDak,.7);
		   var nvLigNvDisTxc = hexToRgbA(colDak,.3);

			   var nvDakNvTxc = hexToRgbA(colLig,.5);
			   var nvDakNvHTxc = hexToRgbA(colLig,.75);
			   var nvDakNvDisTxc = hexToRgbA(colLig,.25);
			   var nvDakTogBdc = hexToRgbA(colLig,.1);

		   // Varios fondos y bordes dependen del color del texto
			   //fondo de breadcrub
			   var thLigBgc = hexToRgbA( HexAHslvar(txColor, 0, 0, 20) , .20);
			   //borde HR
			   var hrBdtColor = hexToRgbA(txColor,.5);
			   //borde thumbnail
			   var imgthBdc = hexToRgbA(txColor,.2); //hexToRgbA(HexAHslvar(txColor, 0, 0, 10));
			   //fondo de tarjetas
			   var crdFooBgc = hexToRgbA(txColor,.03);
			   //fondo de tablas
			   var tabBgc05 = hexToRgbA(txColor,.05);
			   var tabBgc075 = hexToRgbA(txColor,.075);
			   var crdBdc = hexToRgbA(txColor,.10);
			   //bordes de inputs
			   var fmBdc = hexToRgbA(HexAHslvar(txColor, 0, 0, 5)); //55
			   var fmFocBdc = hexToRgbA(HexAHslvar(txColor, 0, 0, 7)); //75
			   var fmFocBxs = hexToRgbA(txColor,.40);

		   // nueva variable, color de fondo varios
			   var bgColor004 = hexToRgbA( HexAHslvar(bgColor, 0, 0, 20) ); //hexToRgbA(HexAHslvar(bgColor, 0, 0, -2)); //hexToRgbA(bgColor,.10); 
			   var bgColor5 = hexToRgbA(bgColor,.05);
			   var bgColor75 = hexToRgbA(bgColor,.75);


		   // });

		   /* -------------------- Variabes y valores para css -------------------- */
		   // var cssValues = {'$txColor':'#212529','$bgColor':'#ffffff','$aColor':'#007bff','$aHColor':'#007bff','$capTxColor':'#6c757d','$hrBdtColor':'rgba(0,0,0,0.1)','$markBgc':'#fcf8e3','$imgthBdc':'#dee2e6','$codtxc':'#dee2e6','$tabBgc05':'rgba(0,0,0,0.05)','$tabBgc075':'rgba(0,0,0,0.075)','$tPriBgc':'#b8daff','$tPriHBgc':'#9fcdff','$tSecBgc':'#d6d8db','$tSecHBgc':'#c8cbcf','$tSucBgc':'#c3e6cb','$tSucHBgc':'#b1dfbb','$tInfBgc':'#bee5eb','$tInfHBgc':'#abdde5','$tWarBgc':'#ffeeba','$tWarHBgc':'#ffe8a1','$tDanBgc':'#f5c6cb','$tDanHBgc':'#f1b0b7','$tLigBgc':'#fdfdfe','$tLigHBgc':'#ececf6','$tDakBgc':'#c6c8ca','$tDakHBgc':'#b9bbbe','$thDakBdc':'#32383e','$thLigTxc':'#495057','$thLigBgc':'#e9ecef','$tDakOdd':'rgba(255,255,255,0.05)','$tDakHov':'rgba(255,255,255,0.075)','$fmBdc':'#ced4da','$fmFocBdc':'#80bdff','$fmFocBxs':'rgba(0,123,255,0.25)','$valFdTxc':'#28a745','$valTtBgc':'rgba(40,167,69,0.8)','$wValFmBx':'rgba(40,167,69,0.25)','$wValInLabBgc':'#71dd8a','$wValChkInLabBgc':'#34ce57','$invFdTxc':'#dc3545','$invTtBgc':'rgba(220,53,69,0.8)','$wValInvFmBx':'rgba(220,53,69,0.25)','$wValInvInvLabBgc':'#efa2a9','$wValInvChkInLabBgc':'#e4606d','$wValChkInLabBx':'rgba(40,167,69,0.25)','$btnPriHBgc':'#0069d9','$btnPriHBdc':'#0062cc','$btnPriFocBx':'rgba(0,123,255,0.5)','$btnPriNotBdc':'#005cbf','$btnSecHBgc':'#5a6268','$btnSecHBdc':'#545b62','$btnSecFocBx':'rgba(108,117,125,0.5)','$btnSecNotBdc':'#4e555b','$btnSucHBgc':'#218838','$btnSucHBdc':'#1e7e34','$btnSucFocBx':'rgba(40,167,69,0.5)','$btnSucNotBdc':'#1c7430','$btnInfBgc':'#17a2b8','$btnInfHBgc':'#138496','$btnInfHBdc':'#117a8b','$btnInfFocBx':'rgba(23,162,184,0.5)','$btnInfNotBdc':'#10707f','$btnWarBgc':'#ffc107','$btnWarHBgc':'#e0a800','$btnWarHBdc':'#d39e00','$btnWarFocBx':'rgba(255,193,7,0.5)','$btnWarNotBdc':'#c69500','$btnDanHBgc':'#c82333','$btnDanHBdc':'#bd2130','$btnDanFocBx':'rgba(220,53,69,0.5)','$btnDanNotBdc':'#b21f2d','$btnLigBgc':'#f8f9fa','$btnLigHBgc':'#e2e6ea','$btnLigHBdc':'#dae0e5','$btnLigFocBx':'rgba(248,249,250,0.5)','$btnLigNotBdc':'#d3d9df','$btnDakBgc':'#343a40','$btnDakHBgc':'#23272b','$btnDakHBdc':'#1d2124','$btnDakFocBx':'rgba(52,58,64,0.5)','$btnDakNotBdc':'#171a1d','$ddMnBdc':'rgba(0,0,0,0.15)','$ddItHTxc':'#16181b','$cuContBgc':'#b3d7ff','$cuSelFcBx':'rgba(128,189,255,0.5)','$nvLigBrdTxc':'rgba(0,0,0,0.9)','$nvLigNvTxc':'rgba(0,0,0,0.5)','$nvLigNvHTxc':'rgba(0,0,0,0.7)','$nvLigNvDisTxc':'rgba(0,0,0,0.3)','$nvDakNvTxc':'rgba(255,255,255,0.5)','$nvDakNvHTxc':'rgba(255,255,255,0.75)','$nvDakNvDisTxc':'rgba(255,255,255,0.25)','$nvDakTogBdc':'rgba(255,255,255,0.1)','$crdBdc':'rgba(0,0,0,0.125)','$crdFooBgc':'rgba(0,0,0,0.03)','$altPriTxc':'#004085','$altPriBgc':'#cce5ff','$altPriLkBgc':'#002752','$altSecTxc':'#383d41','$altSecBgc':'#e2e3e5','$altSecLkBgc':'#202326','$altSucTxc':'#155724','$altSucBgc':'#d4edda','$altSucLkBgc':'#0b2e13','$altInfTxc':'#0c5460','$altInfBgc':'#d1ecf1','$altInfLkBgc':'#062c33','$altWarTxc':'#856404','$altWarBgc':'#fff3cd','$altWarLkBgc':'#533f03','$altDanTxc':'#721c24','$altDanBgc':'#f8d7da','$altDanLkTxc':'#491217','$altLigTxc':'#818182','$altLigBgc':'#fefefe','$altLigLkTxc':'#686868','$altDakTxc':'#1b1e21','$altDakBgc':'#d6d8d9','$altDakLkTxc':'#040505','$close':'#000000','$modContBdc':'rgba(0,0,0,0.2)','$popBsBdc':'rgba(0,0,0,0.25)','$popBtPhdBdc':'#f7f7f7','$popHdBdc':'#ebebeb','$ShLg':'rgba(0,0,0,0.175)'};
		   
		   var cssValues = {
			   '$txColor' : txColor,//'#212529',
			   '$bgColor' : bgColor,//'#ffffff',
			   '$bgColIn' : bgColor004,//'#ffffff',
			   '$aColor' : colPri,//'#007bff'
			   '$aHColor' : aHColor,//'#007bff',
//otros valores en el tema
			   '$bgFtColor' : bgFtColor,
			   '$txFtColor' : txFtColor,
			   '$aFtColor' : aFtColor,
			   '$FbColor' : FbColor,
			   '$txFbColor' : txFbColor,
			   '$aFbColor' : aFbColor,
			   '$mainColor' : mainColor,
			   '$bgNvColor' : bgNvColor,
//gris default, afecta multiples items					
			   '$capTxColor' : colSec, //'#6c757d', 
			   '$hrBdtColor' : hrBdtColor, //'rgba(0,0,0,0.1)',
			   '$markBgc' : altWarBg,//'#fcf8e3',
			   '$imgthBdc' : imgthBdc,//'#dee2e6',
			   '$codtxc' : btnDanFocHBx,//'#e83e8c',
			   '$tabBgc05' : tabBgc05,//'rgba(0,0,0,0.05)',
			   '$tabBgc075' : tabBgc075,//'rgba(0,0,0,0.075)',
//transparencias en alertas					
			   '$tPriBgc' : btnPriFocBx,//'#b8daff',
			   '$tPriHBgc' : btnPriFocHBx,//'#9fcdff',
				   '$tSecBgc' : btnSecFocBx,//'#d6d8db',
				   '$tSecHBgc' : btnSecFocHBx,//'#c8cbcf',
					   '$tSucBgc' : btnSucFocBx,//'#c3e6cb',
					   '$tSucHBgc' : btnSucFocHBx,//'#b1dfbb',
			   '$tInfBgc' : btnInfFocBx,//'#bee5eb',
			   '$tInfHBgc' : btnInfFocHBx,//'#abdde5',
				   '$tWarBgc' : btnWarFocBx,//'#ffeeba',
				   '$tWarHBgc' : btnWarFocHBx,//'#ffe8a1',
					   '$tDanBgc' : btnDanFocBx,//'#f5c6cb',
					   '$tDanHBgc' : btnDanFocHBx,//'#f1b0b7',
			   '$tLigBgc' : btnLigFocBx,//'#fdfdfe',
			   '$tLigHBgc' : btnLigFocHBx,//'#ececf6',
				   '$tDakBgc' : btnDakFocBx,//'#c6c8ca',
				   '$tDakHBgc' : btnDakFocHBx,//'#b9bbbe',
			   '$thDakBdc' : fmBdc,//'#32383e',
			   '$thLigTxc' : fmFocBxs,//'#495057',
//varios fondos y bordes, prueba 1 color de texto 
			   '$thLigBgc' : thLigBgc, //'#e9ecef',
			   '$tDakOdd' : bgColor5, //'rgba(255,255,255,0.05)',
			   '$tDakHov' : bgColor75, //'rgba(255,255,255,0.075)',
				   '$fmBdc' : fmBdc,//'#ced4da',
				   '$fmFocBdc' : fmFocBdc,//'#80bdff',
				   '$fmFocBxs' : fmFocBxs,//'rgba(0,123,255,0.25)',
//revisar las validaciones, hay ajustes en el color por hacer						
			   '$valFdTxc' : colSuc, // '#28a745',
				   '$valTtBgc' : altSucTx, //'rgba(40,167,69,0.8)',
				   '$wValFmBx' : altSucBg, //'rgba(40,167,69,0.25)',
			   '$wValInLabBgc' : colSuc, //'#71dd8a',
			   '$wValChkInLabBgc' : colSuc,//'#34ce57',
			   '$invFdTxc' : colDan, // '#dc3545',
			   '$invTtBgc' : altDanTx,//'rgba(220,53,69,0.8)',
			   '$wValInvFmBx' : altDanBg,//'rgba(220,53,69,0.25)',
			   '$wValInvInvLabBgc' : colDan,//'#efa2a9',
			   '$wValInvChkInLabBgc' : colDan,//'#e4606d',
			   '$wValChkInLabBx' : colDan,//'rgba(40,167,69,0.25)',
//variables de botones					
			   '$btnPriHBgc' : aHColor,//'#0069d9',
			   '$btnPriHBdc' : btnPriHBdc,//'#0062cc',
			   '$btnPriFocBx' : btnPriFocBx,//'rgba(0,123,255,0.5)',
			   '$btnPriNotBdc' : btnPriNotBdc,//'#005cbf',
				   '$btnSecHBgc' : aSecHColor,//'#5a6268',
				   '$btnSecHBdc' : btnSecHBdc,//'#545b62',
				   '$btnSecFocBx' : btnSecFocBx,//'rgba(108,117,125,0.5)',
				   '$btnSecNotBdc' : btnSecNotBdc,//'#4e555b',
					   '$btnSucHBgc' : aSucHColor,//'#218838',
					   '$btnSucHBdc' : btnSucHBdc,//'#1e7e34',
					   '$btnSucFocBx' : btnSucFocBx,//'rgba(40,167,69,0.5)',
					   '$btnSucNotBdc' : btnSucNotBdc,//'#1c7430',
			   '$btnInfBgc' : colInf,//'#17a2b8',
			   '$btnInfHBgc' : aInfHColor,//'#138496',
			   '$btnInfHBdc' : btnInfHBdc,//'#117a8b',
			   '$btnInfFocBx' : btnInfFocBx,//'rgba(23,162,184,0.5)',
			   '$btnInfNotBdc' : btnInfNotBdc,//'#10707f',
				   '$btnWarBgc' : colWar,//'#ffc107',
				   '$btnWarHBgc' : aWarHColor,//'#e0a800',
				   '$btnWarHBdc' : btnWarHBdc,//'#d39e00',
				   '$btnWarFocBx' : btnWarFocBx,//'rgba(255,193,7,0.5)',
				   '$btnWarNotBdc' : btnWarNotBdc,//'#c69500',
					   '$btnDanHBgc' : aDanHColor,//'#c82333',
					   '$btnDanHBdc' : btnDanHBdc,//'#bd2130',
					   '$btnDanFocBx' : btnDanFocBx,//'rgba(220,53,69,0.5)',
					   '$btnDanNotBdc' : btnDanNotBdc,//'#b21f2d',
			   '$btnLigBgc' : colLig,//'#f8f9fa',
			   '$btnLigHBgc' : aLigHColor,//'#e2e6ea',
			   '$btnLigHBdc' : btnLigHBdc,//'#dae0e5',
			   '$btnLigFocBx' : btnLigFocBx,//'rgba(248,249,250,0.5)',
			   '$btnLigNotBdc' : btnLigNotBdc,//'#d3d9df',
				   '$btnDakBgc' : colDak,//'#343a40',
				   '$btnDakHBgc' : aDakHColor,//'#23272b',
				   '$btnDakHBdc' : btnDakHBdc,//'#1d2124',
				   '$btnDakFocBx' : btnDakFocBx,//'rgba(52,58,64,0.5)',
				   '$btnDakNotBdc' : btnDakNotBdc,//'#171a1d',
			   '$ddMnBdc' : txColor,//'rgba(0,0,0,0.15)',
			   '$ddItHTxc' : txColor,//'#16181b',
			   '$cuContBgc' : txColor,//'#b3d7ff',
			   '$cuSelFcBx' : txColor,//'rgba(128,189,255,0.5)',
//textos y bordes					
			   '$nvLigBrdTxc' : nvLigBrdTxc,//'rgba(0,0,0,0.9)',
			   '$nvLigNvTxc' : nvLigNvTxc, //'rgba(0,0,0,0.5)',
			   '$nvLigNvHTxc' : nvLigNvHTxc, //'rgba(0,0,0,0.7)',
			   '$nvLigNvDisTxc' : nvLigNvDisTxc, //'rgba(0,0,0,0.3)',
				   '$nvDakNvTxc' : nvDakNvTxc, //'rgba(255,255,255,0.5)',
				   '$nvDakNvHTxc' : nvDakNvHTxc, //'rgba(255,255,255,0.75)',
				   '$nvDakNvDisTxc' : nvDakNvDisTxc, //'rgba(255,255,255,0.25)',
				   '$nvDakTogBdc' : nvDakTogBdc, //'rgba(255,255,255,0.1)',					
			   '$crdBdc' : crdBdc,//'rgba(0,0,0,0.125)',
			   '$crdFooBgc' : crdFooBgc, //'rgba(0,0,0,0.03)',
//transparencias en alertas
			   '$altPriTxc' : altPriTx,//'#004085',
			   '$altPriBgc' : altPriBg,//'#cce5ff',
			   '$altPriLkBgc' : altPriLk,//'#002752',
				   '$altSecTxc' : altSecTx,//'#383d41',
				   '$altSecBgc' : altSecBg,//'#e2e3e5',
				   '$altSecLkBgc' : altSecLk,//'#202326',
					   '$altSucTxc' : altSucTx,//'#155724',
					   '$altSucBgc' : altSucBg,//'#d4edda',
					   '$altSucLkBgc' : altSucLk,//'#0b2e13',
			   '$altInfTxc' : altInfTx,//'#0c5460',
			   '$altInfBgc' : altInfBg,//'#d1ecf1',
			   '$altInfLkBgc' : altInfLk,//'#062c33',
				   '$altWarTxc' : altWarTx,//'#856404',
				   '$altWarBgc' : altWarBg,//'#fff3cd',
				   '$altWarLkBgc' : altWarLk,//'#533f03',
					   '$altDanTxc' : altDanTx,//'#721c24',
					   '$altDanBgc' : altDanBg,//'#f8d7da',
					   '$altDanLkTxc' : altDanLk,//'#491217',
			   '$altLigTxc' : altLigTx,//'#818182',
			   '$altLigBgc' : altLigBg,//'#fefefe',
			   '$altLigLkTxc' : altLigLk,//'#686868',
				   '$altDakTxc' : altDakTx,//'#1b1e21',
				   '$altDakBgc' : altDakBg,//'#d6d8d9',
				   '$altDakLkTxc' : altDakLk,//'#040505',
			   '$close' : colDak,//'#000000',
			   '$modContBdc' : imgthBdc,//'rgba(0,0,0,0.2)',
			   '$popBsBdc' : imgthBdc,//'rgba(0,0,0,0.25)',
			   '$popBtPhdBdc' : imgthBdc,//'#f7f7f7',
			   '$popHdBdc' : imgthBdc,//'#ebebeb',
			   '$ShLg' : colDak,//'rgba(0,0,0,0.175)'
		   };

		   // esto es el css duro, el cual recibe los colores modificados.
		   // descartar lineas: $btnSecFocBx
		   function cssOrders() {

			   var cssall = '';

			   /**General**/
			   cssall += 'body{color:' + $txColor + ';background-color:' + $bgColor + ';}\n';
		   cssall += 'a{color:' + $aColor + ';}\n';
		   cssall += 'a:hover{color:' + $aHColor + ';}\n';
		   cssall += 'caption{color:' + $capTxColor + ';}\n';
			   cssall += 'hr{border-top-color:' + $hrBdtColor + ';}\n';
			   cssall += 'mark,.mark{background-color:' + $markBgc + ';}\n';
		   cssall += '.blockquote-footer{color:' + $capTxColor + ';}\n';
			   cssall += '.img-thumbnail{background-color:' + $bgColIn + ';border-color:' + $imgthBdc + ';}\n';
		   cssall += '.figure-caption{color:' + $capTxColor + ';}\n';
			   cssall += 'code{color:' + $codtxc + ';}\n';
			   cssall += 'kbd{color:' + $bgColor + ';background-color:' + $txColor + ';}\n';
			   cssall += 'pre{color:' + $txColor + ';}\n';
			   // otros elementos

		   cssall += '.site-footer{color:' + $txFtColor + ';}\n';
		   if ( $aFtColor !== '#007bffFF' ){
			   cssall += '.site-footer a{color:' + $aFtColor + ';}\n';
		   }
		   if ( $bgFtColor !== '#353b41FF' ){
			   cssall += '.site-footer.bg-dark{background-color:' + $bgFtColor + ' !important;}\n';
		   }
		   // footer-bar
		   cssall += '.footer-bar{color:' + $txFbColor + ';}\n';
		   if ( $aFbColor !== '#007bffFF' ){
			   cssall += '.footer-bar a{color:' + $aFbColor + ';}\n';
		   }				
		   if ( $FbColor !== '#6d767eFF' ){
			   cssall += '.footer-bar.bg-secondary{background-color:' + $FbColor + ' !important;}\n';
		   }

		   // el menu	
		   if ( $bgNvColor !== '#353b41FF' ){
			   cssall += '.primary-navbar.bg-light,.primary-navbar.bg-dark, .offcanvas.bg-light, .offcanvas.bg-dark{background-color:' + $bgNvColor + ' !important;}\n';
		   }
		   if ( $mainColor !== '#f9fafbFF' ){
			   cssall += '.bg-main{background-color:' + $mainColor + ' !important;}\n';
		   }

			   /**tablas**/
			   cssall += '.table th,.table td{border-top-color:' + $imgthBdc + ';}\n';
			   cssall += '.table thead th{border-bottom-color:' + $imgthBdc + ';}\n';
			   cssall += '.table tbody + tbody{border-top-color:' + $imgthBdc + ';}\n';
			   cssall += '.table .table{background-color:' + $bgColor + ';}\n';
			   cssall += '.table-bordered{border-color:' + $imgthBdc + ';}\n';
			   cssall += '.table-bordered th,.table-bordered td{border-color:' + $imgthBdc + ';}\n';
			   cssall += '.table-striped tbody tr:nth-of-type(odd){background-color:' + $tabBgc05 + ';}\n';
			   cssall += '.table-hover tbody tr:hover{background-color:' + $tabBgc075 + ';}\n';
		   cssall += '.table-primary,.table-primary > th,.table-primary > td{background-color:' + $tPriBgc + ';}\n';
		   cssall += '.table-hover .table-primary:hover{background-color:' + $tPriHBgc + ';}\n';
		   cssall += '.table-hover .table-primary:hover > td,.table-hover .table-primary:hover > th{background-color:' + $tPriHBgc + ';}\n';
		   cssall += '.table-secondary,.table-secondary > th,.table-secondary > td{background-color:' + $tSecBgc + ';}\n';
		   cssall += '.table-hover .table-secondary:hover{background-color:' + $tSecHBgc + ';}\n';
		   cssall += '.table-hover .table-secondary:hover > td,.table-hover .table-secondary:hover > th{background-color:' + $tSecHBgc + ';}\n';
		   cssall += '.table-success,.table-success > th,.table-success > td{background-color:' + $tSucBgc + ';}\n';
		   cssall += '.table-hover .table-success:hover{background-color:' + $tSucHBgc + ';}\n';
		   cssall += '.table-hover .table-success:hover > td,.table-hover .table-success:hover > th{background-color:' + $tSucHBgc + ';}\n';
		   cssall += '.table-info,.table-info > th,.table-info > td{background-color:' + $tInfBgc + ';}\n';
		   cssall += '.table-hover .table-info:hover{background-color:' + $tInfHBgc + ';}\n';
		   cssall += '.table-hover .table-info:hover > td,.table-hover .table-info:hover > th{background-color:' + $tInfHBgc + ';}\n';
		   cssall += '.table-warning,.table-warning > th,.table-warning > td{background-color:' + $tWarBgc + ';}\n';
		   cssall += '.table-hover .table-warning:hover{background-color:' + $tWarHBgc + ';}\n';
		   cssall += '.table-hover .table-warning:hover > td,.table-hover .table-warning:hover > th{background-color:' + $tWarHBgc + ';}\n';
		   cssall += '.table-danger,.table-danger > th,.table-danger > td{background-color:' + $tDanBgc + ';}\n';
		   cssall += '.table-hover .table-danger:hover{background-color:' + $tDanHBgc + ';}\n';
		   cssall += '.table-hover .table-danger:hover > td,.table-hover .table-danger:hover > th{background-color:' + $tDanHBgc + ';}\n';
		   cssall += '.table-light,.table-light > th,.table-light > td{background-color:' + $tLigBgc + ';}\n';
		   cssall += '.table-hover .table-light:hover{background-color:' + $tLigHBgc + ';}\n';
		   cssall += '.table-hover .table-light:hover > td,.table-hover .table-light:hover > th{background-color:' + $tLigHBgc + ';}\n';
		   cssall += '.table-dark,.table-dark > th,.table-dark > td{background-color:' + $tDakBgc + ';}\n';
		   cssall += '.table-hover .table-dark:hover{background-color:' + $tDakHBgc + ';}\n';
		   cssall += '.table-hover .table-dark:hover > td,.table-hover .table-dark:hover > th{background-color:' + $tDakHBgc + ';}\n';
			   cssall += '.table-active,.table-active > th,.table-active > td{background-color:' + $tabBgc075 + ';}\n';
			   cssall += '.table-hover .table-active:hover{background-color:' + $tabBgc075 + ';}\n';
			   cssall += '.table-hover .table-active:hover > td,.table-hover .table-active:hover > th{background-color:' + $tabBgc075 + ';}\n';
			   cssall += '.table .thead-dark th{color:' + $bgColor + ';background-color:' + $txColor + ';border-color:' + $thDakBdc + ';}\n';
			   cssall += '.table .thead-light th{color:' + $thLigTxc + ';background-color:' + $thLigBgc + ';border-color:' + $imgthBdc + ';}\n';
			   cssall += '.table-dark{color:' + $bgColor + ';background-color:' + $txColor + ';}\n';
			   cssall += '.table-dark th,.table-dark td,.table-dark thead th{border-color:' + $thDakBdc + ';}\n';
			   cssall += '.table-dark.table-striped tbody tr:nth-of-type(odd){background-color:' + $tDakOdd + ';}\n';
			   cssall += '.table-dark.table-hover tbody tr:hover{background-color:' + $tDakHov + ';}\n';

			   /**Formularios**/
			   cssall += '.form-control{color:' + $fmBdc + ';background-color:' + $bgColIn + ';border-color:' + $fmBdc + ';}\n';
			   cssall += '.form-control:focus{color:' + $thLigTxc + ';background-color:' + $bgColor + ';border-color:' + $fmFocBdc + ';box-shadow:0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
		   cssall += '.form-control::-webkit-input-placeholder{color:' + $capTxColor + ';}\n';
		   cssall += '.form-control::-moz-placeholder{color:' + $capTxColor + ';}\n';
		   cssall += '.form-control:-ms-input-placeholder{color:' + $capTxColor + ';}\n';
		   cssall += '.form-control::-ms-input-placeholder{color:' + $capTxColor + ';}\n';
		   cssall += '.form-control::placeholder{color:' + $capTxColor + ';}\n';
			   cssall += '.form-control:disabled,.form-control[readonly]{background-color:' + $thLigBgc + ';}\n';

			   cssall += 'select.form-control:focus::-ms-value{color:' + $thLigTxc + ';background-color:' + $bgColor + ';}\n';
			   cssall += '.form-control-plaintext{color:' + $txColor + ';}\n';
			   cssall += '.form-check-input:disabled ~';
		   cssall += '.form-check-label{color:' + $capTxColor + ';}\n';
			   cssall += '.valid-feedback{color:' + $valFdTxc + ';}\n';
			   cssall += '.valid-tooltip{color:' + $bgColor + ';background-color:' + $valTtBgc + ';}\n';
			   cssall += '.was-validated .form-control:valid,.form-control.is-valid,.was-validated';
			   cssall += '.custom-select:valid,.custom-select.is-valid{border-color:' + $valFdTxc + ';}\n';
			   cssall += '.was-validated .form-control:valid:focus,.form-control.is-valid:focus,.was-validated';
			   cssall += '.custom-select:valid:focus,.custom-select.is-valid:focus{border-color:' + $valFdTxc + ';box-shadow:0 0 0 0.2rem ' + $wValFmBx + ';}\n';

			   cssall += '.was-validated .form-check-input:valid ~ .form-check-label,.form-check-input.is-valid ~';
			   cssall += '.form-check-label{color:' + $valFdTxc + ';}\n';
			   cssall += '.was-validated .custom-control-input:valid ~ .custom-control-label,.custom-control-input.is-valid ~';
			   cssall += '.custom-control-label{color:' + $valFdTxc + ';}\n';
			   cssall += '.was-validated .custom-control-input:valid ~ .custom-control-label::before,.custom-control-input.is-valid ~';
			   cssall += '.custom-control-label::before{background-color:' + $wValInLabBgc + ';}\n';
			   cssall += '.was-validated .custom-control-input:valid:checked ~ .custom-control-label::before,.custom-control-input.is-valid:checked ~';
			   cssall += '.custom-control-label::before{background-color:' + $wValChkInLabBgc + ';}\n';
			   cssall += '.was-validated .custom-control-input:valid:focus ~ .custom-control-label::before,.custom-control-input.is-valid:focus ~';
			   cssall += '.custom-control-label::before{box-shadow:0 0 0 1px ' + $bgColor + ',0 0 0 0.2rem ' + $wValChkInLabBx + ';}\n';
			   cssall += '.was-validated .custom-file-input:valid ~ .custom-file-label,.custom-file-input.is-valid ~';
			   cssall += '.custom-file-label{border-color:' + $valFdTxc + ';}\n';
			   cssall += '.was-validated .custom-file-input:valid:focus ~ .custom-file-label,.custom-file-input.is-valid:focus ~';
			   cssall += '.custom-file-label{box-shadow:0 0 0 0.2rem ' + $wValChkInLabBx + ';}\n';

			   cssall += '.invalid-feedback{color:' + $invFdTxc + ';}\n';
			   cssall += '.invalid-tooltip{color:' + $bgColor + ';background-color:' + $invTtBgc + ';}\n';
			   cssall += '.was-validated .form-control:invalid,.form-control.is-invalid,.was-validated';
			   cssall += '.custom-select:invalid,.custom-select.is-invalid{border-color:' + $invFdTxc + ';}\n';
			   cssall += '.was-validated .form-control:invalid:focus,.form-control.is-invalid:focus,.was-validated';
			   cssall += '.custom-select:invalid:focus,.custom-select.is-invalid:focus{border-color:' + $invFdTxc + ';box-shadow:0 0 0 0.2rem ' + $wValInvFmBx + ';}\n';
			   cssall += '.was-validated .form-check-input:invalid ~ .form-check-label,.form-check-input.is-invalid ~';
			   cssall += '.form-check-label{color:' + $invFdTxc + ';}\n';
			   cssall += '.was-validated .custom-control-input:invalid ~ .custom-control-label,.custom-control-input.is-invalid ~';
			   cssall += '.custom-control-label{color:' + $invFdTxc + ';}\n';
			   cssall += '.was-validated .custom-control-input:invalid ~ .custom-control-label::before,.custom-control-input.is-invalid ~';
			   cssall += '.custom-control-label::before{background-color:' + $wValInvInvLabBgc + ';}\n';
			   cssall += '.was-validated .custom-control-input:invalid:checked ~ .custom-control-label::before,.custom-control-input.is-invalid:checked ~';
			   cssall += '.custom-control-label::before{background-color:' + $wValInvChkInLabBgc + ';}\n';
			   cssall += '.was-validated .custom-control-input:invalid:focus ~ .custom-control-label::before,.custom-control-input.is-invalid:focus ~';
			   cssall += '.custom-control-label::before{box-shadow:0 0 0 1px ' + $bgColor + ',0 0 0 0.2rem ' + $wValInvFmBx + ';}\n';
			   cssall += '.was-validated .custom-file-input:invalid ~ .custom-file-label,.custom-file-input.is-invalid ~';
			   cssall += '.custom-file-label{border-color:' + $invFdTxc + ';}\n';
			   cssall += '.was-validated .custom-file-input:invalid:focus ~ .custom-file-label,.custom-file-input.is-invalid:focus ~';
			   cssall += '.custom-file-label{box-shadow:0 0 0 0.2rem ' + $wValInvFmBx + ';}\n';

			   /**Botones**/
			   cssall += '.btn:focus,.btn.focus{box-shadow:0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
//				cssall += '.btn-primary{color:' + $bgColor + ';background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
		   cssall += '.btn-primary{background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
//				cssall += '.btn-primary:hover{color:' + $bgColor + ';background-color:' + $btnPriHBgc + ';border-color:' + $btnPriHBdc + ';}\n';
		   cssall += '.btn-primary:hover{background-color:' + $btnPriHBgc + ';border-color:' + $btnPriHBdc + ';}\n';
		   cssall += '.btn-primary:focus,.btn-primary.focus{box-shadow:0 0 0 0.2rem ' + $btnPriFocBx + ';}\n';
//				cssall += '.btn-primary.disabled,.btn-primary:disabled{color:' + $bgColor + ';background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
		   cssall += '.btn-primary.disabled,.btn-primary:disabled{background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
			   cssall += '.btn-primary:not(:disabled):not(.disabled):active,.btn-primary:not(:disabled)';
//				cssall += ':not(.disabled).active,.show > .btn-primary.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnPriHBdc + ';border-color:' + $btnPriNotBdc + ';}\n';
		   cssall += ':not(.disabled).active,.show > .btn-primary.dropdown-toggle{background-color:' + $btnPriHBdc + ';border-color:' + $btnPriNotBdc + ';}\n';
			   cssall += '.btn-primary:not(:disabled):not(.disabled):active:focus,.btn-primary:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-primary.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnPriFocBx + ';}\n';

//				cssall += '.btn-secondary{color:' + $bgColor + ';background-color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
		   cssall += '.btn-secondary{background-color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
//				cssall += '.btn-secondary:hover{color:' + $bgColor + ';background-color:' + $btnSecHBgc + ';border-color:' + $btnSecHBdc + ';}\n';
		   cssall += '.btn-secondary:hover{background-color:' + $btnSecHBgc + ';border-color:' + $btnSecHBdc + ';}\n';
		   cssall += '.btn-secondary:focus,.btn-secondary.focus{box-shadow:0 0 0 0.2rem ' + $btnSecFocBx + ';}\n';
//				cssall += '.btn-secondary.disabled,.btn-secondary:disabled{color:' + $bgColor + ';background-color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
		   cssall += '.btn-secondary.disabled,.btn-secondary:disabled{background-color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
			   cssall += '.btn-secondary:not(:disabled):not(.disabled):active,.btn-secondary:not(:disabled)';
//				cssall += ':not(.disabled).active,.show > .btn-secondary.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnSecHBdc + ';border-color:' + $btnSecNotBdc + ';}\n';
		   cssall += ':not(.disabled).active,.show > .btn-secondary.dropdown-toggle{background-color:' + $btnSecHBdc + ';border-color:' + $btnSecNotBdc + ';}\n';
			   cssall += '.btn-secondary:not(:disabled):not(.disabled):active:focus,.btn-secondary:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-secondary.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnSecFocBx + ';}\n';

//					cssall += '.btn-success{color:' + $bgColor + ';background-color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
			   cssall += '.btn-success{background-color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
//				cssall += '.btn-success:hover{color:' + $bgColor + ';background-color:' + $btnSucHBgc + ';border-color:' + $btnSucHBdc + ';}\n';
		   cssall += '.btn-success:hover{background-color:' + $btnSucHBgc + ';border-color:' + $btnSucHBdc + ';}\n';
		   cssall += '.btn-success:focus,.btn-success.focus{box-shadow:0 0 0 0.2rem ' + $btnSucFocBx + ';}\n';
//					cssall += '.btn-success.disabled,.btn-success:disabled{color:' + $bgColor + ';background-color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
			   cssall += '.btn-success.disabled,.btn-success:disabled{background-color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
			   cssall += '.btn-success:not(:disabled):not(.disabled):active,.btn-success:not(:disabled)';
//				cssall += ':not(.disabled).active,.show > .btn-success.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnSucHBdc + ';border-color:' + $btnSucNotBdc + ';}\n';
		   cssall += ':not(.disabled).active,.show > .btn-success.dropdown-toggle{background-color:' + $btnSucHBdc + ';border-color:' + $btnSucNotBdc + ';}\n';
			   cssall += '.btn-success:not(:disabled):not(.disabled):active:focus,.btn-success:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-success.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnSucFocBx + ';}\n';

//				cssall += '.btn-info{color:' + $bgColor + ';background-color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
		   cssall += '.btn-info{background-color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
//				cssall += '.btn-info:hover{color:' + $bgColor + ';background-color:' + $btnInfHBgc + ';border-color:' + $btnInfHBdc + ';}\n';
		   cssall += '.btn-info:hover{background-color:' + $btnInfHBgc + ';border-color:' + $btnInfHBdc + ';}\n';
		   cssall += '.btn-info:focus,.btn-info.focus{box-shadow:0 0 0 0.2rem ' + $btnInfFocBx + ';}\n';
//				cssall += '.btn-info.disabled,.btn-info:disabled{color:' + $bgColor + ';background-color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
		   cssall += '.btn-info.disabled,.btn-info:disabled{background-color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
			   cssall += '.btn-info:not(:disabled):not(.disabled):active,.btn-info:not(:disabled)';
//				cssall += ':not(.disabled).active,.show > .btn-info.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnInfHBdc + ';border-color:' + $btnInfNotBdc + ';}\n';
		   cssall += ':not(.disabled).active,.show > .btn-info.dropdown-toggle{background-color:' + $btnInfHBdc + ';border-color:' + $btnInfNotBdc + ';}\n';
			   cssall += '.btn-info:not(:disabled):not(.disabled):active:focus,.btn-info:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-info.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnInfFocBx + ';}\n';

//				cssall += '.btn-warning{color:' + $txColor + ';background-color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
		   cssall += '.btn-warning{background-color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
//				cssall += '.btn-warning:hover{color:' + $txColor + ';background-color:' + $btnWarHBgc + ';border-color:' + $btnWarHBdc + ';}\n';
		   cssall += '.btn-warning:hover{background-color:' + $btnWarHBgc + ';border-color:' + $btnWarHBdc + ';}\n';
		   cssall += '.btn-warning:focus,.btn-warning.focus{box-shadow:0 0 0 0.2rem ' + $btnWarFocBx + ';}\n';
//				cssall += '.btn-warning.disabled,.btn-warning:disabled{color:' + $txColor + ';background-color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
		   cssall += '.btn-warning.disabled,.btn-warning:disabled{background-color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
			   cssall += '.btn-warning:not(:disabled):not(.disabled):active,.btn-warning:not(:disabled)';
//				cssall += ':not(.disabled).active,.show > .btn-warning.dropdown-toggle{color:' + $txColor + ';background-color:' + $btnWarHBdc + ';border-color:' + $btnWarNotBdc + ';}\n';
		   cssall += ':not(.disabled).active,.show > .btn-warning.dropdown-toggle{background-color:' + $btnWarHBdc + ';border-color:' + $btnWarNotBdc + ';}\n';
			   cssall += '.btn-warning:not(:disabled):not(.disabled):active:focus,.btn-warning:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-warning.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnWarFocBx + ';}\n';

//					cssall += '.btn-danger{color:' + $bgColor + ';background-color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
			   cssall += '.btn-danger{background-color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
//				cssall += '.btn-danger:hover{color:' + $bgColor + ';background-color:' + $btnDanHBgc + ';border-color:' + $btnDanHBdc + ';}\n';
		   cssall += '.btn-danger:hover{background-color:' + $btnDanHBgc + ';border-color:' + $btnDanHBdc + ';}\n';
		   cssall += '.btn-danger:focus,.btn-danger.focus{box-shadow:0 0 0 0.2rem ' + $btnDanFocBx + ';}\n';
//					cssall += '.btn-danger.disabled,.btn-danger:disabled{color:' + $bgColor + ';background-color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
			   cssall += '.btn-danger.disabled,.btn-danger:disabled{background-color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
			   cssall += '.btn-danger:not(:disabled):not(.disabled):active,.btn-danger:not(:disabled)';
//				cssall += ':not(.disabled).active,.show > .btn-danger.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnDanHBdc + ';border-color:' + $btnDanNotBdc + ';}\n';
		   cssall += ':not(.disabled).active,.show > .btn-danger.dropdown-toggle{background-color:' + $btnDanHBdc + ';border-color:' + $btnDanNotBdc + ';}\n';
			   cssall += '.btn-danger:not(:disabled):not(.disabled):active:focus,.btn-danger:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-danger.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnDanFocBx + ';}\n';

//					cssall += '.btn-light{color:' + $txColor + ';background-color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-light{background-color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
//					cssall += '.btn-light:hover{color:' + $txColor + ';background-color:' + $btnLigHBgc + ';border-color:' + $btnLigHBdc + ';}\n';
			   cssall += '.btn-light:hover{background-color:' + $btnLigHBgc + ';border-color:' + $btnLigHBdc + ';}\n';
			   cssall += '.btn-light:focus,.btn-light.focus{box-shadow:0 0 0 0.2rem ' + $btnLigFocBx + ';}\n';
//					cssall += '.btn-light.disabled,.btn-light:disabled{color:' + $txColor + ';background-color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-light.disabled,.btn-light:disabled{background-color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-light:not(:disabled):not(.disabled):active,.btn-light:not(:disabled)';
//					cssall += ':not(.disabled).active,.show > .btn-light.dropdown-toggle{color:' + $txColor + ';background-color:' + $btnLigHBdc + ';border-color:' + $btnLigNotBdc + ';}\n';
			   cssall += ':not(.disabled).active,.show > .btn-light.dropdown-toggle{background-color:' + $btnLigHBdc + ';border-color:' + $btnLigNotBdc + ';}\n';
			   cssall += '.btn-light:not(:disabled):not(.disabled):active:focus,.btn-light:not(:disabled)';
			   cssall += ':not(.disabled).active:focus,.show > .btn-light.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnLigFocBx + ';}\n';

//					cssall += '.btn-dark{color:' + $bgColor + ';background-color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-dark{background-color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
//					cssall += '.btn-dark:hover{color:' + $bgColor + ';background-color:' + $btnDakHBgc + ';border-color:' + $btnDakHBdc + ';}\n';
			   cssall += '.btn-dark:hover{background-color:' + $btnDakHBgc + ';border-color:' + $btnDakHBdc + ';}\n';
			   cssall += '.btn-dark:focus,.btn-dark.focus{box-shadow:0 0 0 0.2rem ' + $btnDakFocBx + ';}\n';
//					cssall += '.btn-dark.disabled,.btn-dark:disabled{color:' + $bgColor + ';background-color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-dark.disabled,.btn-dark:disabled{background-color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-dark:not(:disabled):not(.disabled):active,.btn-dark:not(:disabled)';
//					cssall += ':not(.disabled).active,.show > .btn-dark.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnDakHBdc + ';border-color:' + $btnDakNotBdc + ';}\n';
			   cssall += ':not(.disabled).active,.show > .btn-dark.dropdown-toggle{background-color:' + $btnDakHBdc + ';border-color:' + $btnDakNotBdc + ';}\n';
			   cssall += '.btn-dark:not(:disabled):not(.disabled):active:focus,.btn-dark:not(:disabled)';
			   cssall += ':not(.disabled).active:focus,.show > .btn-dark.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnDakFocBx + ';}\n';

		   cssall += '.btn-outline-primary{color:' + $aColor + ';border-color:' + $aColor + ';}\n';
		   cssall += '.btn-outline-primary:hover{color:' + $bgColor + ';background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
		   cssall += '.btn-outline-primary:focus,.btn-outline-primary.focus{box-shadow:0 0 0 0.2rem ' + $btnPriFocBx + ';}\n';
		   cssall += '.btn-outline-primary.disabled,.btn-outline-primary:disabled{color:' + $aColor + ';}\n';
			   cssall += '.btn-outline-primary:not(:disabled):not(.disabled):active,.btn-outline-primary:not(:disabled)';
		   cssall += ':not(.disabled).active,.show > .btn-outline-primary.dropdown-toggle{color:' + $bgColor + ';background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
			   cssall += '.btn-outline-primary:not(:disabled):not(.disabled):active:focus,.btn-outline-primary:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-outline-primary.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnPriFocBx + ';}\n';

		   cssall += '.btn-outline-secondary{color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
		   cssall += '.btn-outline-secondary:hover{color:' + $bgColor + ';background-color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
		   cssall += '.btn-outline-secondary:focus,.btn-outline-secondary.focus{box-shadow:0 0 0 0.2rem ' + $btnSecFocBx + ';}\n';
		   cssall += '.btn-outline-secondary.disabled,.btn-outline-secondary:disabled{color:' + $capTxColor + ';}\n';
			   cssall += '.btn-outline-secondary:not(:disabled):not(.disabled):active,.btn-outline-secondary:not(:disabled)';
		   cssall += ':not(.disabled).active,.show > .btn-outline-secondary.dropdown-toggle{color:' + $bgColor + ';background-color:' + $capTxColor + ';border-color:' + $capTxColor + ';}\n';
			   cssall += '.btn-outline-secondary:not(:disabled):not(.disabled):active:focus,.btn-outline-secondary:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-outline-secondary.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnSecFocBx + ';}\n';

			   cssall += '.btn-outline-success{color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
			   cssall += '.btn-outline-success:hover{color:' + $bgColor + ';background-color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
		   cssall += '.btn-outline-success:focus,.btn-outline-success.focus{box-shadow:0 0 0 0.2rem ' + $btnSucFocBx + ';}\n';
			   cssall += '.btn-outline-success.disabled,.btn-outline-success:disabled{color:' + $valFdTxc + ';}\n';
			   cssall += '.btn-outline-success:not(:disabled):not(.disabled):active,.btn-outline-success:not(:disabled)';
			   cssall += ':not(.disabled).active,.show > .btn-outline-success.dropdown-toggle{color:' + $bgColor + ';background-color:' + $valFdTxc + ';border-color:' + $valFdTxc + ';}\n';
			   cssall += '.btn-outline-success:not(:disabled):not(.disabled):active:focus,.btn-outline-success:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-outline-success.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnSucFocBx + ';}\n';

		   cssall += '.btn-outline-info{color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
		   cssall += '.btn-outline-info:hover{color:' + $bgColor + ';background-color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
		   cssall += '.btn-outline-info:focus,.btn-outline-info.focus{box-shadow:0 0 0 0.2rem ' + $btnInfFocBx + ';}\n';
		   cssall += '.btn-outline-info.disabled,.btn-outline-info:disabled{color:' + $btnInfBgc + ';}\n';
			   cssall += '.btn-outline-info:not(:disabled):not(.disabled):active,.btn-outline-info:not(:disabled)';
		   cssall += ':not(.disabled).active,.show > .btn-outline-info.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnInfBgc + ';border-color:' + $btnInfBgc + ';}\n';
			   cssall += '.btn-outline-info:not(:disabled):not(.disabled):active:focus,.btn-outline-info:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-outline-info.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnInfFocBx + ';}\n';

		   cssall += '.btn-outline-warning{color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
		   cssall += '.btn-outline-warning:hover{color:' + $txColor + ';background-color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
		   cssall += '.btn-outline-warning:focus,.btn-outline-warning.focus{box-shadow:0 0 0 0.2rem ' + $btnWarFocBx + ';}\n';
		   cssall += '.btn-outline-warning.disabled,.btn-outline-warning:disabled{color:' + $btnWarBgc + ';}\n';
			   cssall += '.btn-outline-warning:not(:disabled):not(.disabled):active,.btn-outline-warning:not(:disabled)';
		   cssall += ':not(.disabled).active,.show > .btn-outline-warning.dropdown-toggle{color:' + $txColor + ';background-color:' + $btnWarBgc + ';border-color:' + $btnWarBgc + ';}\n';
			   cssall += '.btn-outline-warning:not(:disabled):not(.disabled):active:focus,.btn-outline-warning:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-outline-warning.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnWarFocBx + ';}\n';

			   cssall += '.btn-outline-danger{color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
			   cssall += '.btn-outline-danger:hover{color:' + $bgColor + ';background-color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
		   cssall += '.btn-outline-danger:focus,.btn-outline-danger.focus{box-shadow:0 0 0 0.2rem ' + $btnDanFocBx + ';}\n';
			   cssall += '.btn-outline-danger.disabled,.btn-outline-danger:disabled{color:' + $invFdTxc + ';}\n';
			   cssall += '.btn-outline-danger:not(:disabled):not(.disabled):active,.btn-outline-danger:not(:disabled)';
			   cssall += ':not(.disabled).active,.show > .btn-outline-danger.dropdown-toggle{color:' + $bgColor + ';background-color:' + $invFdTxc + ';border-color:' + $invFdTxc + ';}\n';
			   cssall += '.btn-outline-danger:not(:disabled):not(.disabled):active:focus,.btn-outline-danger:not(:disabled)';
		   cssall += ':not(.disabled).active:focus,.show > .btn-outline-danger.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnDanFocBx + ';}\n';

			   cssall += '.btn-outline-light{color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-outline-light:hover{color:' + $txColor + ';background-color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-outline-light:focus,.btn-outline-light.focus{box-shadow:0 0 0 0.2rem ' + $btnLigFocBx + ';}\n';
			   cssall += '.btn-outline-light.disabled,.btn-outline-light:disabled{color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-outline-light:not(:disabled):not(.disabled):active,.btn-outline-light:not(:disabled)';
			   cssall += ':not(.disabled).active,.show > .btn-outline-light.dropdown-toggle{color:' + $txColor + ';background-color:' + $btnLigBgc + ';border-color:' + $btnLigBgc + ';}\n';
			   cssall += '.btn-outline-light:not(:disabled):not(.disabled):active:focus,.btn-outline-light:not(:disabled)';
			   cssall += ':not(.disabled).active:focus,.show > .btn-outline-light.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnLigFocBx + ';}\n';

			   cssall += '.btn-outline-dark{color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-outline-dark:hover{color:' + $bgColor + ';background-color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-outline-dark:focus,.btn-outline-dark.focus{box-shadow:0 0 0 0.2rem ' + $btnDakFocBx + ';}\n';
			   cssall += '.btn-outline-dark.disabled,.btn-outline-dark:disabled{color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-outline-dark:not(:disabled):not(.disabled):active,.btn-outline-dark:not(:disabled)';
			   cssall += ':not(.disabled).active,.show > .btn-outline-dark.dropdown-toggle{color:' + $bgColor + ';background-color:' + $btnDakBgc + ';border-color:' + $btnDakBgc + ';}\n';
			   cssall += '.btn-outline-dark:not(:disabled):not(.disabled):active:focus,.btn-outline-dark:not(:disabled)';
			   cssall += ':not(.disabled).active:focus,.show > .btn-outline-dark.dropdown-toggle:focus{box-shadow:0 0 0 0.2rem ' + $btnDakFocBx + ';}\n';

		   cssall += '.btn-link{color:' + $aColor + ';}\n';
		   cssall += '.btn-link:hover{color:' + $aHColor + ';}\n';
		   cssall += '.btn-link:disabled,.btn-link.disabled{color:' + $capTxColor + ';}\n';

			   /**Dropdowns**/
			   cssall += '.dropdown-menu{color:' + $txColor + ';background-color:' + $bgColor + ';border-color:' + $thLigBgc + ';}\n';
			   cssall += '.dropdown-divider{border-top-color:' + $thLigBgc + ';}\n';
			   cssall += '.dropdown-item{color:' + $txColor + '!important;}\n';
			   cssall += '.dropdown-item:hover,.dropdown-item:focus{color:' + $ddItHTxc + ';background-color:' + $btnLigBgc + ';}\n';
		   cssall += '.dropdown-item.active,.dropdown-item:active{color:' + $bgColor + ';background-color:' + $aColor + ';}\n';
		   cssall += '.dropdown-item.disabled,.dropdown-item:disabled{color:' + $capTxColor + ';}\n';
			   cssall += '.dropdown-item-text{color:' + $txColor + ';}\n';

			   /**Buttongroup**/
			   cssall += '.input-group-text{color:' + $thLigTxc + ';background-color:' + $thLigBgc + ';border-color:' + $fmBdc + ';}\n';
			   cssall += '.custom-control-input:checked ~';
		   cssall += '.custom-control-label::before{color:' + $bgColor + ';background-color:' + $aColor + ';}\n';
			   cssall += '.custom-control-input:focus ~';
			   cssall += '.custom-control-label::before{box-shadow:0 0 0 1px ' + $bgColor + ',0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
			   cssall += '.custom-control-input:active ~';
			   cssall += '.custom-control-label::before{color:' + $bgColor + ';background-color:' + $cuContBgc + ';}\n';
			   cssall += '.custom-control-input:disabled ~';
		   cssall += '.custom-control-label{color:' + $capTxColor + ';}\n';
			   cssall += '.custom-control-input:disabled ~';
			   cssall += '.custom-control-label::before{background-color:' + $thLigBgc + ';}\n';
			   cssall += '.custom-control-label::before{background-color:' + $imgthBdc + ';}\n';

			   cssall += '.custom-checkbox .custom-control-input:checked ~';
		   cssall += '.custom-control-label::before{background-color:' + $aColor + ';}\n';
			   cssall += '.custom-checkbox .custom-control-input:indeterminate ~';
		   cssall += '.custom-control-label::before{background-color:' + $aColor + ';}\n';
			   cssall += '.custom-checkbox .custom-control-input:disabled:checked ~';
		   cssall += '.custom-control-label::before{background-color:' + $btnPriFocBx + ';}\n';
			   cssall += '.custom-checkbox .custom-control-input:disabled:indeterminate ~';
		   cssall += '.custom-control-label::before{background-color:' + $btnPriFocBx + ';}\n';

			   cssall += '.custom-radio .custom-control-input:checked ~';
		   cssall += '.custom-control-label::before{background-color:' + $aColor + ';}\n';
			   cssall += '.custom-radio .custom-control-input:disabled:checked ~';
		   cssall += '.custom-control-label::before{background-color:' + $btnPriFocBx + ';}\n';

			   cssall += '.custom-select{color:' + $thLigTxc + ';background-color:' + $bgColor + '; border-color:' + $fmBdc + ';}\n';
			   cssall += '.custom-select:focus{border-color:' + $fmFocBdc + ';box-shadow:inset 0 1px 2px ' + $tabBgc075 + ' ,0 0 5px ' + $cuSelFcBx + ';}\n';
			   cssall += '.custom-select:focus::-ms-value{color:' + $thLigTxc + ';background-color:' + $bgColor + ';}\n';
		   cssall += '.custom-select:disabled{color:' + $capTxColor + ';background-color:' + $thLigBgc + ';}\n';

			   cssall += '.custom-file-input:focus ~';
			   cssall += '.custom-file-label{border-color:' + $fmFocBdc + ';box-shadow:0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
			   cssall += '.custom-file-input:focus ~';
			   cssall += '.custom-file-label::after{border-color:' + $fmFocBdc + ';}\n';
			   cssall += '.custom-file-label{color:' + $thLigTxc + ';background-color:' + $bgColor + ';border-color:' + $fmBdc + ';}\n';
			   cssall += '.custom-file-label::after{color:' + $thLigTxc + ';background-color:' + $thLigBgc + ';border-left-color:' + $fmBdc + ';}\n';

		   cssall += '.custom-range::-webkit-slider-thumb{background-color:' + $aColor + ';}\n';
			   cssall += '.custom-range::-webkit-slider-thumb:focus{box-shadow:0 0 0 1px ' + $bgColor + ',0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
			   cssall += '.custom-range::-webkit-slider-thumb:active{background-color:' + $cuContBgc + ';}\n';
			   cssall += '.custom-range::-webkit-slider-runnable-track{background-color:' + $imgthBdc + ';}\n';
		   cssall += '.custom-range::-moz-range-thumb{background-color:' + $aColor + ';}\n';
			   cssall += '.custom-range::-moz-range-thumb:focus{box-shadow:0 0 0 1px ' + $bgColor + ',0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
			   cssall += '.custom-range::-moz-range-thumb:active{background-color:' + $cuContBgc + ';}\n';
			   cssall += '.custom-range::-moz-range-track{background-color:' + $imgthBdc + ';}\n';
		   cssall += '.custom-range::-ms-thumb{background-color:' + $aColor + ';}\n';
			   cssall += '.custom-range::-ms-thumb:focus{box-shadow:0 0 0 1px ' + $bgColor + ',0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
			   cssall += '.custom-range::-ms-thumb:active{background-color:' + $cuContBgc + ';}\n';
			   cssall += '.custom-range::-ms-fill-lower{background-color:' + $imgthBdc + ';}\n';
			   cssall += '.custom-range::-ms-fill-upper{background-color:' + $imgthBdc + ';}\n';

			   /**Navs**/

		   cssall += '.nav-link.disabled{color:' + $capTxColor + ';}\n';
			   cssall += '.nav-tabs{border-bottom-color:' + $imgthBdc + ';}\n';
			   cssall += '.nav-tabs .nav-link:hover,.nav-tabs .nav-link:focus{border-color:' + $thLigBgc + ' ' + $thLigBgc + ' ' + $imgthBdc + ';}\n';
		   cssall += '.nav-tabs .nav-link.disabled{color:' + $capTxColor + ';}\n';
			   cssall += '.nav-tabs .nav-link.active,.nav-tabs .nav-item.show .nav-link{color:' + $thLigTxc + ';background-color:' + $bgColor + ';border-color:' + $imgthBdc + ' ' + $imgthBdc + ' ' + $bgColor + ';}\n';
		   cssall += '.nav-pills .nav-link.active,.nav-pills .show > .nav-link{color:' + $bgColor + ';background-color:' + $aColor + ';}\n';
			   cssall += '.navbar-light .navbar-brand{color:' + $nvLigBrdTxc + ';}\n';
			   cssall += '.navbar-light .navbar-brand:hover,.navbar-light .navbar-brand:focus{color:' + $nvLigBrdTxc + ';}\n';
			   cssall += '.navbar-light .navbar-nav .nav-link{color:' + $nvLigNvTxc + ';}\n';
			   cssall += '.navbar-light .navbar-nav .nav-link:hover,.navbar-light .navbar-nav .nav-link:focus{color:' + $nvLigNvHTxc + ';}\n';
			   cssall += '.navbar-light .navbar-nav .nav-link.disabled{color:' + $nvLigNvDisTxc + ';}\n';
			   cssall += '.navbar-light .navbar-nav .show > .nav-link,.navbar-light .navbar-nav .active > .nav-link,.navbar-light .navbar-nav .nav-link.show,.navbar-light .navbar-nav .nav-link.active{color:' + $nvLigBrdTxc + ';}\n';
			   cssall += '.navbar-light .navbar-toggler{color:' + $nvLigNvTxc + ';border-color:' + $hrBdtColor + ';}\n';
			   cssall += '.navbar-light .navbar-text{color:' + $nvLigNvTxc + ';}\n';
			   cssall += '.navbar-light .navbar-text a{color:' + $nvLigBrdTxc + ';}\n';
			   cssall += '.navbar-light .navbar-text a:hover,.navbar-light .navbar-text a:focus{color:' + $nvLigBrdTxc + ';}\n';

			   // cssall += '.navbar-dark .navbar-brand{color:' + $bgColor + ';}\n';
			   cssall += '.navbar-dark .navbar-brand:hover,.navbar-dark .navbar-brand:focus{color:' + $bgColor + ';}\n';
			   cssall += '.navbar-dark .navbar-nav .nav-link{color:' + $nvDakNvTxc + ';}\n';
			   cssall += '.navbar-dark .navbar-nav .nav-link:hover,.navbar-dark .navbar-nav .nav-link:focus{color:' + $nvDakNvHTxc + ';}\n';
			   cssall += '.navbar-dark .navbar-nav .nav-link.disabled{color:' + $nvDakNvDisTxc + ';}\n';
			   cssall += '.navbar-dark .navbar-nav .show > .nav-link,.navbar-dark .navbar-nav .active > .nav-link,.navbar-dark .navbar-nav .nav-link.show,.navbar-dark .navbar-nav .nav-link.active{color:' + $bgColor + ';}\n';

			   cssall += '.navbar-dark .navbar-toggler{color:' + $nvDakNvTxc + ';border-color:' + $nvDakTogBdc + ';}\n';
			   cssall += '.navbar-dark .navbar-text{color:' + $nvDakNvTxc + ';}\n';
			   cssall += '.navbar-dark .navbar-text a{color:' + $bgColor + ';}\n';
			   cssall += '.navbar-dark .navbar-text a:hover,.navbar-dark .navbar-text a:focus{color:' + $bgColor + ';}\n';

			   /**cards**/
			   cssall += '.card{background-color:' + $bgColIn + ';border-color:' + $crdBdc + ';}\n';
			   cssall += '.card-header{border-bottom-color:' + $crdBdc + ';background-color: ' + $crdFooBgc + ';}\n';
			   cssall += '.card-footer{background-color:' + $crdFooBgc + ';border-top-color:' + $crdBdc + ';}\n';

			   /**breadcrumb**/
			   cssall += '.breadcrumb{background-color:' + $thLigBgc + ';}\n';
		   cssall += '.breadcrumb-item + .breadcrumb-item::before{color:' + $capTxColor + ';}\n';
		   cssall += '.breadcrumb-item.active{color:' + $capTxColor + ';}\n';

			   /**pagelinks**/
		   cssall += '.page-link{color:' + $aColor + ';background-color:' + $bgColIn + ';border-color:' + $imgthBdc + ';}\n';
		   cssall += '.page-link:hover{color:' + $aHColor + ';background-color:' + $thLigBgc + ';border-color:' + $imgthBdc + ';}\n';
			   cssall += '.page-link:focus{box-shadow:0 0 0 0.2rem ' + $fmFocBxs + ';}\n';
		   cssall += '.page-item.active .page-link{color:' + $bgColor + ';background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
		   cssall += '.page-item.disabled .page-link{color:' + $capTxColor + ';background-color:' + $bgColor + ';border-color:' + $imgthBdc + ';}\n';

			   /**badge**/
		   cssall += '.badge-primary{color:' + $bgColor + ';background-color:' + $aColor + ';}\n';
		   cssall += '.badge-primary[href]:hover,.badge-primary[href]:focus{color:' + $bgColor + ';background-color:' + $btnPriHBdc + ';}\n';
		   cssall += '.badge-secondary{color:' + $bgColor + ';background-color:' + $capTxColor + ';}\n';
		   cssall += '.badge-secondary[href]:hover,.badge-secondary[href]:focus{color:' + $bgColor + ';background-color:' + $btnSecHBdc + ';}\n';
			   cssall += '.badge-success{color:' + $bgColor + ';background-color:' + $valFdTxc + ';}\n';
		   cssall += '.badge-success[href]:hover,.badge-success[href]:focus{color:' + $bgColor + ';background-color:' + $btnSucHBdc + ';}\n';
		   cssall += '.badge-info{color:' + $bgColor + ';background-color:' + $btnInfBgc + ';}\n';
		   cssall += '.badge-info[href]:hover,.badge-info[href]:focus{color:' + $bgColor + ';background-color:' + $btnInfHBdc + ';}\n';
		   cssall += '.badge-warning{color:' + $txColor + ';background-color:' + $btnWarBgc + ';}\n';
		   cssall += '.badge-warning[href]:hover,.badge-warning[href]:focus{color:' + $txColor + ';background-color:' + $btnWarHBdc + ';}\n';
			   cssall += '.badge-danger{color:' + $bgColor + ';background-color:' + $invFdTxc + ';}\n';
		   cssall += '.badge-danger[href]:hover,.badge-danger[href]:focus{color:' + $bgColor + ';background-color:' + $btnDanHBdc + ';}\n';
			   cssall += '.badge-light{color:' + $txColor + ';background-color:' + $btnLigBgc + ';}\n';
			   cssall += '.badge-light[href]:hover,.badge-light[href]:focus{color:' + $txColor + ';background-color:' + $btnLigHBdc + ';}\n';
			   cssall += '.badge-dark{color:' + $bgColor + ';background-color:' + $btnDakBgc + ';}\n';
			   cssall += '.badge-dark[href]:hover,.badge-dark[href]:focus{color:' + $bgColor + ';background-color:' + $btnDakHBdc + ';}\n';

			   /**jumbotron**/
			   cssall += '.jumbotron{background-color:' + $thLigBgc + ';}\n';

			   /**alerts**/
		   cssall += '.alert-primary{color:' + $altPriTxc + ';background-color:' + $altPriBgc + ';border-color:' + $tPriBgc + ';}\n';
		   cssall += '.alert-primary hr{border-top-color:' + $tPriHBgc + ';}\n';
		   cssall += '.alert-primary .alert-link{color:' + $altPriLkBgc + ';}\n';
		   cssall += '.alert-secondary{color:' + $altSecTxc + ';background-color:' + $altSecBgc + ';border-color:' + $tSecBgc + ';}\n';
		   cssall += '.alert-secondary hr{border-top-color:' + $tSecHBgc + ';}\n';
		   cssall += '.alert-secondary .alert-link{color:' + $altSecLkBgc + ';}\n';
		   cssall += '.alert-success{color:' + $altSucTxc + ';background-color:' + $altSucBgc + ';border-color:' + $tSucBgc + ';}\n';
		   cssall += '.alert-success hr{border-top-color:' + $tSucHBgc + ';}\n';
		   cssall += '.alert-success .alert-link{color:' + $altSucLkBgc + ';}\n';
		   cssall += '.alert-info{color:' + $altInfTxc + ';background-color:' + $altInfBgc + ';border-color:' + $tInfBgc + ';}\n';
		   cssall += '.alert-info hr{border-top-color:' + $tInfHBgc + ';}\n';
		   cssall += '.alert-info .alert-link{color:' + $altInfLkBgc + ';}\n';
		   cssall += '.alert-warning{color:' + $altWarTxc + ';background-color:' + $altWarBgc + ';border-color:' + $tWarBgc + ';}\n';
		   cssall += '.alert-warning hr{border-top-color:' + $tWarHBgc + ';}\n';
		   cssall += '.alert-warning .alert-link{color:' + $altWarLkBgc + ';}\n';
		   cssall += '.alert-danger{color:' + $altDanTxc + ';background-color:' + $altDanBgc + ';border-color:' + $tDanBgc + ';}\n';
		   cssall += '.alert-danger hr{border-top-color:' + $tDanHBgc + ';}\n';
		   cssall += '.alert-danger .alert-link{color:' + $altDanLkTxc + ';}\n';

		   cssall += '.alert-light{color:' + $altLigTxc + ';background-color:' + $altLigBgc + ';border-color:' + $tLigBgc + ';}\n';
		   cssall += '.alert-light hr{border-top-color:' + $tLigHBgc + ';}\n';
		   cssall += '.alert-light .alert-link{color:' + $altLigLkTxc + ';}\n';

		   cssall += '.alert-dark{color:' + $altDakTxc + ';background-color:' + $altDakBgc + ';border-color:' + $tDakBgc + ';}\n';
		   cssall += '.alert-dark hr{border-top-color:' + $tDakHBgc + ';}\n';
		   cssall += '.alert-dark .alert-link{color:' + $altDakLkTxc + ';}\n';

			   /**progress**/
			   cssall += '.progress{background-color:' + $thLigBgc + ';}\n';
		   cssall += '.progress-bar{color:' + $bgColor + ';background-color:' + $aColor + ';}\n';

			   /**listgroup**/
			   cssall += '.list-group-item-action{color:' + $thLigTxc + ';}\n';
			   cssall += '.list-group-item-action:hover,.list-group-item-action:focus{color:' + $thLigTxc + ';background-color:' + $btnLigBgc + ';}\n';
			   cssall += '.list-group-item-action:active{color:' + $txColor + ';background-color:' + $thLigBgc + ';}\n';
			   cssall += '.list-group-item{background-color:' + $bgColIn + ';border-color:' + $crdBdc + ';}\n';
		   cssall += '.list-group-item.disabled,.list-group-item:disabled{color:' + $capTxColor + ';background-color:' + $bgColor + ';}\n';
		   cssall += '.list-group-item.active{color:' + $bgColor + ';background-color:' + $aColor + ';border-color:' + $aColor + ';}\n';
		   cssall += '.list-group-item-primary{color:' + $altPriTxc + ';background-color:' + $tPriBgc + ';}\n';
		   cssall += '.list-group-item-primary.list-group-item-action:hover,.list-group-item-primary.list-group-item-action:focus{color:' + $altPriTxc + ';background-color:' + $tPriHBgc + ';}\n';
		   cssall += '.list-group-item-primary.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altPriTxc + ';border-color:' + $altPriTxc + ';}\n';
		   cssall += '.list-group-item-secondary{color:' + $altSecTxc + ';background-color:' + $tSecBgc + ';}\n';
		   cssall += '.list-group-item-secondary.list-group-item-action:hover,.list-group-item-secondary.list-group-item-action:focus{color:' + $altSecTxc + ';background-color:' + $tSecHBgc + ';}\n';
		   cssall += '.list-group-item-secondary.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altSecTxc + ';border-color:' + $altSecTxc + ';}\n';
		   cssall += '.list-group-item-success{color:' + $altSucTxc + ';background-color:' + $tSucBgc + ';}\n';
		   cssall += '.list-group-item-success.list-group-item-action:hover,.list-group-item-success.list-group-item-action:focus{color:' + $altSucTxc + ';background-color:' + $tSucHBgc + ';}\n';
		   cssall += '.list-group-item-success.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altSucTxc + ';border-color:' + $altSucTxc + ';}\n';
		   cssall += '.list-group-item-info{color:' + $altInfTxc + ';background-color:' + $tInfBgc + ';}\n';
		   cssall += '.list-group-item-info.list-group-item-action:hover,.list-group-item-info.list-group-item-action:focus{color:' + $altInfTxc + ';background-color:' + $tInfHBgc + ';}\n';
		   cssall += '.list-group-item-info.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altInfTxc + ';border-color:' + $altInfTxc + ';}\n';
		   cssall += '.list-group-item-warning{color:' + $altWarTxc + ';background-color:' + $tWarBgc + ';}\n';
		   cssall += '.list-group-item-warning.list-group-item-action:hover,.list-group-item-warning.list-group-item-action:focus{color:' + $altWarTxc + ';background-color:' + $tWarHBgc + ';}\n';
		   cssall += '.list-group-item-warning.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altWarTxc + ';border-color:' + $altWarTxc + ';}\n';
		   cssall += '.list-group-item-danger{color:' + $altDanTxc + ';background-color:' + $tDanBgc + ';}\n';
		   cssall += '.list-group-item-danger.list-group-item-action:hover,.list-group-item-danger.list-group-item-action:focus{color:' + $altDanTxc + ';background-color:' + $tDanHBgc + ';}\n';
		   cssall += '.list-group-item-danger.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altDanTxc + ';border-color:' + $altDanTxc + ';}\n';
		   cssall += '.list-group-item-light{color:' + $altLigTxc + ';background-color:' + $tLigBgc + ';}\n';
		   cssall += '.list-group-item-light.list-group-item-action:hover,.list-group-item-light.list-group-item-action:focus{color:' + $altLigTxc + ';background-color:' + $tLigHBgc + ';}\n';
		   cssall += '.list-group-item-light.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altLigTxc + ';border-color:' + $altLigTxc + ';}\n';
		   cssall += '.list-group-item-dark{color:' + $altDakTxc + ';background-color:' + $tDakBgc + ';}\n';
		   cssall += '.list-group-item-dark.list-group-item-action:hover,.list-group-item-dark.list-group-item-action:focus{color:' + $altDakTxc + ';background-color:' + $tDakHBgc + ';}\n';
		   cssall += '.list-group-item-dark.list-group-item-action.active{color:' + $bgColor + ';background-color:' + $altDakTxc + ';border-color:' + $altDakTxc + ';}\n';

			   /**closeicon**/
			   cssall += '.close{color:' + $close + ';text-shadow:0 1px 0' + $bgColor + ';}\n';
			   cssall += '.close:hover,.close:focus{color:' + $close + ';}\n';

			   /**modal**/
			   // cssall += '.modal-content{background-color:' + $bgColor + ';border-color:' + $modContBdc + ';}\n';
			   // cssall += '.modal-backdrop{background-color:' + $close + ';}\n';
			   // cssall += '.modal-footer{border-top-color:' + $thLigBgc + ';}\n';

			   /**tooltip**/
			   // cssall += '.bs-tooltip-top .arrow::before,.bs-tooltip-auto[x-placement^="top"] .arrow::before{border-top-color:' + $close + ';}\n';
			   // cssall += '.bs-tooltip-right .arrow::before,.bs-tooltip-auto[x-placement^="right"] .arrow::before{border-right-color:' + $close + ';}\n';
			   // cssall += '.bs-tooltip-bottom .arrow::before,.bs-tooltip-auto[x-placement^="bottom"] .arrow::before{border-bottom-color:' + $close + ';}\n';
			   // cssall += '.bs-tooltip-left .arrow::before,.bs-tooltip-auto[x-placement^="left"] .arrow::before{border-left-color:' + $close + ';}\n';
			   // cssall += '.tooltip-inner{color:' + $bgColor + ';background-color:' + $close + ';}\n';

			   /**popover**/
			   // cssall += '.popover{background-color:' + $bgColor + ';border-color:' + $modContBdc + ';}\n';
			   // cssall += '.bs-popover-top .arrow::before,.bs-popover-auto[x-placement^="top"] .arrow::before{border-top-color:' + $popBsBdc + ';}\n';
			   // cssall += '.bs-popover-top .arrow::after,.bs-popover-auto[x-placement^="top"] .arrow::after{border-top-color:' + $bgColor + ';}\n';
			   // cssall += '.bs-popover-right .arrow::after,.bs-popover-auto[x-placement^="right"] .arrow::after{border-right-color:' + $bgColor + ';}\n';
			   // cssall += '.bs-popover-bottom .arrow::before,.bs-popover-auto[x-placement^="bottom"] .arrow::before{border-bottom-color:' + $popBsBdc + ';}\n';
			   // cssall += '.bs-popover-bottom .arrow::after,.bs-popover-auto[x-placement^="bottom"] .arrow::after{border-bottom-color:' + $bgColor + ';}\n';
			   // cssall += '.bs-popover-bottom .popover-header::before,.bs-popover-auto[x-placement^="bottom"] .popover-header::before{border-bottom-color:' + $popBtPhdBdc + ';}\n';
			   // cssall += '.bs-popover-left .arrow::before,.bs-popover-auto[x-placement^="left"] .arrow::before{border-left-color:' + $popBsBdc + ';}\n';
			   // cssall += '.bs-popover-left .arrow::after,.bs-popover-auto[x-placement^="left"] .arrow::after{border-left-color:' + $bgColor + ';}\n';
			   // cssall += '.popover-header{background-color:' + $popBtPhdBdc + ';border-bottom-color:' + $popHdBdc + ';}\n';
			   // cssall += '.popover-body{color:' + $txColor + ';}\n';

			   /**carousel**/
			   cssall += '.carousel-control-prev,.carousel-control-next{color:' + $bgColor + ';}\n';
			   cssall += '.carousel-control-prev:hover,.carousel-control-prev:focus,.carousel-control-next:hover,.carousel-control-next:focus{color:' + $bgColor + ';}\n';
			   cssall += '.carousel-indicators li{background-color:' + $nvDakNvTxc + ';}\n';
			   cssall += '.carousel-indicators .active{background-color:' + $bgColor + ';}\n';
			   cssall += '.carousel-caption{color:' + $txColor + ';}\n';

			   /**Backgrounds**/

		   cssall += '.bg-primary{background-color:' + $aColor + ' !important;}\n';
		   cssall += 'a.bg-primary:hover,a.bg-primary:focus,button.bg-primary:hover,button.bg-primary:focus{background-color:' + $btnPriHBdc + ' !important;}\n';
		   cssall += '.bg-secondary{background-color:' + $capTxColor + ' !important;}\n';
		   cssall += 'a.bg-secondary:hover,a.bg-secondary:focus,button.bg-secondary:hover,button.bg-secondary:focus{background-color:' + $btnSecHBdc + ' !important;}\n';
			   cssall += '.bg-success{background-color:' + $valFdTxc + ' !important;}\n';
		   cssall += 'a.bg-success:hover,a.bg-success:focus,button.bg-success:hover,button.bg-success:focus{background-color:' + $btnSucHBdc + ' !important;}\n';
		   cssall += '.bg-info{background-color:' + $btnInfBgc + ' !important;}\n';
		   cssall += 'a.bg-info:hover,a.bg-info:focus,button.bg-info:hover,button.bg-info:focus{background-color:' + $btnInfHBdc + ' !important;}\n';
		   cssall += '.bg-warning{background-color:' + $btnWarBgc + ' !important;}\n';
		   cssall += 'a.bg-warning:hover,a.bg-warning:focus,button.bg-warning:hover,button.bg-warning:focus{background-color:' + $btnWarHBdc + ' !important;}\n';
			   cssall += '.bg-danger{background-color:' + $invFdTxc + ' !important;}\n';
		   cssall += 'a.bg-danger:hover,a.bg-danger:focus,button.bg-danger:hover,button.bg-danger:focus{background-color:' + $btnDanHBdc + ' !important;}\n';
			   cssall += '.bg-light{background-color:' + $btnLigBgc + ' !important;}\n';
			   cssall += 'a.bg-light:hover,a.bg-light:focus,button.bg-light:hover,button.bg-light:focus{background-color:' + $btnLigHBdc + ' !important;}\n';
			   cssall += '.bg-dark{background-color:' + $btnDakBgc + ' !important;}\n';
			   cssall += 'a.bg-dark:hover,a.bg-dark:focus,button.bg-dark:hover,button.bg-dark:focus{background-color:' + $btnDakHBdc + ' !important;}\n';
			   // cssall += '.bg-white{background-color:' + $bgColor + ' !important;}\n';

			   /**Borders**/
			   cssall += '.border{border-color:' + $imgthBdc + ' !important;}\n';
			   cssall += '.border-top{border-top-color:' + $imgthBdc + ' !important;}\n';
			   cssall += '.border-bottom{border-bottom-color:' + $imgthBdc + ' !important;}\n';
			   cssall += '.border-right-color{border-right-color:' + $imgthBdc + ' !important;}\n';
			   cssall += '.border-bottom-color{border-bottom-color:' + $imgthBdc + ' !important;}\n';
			   cssall += '.border-left-color{border-left-color:' + $imgthBdc + ' !important;}\n';
		   cssall += '.border-primary{border-color:' + $aColor + ' !important;}\n';
		   cssall += '.border-secondary{border-color:' + $capTxColor + ' !important;}\n';
			   cssall += '.border-success{border-color:' + $valFdTxc + ' !important;}\n';
		   cssall += '.border-info{border-color:' + $btnInfBgc + ' !important;}\n';
		   cssall += '.border-warning{border-color:' + $btnWarBgc + ' !important;}\n';
			   cssall += '.border-danger{border-color:' + $invFdTxc + ' !important;}\n';
			   cssall += '.border-light{border-color:' + $btnLigBgc + ' !important;}\n';
			   cssall += '.border-dark{border-color:' + $btnDakBgc + ' !important;}\n';
			   cssall += '.border-white{border-color:' + $bgColor + ' !important;}\n';

			   /**Shadows**/
			   cssall += '.shadow-sm{box-shadow:0 0.125rem 0.25rem ' + $tabBgc075 + ' !important;}\n';
			   cssall += '.shadow{box-shadow:0 0.5rem 1rem ' + $ShLg + ' !important;}\n';
			   cssall += '.shadow-lg{box-shadow:0 1rem 3rem ' + $ShLg + ' !important;}\n';

			   /**Text**/
//					cssall += '.text-white{color:' + $bgColor + ' !important;}\n';
		   cssall += '.text-primary{color:' + $aColor + ' !important;}\n';
		   cssall += 'a.text-primary:hover,a.text-primary:focus{color:' + $btnPriHBdc + ' !important;}\n';
		   cssall += '.text-secondary{color:' + $capTxColor + ' !important;}\n';
		   cssall += 'a.text-secondary:hover,a.text-secondary:focus{color:' + $btnSecHBdc + ' !important;}\n';
			   cssall += '.text-success{color:' + $valFdTxc + ' !important;}\n';
		   cssall += 'a.text-success:hover,a.text-success:focus{color:' + $btnSucHBdc + ' !important;}\n';
		   cssall += '.text-info{color:' + $btnInfBgc + ' !important;}\n';
		   cssall += 'a.text-info:hover,a.text-info:focus{color:' + $btnInfHBdc + ' !important;}\n';
		   cssall += '.text-warning{color:' + $btnWarBgc + ' !important;}\n';
		   cssall += 'a.text-warning:hover,a.text-warning:focus{color:' + $btnWarHBdc + ' !important;}\n';
			   cssall += '.text-danger{color:' + $invFdTxc + ' !important;}\n';
		   cssall += 'a.text-danger:hover,a.text-danger:focus{color:' + $btnDanHBdc + ' !important;}\n';
			   cssall += '.text-light{color:' + $btnLigBgc + ' !important;}\n';
			   cssall += 'a.text-light:hover,a.text-light:focus{color:' + $btnLigHBdc + ' !important;}\n';
			   cssall += '.text-dark{color:' + $btnDakBgc + ' !important;}\n';
			   cssall += 'a.text-dark:hover,a.text-dark:focus{color:' + $btnDakHBdc + ' !important;}\n';
			   cssall += '.text-body{color:' + $txColor + ' !important;}\n';
		   cssall += '.text-muted{color:' + $capTxColor + ' !important;}\n';
			   cssall += '.text-black-50{color:' + $nvLigNvTxc + ' !important;}\n';
			   cssall += '.text-white-50{color:' + $nvDakNvTxc + ' !important;}\n';

			   return cssall;

		   }

		   /* -------------------- fin de variabes, variabes y valores para css -------------------- */

		   /** -------------------- funciones que cambian los colores -------------------- **/
		   //Hexadecimal a RGBA, variable extra en caso de necesitar controlar la opacidad.
		   function hexToRgbA(hex,op) {
			   var c;
			   var op;
			   if (op==''||op==null){op=1;}
			   if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
				   c = hex.substring(1).split('');
				   if (c.length == 3) {
					   c = [c[0], c[0], c[1], c[1], c[2], c[2]];
				   }
				   c = '0x' + c.join('');
				   // return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',1)';
				   return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ','+op+')';
			   } else {
				   // si el valor no es hexadecimal entonces es rgba, no requiere transformar.
				   return hex;
			   }
		   }

		   //RGBA a hexadecimal con opacidad
		   function rgbaToHexOp(rgba) {
			   var a,
				   isPercent,
				   rgb = rgba.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i),
				   alpha = (rgb && rgb[4] || "").trim(),
				   hex = rgb ? (rgb[1] | 1 << 8).toString(16).slice(1) + (rgb[2] | 1 << 8).toString(16).slice(1) + (rgb[3] | 1 << 8).toString(16).slice(1) : rgba;
			   if (alpha !== "") {
				   a = alpha;
			   } else {
				   a = 01;
			   }

			   a = Math.round(a * 100) / 100;
			   var alpha = Math.round(a * 255);
			   var hexAlpha = (alpha + 0x10000).toString(16).substr(-2).toUpperCase();
			   hex = hex + hexAlpha;

			   return '#' + hex;
		   }

		   //hexadecimal hsl ekiline
		   function HexAHslvar(hex, nh, ns, nl) {

			   hex = hex.replace('#', '');

			   var r = parseInt(hex.substring(0, 2), 16);
			   var g = parseInt(hex.substring(2, 4), 16);
			   var b = parseInt(hex.substring(4, 6), 16);
			   //para mantener la opacidad la extraemos en una variable alternativa
			   var opa = hex.substring(6, 8);

			   r /= 255;
			   g /= 255;
			   b /= 255;

			   var max = Math.max(r, g, b),
				   min = Math.min(r, g, b);
			   var h,
				   s,
				   l = (max + min) / 2;

			   if (max == min) {
				   h = s = 0;
				   // achromatic
			   } else {
				   var d = max - min;
				   s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
				   switch(max) {
				   case r:
					   h = (g - b) / d + (g < b ? 6 : 0);
					   break;
				   case g:
					   h = (b - r) / d + 2;
					   break;
				   case b:
					   h = (r - g) / d + 4;
					   break;
				   }
				   h /= 6;
			   }

			   s = s * 100;
			   s = Math.round(s);
			   l = l * 100;
			   l = Math.round(l);
			   h = Math.round(360 * h);

			   // aqui llamo mis nuevas variables y modifico la salida del color
			   // var nh = nh;
			   // var ns = ns;
			   // var nl = nl;

			   h = h + nh;
			   s = s + ns;
			   l = l + nl;

			   var r2,
				   g2,
				   b2,
				   m,
				   c,
				   x;

			   if (!isFinite(h))
				   h = 0;
			   if (!isFinite(s))
				   s = 0;
			   if (!isFinite(l))
				   l = 0;

			   h /= 60;
			   if (h < 0)
				   h = 6 - (-h % 6);
			   h %= 6;

			   s = Math.max(0, Math.min(1, s / 100));
			   l = Math.max(0, Math.min(1, l / 100));

			   c = (1 - Math.abs((2 * l) - 1)) * s;
			   x = c * (1 - Math.abs((h % 2) - 1));

			   if (h < 1) {
				   r2 = c;
				   g2 = x;
				   b2 = 0;
			   } else if (h < 2) {
				   r2 = x;
				   g2 = c;
				   b2 = 0;
			   } else if (h < 3) {
				   r2 = 0;
				   g2 = c;
				   b2 = x;
			   } else if (h < 4) {
				   r2 = 0;
				   g2 = x;
				   b2 = c;
			   } else if (h < 5) {
				   r2 = x;
				   g2 = 0;
				   b2 = c;
			   } else {
				   r2 = c;
				   g2 = 0;
				   b2 = x;
			   }

			   m = l - c / 2;
			   r2 = Math.round((r2 + m) * 255);
			   g2 = Math.round((g2 + m) * 255);
			   b2 = Math.round((b2 + m) * 255);

			   var fullrgb = [r2, g2, b2];

			   function hextract(x) {
				   return ('0' + parseInt(x).toString(16)).slice(-2);
			   }

			   return '#' + hextract(fullrgb[0]) + hextract(fullrgb[1]) + hextract(fullrgb[2]) + opa;
		   }

		   /** -------------------- fin de funciones -------------------- **/

		   /**  Paso 2 : aplicar filtros de ajuste de color, ejercicio con posibilidades **/

		   // variable array de valores css
		   var all2rgba = [];

		   /* Funcion de cambio de tono:
			* obtener los valores css y pasar cada uno por alguna funcion */

		   Object.keys(cssValues).forEach(function(key) {
				   // 1 todos los tonos HEX a RGBA, manteniendo opacidad.
				   var nc = hexToRgbA(cssValues[key]);
				   // 2 todos RGBA a HEX con opacidad
				   var nc3 = rgbaToHexOp(nc);
				   // 3 todos los hexadecimales con opacidad, cambiar a HSL
				   var nc4 = HexAHslvar(nc3, 0, 0, 0);

				   all2rgba.push({
					   'item' : key, // el color original
					   'rgba' : nc, // el color en RGBA
					   'hexop' : nc3, // el color HEX con Opacidad
					   'hexhsl' : nc4 // el color HSL a HEX
				   });
		   });

		   /**
			*  Paso 3 : del json nuevo, se debe generar una cadena de variables y validar en el dom con eval()
			*	eval() para variables dinamicas: http://www.forosdelweb.com/f13/generar-variables-dinamicamente-699388/
			**/

		   var string = '';
		   // cada nuevo color se transforma en una variable para crear el CSS.
		   for (i in all2rgba) {
			   string += 'var ' + all2rgba[i].item + '=\'' + all2rgba[i].hexhsl + '\';';
		   }
		   eval(string);
		   // este es iportante.

		   // console.log(string); // ver resultados

		   /**  Paso 4 : generar el nuevo CSS con los valores para que se cambie el tema, este puede ser dinamico pero tambien guardarlo como css**/

		   // invocar el css
		   // var styleColor = $('<style/>', {
		   // 	html : cssOrders(),
		   // 	id: 'tmpstyle'
		   // });
		   // $("head").append(styleColor);

		   // var styleColor = cssOrders();
		   // console.log(cssOrders());
		   // esta clase es nativa de wp.	

	   // FIN funcion simple que genera varios tonos.


/* --------------------------------------- 
	Finaliza el ejerciocio original de colores.
-----------------------------------------*/						


	   /****
		* Anotacion, no se refresca el dato.
		*/
		
		// wp.customize( 'ekiline_textarea_css', function ( obj ) {
		// 	obj.set( cssOrders() );
		// } );

		// console.log(wp.customize.value('ekiline_textarea_css')());

//1) este refresca al escribir	
		// wp.customize( 'ekiline_textarea_css', function( value ) {
		// 	value.bind( function( newval ) {
				// wp.customize.previewer.refresh();			
		// 		value.set( cssOrders() );
		// 	} );
		// } ); 		  

//2) este refresca al cambio en un selector...	
		// wp.customize( 'back_color', 'ekiline_textarea_css', function( field1, field2 ) {
		// 	field1.bind( function( value ) {
		// 		field2.set( cssOrders() );
		// 	} );
		// } );

		


//3) Entonces hacemos un loop que detectce algun cambio en los colores...	

			// var colors = [
			// 	'back_color','text_color',
			// ];

			// $.each( colors, function( key, value ) {

			// 	wp.customize( value, 'ekiline_textarea_css', function( field1, field2 ) {

			// 		field1.bind( function( value ) {

						field2.set( cssOrders() );							

					} );

				});

			});






}); // jQuery(document)

