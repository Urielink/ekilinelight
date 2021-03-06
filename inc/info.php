<?php
/**
 * Ekiline administration info
 *
 * Admin bar button
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_before_admin_bar_render
 * @link https://codex.wordpress.org/Javascript_Reference/ThickBox
 *
 * Y con estilos agregados.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_add_inline_style
 * @link https://gist.github.com/corvannoorloos/43980115659cb5aee571
 * @link https://wordpress.stackexchange.com/questions/36394/wp-3-3-how-to-add-menu-items-to-the-admin-bar
 * @link https://wordpress.stackexchange.com/questions/266318/how-to-add-custom-submenu-links-in-wp-admin-menus
 *
 * @package ekiline
 */

/**
 * Ekiline, adminbar "fundme" button.
 */
function ekiline_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu(
		array(
			'id'     => 'goekiline',
			'title'  => __( 'Ekiline', 'ekiline' ),
			'href'   => esc_url( 'themes.php?page=ekiline_options' ),
			'meta'   => array(
				'class'  => 'gold',
				'target' => '_self',
			),
			'parent' => 'top-secondary',
		)
	);
}
add_action( 'admin_bar_menu', 'ekiline_bar', 0 );

/**
 * Ekiline, side menu button.
 */
function ekiline_theme_page() {
	add_theme_page(
		'Ekiline Menu Page Title',
		__( 'About Ekiline', 'ekiline' ),
		'edit_posts',
		'ekiline_options',
		'theme_html_page'
	);
}
add_action( 'admin_menu', 'ekiline_theme_page' );

/**
 * Ekiline, info.
 */
