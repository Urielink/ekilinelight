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

		<?php the_title('<h2 class="entry-title card-title"><a href="'. get_the_permalink() .'" title="'. get_the_title() .'">','</a></h2>'); ?>

		<?php the_content();?>

	</div>

	<footer class="card-footer">	
		<p class="entry-meta small mark">
			<?php echo ekiline_notes('categories'); ?>
			<?php echo ekiline_notes('tags'); ?>
		</p><!-- .entry-meta -->			
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->