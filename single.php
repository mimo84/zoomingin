<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content">
			<?php 		
			if (have_posts()) : the_post(); ?>
				<?php get_template_part('partials/post'); ?>

				<div class="prev-link"><?php previous_post_link(); ?> </div>

				<div class="next-link"><?php next_post_link(); ?> </div>

			<?php endif; ?>
			<?php comments_template(); ?>
		</div><!-- End Main Content -->
		
	</div><!-- End Container -->
	
<?php get_footer(); ?>
