<?php
/**
 * El footer de ekiline contiene espacios para jugar con widgets.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @link https://codex.wordpress.org/Function_Reference/is_active_sidebar
 *
 * @package ekiline
 *
 */ 
?>

<?php if ( is_active_sidebar( 'footer-w2' ) ) { ?>

  <div class="footer-bar bg-secondary text-white">
    <div class="pt-4 pb-2 container">  	
      <?php ekiline_countWidgets('footer-w2'); ?>  	         
    </div>
  </div><!-- .footer-bar -->

<?php } ?>


<footer class="site-footer pt-4 pb-2 bg-dark text-white">
  <div class="container">  	
    <?php ekiline_countWidgets('footer-w1'); ?>  	         
    <p>
      <?php echo ekiline_notes('copyright'); ?>
      <?php echo ekiline_notes('poweredby'); ?>
      <a class="goTop float-right" href="#top"><span>&uarr;</span><?php echo __('Back','ekiline'); ?></a>
    </p>
  </div>
</footer><!-- .site-footer -->

<?php wp_footer(); ?>

	</body>
</html>
