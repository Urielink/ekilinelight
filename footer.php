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
 // Variables en footer:
 $copyright = sprintf( esc_html__( '&copy; Copyright %1$s.', 'ekiline' ), esc_attr( date('Y') . ' ' . get_bloginfo( 'name', 'display' ) ) );
 $madein = sprintf( esc_html__( 'Proudly powered by %1$s and %2$s.', 'ekiline' ),'<a href="'.__('https://wordpress.org/','ekiline').'" target="_blank">WordPress</a>','<a href="'.__('http://ekiline.com','ekiline').'" target="_blank">Ekiline</a>' );
 
?>

<?php get_sidebar('footerbar'); ?>	

<footer class="site-footer pt-4 pb-2 bg-dark text-light">
  <div class="container">  	
    <?php ekiline_countWidgets('footer-w1'); ?>  	         
    <p class="pt-4 text-center border-top"><small><?php echo $copyright . ' ' . $madein; ?><a class="goTop float-right" href="#top"><span>&uarr;</span><?php echo __('Back','ekiline'); ?></a></small></p>
  </div>
</footer><!-- .site-footer -->


<?php wp_footer(); ?>
	</body>
</html>
