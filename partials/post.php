<article class="clearfix home">
	<header class="clearfix">
		<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
		<div class="float-left article-infos">
			<span><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time></span> - <span>  <?php
  	comments_number(__('No Comments', 'frank_theme'),
  	                __('One Comment', 'frank_theme'),
  		              __('% Comments', 'frank_theme'));
  ?></span> - <?php the_category(', '); ?>
		</div>
		<div class="float-right">
			<a href="#">Twitter</a> | <a href="#">Facebook</a> | <a href="#">G+</a> | <a href="#">LinkedIn</a>
		</div>
	</header>
	<?php the_content('Read More&hellip;'); ?>
</article>
<hr />