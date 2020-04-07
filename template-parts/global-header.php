<?php
/**
 * El header de ekiline contiene las metaetiquetas escenciales, el resto se incorporan
 * con funciones: Analytics, Searchconsole y las redes sociales. Sucede lo mismo con estilos y scripts.
 * De ese modo solo modificas el controlador de metaetiquetas.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @package ekiline
 */
$url = 'http://localhost/wpdev/ekiline/wp-content/uploads/2008/06/dsc04563.jpg';
if ( is_home() ){
    $title = get_the_title( get_option('page_for_posts', true) );
        $contentfield = get_post_field( 'post_content', get_option('page_for_posts') );
    $content = wp_trim_words( $contentfield, 10, '...' );
}
if( is_singular() ){
    if( has_post_thumbnail() ){
        $url = get_the_post_thumbnail_url();
    }
    $title = get_the_title();
    $content = wp_trim_words( $post->post_content, 10, '...' );
} 
if ( is_archive() || is_category() ){
    $title = get_the_archive_title();
    $content = wp_trim_words( get_the_archive_description(), 10, '...' );
}
?>
<header>
<div class="wp-block-cover has-background-dim-20 has-background-dim has-parallax alignfull" 
    style="background-image:url(<?php echo $url; ?>);height:100vh;color:#fff;margin:0px;flex-direction:column;">
    <h1><?php echo $title; ?></h1>
    <p class="wp-block-cover-text"><?php echo $content; ?></p>
</div>
<!-- <div class="wp-block-cover has-background-dim aligncenter" style="height:100vh;color:#fff;margin:0px;">
    <video class="wp-block-cover__video-background" autoplay="" muted="" loop="" src="http://localhost/wpdev/ekiline/wp-content/uploads/2013/12/2014-slider-mobile-behavior.mov"></video>
    <p class="wp-block-cover-text">Compare the video and image blocks.<br>This block is centered.</p>
</div> -->
</header>