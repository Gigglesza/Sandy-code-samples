<?php
error_reporting(0);
header('Content-Type: application/javascript');

global $wpdb;

$form_id = isset($_GET['id_form']) ? (int)$_GET['id_form'] : 0;

//load parameters
$query = "
				SELECT
				sp.`id_template`,
				sp.name,
				sp.top_text,
				sp.pre_text,
				sp.thank_you_text,
				sp.send_text,
				sp.send_new_text,
				sp.close_alert_text,
				sp.form_width,
				sp.redirect,
				sp.redirect_itemid,
				sp.redirect_url,
				sp.redirect_delay,
				sp.shake_count,
				sp.shake_distanse,
				sp.send_copy_enable,
				sp.send_copy_text,
				sp.shake_duration
				FROM
				`".$wpdb->prefix."sexy_forms` sp
				WHERE sp.published = '1'
				AND sp.id = '".$form_id."'";
$form_data = $wpdb->get_row($query);

$templateid = $form_data->id_template;
$toptxt = $form_data->top_text;
$pretxt = $form_data->pre_text;
$form_width = $form_data->form_width;
$redirect_enable =  $form_data->redirect;
$redirect = '';
if ($redirect_enable) {
	$redirectItemId = (int) $form_data->redirect_itemid == 0 ? 1 : (int) $form_data->redirect_itemid;
	$redirectUrl = $form_data->redirect_url;
	if ($redirectUrl != '') {
		$redirect = $redirectUrl;
	} else {
		$args = array(
				'sort_order' => 'ASC',
				'sort_column' => 'post_title',
				'hierarchical' => 1,
				'exclude' => '',
				'include' => '',
				'meta_key' => '',
				'meta_value' => '',
				'authors' => '',
				'child_of' => 0,
				'parent' => -1,
				'exclude_tree' => '',
				'number' => '',
				'offset' => 0,
				'post_type' => 'page',
				'post_status' => 'publish'
		);
		$pages = get_pages($args);
		if(is_array($pages)) {
			foreach($pages as $page) {
				if($page->ID == $redirectItemId)
					$redirect = $page->guid;
			}
		}
	}
}
$redirect_delay = (int) $form_data->redirect_delay;
$thank_you_text = htmlspecialchars($form_data->thank_you_text,ENT_QUOTES);
$send_text = htmlspecialchars($form_data->send_text,ENT_QUOTES);
$send_new_text = htmlspecialchars($form_data->send_new_text,ENT_QUOTES);
$close_alert_text = htmlspecialchars($form_data->close_alert_text,ENT_QUOTES);

//validation options
$shake_count = (int) $form_data->shake_count;
$shake_distanse = (int) $form_data->shake_distanse;
$shake_duration = (int) $form_data->shake_duration;

//send copy options
$send_copy_enable= (int) $form_data->send_copy_enable;
$send_copy_text=htmlspecialchars($form_data->send_copy_text,ENT_QUOTES);

$module_id = 0;

//including custom javascript/////////////////////////////////////////////////////////////////////////////////////////////////
$wpscf_jsinclude = ' if (typeof sexycontactform_shake_count_array === \'undefined\') { var sexycontactform_shake_count_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_shake_count_array['.$form_id.'] = "'.$shake_count.'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_shake_distanse_array === \'undefined\') { var sexycontactform_shake_distanse_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_shake_distanse_array['.$form_id.'] = "'.$shake_distanse.'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_shake_duration_array === \'undefined\') { var sexycontactform_shake_duration_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_shake_duration_array['.$form_id.'] = "'.$shake_duration.'";';


$wpscf_jsinclude .= 'var sexycontactform_path = "'.plugin_dir_url( __FILE__ ).'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_redirect_enable_array === \'undefined\') { var sexycontactform_redirect_enable_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_redirect_enable_array['.$form_id.'] = "'.$redirect_enable.'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_redirect_array === \'undefined\') { var sexycontactform_redirect_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_redirect_array['.$form_id.'] = "'.$redirect.'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_redirect_delay_array === \'undefined\') { var sexycontactform_redirect_delay_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_redirect_delay_array['.$form_id.'] = "'.$redirect_delay.'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_thank_you_text_array === \'undefined\') { var sexycontactform_thank_you_text_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_thank_you_text_array['.$form_id.'] = "'.$thank_you_text.'";';

$wpscf_jsinclude .= ' if (typeof sexycontactform_pre_text_array === \'undefined\') { var sexycontactform_pre_text_array = new Array();};';
$wpscf_jsinclude .= 'sexycontactform_pre_text_array['.$form_id.'] = "'.$pretxt.'";';

$wpscf_jsinclude .= ' if (typeof close_alert_text === \'undefined\') { var close_alert_text = new Array();};';
$wpscf_jsinclude .= 'close_alert_text['.$form_id.'] = "'.$close_alert_text.'";';

$wpscf_jsinclude .= 'sexycontactform_juri = "'.plugin_dir_url( __FILE__ ).'";';

$wpscf_jsinclude .= 'sexycontactform_admin_path = "'.admin_url().'";';

echo $wpscf_jsinclude;