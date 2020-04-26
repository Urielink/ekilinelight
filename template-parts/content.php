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
		
	<?php if (is_singular()){ ?>
			<p class="entry-meta">
				<?php echo ekiline_notes('author') . ' , '. ekiline_notes('published') . ' , '. ekiline_notes('addcomment'); ?>
			</p>
	<?php } ?>


	</header>
	
	<?php ekiline_thumbnail(); ?>

	<?php the_content();?>
  
	<?php ekiline_link_pages(); ?>	
	
<?php if ( is_singular() ){?>
	<footer>	
		<p class="entry-meta">
			<?php echo ekiline_notes('categories'); ?>
			<br><?php echo ekiline_notes('tags'); ?>
		</p><!-- .entry-meta -->	
	</footer>
<?php } ?>

</article><!-- #post-## -->