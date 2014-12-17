<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php 
				wp_title('|', 'true', 'right');
				bloginfo('name');
			?>
		</title>
		<?php wp_enqueue_script("jquery");?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/style.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/skeleton.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head();?>
		
	</head>
	<body>
		<?php show_admin_bar( $bool ); ?>
				<div class="main-nav sixteen columns" id="show-nav">
					<a href="#">Toggle Navigation</a>
				</div>
				<div class="sixteen columns" id="close-nav">
					<a href="#">x</a>
				</div>
				<div class="sixteen columns nav-bar" id="nav-bar">
					<?php wp_nav_menu(array('container_class' => 'main-nav', 'container' => 'nav'));?>
				</div>
		<div class="container">
			<header>
				<div class="sixteen columns clearfix">
					<a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo('template_url');?>/img/fzLogo.png" title="<?php bloginfo('title');?>"/></a>
				</div>
			</header>
