<?php

add_filter('wp_list_categories', 'zoomingin_remove_category_list_rel');
add_filter('the_category', 'zoomingin_remove_category_list_rel');


if (!is_admin()) {  
	add_action('init', 'zoomingin_enqueue_styles');   
}

// Remove rel attribute from the category list - thanks Joseph (http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/)! 
function zoomingin_remove_category_list_rel($output) {
  $output = str_replace(' rel="category tag"', '', $output);
  return $output;
}

/* Let's add the styles using the built-in wordpress functions */
if (!function_exists('zoomingin_enqueue_styles')) {
	function zoomingin_enqueue_styles() {	
		wp_register_style('zoomignin_stylesheet', get_stylesheet_directory_uri().'/css/styles.css', null, '0.9', 'all' );

		wp_enqueue_style('zoomignin_stylesheet');
		
	}
}