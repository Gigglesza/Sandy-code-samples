<?php 
global $wpdb;

if($id != 0) {
	//get the rows
	$sql = "SELECT * FROM ".$wpdb->prefix."sexy_forms WHERE id = '".$id."'";
	$row = $wpdb->get_row($sql);
}

//get template sarray
$sql = "SELECT name, id FROM ".$wpdb->prefix."sexy_contact_templates";
$templates = $wpdb->get_results($sql);
?>
<form action="admin.php?page=sexyforms&act=submit_data&holder=templates" method="post" id="wpscf_form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float:right;">
		<button  id="wpscf_form_save" class="button-primary">Save</button>
		<button id="wpscf_form_save_close" class="button">Save & Close</button>
		<button id="wpscf_form_save_new" class="button">Save & New</button>
		<a href="admin.php?page=sexytemplates" id="wpscf_add" class="button"><?php echo $t = $id == 0 ? 'Cancel' : 'Close';?></a>
	</div>
</div>
<table class="wpscf_table">
	<tr>
		<td style="width: 180px;"><label for="wpscf_name" title="New template name">Name <span style="color: red">*</span></label></td>
		<td><input name="name" id="wpscf_name" type="text" value="<?php echo $wpscf_name;?>" class="required" /></td>	
	</tr>
	<tr>
		<td><label for="wpscf_id_template" title="Load default values from this template">Start values</label><br /><a href="http://2glux.com/projects/sexy-contact-form/demo" target="_blank">See Templates Demo</a></td>
		<td>
			<select id="wpscf_id_template" name="id_template">
				<?php 
					foreach($templates as $template) {
						echo '<option value="'.$template->id.'">'.$template->name.'</option>';
					}
				?>
			</select>
		</td>	
	</tr>
	<tr>
		<td><label title="Status">Status</label></td>
		<td>
			<label for="wpscf_status_yes">Published</label>
			<input id="wpscf_status_yes" type="radio" name="published" value="1" checked="checked"  />
			&nbsp;&nbsp;&nbsp;
			<label for="wpscf_status_no">Unpublished</label>
			<input id="wpscf_status_no" type="radio" name="published" value="0" />
		</td>	
	</tr>
</table>
<input type="hidden" name="task" value="" id="wpscf_task">
<input type="hidden" name="id" value="0" >
</form>