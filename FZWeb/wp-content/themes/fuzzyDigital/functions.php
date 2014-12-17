<?php
// Create nav menu
if (function_exists('register_nav_menus')) {
	register_nav_menus(array('primary' => 'Header Navigation'));
}

if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
}

if (class_exists('MultiPostThumbnails')) {

	new MultiPostThumbnails(array(
	'label' => 'Secondary Image',
	'id' => 'secondary-image',
	'post_type' => 'post'
	 ) );

 }

/* if (function_exists('add_image_size')) {
	add_image_size('featured', 250, 200, true);
	add_image_size('post-thumb', 125, 100, true);
}*/
?>