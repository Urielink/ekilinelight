<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ekiline
 * @link https://codex.wordpress.org/Settings_API
 * @link https://www.sitepoint.com/create-a-wordpress-theme-settings-page-with-the-settings-api/
 */

/* Alta de pagina en menu lateral */

function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Theme Panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_theme_menu_item()
{
	// add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
	add_theme_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");


/* Formularios de prueba INPUT y CHECKBOX */

function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_layout_element()
{
	?>
		<input type="checkbox" name="theme_layout" value="1" <?php checked(1, get_option('theme_layout'), true); ?> /> 
	<?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	
	add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
    add_settings_field("theme_layout", "Do you want the layout to be responsive?", "display_layout_element", "theme-options", "section");

    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "theme_layout");
}

add_action("admin_init", "display_theme_panel_fields");


/* Formularios de prueba Uso de UPLOAD */

function logo_display()
{
	?>
        <input type="file" name="logo" /> 
        <?php echo get_option('logo'); ?>
   <?php
}

function handle_logo_upload()
{
	if(!empty($_FILES["demo-file"]["tmp_name"]))
	{
		$urls = wp_handle_upload($_FILES["logo"], array('test_form' => FALSE));
	    $temp = $urls["url"];
	    return $temp;   
	}
	  
	return $option;
}

function display_theme_panel_fields_logo()
{
	// add_settings_section("section", "All Settings", null, "theme-options");
	
    add_settings_field("logo", "Logo", "logo_display", "theme-options", "section");  

    register_setting("section", "logo", "handle_logo_upload");
}

add_action("admin_init", "display_theme_panel_fields_logo");


/* Obtener datos */

function print_data(){ 
    $layout = get_option('theme_layout');
    $facebook_url = get_option('facebook_url');
    $twitter_url = get_option('twitter_url');
?>
<div class="wrap">
    <div id="welcome-panel" class="welcome-panel">
        <div class="welcome-panel-content">
            <?php echo $twitter_url;?>
            <hr>
            <?php echo $facebook_url;?>
            <hr>
            <?php echo $layout;?>
            <hr>
        </div>
    </div>
</div>

<?php }

function display_theme_options(){

	// add_settings_section("section", "All Settings", null, "theme-options");
	
    add_settings_field("view-options", "view", "print_data", "theme-options", "section");  

}

add_action("admin_init", "display_theme_options");

