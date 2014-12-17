<?php 
global $wpdb;
$id = (int) $_POST['id'];
$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';

$sql = "SELECT COUNT(id) FROM ".$wpdb->prefix."sexy_fields";
$count_fields = $wpdb->get_var($sql);

$id_type = (int) $_POST['id_type'];

if($id == 0 && $count_fields < 5 && $id_type != 13 && $id_type != 14) {
	$sql = "SELECT MAX(`ordering`) FROM `".$wpdb->prefix."sexy_fields` WHERE `id_form` = ". (int) $_POST['id_form'];
	$max_order = $wpdb->get_var($sql) + 1;
	
	$wpdb->query( $wpdb->prepare(
			"
			INSERT INTO ".$wpdb->prefix."sexy_fields
			( 
				`name`, `id_form`, `id_type`, `required`, `published`, `ordering`
			)
			VALUES ( %s, %d, %d, %s, %d, %d )
			",
			$_POST['name'], $_POST['id_form'], $_POST['id_type'], $_POST['required'], $_POST['published'], $max_order
	) );
	
	$insrtid = (int) $wpdb->insert_id;
	if($insrtid != 0) {
		if($task == 'save')
			$redirect = "admin.php?page=sexyfields&act=edit&id=".$insrtid;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=sexyfields&act=new";
		else
			$redirect = "admin.php?page=sexyfields";
	}
	else
		$redirect = "admin.php?page=sexyforms&error=1";
}
elseif($id_type != 13 && $id_type != 14) {
	
	$wpscf_name = isset($_POST['name']) ? $_POST['name'] : '';
	$wpscf_id_form = isset($_POST['id_form']) ? $_POST['id_form'] : 0;
	$wpscf_id_type = isset($_POST['id_type']) ? $_POST['id_type'] : 0;
	$wpscf_required = isset($_POST['required']) ? $_POST['required'] : '0';
	$wpscf_status = isset($_POST['published']) ? $_POST['published'] : 0;
	$wpscf_width = isset($_POST['width']) ? $_POST['width'] : '';
	$wpscf_ordering_field = isset($_POST['ordering_field']) ? $_POST['ordering_field'] : '0';
	$wpscf_show_parent_label = isset($_POST['show_parent_label']) ? $_POST['show_parent_label'] : 1;
	$wpscf_select_default_text = isset($_POST['select_default_text']) ? $_POST['select_default_text'] : '';
	$wpscf_select_no_match_text = isset($_POST['select_no_match_text']) ? $_POST['select_no_match_text'] : '';
	$wpscf_select_show_scroll_after = isset($_POST['select_show_scroll_after']) ? $_POST['select_show_scroll_after'] : 10;
	$wpscf_select_show_search_after = isset($_POST['select_show_search_after']) ? $_POST['select_show_search_after'] : 10;
	$wpscf_upload_button_text = isset($_POST['upload_button_text']) ? $_POST['upload_button_text'] : '';
	$wpscf_upload_minfilesize = isset($_POST['upload_minfilesize']) ? $_POST['upload_minfilesize'] : '';
	$wpscf_upload_maxfilesize = isset($_POST['upload_maxfilesize']) ? $_POST['upload_maxfilesize'] : '';
	$wpscf_upload_acceptfiletypes = isset($_POST['upload_acceptfiletypes']) ? $_POST['upload_acceptfiletypes'] : '';
	$wpscf_upload_minfilesize_message = isset($_POST['upload_minfilesize_message']) ? $_POST['upload_minfilesize_message'] : '';
	$wpscf_upload_maxfilesize_message = isset($_POST['upload_maxfilesize_message']) ? $_POST['upload_maxfilesize_message'] : '';
	$wpscf_upload_acceptfiletypes_message = isset($_POST['upload_acceptfiletypes_message']) ? $_POST['upload_acceptfiletypes_message'] : '';
	$wpscf_captcha_wrong_message = isset($_POST['captcha_wrong_message']) ? $_POST['captcha_wrong_message'] : '';
	
	$q = $wpdb->query( $wpdb->prepare(
			"
			UPDATE ".$wpdb->prefix."sexy_fields
			SET
				`name` = %s, 
				`id_form` = %d, 
				`id_type` = %d, 
				`required` = %s, 
				`published` = %d, 
				`width` = %s, 
				`ordering_field` = %s, 
				`show_parent_label` = %s, 
				`select_default_text` = %s, 
				`select_no_match_text` = %s, 
				`select_show_scroll_after` = %d, 
				`select_show_search_after` = %d, 
				`upload_button_text` = %s, 
				`upload_minfilesize` = %d, 
				`upload_maxfilesize` = %d, 
				`upload_acceptfiletypes` = %s, 
				`upload_minfilesize_message` = %s, 
				`upload_maxfilesize_message` = %s, 
				`upload_acceptfiletypes_message` = %s, 
				`captcha_wrong_message` = %s
			WHERE
				`id` = '".$id."'
			",
			$wpscf_name, $wpscf_id_form, $wpscf_id_type, $wpscf_required, $wpscf_status, $wpscf_width, $wpscf_ordering_field, $wpscf_show_parent_label, $wpscf_select_default_text, $wpscf_select_no_match_text, $wpscf_select_show_scroll_after, $wpscf_select_show_search_after, $wpscf_upload_button_text, $wpscf_upload_minfilesize, $wpscf_upload_maxfilesize, $wpscf_upload_acceptfiletypes, $wpscf_upload_minfilesize_message, $wpscf_upload_maxfilesize_message, $wpscf_upload_acceptfiletypes_message, $wpscf_captcha_wrong_message
	) );
	if($q !== false) {
		if($task == 'save')
			$redirect = "admin.php?page=sexyfields&act=edit&id=".$id;
		elseif($task == 'save_new')
			$redirect = "admin.php?page=sexyfields&act=new";
		else
			$redirect = "admin.php?page=sexyfields";
	}
	else
		$redirect = "admin.php?page=sexyfields&error=1";
}
else {
	$redirect = "admin.php?page=sexyfields&error=1";
}
header("Location: ".$redirect);
exit();
?>