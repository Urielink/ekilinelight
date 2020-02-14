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

<footer class="site-footer">
  <div class="container">
  	
    <?php dynamic_sidebar('footer-w1');?>
  	         
	<p><small> <?php echo $copyright . ' ' . $madein; ?><a class="goTop float-right" href="#top"><span>&uarr;</span><?php echo __('Back','ekiline'); ?></a></small></p>
  </div>
</footer><!-- .site-footer -->


<?php wp_footer(); ?>
	</body>
</html>
