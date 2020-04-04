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

	<header>
			
		<?php the_title(); ?>

		<p class="entry-meta">
			<?php ekiline_posted_on(); ?>
		</p><!-- .entry-meta -->

	</header>
	
	<?php ekiline_thumbnail(); ?>

	<?php the_content();?>
  
	<?php ekiline_link_pages(); ?>	

	
	<footer>	
		<?php ekiline_entry_footer(); ?>		
	</footer>

</article><!-- #post-## -->