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

<aside class="footer-bar bg-light pt-4 pb-2">
  <div class="container">  	
    <?php ekiline_countWidgets('footer-w2'); ?>  	         
  </div>
</aside><!-- .footer-bar -->