<?php

function wpscf_admin() {
	global $wpscf_options;
	ob_start(); ?>
	<div class="wrap">
		<?php include ('admin/header.php');?>
		<?php include ('admin/content.php');?>
		<?php include ('admin/footer.php');?>
	</div>
	<?php
	echo ob_get_clean();
}

function wpscf_add_options_link() {
	$icon_url=plugins_url( '/images/Box_tool_sexycontactform_16.png' , __FILE__ );
	
	add_menu_page('Sexy Contact Form', 'Sexy Contact Form', 'manage_options', 'sexycontactform', 'wpscf_admin', $icon_url);
	
	$page1 = add_submenu_page('sexycontactform', 'Sexy Contact Form Overview', 'Overview', 'manage_options', 'sexycontactform', 'wpscf_admin');
	$page2 = add_submenu_page('sexycontactform', 'Forms', 'Forms', 'manage_options', 'sexyforms', 'wpscf_admin');
	$page3 = add_submenu_page('sexycontactform', 'Fields', 'Fields', 'manage_options', 'sexyfields', 'wpscf_admin');
	$page4 = add_submenu_page('sexycontactform', 'Templates', 'Templates', 'manage_options', 'sexytemplates', 'wpscf_admin');
	
	add_action('admin_print_scripts-' . $page1, 'wpscf_load_overview_scripts');
	add_action('admin_print_scripts-' . $page2, 'wpscf_load_forms_scripts');
	add_action('admin_print_scripts-' . $page3, 'wpscf_load_fields_scripts');
	add_action('admin_print_scripts-' . $page4, 'wpscf_load_template_scripts');
}

function wpscf_register_settings() {
	// creates our settings in the options table
	register_setting('wpscf_settings_group', 'wpscf_settings');
}

function wpscf_load_overview_scripts() {
	wp_enqueue_style('wpscf-styles10', plugin_dir_url( __FILE__ ) . 'css/admin.css');
}
function wpscf_load_forms_scripts() {
	wp_enqueue_style('wpgs-styles9', plugin_dir_url( __FILE__ ) . 'css/ui-lightness/jquery-ui-1.10.1.custom.css');
	wp_enqueue_style('wpscf-styles10', plugin_dir_url( __FILE__ ) . 'css/admin.css');

	wp_enqueue_script('wpscf-script14', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery','jquery-ui-core','jquery-ui-sortable', 'jquery-ui-dialog','jquery-ui-tabs'));
	//wp_enqueue_script('wpscf-script15', plugin_dir_url( __FILE__ ) . 'js/admin.js',array('jquery','jquery-ui-core','jquery-ui-accordion','jquery-ui-tabs','jquery-ui-slider'));
}
function wpscf_load_fields_scripts() {
	wp_enqueue_style('wpgs-styles9', plugin_dir_url( __FILE__ ) . 'css/ui-lightness/jquery-ui-1.10.1.custom.css');
	wp_enqueue_style('wpscf-styles10', plugin_dir_url( __FILE__ ) . 'css/admin.css');
	wp_enqueue_style('wpscf-styles11', plugin_dir_url( __FILE__ ) . 'css/options_styles.css');

	wp_enqueue_script('wpscf-script14', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery'));
	//wp_enqueue_script('wpscf-script15', plugin_dir_url( __FILE__ ) . 'js/admin.js',array('jquery','jquery-ui-core','jquery-ui-accordion','jquery-ui-tabs','jquery-ui-slider'));
	wp_enqueue_script('wpscf-script15', plugin_dir_url( __FILE__ ) . 'js/options_functions.js',array('jquery','jquery-ui-core','jquery-ui-sortable', 'jquery-ui-dialog','jquery-ui-tabs'));
}
function wpscf_load_template_scripts() {
	wp_enqueue_style('wpgs-styles1', plugin_dir_url( __FILE__ ) . 'css/ui-lightness/jquery-ui-1.10.1.custom.css');
	wp_enqueue_style('wpscf-styles2', plugin_dir_url( __FILE__ ) . 'css/admin.css');
	wp_enqueue_style('wpscf-styles3', plugin_dir_url( __FILE__ ) . 'css/colorpicker.css');
	wp_enqueue_style('wpscf-styles4', plugin_dir_url( __FILE__ ) . 'css/layout.css');
	wp_enqueue_style('wpscf-styles5', plugin_dir_url( __FILE__ ) . 'css/temp.css');
	wp_enqueue_style('wpscf-styles6', plugin_dir_url( __FILE__ ) . 'css/ui.slider.extras.css');
	wp_enqueue_style('wpscf-styles7', plugin_dir_url( __FILE__ ) . 'css/main.css');

	wp_enqueue_script('wpscf-script1', plugin_dir_url( __FILE__ ) . 'js/admin.js', array('jquery','jquery-ui-core','jquery-ui-sortable', 'jquery-ui-dialog','jquery-ui-tabs'));
	wp_enqueue_script('wpscf-script2', plugin_dir_url( __FILE__ ) . 'js/colorpicker.js', array('jquery','jquery-ui-core'));
	wp_enqueue_script('wpscf-script3', plugin_dir_url( __FILE__ ) . 'js/eye.js', array('jquery','jquery-ui-core'));
	wp_enqueue_script('wpscf-script4', plugin_dir_url( __FILE__ ) . 'js/utils.js', array('jquery','jquery-ui-core'));
	wp_enqueue_script('wpscf-script5', plugin_dir_url( __FILE__ ) . 'js/sexycontactform.js', array('jquery'));
}

add_action('admin_menu', 'wpscf_add_options_link');
add_action('admin_init', 'wpscf_register_settings');