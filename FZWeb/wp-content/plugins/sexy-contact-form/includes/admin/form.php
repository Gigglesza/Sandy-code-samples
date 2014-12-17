<?php 
global $wpdb;

if($id != 0) {
//get the rows
$sql = "SELECT * FROM ".$wpdb->prefix."sexy_forms WHERE id = '".$id."'";
$row = $wpdb->get_row($sql);
}

//set variables
$wpscf_name = $id == 0 ? '' : $row->name;
$wpscf_top_text = $id == 0 ? '' : $row->top_text;
$wpscf_pre_text = $id == 0 ? '' : $row->pre_text;
$wpscf_thank_you_text = $id == 0 ? 'Message successfully sent' : $row->thank_you_text;
$wpscf_send_text = $id == 0 ? 'Send' : $row->send_text;
$wpscf_send_new_text = $id == 0 ? 'New email' : $row->send_new_text;
$wpscf_close_alert_text = $id == 0 ? 'Close' : $row->close_alert_text;
$wpscf_form_width = $id == 0 ? '98%' : $row->form_width;
$wpscf_id_template = $id == 0 ? '1' : $row->id_template;
$wpscf_redirect = $id == 0 ? '0' : $row->redirect;
$wpscf_redirect_itemid = $id == 0 ? '' : $row->redirect_itemid;
$wpscf_redirect_url = $id == 0 ? '' : $row->redirect_url;
$wpscf_redirect_delay = $id == 0 ? '' : $row->redirect_delay;
$wpscf_send_copy_enable = $id == 0 ? '1' : $row->send_copy_enable;
$wpscf_send_copy_text = $id == 0 ? 'Send me a copy' : $row->send_copy_text;
$wpscf_email_to = $id == 0 ? '' : $row->email_to;
$wpscf_email_bcc = $id == 0 ? '' : $row->email_bcc;
$wpscf_email_subject = $id == 0 ? '' : $row->email_subject;
$wpscf_email_from = $id == 0 ? '' : $row->email_from;
$wpscf_email_from_name = $id == 0 ? '' : $row->email_from_name;
$wpscf_email_replyto = $id == 0 ? '' : $row->email_replyto;
$wpscf_email_replyto_name = $id == 0 ? '' : $row->email_replyto_name;
$wpscf_shake_count = $id == 0 ? '2' : $row->shake_count;
$wpscf_shake_distanse = $id == 0 ? '10' : $row->shake_distanse;
$wpscf_shake_duration = $id == 0 ? '300' : $row->shake_duration;
$wpscf_status = $id == 0 ? '1' : $row->published;
$wpscf_show_back = $id == 0 ? '1' : $row->show_back;

