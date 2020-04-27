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

		<?php if ( is_singular() ){ ?>

			<?php // Page & post title ?>
			<?php the_title('<h1 class="entry-title">','</h1>'); ?>
			
			<p class="entry-meta">
				<?php echo ekiline_notes('author') . ' , '. ekiline_notes('published') . ' , '. ekiline_notes('addcomment'); ?>
			</p>

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
		<p class="entry-meta">
			<?php echo ekiline_notes('categories'); ?>
			<br><?php echo ekiline_notes('tags'); ?>
		</p><!-- .entry-meta -->	
	</footer>
<?php } ?>

</article><!-- #post-## -->


<p class="text-success">
<mark>Nueva meta</mark>

<?php echo sprintf( 
		esc_html_x( 'Written by %s', 'post authors', 'ekiline' ), 
		get_the_author_posts_link() 
	); ?>

<br>

<?php echo sprintf( 
		esc_html_x( 'Posted on %s', 'post date', 'ekiline' ), 
		'<a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '" rel="bookmark">' . get_the_time( esc_html__( 'F j, Y', 'ekiline' ) ) . '</a>'
	); ?>
<br>
<?php echo sprintf( 
		esc_html_x( 'Updated on %s', 'ekiline' ), 
		get_the_modified_date( esc_html__( 'F j, Y', 'ekiline' ) )
	); ?>

<br>
<?php comments_popup_link( 
		__('No comments yet', 'ekiline'), 
		__('1 Comment', 'ekiline'), 
		__('% Comments', 'ekiline'), 
		'comments-link', 
		__('Comments are closed.', 'ekiline') 
	); ?>

<br>					
<?php echo sprintf( 
		esc_html_x( 'Categories: %s', 'ekiline' ), 
		get_the_category_list(', ')
	); ?>

<br>					
<?php echo sprintf( 
		esc_html_x( 'Tags: %s', 'ekiline' ), 
		get_the_tag_list( '', ', ')
	); ?>


<p>