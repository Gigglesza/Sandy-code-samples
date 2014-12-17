<?php
/*
Plugin Name: RK Responsive Contact Form
Plugin URI: http://rkdownload.com 
Description: A simple WordPress plugin that generates a responsive contact form on your website or blog.
Version: 1.0.0
Author: rkdevelopers
Author URI: http://rkdownload.com
Wordpress version supported: 3.0 and above
License: GPL2
*/

define('RK_PDIR_PATH',plugin_dir_path(__FILE__ ));

add_action('plugins_loaded', 'rk_contact_init');
 
/* Activate Hook Plugin */

register_activation_hook(__FILE__,'rk_add_contact_table');

# Load the language files

function rk_contact_init(){

	load_plugin_textdomain( 'rkcontactform', false, plugin_basename( dirname( __FILE__ )  . '/languages/' ));
}



add_action('admin_init', 'rk_register_fields' );

function rk_register_fields(){
	
	  
	register_setting( 'rk-fields', 'rk_email_address_setting' );

	register_setting( 'rk-fields', 'rk_subject_text' );

	register_setting( 'rk-fields', 'rk_reply_user_message' );

	register_setting( 'rk-fields', 'rk_enable_captcha' );

	register_setting( 'rk-fields', 'rk_error_setting' );	

	register_setting( 'rk-fields', 'rk_visible_name' ); 

	register_setting( 'rk-fields', 'rk_enable_require_name' );

	register_setting( 'rk-fields', 'rk_visible_phone' ); 

	register_setting( 'rk-fields', 'rk_enable_require_phone' );

	register_setting( 'rk-fields', 'rk_visible_email' );

	register_setting( 'rk-fields', 'rk_visible_subject' );

	register_setting( 'rk-fields', 'rk_enable_require_subject' );

	register_setting( 'rk-fields', 'rk_visible_website' );

	register_setting( 'rk-fields', 'rk_enable_require_website' );

	register_setting( 'rk-fields', 'rk_visible_comment' );

	register_setting( 'rk-fields', 'rk_enable_require_comment' );
	
	register_setting( 'rk-fields', 'rk_visible_sendcopy' );

}

/*Uninstall Hook Plugin */

if( function_exists('register_uninstall_hook') ){

	register_uninstall_hook(__FILE__,'rk_contact_form_uninstall');			
}

function rk_contact_form_uninstall(){ 

	delete_option('rk_email_address_setting');

	delete_option('rk_enable_captcha');

	delete_option('rk_error_setting');

	delete_option('rk_subject_text');

	delete_option('rk_reply_user_message');

	delete_option('rk_visible_name');

	delete_option('rk_enable_require_name');

	delete_option('rk_visible_phone');

	delete_option('rk_enable_require_phone');

	delete_option('rk_visible_email');

	delete_option('rk_visible_subject');

	delete_option('rk_enable_require_subject');

	delete_option('rk_visible_website');

	delete_option('rk_enable_require_website');

	delete_option('rk_visible_comment');

	delete_option('rk_enable_require_comment');
		 
	delete_option('rk_visible_sendcopy');	 

	global $wpdb;	

	$rk_table_contact_drop = $wpdb->prefix . "rk_contact";  

	$wpdb->query("DROP TABLE IF EXISTS ".$rk_table_contact_drop);
}



add_shortcode('rk_contact_form', 'rk_shortcode');

function rk_shortcode(){

	include_once('include/rk-contact-form-template.php');
	return contactFormShortcode();
}



/* Make RK Contact Settings in Admin Menu Item*/

add_action('admin_menu','rk_contact_setting');
 
/*

* Setup Admin menu item

*/

function rk_contact_setting(){

	add_menu_page(__('RK Contact Form','rkcontactform'),__('RK Contact Form','rkcontactform'),'manage_options','rk_contact','rk_contact_settings',plugins_url('/rk-responsive-contact-form/images/contact_icon.png'),100);
	global $page_options;
	$page_options = add_submenu_page('rk_contact', __('User List','rkcontactform'), __('User List','rkcontactform'),'manage_options', 'rk_user_lists', 'rk_user_list');
}
 
