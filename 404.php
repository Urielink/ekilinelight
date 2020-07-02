<?php
/**
 * Plantilla 404 (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ekiline
 */
get_header(); ?>

<?php ekiline_main_columns('open'); ?>

	<main id="primary" class="<?php orderCols('main');?>">

		<?php dynamic_sidebar( 'content-w1' );?>

		<article class="error-404 not-found">

			<header class="entry-header">
				<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'ekiline' ); ?></h1>
			</header><!-- .entry-header -->
				
			<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ekiline' ); ?></p>

			<?php get_search_form(); ?>

			<div class="row">

				<div class="col-md-6">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					<?php /** https://developer.wordpress.org/reference/functions/wp_get_archives/ **/ ?>
					<p> <?php echo sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'ekiline' ), convert_smilies( ':)' ) ); ?></p>					
					<select class="form-control" name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
						<option value=""><?php esc_attr( _e( 'Search', 'ekiline' ) ); ?></option> 
						<?php
							$argsArchive = array(
								'type'            => 'monthly',
								'limit'           => '',
								'format'          => 'option', //html
								'before'          => '',
								'after'           => '',
								'show_post_count' => false,
								'echo'            => true,
								'order'           => 'DESC'
							);						
							wp_get_archives( $argsArchive ); 
						?>
					</select>					
				</div>

				<div class="col-md-6">
					<?php if ( ekiline_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php echo esc_html__( 'Most used categories', 'ekiline' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>						
				</div>

				<div class="col-12">
					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
				</div>
				
			</div>

		</article><!-- .error-404 -->

		<?php dynamic_sidebar( 'content-w2' ); ?>		

	</main><!-- #primary -->

	<?php get_sidebar(); ?>

<?php ekiline_main_columns('close'); ?>

<?php get_footer(); ?>