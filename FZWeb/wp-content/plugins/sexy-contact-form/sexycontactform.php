<?php
/*
Plugin Name: Sexy Contact Form
Plugin URI: http://creative-solutions.net/wordpress/creative-contact-form/
Description: The sexiest way to get contacted. See <a href="http://creative-solutions.net/wordpress/creative-contact-form/demo">Sexy Contact Form Demo</a>. 
Author: Creative Solutions
Author URI: http://creative-solutions.net/
Version: 0.9.4
*/

//strat session
if (session_id() == '') {
	session_start();
	//check
}
global $wpscf_db_version;
$plugin_version = '0.9.4';
$wpscf_db_version = '0.9.4';

define('WPSCF_PLUGINS_URL', plugins_url());
define('WPSCF_FOLDER', basename(dirname(__FILE__)));
define('WPSCF_SITE_URL', get_option('siteurl'));

/******************************
* includes
******************************/

if(isset($_GET['act']) && $_GET['act'] == 'submit_data') {
	if(isset($_GET['holder']) && $_GET['holder'] == 'forms')
		include('includes/admin/form_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'fields')
		include('includes/admin/field_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'templates')
		include('includes/admin/template_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'sexyajax')
		include('includes/admin/sexyajax.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'generate_css')
		include('includes/generate.css.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'generate_js')
		include('includes/generate.js.php');
	exit();
}
include('includes/display-functions.php'); // display content functions
include('includes/sexycontactform_widget.php'); // widget
include('includes/admin-page.php'); // the plugin options page HTML and save functions

function wpscf_on_install() {
	include('includes/install/install.sql.php'); // install
}

register_activation_hook(__FILE__, 'wpscf_on_install');

function wpscf_on_uninstall() {
	include('includes/install/uninstall.sql.php'); // uninstall
}

register_uninstall_hook(__FILE__, 'wpscf_on_uninstall');

add_action('wp_ajax_wpscf_send_email', 'wpscf_send_email');
add_action('wp_ajax_nopriv_wpscf_send_email', 'wpscf_send_email');

function wpscf_send_email() {
	include('includes/sendmail.php');
}

?>