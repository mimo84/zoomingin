<?php
/**
 * Add internazionalization and localization to the theme
 * From SmashingMagazine tutorial:
 * http://wp.smashingmagazine.com/2011/12/29/internationalizing-localizing-wordpress-theme/
 */
add_action('after_setup_theme', 'zoomingin_theme_setup');
function zoomingin_theme_setup(){
    load_theme_textdomain('zoomingintheme', get_template_directory() . '/languages');
}

/**
 * Add sidebars and widgets 
 * We handle them from just one place
 */
add_action('widgets_init', 'zoomingin_sidebars');
function zoomingin_sidebars() {
	register_sidebar(array(
		'name' 					=> __('Right Sidebar','zoomingintheme'),
		'id' 						=> 'right-sidebar',
		'before_widget' => '<div id="%1$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="side-title">',
		'after_title' 	=> '</h4>',
	));
	
	register_sidebar(array(
		'name' 					=> __('Footer Sidebar','zoomingintheme'),
		'id' 						=> 'footer-sidebar',
		'before_widget' => '<div id="%1$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="side-title">',
		'after_title' 	=> '</h4>',
	));
}

/**
 * Add basic support for the header image
 * using the built-in WordPress functionality
 */
$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

/**
 * Since I don't like having the more taking you at the
 * middle of the article I wrote this functionality to 
 * remove the ID from the anchor of the "more" link.
 * 
 * @to-do: add an option to activate/disactivate this functionality
 *
 */
add_filter('the_content_more_link', 'more_link_top');
function more_link_top($more_link) {
	$more_link = preg_replace( '|#more-[0-9]+|', '', $more_link );
	return $more_link;
}

/**
 * Add custom styles for non-administration
 */
if (!is_admin()) {  
	add_action('init', 'zoomingin_enqueue_styles');
	add_action('init', 'zoomingin_enqueue_scripts');
}

if ( ! function_exists( 'zoomignin_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own zoomingintheme_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function zoomignin_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'zoomingintheme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'zoomingintheme' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
				echo get_avatar( $comment, 120 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'zoomingintheme' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'zoomingintheme' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'zoomingintheme' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'zoomingintheme' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'zoomingintheme' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**
 * Remove rel attribute from the category list - thanks Joseph 
 * From Joseph Leedy blog:
 * http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/
 */
add_filter('wp_list_categories', 'zoomingin_remove_category_list_rel');
add_filter('the_category', 'zoomingin_remove_category_list_rel');
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

/* 
 * Add the scripts using the WordPress built-in functionalities and using a 
 * protocol relative URL
 * http://paulirish.com/2010/the-protocol-relative-url/ 
 */
if (!function_exists('zoomingin_enqueue_scripts')) {
	function zoomingin_enqueue_scripts() {
		
		wp_deregister_script('jquery');
		wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
		wp_register_script('zoomingin_modernizr', "//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js", false, null);
		wp_register_script('zoomingin_jq_plugins', get_stylesheet_directory_uri().'/js/plugins.js', 'jquery', '0.2', 'all');
		wp_register_script('zoomingin_scripts', get_stylesheet_directory_uri().'/js/main.js', 'zoomingin_jq_plugins', '0.2', 'all');
			
		wp_enqueue_script('jquery');
		wp_enqueue_script('zoomingin_modernizr');
		wp_enqueue_script('zoomingin_jq_plugins');
		wp_enqueue_script('zoomingin_scripts');
	}
}