function rk_add_contact_table(){	

	global $wpdb;

	$rk_table_contact = $wpdb->prefix . "rk_contact";			

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');	  

	$wpdb->query("DROP TABLE IF EXISTS ".$rk_table_contact);

	$rk_sql_contact = "CREATE TABLE IF NOT EXISTS $rk_table_contact (

	user_id int(10) NOT NULL AUTO_INCREMENT,

	username varchar(50) NULL,

	email_id varchar(255) NULL,
	
	message varchar(1000) NULL,

	contact_date date NULL,					  					  

	PRIMARY KEY (`user_id`)

	) ";

	dbDelta($rk_sql_contact);

}

function rk_contact_settings(){

	include RK_PDIR_PATH."/include/rk_settings.php";

}

function rk_user_list(){

	include RK_PDIR_PATH."/include/rk_user_list.php";

}

function rk_scripts(){

	wp_enqueue_script( 'jquery' );	
	wp_enqueue_script( 'rk_script', plugins_url( '/js/rk_script.js' , __FILE__ ) );		

	wp_enqueue_script( 'rk_script_table', plugins_url('/js/jquery.dataTables.js' , __FILE__), array( 'jquery' ) );
 
	wp_enqueue_style('wp-datatable',  plugins_url('/rk-responsive-contact-form/css/data_table.css'));
 
}  

add_action( 'admin_enqueue_scripts', 'rk_scripts' );

if(!is_admin()){

	wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	

	wp_enqueue_script( 'my-ajax-request', plugins_url('/js/ajax.js' , __FILE__), array( 'jquery' ), '', true );

}

add_action('wp_ajax_rk_action', 'rk_action_call');

add_action('wp_ajax_nopriv_rk_action', 'rk_action_call');

