<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content">
			<?php 		
			if (have_posts()) : the_post(); ?>
				<?php get_template_part('partials/post'); ?>
			<?php endif; ?>
			<?php comments_template(); ?>
		</div><!-- End Main Content -->
		
	</div><!-- End Container -->
	
<?php get_footer(); ?>
