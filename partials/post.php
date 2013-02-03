<article class="clearfix home">
	<header class="clearfix">
		<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
		<div class="float-left article-infos">
			<span><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></span> - <span>  <?php
  	comments_number(__('No Comments', 'zoomingintheme'),
  	                __('One Comment', 'zoomingintheme'),
  		              __('% Comments', 'zoomingintheme'));
  ?></span> - <?php the_category(', '); ?>
		</div>
	</header>
	<?php the_content(__('Read More&hellip;','zoomingintheme')); ?>
</article>
<hr />