function theme_html_page() { ?>

<div class="wrap">
	<h1>
		<span class="dashicons dashicons-layout" aria-hidden="true"></span>
			<?php esc_html_e( 'About Ekiline for WordPress', 'ekiline' ); ?>
	</h1>

	<div id="welcome-panel" class="welcome-panel">

		<div class="welcome-panel-content">

			<h2><?php esc_html_e( 'Thanks for using this theme!', 'ekiline' ); ?></h2>
			<hr>
			<p class="about-description">
				<?php esc_html_e( 'Find more information to improve your skills in customizing your site.', 'ekiline' ); ?>
			</p>

			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<div style="padding:4px;">
						<h3><?php esc_html_e( 'Add an extra to the creation and delivery of your projects.', 'ekiline' ); ?></h3>
						<ul>
							<li><span class="dashicons dashicons-book dash-note"></span>
								<?php esc_html_e( 'Quick use guide in Keynote or Powerpoint to freely customize and deliver to your clients.', 'ekiline' ); ?></li>
							<li><span class="dashicons dashicons-edit dash-note"></span>
								<?php esc_html_e( 'More design elements, CSS, HTML and JS available to grow your project.', 'ekiline' ); ?></li>
							<li><span class="dashicons dashicons-layout dash-note"></span>
								<?php esc_html_e( 'Ekiline Blocks, plugin with carousel and more options in page editor.', 'ekiline' ); ?></li>
							<li><span class="dashicons dashicons-welcome-view-site dash-note"></span>
								<?php esc_html_e( 'Complete clean theme, no warnings or messages.', 'ekiline' ); ?></li>
						</ul>
						<p>
							<?php printf( '<a class="button button-primary button-hero" href="%1$s" target="_blank"><span class="dashicons dashicons-cart"></span> %2$s</a>', esc_url( 'https://ekiline.com/compra/' ), esc_html__( 'Buy and download', 'ekiline' ) ); ?>
							<?php printf( '<a class="button button-primary button-hero gold" href="%1$s" target="_blank"><span class="dashicons dashicons-carrot"></span> %2$s</a>', esc_url( 'https://ekiline.com/fondeo/' ), esc_html__( 'FundMe', 'ekiline' ) ); ?>
						</p>
						<p>
							<?php
							printf(
								/* translators: %1$s is replaced with links data */
								esc_html__( '%1$s with Ekiline and %2$s, %3$s.', 'ekiline' ),
								'<a href="' . esc_url( 'https://ekiline.com/gana/' ) . '" target="_blank" rel="noopener">' . esc_html__( 'Make money', 'ekiline' ) . '</a>',
								'<a href="' . esc_url( 'https://ekiline.com/fondeo/' ) . '" target="_blank" rel="noopener">' . esc_html__( 'fund its development', 'ekiline' ) . '</a>',
								'<a href="' . esc_url( 'https://ekiline.com/' ) . '" target="_blank" rel="noopener">' . esc_html__( 'discover how', 'ekiline' ) . '</a>'
							);
							?>
						</p>
					</div>
				</div>
				<div class="welcome-panel-column">
					<div style="padding:4px;">
						<h3><?php esc_html_e( 'About Ekiline', 'ekiline' ); ?></h3>
						<p><?php esc_html_e( 'Ekiline simplifies the creation of a website with WordPress, it is a working method that brings together the standard practices of the internet industry, to facilitate the tasks of planning, design, development and optimization. For more information visit ekiline.com', 'ekiline' ); ?></p>
						<h3><?php esc_html_e( 'About Uri Lazcano', 'ekiline' ); ?></h3>
						<p>
							<span style="float:left;"><?php echo ( function_exists( 'get_avatar' ) ) ? get_avatar( 'uriel@bixnia.com', $size = '60', $default = '' ) : ''; ?></span>
							<?php esc_html_e( 'Frontend designer established in Mexico City. 10 years developing websites and 10 more years of experience in graphic design for advertising. Check my career and work.', 'ekiline' ); ?>
						</p>
						<p>
							<?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://profiles.wordpress.org/urielink/' ), esc_html__( 'WordPress', 'ekiline' ) ); ?>
							| <?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://github.com/Urielink' ), esc_html__( 'Github', 'ekiline' ) ); ?>
							| <?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://www.linkedin.com/in/urielink/' ), esc_html__( 'Linkedin', 'ekiline' ) ); ?>
							| <?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://www.behance.net/Urielink' ), esc_html__( 'Behance', 'ekiline' ) ); ?>
							| <?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://bixnia.com' ), esc_html__( 'B I X N I A', 'ekiline' ) ); ?>
						</p>
					</div>
				</div>
				<div class="welcome-panel-column welcome-panel-last">
					<div style="padding:4px;">
						<h3>
							<span class="dashicons dashicons-book dash-note"></span>
							<?php esc_html_e( 'Ekiline docs', 'ekiline' ); ?>
						</h3>
						<ul>
							<li><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://ekiline.com/instala/' ), esc_html__( 'Install', 'ekiline' ) ); ?></li>
							<li><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://ekiline.com/personaliza/' ), esc_html__( 'Customize', 'ekiline' ) ); ?></li>
							<li><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://ekiline.com/elementos/' ), esc_html__( 'Elements and blocks', 'ekiline' ) ); ?></li>
							<li><?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://ekiline.com/compatible/' ), esc_html__( 'Compatibility', 'ekiline' ) ); ?></li>
						</ul>
						<p><small><strong><?php esc_html_e( 'Limited liability:', 'ekiline' ); ?></strong>
						<?php esc_html_e( 'As a courtesy, we provide information on how to use certain third-party products, but we do not directly support their use and we are not responsible for the functions, reliability or compatibility of such products. The names, trademarks and logos of third parties are registered trademarks of their respective owners.', 'ekiline' ); ?></small></p>
					</div>
				</div>
			</div>

		</div>
	</div>




	<p style="text-align: right;">
		<small>
			<?php
				/* translators: %1$s is replaced with date data */
				printf( esc_html__( '&copy; Copyright %1$s Ekiline', 'ekiline' ), esc_attr( date( 'Y' ) ) );
			?>
			<?php esc_html_e( 'All rights reserved. Ekiline developed by', 'ekiline' ); ?>
			<?php printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://bixnia.com/' ), esc_html__( 'B I X N I A', 'ekiline' ) ); ?>
		</small>
	</p>
</div>

	<?php
}


/**
 * Noticias para el suscriptor de Ekiline, con widget
 *
 * @link https://developer.wordpress.org/reference/functions/the_widget/
 */