function rk_action_call(){	

	global $wpdb;

	$data = $_POST['fdata'];
	$returndata = array();

	$strArray = explode("&", $data);

	$i = 0;

	foreach($strArray as $item){

		$array = explode("=", $item);

		$returndata[$array[0]] = $array[1];

	}

	foreach($returndata as $key => $val){

		if($key == 'rk_name'){

			$rk_name = urldecode($val);

		}elseif($key == 'rk_phone'){

			$rk_phone = urldecode($val);

		}elseif($key == 'rk_email'){

			$rk_email = urldecode($val);

		}elseif($key == 'rk_website'){

			$rk_website = urldecode($val);

		}elseif($key == 'rk_subject'){

			$rk_subject = urldecode($val);

		}elseif($key == 'rk_comment'){

			$rk_comment = urldecode($val);

		}elseif($key == 'rk_captcha'){

			$rk_captcha = urldecode($val);

		}elseif($key == 'rk_sendcopy'){

			$sendcopy = $val;

		}		
	}

	if(get_option('rk_email_address_setting')==''){

		$rk_emailadmin = get_option('admin_email');	

	}else{

		$rk_emailadmin = get_option('rk_email_address_setting');

	}

            

	if(get_option('rk_subject_text')==''){

		$rk_subtext = __('RK Download','rkcontactform');

	}else{

		$rk_subtext = get_option('rk_subject_text');

	}

	

	if(get_option('rk_reply_user_message')==''){

		$rk_reply_msg = __('Thank you for contacting us...We will get back to you soon...','rkcontactform');

	}else{

		$rk_reply_msg = get_option('rk_reply_user_message');

	}	

	$arr = 1;

	$enable = get_option('rk_enable_captcha');	

	if($enable == 'on'){

		session_start();

		if(empty($_SESSION['captcha']) || (strcasecmp($_SESSION['captcha'], $rk_captcha) != 0) || trim($rk_captcha) == ''){ 	 

			$arr=2;

		}

	}

	

	// settings for mail received by user

	$rk_subject_mail = __('Reply : ','rkcontactform').$rk_subtext;			

	$rk_headers = "MIME-Version: 1.0\n";

	$rk_headers .= "Content-type: text/html; charset=iso-8859-1\n";

	$rk_headers .= "From:".get_bloginfo('name')." ".$rk_emailadmin."\n";

	$rk_headers .= "Message-Id: <".time()."@".$_SERVER['SERVER_NAME'].">\n";

	$rk_headers .= "X-Mrkler: php-mail-function-0.2\n";

	

	// settings for mail received by admin			

	

	$rk_admin_usermsg = "<table><tr><td colspan='2'><b>".__('User Details','rkcontactform')."</b></td><tr/><tr><td colspan='2' height='40%'></td></tr>";

	

	if(esc_attr(get_option('rk_visible_name'))=="on" && $rk_name != ''){

		$rk_admin_usermsg .= "<tr><td align='left' width='80px'>".__('Name :','rkcontactform')."</td><td>".$rk_name."</td></tr>";

	} 

						

	$rk_admin_usermsg .= "<tr><td align='left' width='80px'>".__('Email ID :','rkcontactform')." </td><td>".$rk_email."</td></tr>";

						

	if(esc_attr(get_option('rk_visible_phone'))=="on" && $rk_phone != ''){

		$rk_admin_usermsg .= "<tr><td align='left' width='70px'>".__('Phone :','rkcontactform')."</td><td>".$rk_phone."</td></tr>";

	}

						

	if(esc_attr(get_option('rk_visible_website'))=="on" && $rk_website != ''){

		$rk_admin_usermsg .= "<tr><td align='left' width='80px'>".__('URL :','rkcontactform')."</td><td>".$rk_website."</td></tr>";

	}

						

	if(esc_attr(get_option('rk_visible_subject'))=="on" && $rk_subject != ''){ 

		$rk_admin_usermsg .= "<tr><td align='left' width='80px'>".__('Subject :','rkcontactform')." </td><td>".$rk_subject."</td></tr>";

	}

						

	if(esc_attr(get_option('rk_visible_comment'))=="on" && $rk_comment != ''){ 

		$rk_admin_usermsg .= "<tr><td align='left' valign='top' width='70px'>".__('Comment : ','rkcontactform')."</td><td>".$rk_comment."</td></tr></table>";		

	}

	

	if($rk_name == ''){	$rk_name = 'User';}

	$rk_admin_subject = $rk_name.__(' has contact us','rkcontactform');		

						

	$rk_admin_headers = "MIME-Version: 1.0\n";

	$rk_admin_headers .= "Content-type: text/html; charset=iso-8859-1\n";	

	//$rk_admin_headers .= "From: ".str_replace(' ', '-', $rk_name)."\n";
	$rk_admin_headers .= "From: ".str_replace(' ', '-', $rk_name)." ".$rk_email."\n";

	$rk_admin_headers .= "Message-Id: <".time()."@".$_SERVER['SERVER_NAME'].">\n";

	$rk_admin_headers .= "X-Mrkler: php-mail-function-0.2\n";

	$rk_usercopy_subject = __('Copy of form submitted','rkcontactform');

	if($arr == 1){		

		mail($rk_email, $rk_subject_mail, $rk_reply_msg, $rk_headers);
		if($sendcopy == 1){
			mail($rk_email, $rk_usercopy_subject, $rk_admin_usermsg, $rk_admin_headers);
		}

		mail($rk_emailadmin, $rk_admin_subject, $rk_admin_usermsg, $rk_admin_headers);

		$date = date("Y-m-d");

		$table_name = $wpdb->prefix."rk_contact";

		$date = current_time( 'mysql' );

		if($rk_name != 'User' && $rk_name != ''){

			$wpdb->insert( $table_name, array("username" => urlencode($rk_name), "email_id" => $rk_email, "message" => $rk_comment, "contact_date" => $date ));

		}else{

			$wpdb->insert( $table_name, array("email_id" => $rk_email, "message" => $rk_comment, "contact_date" => $date ));

		}	

	}

	echo json_encode($arr);	

	die(); 	

}
?>