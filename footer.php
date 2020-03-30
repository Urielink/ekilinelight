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

<?php get_sidebar('footerbar'); ?>	

<footer class="site-footer pt-4 pb-2 bg-dark">
  <div class="container">  	
    <?php ekiline_countWidgets('footer-w1'); ?>  	         
    <p class="pt-4 text-center border-top"><small><?php echo ekiline_notes('copyright'); ?><a class="goTop float-right" href="#top"><span>&uarr;</span><?php echo __('Back','ekiline'); ?></a></small></p>
  </div>
</footer><!-- .site-footer -->

<?php wp_footer(); ?>

	</body>
</html>