// Verificar paginas de administracion.
global $pagenow;
$adminpages = array( 'index.php', 'themes.php', 'tools.php', 'plugins.php' );

if ( in_array( $pagenow, $adminpages, true ) ) {
	add_action( 'admin_notices', 'ekiline_docs_feed' );
	add_action( 'admin_footer', 'ekiline_docs_feed_set' );
}

/**
 * 1) Obtener noticias de Ekiline mediante feed.
 * Setup Feed #155
 */
function ekiline_docs_feed() {
	?>
	<div class="notice notice-success is-dismissible ekiline-notice" style="display: none;">

		<?php
		$rss_instance = array(
			'title'        => 'Ekiline Tips',
			'url'          => 'http://ekiline.com/feed/',
			'items'        => 5,
			'show_summary' => 0,
			'show_author'  => 0,
			'show_date'    => 0,
		);
		$rss_args     = array(
			'before_widget' => '<div class="widget rss-admin-notice %s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		);

		the_widget( 'WP_Widget_RSS', $rss_instance, $rss_args );
		?>
		<div>
			<?php printf( '<a class="button button-primary"  href="%1$s">%2$s</a>', esc_url( 'themes.php?page=ekiline_options' ), esc_html__( 'About', 'ekiline' ) ); ?>
			<?php printf( '<a class="button button-primary"  href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://ekiline.com/compra/' ), esc_html__( 'Get more', 'ekiline' ) ); ?>
			<?php printf( '<a class="button button-primary gold"  href="%1$s" target="_blank">%2$s</a>', esc_url( 'https://ekiline.com/fondeo/' ), esc_html__( 'FundMe', 'ekiline' ) ); ?>
		</div>
	</div>

	<?php
}

/**
 * 2) Agregar comportaminetos JS.
 * Setup JS in Notice #156
 */
function ekiline_docs_feed_set() {
	?>
<script type='text/javascript'>
jQuery(document).ready(function($){
	$('.ekiline-notice').delay(2000).show(100);
	var random = Math.floor(Math.random() * 10) + 1;
	$('.ekiline-notice ul li:nth-child('+random+')').delay(3000).show(100);
});
</script>
	<?php
}

/**
 * 3) Agregar estilos CSS.
 * Setup CSS styles in Notice.
 */
function ekiline_admin_styles() {
	$extracss  = '.gold a::before { content: "\f511";} .gold a{ background-color: #58aa03 !important; } .gold:hover a{ background-color: #ffb900 !important; color: #fff !important; } .gold:hover a::before { content: "\f339"; color: #fff !important; }';
	$extracss .= '.advice a::before { content: "\f325";} .advice a { background-color: #ff7e00 !important; } .advice:hover a { background-color: #ff7e00 !important; color: #fff !important; } .advice:hover a::before { content: "\f325"; color: #fff !important; }';
	$extracss .= 'a.gold{ background-color: #58aa03 !important;border:none !important; } a.gold:hover{ background-color: #ffb900 !important; color: #fff !important; } a.gold:hover .dashicons-carrot::before {content: "\f339";color: #fff !important;}';
	$extracss .= '.dash-note{margin: 0px 10px 0px 0px;float: left;font-size: 20px;}';
	$extracss .= '.ekiline-notice { display:flex;justify-content: space-between;align-items: center; padding:10px; }';
	$extracss .= '.ekiline-notice h2, .ekiline-notice ul, .ekiline-notice li{ margin:0px; }';
	$extracss .= '.ekiline-notice h2{ margin-right:10px; }';
	$extracss .= '.rss-admin-notice{ margin:0px;display:flex;justify-content: space-between;align-items: center; }';
	$extracss .= '.rss-admin-notice ul li{ display:none; }';
	$extracss .= 'a[href^="themes.php?page=ekiline_options"]{background-color:#58aa03;color:#ffffff !important;}';
	$extracss .= 'a[href^="themes.php?page=ekiline_options"]:hover{background-color:#ffb900 !important;}';
	wp_add_inline_style( 'wp-admin', $extracss );
}
add_action( 'admin_enqueue_scripts', 'ekiline_admin_styles' );
