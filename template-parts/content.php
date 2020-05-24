<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ekiline
 */
?>

<?php
// en caso de ocupar tarjetas en el inidice.
if ( !is_singular() && get_theme_mod('ekiline_Columns') == 4 ){
	return get_template_part( 'template-parts/content', 'card' );
} 
?>

<article id="<?php ekiline_post_id();?>" <?php post_class();?>>

	<header>				

		<?php if ( is_singular() ){ ?>

			<?php // Page & post title ?>
			<?php the_title('<h1 class="entry-title">','</h1>'); ?>

			<p class="entry-meta small mark">
				<?php echo ekiline_notes('author'); ?>
				<?php echo ekiline_notes('posted'); ?>
				<?php echo ekiline_notes('updated'); ?>
				<?php echo ekiline_notes('comments'); ?>
			</p><!-- .entry-meta -->	
	
		<?php } else { ?>

			<?php // Archive, list titles ?>
			<?php the_title('<h2 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '" title="' . get_the_title() . '">','</a></h2>'); ?>

		<?php } ?>

	</header>

	<?php ekiline_thumbnail(); ?>
	
	<?php the_content();?>
  
	<?php ekiline_link_pages(); ?>	
	
<?php if ( is_singular() ){?>
	<footer>
		<p class="entry-meta small mark">
			<?php echo ekiline_notes('categories'); ?>
			<?php echo ekiline_notes('tags'); ?>
		</p><!-- .entry-meta -->	
	</footer>
<?php } ?>

</article><!-- #post-## -->
