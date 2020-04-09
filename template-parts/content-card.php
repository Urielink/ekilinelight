<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */
?>

<article id="<?php ekiline_post_id();?>" <?php post_class();?>>
			
	<?php ekiline_thumbnail(); ?>

	<div class="card-body">

		<?php the_title(); ?>
		<?php the_content();?>

	</div>

	<footer class="card-footer">	

		<p class="entry-meta">
			<?php echo ekiline_notes('categories'); ?>
			<br><?php echo ekiline_notes('tags'); ?>
		</p><!-- .entry-meta -->	
		
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->