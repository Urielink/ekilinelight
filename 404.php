<?php
/** 
 * Plantilla principal del Frontend.
 * 
 * Esta es la vista principal de un sitio, aqui se mostraran cada una de sus partes.
 * El consejo es que no ocupes caracteres especiales.
 * Y organices bien tus archivos.
 * Ekiline esta hecho para tener control sobre elementos de diseno.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/
 * 
 * @package ekiline
 * 
 */ 
get_header(); ?>

<?php ekiline_main_columns('open'); ?>

	<main id="primary" class="<?php orderCols('main');?>">

		<?php dynamic_sidebar( 'content-w1' );?>

		<section class="error-404 not-found">

				<header class="entry-header">
					<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'ekiline' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="page-content">
				    
					<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ekiline' ); ?></p>

					<?php get_search_form(); ?>

					<div class="row">

						<div class="col-md-6">
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
							<?php
								/* translators: %1$s: smiley */
								$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'ekiline' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

						</div>

						<div class="col-md-6">
							<?php if ( ekiline_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
							<div class="widget widget_categories">
								<h2 class="widget-title"><?php echo esc_html__( 'Most Used Categories', 'ekiline' ); ?></h2>
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

				</div><!-- .page-content -->

		</section><!-- .error-404 -->


		<?php dynamic_sidebar( 'content-w2' ); ?>		

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( is_singular() && !is_front_page() ){
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			}
		?>

	</main><!-- #primary -->

	<?php get_sidebar(); ?>

	<?php get_sidebar('right'); ?>	

<?php ekiline_main_columns('close'); ?>

<?php get_footer(); ?>