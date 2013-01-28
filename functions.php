<?php

add_filter('wp_list_categories', 'zoomingin_remove_category_list_rel');
add_filter('the_category', 'zoomingin_remove_category_list_rel');


if (!is_admin()) {  
	add_action('init', 'zoomingin_enqueue_styles');
	add_action('init', 'zoomingin_enqueue_scripts');
}

// Remove rel attribute from the category list - thanks Joseph (http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/)! 
function zoomingin_remove_category_list_rel($output) {
  $output = str_replace(' rel="category tag"', '', $output);
  return $output;
}

/* Let's add the styles using the built-in wordpress functions */
if (!function_exists('zoomingin_enqueue_styles')) {
	function zoomingin_enqueue_styles() {	
		wp_register_style('zoomignin_stylesheet', get_stylesheet_directory_uri().'/css/styles.css', null, '0.2', 'all' );

		wp_enqueue_style('zoomignin_stylesheet');
		
	}
}

/* The same for the scripts */
if (!function_exists('zoomingin_enqueue_scripts')) {
	function zoomingin_enqueue_scripts() {
		$httpprefix = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "");
		wp_deregister_script('jquery');
		wp_register_script('jquery', $httpprefix . "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
		wp_register_script('zoomingin_modernizr', $httpprefix . "://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js", false, null);
		wp_register_script('zoomingin_jq_plugins', get_stylesheet_directory_uri().'/js/plugins.js', 'jquery', '0.2', 'all');
		wp_register_script('zoomingin_scripts', get_stylesheet_directory_uri().'/js/main.js', 'zoomingin_jq_plugins', '0.2', 'all');
		
   wp_enqueue_script('jquery');
   wp_enqueue_script('zoomingin_modernizr');
   wp_enqueue_script('zoomingin_jq_plugins');
   wp_enqueue_script('zoomingin_scripts');
	}
}
