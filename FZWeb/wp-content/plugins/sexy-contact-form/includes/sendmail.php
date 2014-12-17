<?php
error_reporting(0);
header('Content-Type: text/plain');
ob_clean();
global $wpdb;

parse_str($_POST['data'],$wpscf_my_post);

//check captcha  
$captcha_tested = true;
if(isset($wpscf_my_post['sexycontactform_captcha'])) {
	foreach($wpscf_my_post['sexycontactform_captcha'] as $captcha_key => $val) {
		$session_keeper = 'sexy_captcha_'.$captcha_key;
		if(trim(strtolower($val)) != $_SESSION[$session_keeper]) {
			$captcha_tested = false;
			break;
		}
	}
}

define( 'CAPTCHA_TESTED', $captcha_tested );

$module_id = (int) $wpscf_my_post['sexycontactform_module_id'];
$form_id = (int) $wpscf_my_post['sexycontactform_form_id'];
$get_token = (int) $_GET['get_token'];
$session_token = $_SESSION['sexycontactform_token'];
$token = $wpscf_my_post['sexycontactform_token'];

//get form configuration
$query = "
			SELECT
				sp.`email_to`,
				sp.`email_bcc`,
				sp.`email_subject`,
				sp.`email_from`,
				sp.`email_from_name`,
				sp.`email_replyto`,
				sp.`email_replyto_name`,
				sp.`show_back`
			FROM
				`".$wpdb->prefix."sexy_forms` sp
			WHERE sp.published = '1'
			AND sp.id = '".$form_id."'";
$form_data = $wpdb->get_row($query);


//check if captcha exists
$query_captcha = "
			SELECT 
				sp.id 
			FROM 
			`".$wpdb->prefix."sexy_fields` sp 
			WHERE sp.published = '1' 
			AND sp.id_type = '13' 
			AND sp.id_form = '".$form_id."'";
$count_captcha = (int) $wpdb->query($query_captcha);
$captcha_error = false;
if( $count_captcha > 0 && !isset($wpscf_my_post['sexycontactform_captcha']))
	$captcha_error = true;

//get field types array
$query = "
			SELECT
			sp.id,
			st.name as type
			FROM
			`".$wpdb->prefix."sexy_fields` sp
			JOIN `".$wpdb->prefix."sexy_field_types` st ON st.id = sp.id_type
			WHERE sp.published = '1'
			AND sp.id_form = '".$form_id."'
			ORDER BY sp.ordering,sp.id
			";
$types_array_data = $wpdb->get_results($query);
$types_array_index = 1;
$types_array = array();
if(is_array($types_array_data)) {
	for($i=0; $i < count( $types_array_data ); $i++) {
		$type = $types_array_data[$i];
		$type_formated = strtolower(str_replace(' ','-',str_replace('-','',$type->type)));
		if(!in_array($type_formated, $types_array)) {
			$types_array[$types_array_index] = $type_formated;
			$types_array_index ++;
		}
	}
}

$check_token_enable = $form_data->show_back == 1 ? true : false;

