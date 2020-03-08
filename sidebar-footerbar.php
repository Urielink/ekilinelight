<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ekiline
 */
if (!is_active_sidebar( 'footer-w2' )) return;
?>

<div class="footer-bar bg-secondary">
  <div class="pt-4 pb-2 container">  	
    <?php ekiline_countWidgets('footer-w2'); ?>  	         
  </div>
</div><!-- .footer-bar -->