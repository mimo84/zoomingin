<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content home">
			<?php 		
			if (have_posts()) : the_post(); ?>
				<?php get_template_part('partials/post'); ?>
			<?php endif; ?>
		</div><!-- End Main Content -->
		<?php comments_template(); ?>
	</div><!-- End Container -->
	
<?php get_footer(); ?>