//getbtemplate sarray
$sql = "SELECT name, id FROM ".$wpdb->prefix."sexy_contact_templates";
$templates = $wpdb->get_results($sql);
?>
<?php $args = array(
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
?>
<?php 
$sql = "SELECT COUNT(id) FROM ".$wpdb->prefix."sexy_forms";
$count_forms = $wpdb->get_var($sql);
if($id == 0 && $count_forms >= 1) {
	?>
	<div style="color: rgb(235, 9, 9);font-size: 16px;font-weight: bold;">Please Upgrade to PRO Version to have more than 1 Sexy Forms!</div>
	<div id="cpanel" style="float: left;">
		<div class="icon" style="float: right;">
			<a href="http://creative-solutions.net/wordpress/creative-contact-form" target="_blank" title="Buy PRO version">
				<table style="width: 100%;height: 100%;text-decoration: none;">
					<tr>
						<td align="center" valign="middle">
							<img src="<?php echo plugins_url( '../images/shopping_cart.png' , __FILE__ );?>" /><br />
							Buy Pro Version
						</td>
					</tr>
				</table>
			</a>
		</div>
	</div>
	<?php 
}
else {
?>
<form action="admin.php?page=sexyforms&act=submit_data&holder=forms" method="post" id="wpscf_form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float:right;">
		<button  id="wpscf_form_save" class="button-primary">Save</button>
		<button id="wpscf_form_save_close" class="button">Save & Close</button>
		<button id="wpscf_form_save_new" class="button">Save & New</button>
		<a href="admin.php?page=sexyforms" id="wpscf_add" class="button"><?php echo $t = $id == 0 ? 'Cancel' : 'Close';?></a>
	</div>
</div>
<table class="wpscf_table">
	<tr>
		<td style="width: 180px;"><label for="wpscf_name" title="Contact Box Name">Name <span style="color: red">*</span></label></td>
		<td><input name="name" id="wpscf_name" type="text" value="<?php echo $wpscf_name;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_top_text" title="Top text">Top text <span style="color: red">*</span></label></td>
		<td><input name="top_text" id="wpscf_top_text" type="text" value="<?php echo $wpscf_top_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_pre_text" title="Pre text">Pre text</label></td>
		<td><input name="pre_text" id="wpscf_pre_text" type="text" value="<?php echo $wpscf_pre_text;?>" class="" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_thank_you_text" title="Message to show, after email successfully sent">Thank You Message</label></td>
		<td><input name="thank_you_text" id="wpscf_thank_you_text" type="text" value="<?php echo $wpscf_thank_you_text;?>" class="" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_send_text" title="Send button text">Send text <span style="color: red">*</span></label></td>
		<td><input name="send_text" id="wpscf_send_text" type="text" value="<?php echo $wpscf_send_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_send_new_text" title="Send new button text">Send new text <span style="color: red">*</span></label></td>
		<td><input name="send_new_text" id="wpscf_send_new_text" type="text" value="<?php echo $wpscf_send_new_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_close_alert_text" title="Close alert box text">Close alert text <span style="color: red">*</span></label></td>
		<td><input name="close_alert_text" id="wpscf_close_alert_text" type="text" value="<?php echo $wpscf_close_alert_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_form_width" title="Form width. Can be a percent, or in pixels.">Form width <span style="color: red">*</span></label></td>
		<td><input name="form_width" id="wpscf_form_width" type="text" value="<?php echo $wpscf_form_width;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_id_template" title="Template">Template <span style="color: red">*</span></label><br /><a href="http://2glux.com/projects/sexy-contact-form/demo" target="_blank">See Templates Demo</a></td>
		<td>
			<select id="wpscf_id_template" name="id_template">
				<?php 
					foreach($templates as $template) {
						$selected = $template->id == $wpscf_id_template ? 'selected="selected"' : '';
						echo '<option value="'.$template->id.'" '.$selected.'>'.$template->name.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td style="height: 15px;" colspan="2"></td>
	</tr>
	<tr>
		<td><label title="Enable Redirect. Redirect to another page, after email has been sent">Enable Redirect</label></td>
		<td>
			<label for="wpscf_redirect_yes">Yes</label>
			<input id="wpscf_redirect_yes" type="radio" name="redirect" value="1" <?php if($wpscf_redirect == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpscf_redirect_no">No</label>
			<input id="wpscf_redirect_no" type="radio" name="redirect" value="0"  <?php if($wpscf_redirect == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<tr>
		<td><label for="wpscf_redirect_itemid" title="Redirect to this menu item, after email has been sent">Redirect menu item</label></td>
		<td>
			<select id="wpscf_redirect_itemid" name="redirect_itemid">
				<?php 
					foreach($pages as $page) {
						$selected = $page->ID == $wpscf_redirect_itemid ? 'selected="selected"' : '';
						echo '<option value="'.$page->ID.'" '.$selected.'>'.$page->post_title.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label for="wpscf_redirect_url" title="Redirect URL. If blank, menu item will be used">Redirect URL</label></td>
		<td><input name="redirect_url" id="wpscf_redirect_url" type="text" value="<?php echo $wpscf_redirect_url;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_redirect_delay" title="Time before redirect (in miliseconds)">Redirect delay</label></td>
		<td><input name="redirect_delay" id="wpscf_redirect_delay" type="text" value="<?php echo $wpscf_redirect_delay;?>" /></td>	
	</tr>
	<tr>
		<td style="height: 15px;" colspan="2"></td>
	</tr>
	<tr>
		<td><label title="Show 'Send me a copy' field">Show send me copy</label></td>
		<td>
			<label for="wpscf_send_copy_enable_yes">Yes</label>
			<input id="wpscf_send_copy_enable_yes" type="radio" name="send_copy_enable" value="1" <?php if($wpscf_send_copy_enable == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpscf_send_copy_enable_no">No</label>
			<input id="wpscf_send_copy_enable_no" type="radio" name="send_copy_enable" value="0"  <?php if($wpscf_send_copy_enable == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
	<tr>
		<td><label for="wpscf_send_copy_text" title="'Send me a copy' text">Send me a copy text <span style="color: red">*</span></label></td>
		<td><input name="send_copy_text" id="wpscf_send_copy_text" type="text" value="<?php echo $wpscf_send_copy_text;?>" class="required" /></td>	
	</tr>
	<tr>
		<td style="height: 15px;" colspan="2"></td>
	</tr>
	<tr>
		<td><label for="wpscf_email_to" title="If blank then message will be sent to email set in global configuration. To add multiple recipitents, seperate them with coma(,)">Email to</label></td>
		<td><input name="email_to" id="wpscf_email_to" type="text" value="<?php echo $wpscf_email_to;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_email_bcc" title="Add bind carbon copy recipitens to the email. To add multiple recipitents, seperate them with coma(,)">Email Bcc</label></td>
		<td><input name="email_bcc" id="wpscf_email_bcc" type="text" value="<?php echo $wpscf_email_bcc;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_email_subject" title="If blank, then (Message sent from SITE NAME) will be used">Email Subject</label></td>
		<td><input name="email_subject" id="wpscf_email_subject" type="text" value="<?php echo $wpscf_email_subject;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_email_from" title="If blank, then it will be set to user inputed email, if it is empty, then to email set in global configuration">Email From</label></td>
		<td><input name="email_from" id="wpscf_email_from" type="text" value="<?php echo $wpscf_email_from;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_email_from_name" title="Email from name">Email From Name</label></td>
		<td><input name="email_from_name" id="wpscf_email_from_name" type="text" value="<?php echo $wpscf_email_from_name;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_email_replyto" title="If blank, then user will reply to user inputed email, if it is empty, then to email set in global configuration">Reply to Email</label></td>
		<td><input name="email_replyto" id="wpscf_email_replyto" type="text" value="<?php echo $wpscf_email_replyto;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_email_replyto_name" title="Reply to Name">Reply to Name</label></td>
		<td><input name="email_replyto_name" id="wpscf_email_replyto_name" type="text" value="<?php echo $wpscf_email_replyto_name;?>" /></td>	
	</tr>
	<tr>
		<td style="height: 15px;" colspan="2"></td>
	</tr>
	<tr>
		<td><label for="wpscf_shake_count" title="How many times shake field, if it is not valid">Shakes Count</label></td>
		<td><input name="shake_count" id="wpscf_shake_count" type="text" value="<?php echo $wpscf_shake_count;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_shake_distanse" title="Shake distanse in pixels">Shakes Distanse</label></td>
		<td><input name="shake_distanse" id="wpscf_shake_distanse" type="text" value="<?php echo $wpscf_shake_distanse;?>" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_shake_duration" title="Shake Duration, set in miliseconds">Shakes Duration</label></td>
		<td><input name="shake_duration" id="wpscf_shake_duration" type="text" value="<?php echo $wpscf_shake_duration;?>" /></td>	
	</tr>
	<tr>
		<td style="height: 15px;" colspan="2"></td>
	</tr>
	<tr>
		<td><label title="Additional anti-spam protection. If you got INVALID TOKEN message, set it to no.">Check Token</label></td>
		<td>
			<label for="wpscf_show_back_yes">Yes</label>
			<input id="wpscf_show_back_yes" type="radio" name="show_back" value="1" <?php if($wpscf_show_back == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpscf_show_back_no">No</label>
			<input id="wpscf_show_back_no" type="radio" name="show_back" value="0"  <?php if($wpscf_show_back == 0) echo 'checked="checked"';?>/>
		</td>		
	</tr>
	<tr>
		<td><label title="Status">Status</label></td>
		<td>
			<label for="wpscf_status_yes">Published</label>
			<input id="wpscf_status_yes" type="radio" name="published" value="1" <?php if($wpscf_status == 1) echo 'checked="checked"';?>  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpscf_status_no">Unpublished</label>
			<input id="wpscf_status_no" type="radio" name="published" value="0"  <?php if($wpscf_status == 0) echo 'checked="checked"';?>/>
		</td>	
	</tr>
</table>
<input type="hidden" name="task" value="" id="wpscf_task">
<input type="hidden" name="id" value="<?php echo $id;?>" >
</form>
<?php }?>