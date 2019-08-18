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
 $copyright = sprintf( esc_html__( '&copy; Copyright %1$s', 'ekiline' ), esc_attr( date('Y') . ' ' . get_bloginfo( 'name', 'display' ) ) );
 $madein = sprintf( esc_html__( 'Proudly powered by %1$s and %2$s', 'ekiline' ),'<a href="'.__('https://wordpress.org/','ekiline').'" target="_blank">WordPress</a>','<a href="'.__('http://ekiline.com','ekiline').'" target="_blank">Ekiline</a>' );
 
?>

<footer class="site-footer">
  <div class="container">
  	
    <?php dynamic_sidebar('footer-w1');?>
  	         
	<p><?php echo $copyright; ?></p>
	<small><?php echo $madein; ?></small>
	<a class="goTop btn btn-sm" href="#top"><span class="fa fa-chevron-up"></span>Up</a>	
  </div>
</footer><!-- .site-footer -->


<?php wp_footer(); ?>
	</body>
</html>
