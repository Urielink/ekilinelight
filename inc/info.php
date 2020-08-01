<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ekiline
 */

/** 
 * Theming Admin theme page
 * Admin bar button
 * https://codex.wordpress.org/Plugin_API/Action_Reference/wp_before_admin_bar_render
 * https://codex.wordpress.org/Javascript_Reference/ThickBox
 * Y con estilos agregados.
 * https://codex.wordpress.org/Function_Reference/wp_add_inline_style
 * https://gist.github.com/corvannoorloos/43980115659cb5aee571
 * https://wordpress.stackexchange.com/questions/36394/wp-3-3-how-to-add-menu-items-to-the-admin-bar
 * https://wordpress.stackexchange.com/questions/266318/how-to-add-custom-submenu-links-in-wp-admin-menus
 */

function ekiline_bar() {
	global $wp_admin_bar;
    $wp_admin_bar->add_menu( array(
        'id' => 'goekiline',
        'title' => __( 'FundMe', 'ekiline'),
        'href' => 'http://ekiline.com/fondeo/',
        'meta' => array( 
            'class' => 'gold',
            'target' => '_blank'
            ),
        'parent' => 'top-secondary'		
    ) );		
} 
add_action('admin_bar_menu', 'ekiline_bar', 0 ); 

function ekiline_theme_page() {
    add_theme_page( 
    	'Ekiline Menu Page Title', 
    	__( 'About Ekiline', 'ekiline'), 
    	'edit_posts', 
    	'ekiline_options', 
    	'theme_html_page'
    );
}
add_action( 'admin_menu', 'ekiline_theme_page' );
 

function theme_html_page() { ?>

<div class="wrap">
	<h1><span class="dashicons dashicons-layout" aria-hidden="true"></span> <?php _e('About Ekiline for WordPress','ekiline'); ?></h1>
    
	<div id="welcome-panel" class="welcome-panel">
		
		<div class="welcome-panel-content">
	
			<h2><?php _e('Thanks for using this theme!','ekiline'); ?></h2>
			<hr />
			<p class="about-description"><?php _e('Find more information to improve your skills in the personalization of your site.','ekiline'); ?></p>
				
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<div style="padding:4px;">
						<h3><?php _e('Get the definitive version, with more benefits for the distribution of your projects:','ekiline'); ?></h3>
						<ul>
							<li><span class="dashicons dashicons-book dash-note"></span><?php _e('Quick use guide for your clients, in Keynote and Power Point format for editing.','ekiline'); ?></li>
							<li><span class="dashicons dashicons-edit dash-note"></span><?php _e('CSS complementary designs for general theme.','ekiline'); ?></li>
							<li><span class="dashicons dashicons-layout dash-note"></span><?php _e('HTML structures preloaded for use in publications.','ekiline'); ?></li>
							<li><span class="dashicons dashicons-welcome-view-site dash-note"></span><?php _e('Complete theme, without external links, ads or tips.','ekiline'); ?></li>
						</ul>
						<p>
							<a class="button button-primary button-hero" href="<?php _e('http://ekiline.com/compra/','ekiline'); ?>" target="_blank"><span class="dashicons dashicons-cart"></span> <?php _e('Buy and download','ekiline'); ?></a>
						</p>
						<p><span class="dashicons dashicons-carrot"></span> <?php _e('You can also','ekiline'); ?> <a href="<?php _e('http://ekiline.com/fondeo/','ekiline'); ?>" target="_blank"><?php _e('fund the development','ekiline'); ?></a> 
							<?php _e('or','ekiline'); ?> <a href="<?php _e('http://ekiline.com/gana/','ekiline'); ?>" target="_blank"><?php _e('earn money','ekiline'); ?></a> <?php _e('by helping.','ekiline'); ?></p>
					</div>
				</div>
				<div class="welcome-panel-column">
					<div style="padding:4px;">
						<h3><?php _e('About','ekiline'); ?></h3>
						<p><?php _e('Ekiline simplifies the creation of a website with WordPress, it is a working method that brings together the standard practices of the internet industry, to facilitate the tasks of planning, design, development and optimization. For more information visit ekiline.com','ekiline'); ?></p>
						<p><strong><?php _e('Limited liability','ekiline'); ?></strong></p>
						<p><small><?php _e('As a courtesy, we provide information on how to use certain third-party products, but we do not directly support their use and we are not responsible for the functions, reliability or compatibility of such products. The names, trademarks and logos of third parties are registered trademarks of their respective owners.','ekiline'); ?></small></p>
					</div>
				</div>
				<div class="welcome-panel-column welcome-panel-last">
					<div style="padding:4px;">
						<h3><?php _e('Documentation','ekiline'); ?></h3>
						<ul>
							<li><a href="<?php _e('http://ekiline.com/instala/','ekiline'); ?>" target="_blank"> <?php _e('Installation','ekiline'); ?></a></li>
							<li><a href="<?php _e('http://ekiline.com/personaliza/','ekiline'); ?>" target="_blank"> <?php _e('Personalization','ekiline'); ?></a></li>
							<li><a href="<?php _e('http://ekiline.com/elementos/','ekiline'); ?>" target="_blank"> <?php _e('Elements and shortcodes','ekiline'); ?></a></li>
							<li><a href="<?php _e('http://ekiline.com/compatible/','ekiline'); ?>" target="_blank"> <?php _e('Compatibility','ekiline'); ?></a></li>
							<li><?php _e('Edit your HTML presets:','ekiline'); ?></li>
							<li><a href="<?php _e('theme-editor.php?file=template-parts%2Fcustom-layouts.php&theme=ekiline','ekiline'); ?>" target="_blank"> <?php _e('Custom presets','ekiline'); ?></a></li>
						</ul>
					</div>
				</div>
			</div>			
	
		</div>
	</div>   

	<p style="text-align: right;">
        <small>
            <?php printf( esc_html__( '&copy; Copyright %1$s Ekiline', 'ekiline' ), esc_attr( date('Y') ) );?>. 
            <?php _e('All rights reserved. Ekiline developed by','ekiline'); ?> 
            <a href="<?php _e('https://bixnia.com/','ekiline'); ?>" target="_blank"> 
            <?php _e('B&nbsp;I&nbsp;X&nbsp;N&nbsp;I&nbsp;A','ekiline'); ?></a>
        </small>
    </p>
</div>

<?php }


