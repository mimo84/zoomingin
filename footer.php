		<footer>
			<div class="footer-content">
			<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
	
				<?php dynamic_sidebar( 'footer-sidebar' ); ?>
	
			<?php endif; ?>
			</div>
		</footer>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
		<?php wp_footer(); ?>
		<!--<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.-->
    </body>
</html>