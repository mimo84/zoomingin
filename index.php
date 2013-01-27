<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content home">
			<?php 		
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part('partials/post'); ?>
			<?php endwhile; ?>
			<?php endif; ?>
		</div><!-- End Main Content -->
		<?php
			$next = get_next_posts_link();
			$prev = get_previous_posts_link();
		?>
		<?php if($next || $prev): ?>	
		<div class="pagination row">			
			<?php if($next): ?>
				<a href='<?php echo next_posts(false, 0 ); ?>' class='btn btn-main'> <?php _e('Older Entries', 'frank_theme') ?> </a>
			<?php endif; ?>
			<?php if($prev): ?>
				<a href='<?php echo previous_posts(false, 0 ); ?>' class='btn btn-main'> <?php _e('Newer Entries', 'frank_theme') ?> </a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div><!-- End Container -->

<?php get_footer(); ?>