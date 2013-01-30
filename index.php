<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content">
			<?php 		
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part('partials/post'); ?>
			<?php endwhile; ?>
			<?php endif; ?>
		</div><!-- End Main Content -->
		<div class="pagination">
			<?php
				global $wp_query;

				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' 		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' 	=> '?paged=%#%',
					'type'		=> 'list',
					'current' => max( 1, get_query_var('paged') ),
					'total' 	=> $wp_query->max_num_pages
				) );
			?>
		</div>
	</div><!-- End Container -->

<?php get_footer(); ?>