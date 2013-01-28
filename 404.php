<?php get_header(); ?>
	
	<div class="container">
		<div class="main_content home">
			<?php
				$home_link = sprintf('<a href="%s" title="%s">%s</a>', home_url(), get_bloginfo('name'),'Home Page');
				echo sprintf('Something wrong... go to the %s', $home_link);
			?>
			<script>
				var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),GOOG_FIXURL_SITE = location.host;
      </script>
      <script src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
		</div><!-- End Main Content -->
	</div><!-- End Container -->

<?php get_footer(); ?>