/*
 * Noticias para el suscriptor de Ekiline
 * https://developer.wordpress.org/reference/functions/the_widget/ */

global $pagenow;
$adminpages = array('index.php','edit.php','post.php','themes.php','tools.php','plugins.php');

if ( in_array( $pagenow, $adminpages, true ) ){
    add_action( 'admin_footer', 'ekiline_docs_feed_set' );
    add_action( 'admin_notices', 'ekiline_docs_feed' );
}    

function ekiline_docs_feed() { ?>
    <div class="notice notice-success is-dismissible ekiline-notice" style="display: none;">

        <?php 
        $rssInstance = array(
                'title' => 'Ekiline Tips', 
                'url' => 'http://ekiline.com/feed/', 
                'items' => 10,
                'show_summary' => 0,
                'show_author' => 0,
                'show_date' => 0
        );
        $rssArgs = array(
            'before_widget' => '<div class="widget rss-admin-notice %s">', 
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        );    
        
        the_widget( 'WP_Widget_RSS', $rssInstance, $rssArgs ); 
        ?>
        <div>
            <a class="button button-primary" href="http://ekiline.com/gana/" target="_blank"><?php _e( 'Make money', 'ekiline' ); ?> <i class="far fa-money-bill-alt"></i></a>
            <a class="button button-primary" href="http://ekiline.com/compra/" target="_blank"><?php _e( 'Get more', 'ekiline' ); ?></a>
            <a class="button button-primary" href="themes.php?page=ekiline_options"><?php _e( 'About', 'ekiline' ); ?></a>
        </div>
    </div>

<?php }
// add_action( 'admin_notices', 'ekiline_docs_feed' );

function ekiline_docs_feed_set(){ ?>	        
<script type='text/javascript'>
    jQuery(document).ready(function($){
        $('.ekiline-notice').delay(2000).show(100);
        var random = Math.floor(Math.random() * 10) + 1;;
        $('.ekiline-notice ul li:nth-child('+random+')').delay(3000).show(100);
    });
</script>
<?php }
// add_action( 'admin_footer', 'ekiline_docs_feed_set' );

function ekiline_admin_styles() {
    $extracss = '.gold a::before { content: "\f511";} .gold a{ background-color: #58aa03 !important; } .gold:hover a{ background-color: #ffb900 !important; color: #fff !important; } .gold:hover a::before { content: "\f339"; color: #fff !important; }'; 				    
	$extracss .= '.advice a::before { content: "\f325";} .advice a { background-color: #ff7e00 !important; } .advice:hover a { background-color: #ff7e00 !important; color: #fff !important; } .advice:hover a::before { content: "\f325"; color: #fff !important; }'; 				    
	$extracss .= 'a.gold{ background-color: #58aa03 !important; } a.gold:hover{ background-color: #ffb900 !important; color: #fff !important; } a.gold:hover .dashicons-carrot::before {content: "\f339";color: #fff !important;}'; 				    
    $extracss .= '.dash-note{margin: 0px 10px 0px 0px;float: left;font-size: 20px;}'; 		
    $extracss .= '.ekiline-notice { display:flex;justify-content: space-between;align-items: center; padding:10px; }';
    $extracss .= '.ekiline-notice h2, .ekiline-notice ul, .ekiline-notice li{ margin:0px; }';
    $extracss .= '.ekiline-notice h2{ margin-right:10px; }';
    $extracss .= '.rss-admin-notice { margin:0px;display:flex;justify-content: space-between;align-items: center; }';
    $extracss .= '.rss-admin-notice ul li { display:none; }';
    wp_add_inline_style( 'wp-admin', $extracss );
}
add_action( 'admin_enqueue_scripts', 'ekiline_admin_styles');
