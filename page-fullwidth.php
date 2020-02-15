<?php
/** 
 * Template Name: Full Width Page
 * 
 * @package WordPress
 * @subpackage ekiline
 * 
 */ 
get_header(); ?>

<main id="primary" class="container-fluid px-0">

<?php dynamic_sidebar( 'content-w1' );?>				

<?php
	/** Loop https://developer.wordpress.org/themes/basics/the-loop/ **/
	if ( have_posts() ) { 
		while ( have_posts() ) : 
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );	
		endwhile;	
    } else {
			get_template_part( 'template-parts/content', 'none' );	
    }	
?>

<?php ekiline_archive_pagination(); ?>

<?php dynamic_sidebar( 'content-w2' ); ?>		

<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( is_single() || is_page() && !is_front_page() ){
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}
?>

</main><!-- #primary -->

<?php get_footer(); ?>