if($get_token == 0) {
	if ($token != $session_token && $check_token_enable) {
		echo '[{"invalid":"invalid_token"}]';
	}
	else if (!CAPTCHA_TESTED || $captcha_error) {
		echo '[{"invalid":"invalid_captcha"}]';
	}
	else {
		
		$info = Array();
		
		//get from
		$fromname = get_option( 'blogname', 'Wordpress site' );
		$mailfrom = get_option( 'admin_email', '' );
		if ($mailfrom == '') {
			$info[] = 'Mail from not set in Global Configuration';
		}
		
		//get email to
		$email_to = array();
		if ( $form_data->email_to != '' ) {
			$email_to = explode(',', $form_data->email_to);
		}
		if (count($email_to) == 0) {
			$email_to = $mailfrom;
		}
		
		// Email subject
		$sexycontactform_subject = $form_data->email_subject == '' ? 'Message sent from '.$fromname : $form_data->email_subject;
		
		$sexycontactform_ip = strip_tags($wpscf_my_post['sexycontactform_ip']);
		$sexycontactform_referrer = strip_tags($wpscf_my_post['sexycontactform_referrer']);
		
		//generate the body
		$headers = array();
		$body = '';
		$sender_email = '';
		$sender_name = '';
		$current_index = 1;
		if(isset($wpscf_my_post['sexycontactform_fields'])) {
			foreach($wpscf_my_post['sexycontactform_fields'] as $field_data) {
				$field_label = strip_tags(trim($field_data[1]));
				if(isset($field_data[0])) {
					if(is_array($field_data[0])) {
						$field_value = implode(', ',$field_data[0]);
						$field_value = strip_tags(trim($field_value));
					}
					else
						$field_value = strip_tags(trim($field_data[0]));
				}
				else {
					$field_value = '';
				}
				if($types_array[$current_index] == 'text-area')
					$fields_seperator = ":\n";
				else
					$fields_seperator = ": ";
				if($types_array[$current_index] == 'text-area')
					$fields_end_seperator = "\r\n\n";
				else
					$fields_end_seperator = "\r\n";
				$body .= $field_label.$fields_seperator.$field_value.$fields_end_seperator;
				
				if($types_array[$current_index] == 'email')
					$sender_email = $field_value;
				if($types_array[$current_index] == 'name')
					$sender_name = $field_value;
				$current_index ++;
			}
		}
		
		$body .= 'Referrer: '.$sexycontactform_referrer."\r\n";
		$body .= 'Ip: '.$sexycontactform_ip."\r\n";
		
		//send me a copy check
		if(isset($wpscf_my_post['sexycontactform_send_copy_enable'])) {
			if((int) $wpscf_my_post['sexycontactform_send_copy_enable'] == 1 && $sender_email != '') {
				if(is_array($email_to)) {
					$email_to[] = $sender_email;
				}
				else {
					$email_to_final = array($email_to, $sender_email);
					$email_to = $email_to_final;
				}
			}
		}
		
		//Set Sender
		$sender_email = $form_data->email_from == '' ? ($sender_email == '' ?  $mailfrom : $sender_email) : $form_data->email_from;
		$sender_name = $form_data->email_from_name == '' ? ($sender_name == '' ?  $fromname : $sender_name) : $form_data->email_from_name;
		$headers[] = 'From: '.$sender_name.' <'.$sender_email.'>';
		//$mail->setSender( array( $sender_email, $sender_name ) );
		$info[] = 'Sender set: '.$sender_email;
		
		// set reply to
		$replyto_email = $form_data->email_replyto == '' ? ($sender_email == '' ?  $mailfrom : $sender_email) : $form_data->email_replyto;
		$email_replyto_name = $form_data->email_replyto_name == '' ? ($sender_name == '' ? $fromname : $sender_name) : $form_data->email_replyto_name;
		$headers[] = 'Reply-To: '.$email_replyto_name.' <'.$replyto_email.'>';
		//$mail->addReplyTo( array( $replyto_email, $email_replyto_name) );
		$info[] = 'Reply to set: '.$replyto_email;
		
		// add blind carbon recipient
		if ($form_data->email_bcc != '') {
			$email_bcc = explode(',', $form_data->email_bcc);
			if(is_array($email_bcc)) {
				foreach($email_bcc as $email_bcc_item) {
					$headers[] = 'Bcc: <'.$email_bcc_item.'>';
				}
			}
			//$mail->addBCC($email_bcc);
			$info[] = 'BCC recipients added';
		}
		
		//attach files
		$attach_files = array();
		if(isset($wpscf_my_post['sexycontactform_upload'])) {
			if(is_array($wpscf_my_post['sexycontactform_upload'])) {
				foreach($wpscf_my_post['sexycontactform_upload'] as $file) {
					$file_path = dirname(__FILE__).'/fileupload/files/'.$file;
					$attach_files[] = $file_path;
				}
			}
		}
		
		//send email
		$wpscf_send = wp_mail( $email_to, $sexycontactform_subject, $body, $headers, $attach_files);
		
		if ( $wpscf_send === true ) {
			$wpscf_token = md5(time() * rand(1000,9999));
			$_SESSION['sexycontactform_token'] = $wpscf_token;
			$info[] = 'Email sent successful';
		}
		else $info[] = 'There are problems sending email';
		
		//delete attached files
		if(sizeof($attach_files) > 0) {
			foreach($attach_files as $file) {
				unlink($file);
			}
		}
		//delete uploaded, but deleted files
		if(isset($wpscf_my_post['sexycontactform_removed_upload'])) {
			if(is_array($wpscf_my_post['sexycontactform_removed_upload'])) {
				foreach($wpscf_my_post['sexycontactform_removed_upload'] as $file) {
					$file_path = dirname(__FILE__).'/fileupload/files/'.$file;
					@unlink($file_path);
				}
			}
		}
		
		//generates json output
		echo '[{';
		if(sizeof($info) > 0) {
			echo '"info": ';
			echo '[';
			foreach ($info as $k => $data) {
				$data = str_replace('"','',$data);
				echo '"'.$data.'"';
				if ($k != sizeof($info) - 1)
					echo ',';
			}
			echo ']';
		}
			
		echo '}]';
	}
}
else {
	$wpscf_token = md5(time() * rand(1000,9999));
	$_SESSION['sexycontactform_token'] = $wpscf_token;
	echo $wpscf_token;
}
exit();