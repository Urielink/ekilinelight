<?php
/**
 * Infinite Scroll
 * https://scripthere.com/simple-infinite-scroll-for-wordpress-sites-without-plugin/
 * https://www.billerickson.net/infinite-scroll-in-wordpress/ 
 * 
 * @package ekiline
 */

/***
	<!-- <div class="infinite"> -->
	<?php //echo do_shortcode('[ajax_posts]'); ?>
	<?php echo script_load_more(); ?>
	<!-- </div> -->
 */

/*
 * initial posts display en shortcode
 */
function script_load_more($args = array()) {
    //initial posts load
    echo '<div id="ajax-primary" class="content-area">';
        echo '<div id="ajax-content" class="content-area">';
            ajax_script_load_more($args);
        echo '</div>';
        echo '<a href="#loadMore" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Load More</a>';
    echo '</div>';
}
//add_shortcode('ajax_posts', 'script_load_more'); // si se desea implementar con shortcode.

/*
 * load more script call back
 */
function ajax_script_load_more($args) {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num = 10;
    //page number
	// $paged = $_POST['page'] + 1;
	$paged = (isset($_POST['page']))?$_POST['page'] : 0;
    //args
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' =>$num,
        'paged'=>$paged
    );
	//query
    $query = new WP_Query($args);
    //check
    if ($query->have_posts()):
        //loop articales
        while ($query->have_posts()): $query->the_post();
            //include articles template
            // include 'ajax-content.php';
			include '/Users/urielink/Sites/wpdev/ekiline/wp-content/themes/ekiline/template-parts/content-infinityscroll.php';
			// get_template_part( 'template-parts/content.php' );
        endwhile;
    else:
        echo 0;
    endif;
    //reset post data
    wp_reset_postdata();
    //check ajax call
    if($ajax) die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_script_load_more', 'ajax_script_load_more');
add_action('wp_ajax_ajax_script_load_more', 'ajax_script_load_more');


function infinity_scroll_js(){ ?>

<script>

jQuery.noConflict($);
/* Ajax functions */
jQuery(document).ready(function($) {
    //find scroll position
    $(window).scroll(function() {
        //init
        var that = $('#loadMore');
        var page = $('#loadMore').data('page');
        var newPage = page + 1;
        var ajaxurl = $('#loadMore').data('url');
        //check
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {

            //ajax call
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    page: page,
                    action: 'ajax_script_load_more'
                },
                error: function(response) {
                    console.log(response);
                },
                success: function(response) {
                    //check
                    if (response == 0) {
                        //check
                        if ($("#no-more").length == 0) {
                            $('#ajax-content').append('<div id="no-more" class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load.</p></div>');
                        }
                        $('#loadMore').hide();
                    } else {
                        $('#loadMore').data('page', newPage);
                        $('#ajax-content').append(response);
                    }
                }
            });
        }
    });
});

</script>
	
<?php }

add_action('wp_footer', 'infinity_scroll_js', 100);



function infinity_scroll_click_js(){ ?>

<script>

jQuery.noConflict($);
/* Ajax functions */
jQuery(document).ready(function($) {
	//onclick
	$("#loadMore").on('click', function(e) {
		//init
		var that = $(this);
		var page = $(this).data('page');
		var newPage = page + 1;
		var ajaxurl = that.data('url');
		//ajax call
		$.ajax({
			url: ajaxurl,
			type: 'post',
			data: {
				page: page,
				action: 'ajax_script_load_more'

			},
			error: function(response) {
				console.log(response);
			},
			success: function(response) {
				//check
				if (response == 0) {
					$('#ajax-content').append('<div class="text-center"><h3>Haz llegado al final</h3><p>Nada más que mostrar.</p></div>');
					$('#loadMore').hide();
				} else {
					that.data('page', newPage);
					$('#ajax-content').append(response);
				}
			}
		});
	});
});

</script>
		
	<?php }
	
// add_action('wp_footer', 'infinity_scroll_click_js', 100);