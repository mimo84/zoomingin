<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content">
			<?php 		
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article class="clearfix">
					<header class="clearfix">
						<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
						<div class="float-left article-infos">
							<span><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></span> - <span>  <?php
						comments_number(__('No Comments', 'zoomingintheme'),
														__('One Comment', 'zoomingintheme'),
														__('% Comments', 'zoomingintheme'));
					?></span> - <?php the_category(', '); ?>
						</div>
						<div class="float-right">
							<a href="#">Twitter</a> | <a href="#">Facebook</a> | <a href="#">G+</a> | <a href="#">LinkedIn</a>
						</div>
					</header>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
			<?php endif; ?>
		</div><!-- End Main Content -->
	</div><!-- End Container -->

<?php get_footer(); ?>