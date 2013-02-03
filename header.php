<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">
				
    <title> <?php wp_title('|',true,'right'); ?>	<?php bloginfo('name'); ?></title>

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Mono' rel='stylesheet' type='text/css'>
		
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
			<?php wp_head(); ?>	
    </head>
    <body>
			<!--[if lt IE 10]>
				<p class="chromeframe"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.','zoomingintheme');?></p>
			<![endif]-->
			<a href="https://github.com/mimo84/zoomingin"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>
			<header class="main">
				<h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
				<h3><?php bloginfo('description'); ?></h3>
				<?php $header_image = get_header_image(); 
							if( ! empty($header_image) ) :  ?>
								<img src="<?php echo esc_url( $header_image); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
				<?php endif; ?>
			</header>