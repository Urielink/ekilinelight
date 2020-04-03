<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */
?>

<article id="<?php echo ekiline_post_id();?>" <?php post_class();?>>
			
	<?php ekiline_thumbnail(); ?>

	<div class="card-body">

		<?php the_title(); ?>

		<?php the_content();?>

	</div>

	<footer class="card-footer">	

		<?php ekiline_entry_footer(); ?>
		
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->