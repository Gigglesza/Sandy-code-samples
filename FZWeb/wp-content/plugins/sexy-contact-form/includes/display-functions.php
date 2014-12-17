<?php
global $wpdb;
global $wpscf_token;
$wpscf_token = '';



function wpscf_sexyform_shortcode_function( $atts ) {
	global $wpscf_token;
	
	extract( shortcode_atts( array(
			'id' => 0,
	), $atts ) );
	
	//set token
	if($wpscf_token == '') {
		$wpscf_token = md5(time() * rand(1000,9999));
		$_SESSION['sexycontactform_token'] = $wpscf_token;
	}

	wpscf_enqueue_front_scripts($id);
	return wpscf_render_form($id);

}
add_shortcode( 'sexyform', 'wpscf_sexyform_shortcode_function' );

//add_action('template_redirect','wpscf_my_shortcode_head');
function wpscf_my_shortcode_head(){
	global $posts;
	global $wpscf_token;
	$pattern = get_shortcode_regex();
	preg_match('/(\[(sexyform) id="([0-9]+)"\])/s', $posts[0]->post_content, $matches);
	if (is_array($matches) && $matches[2] == 'sexyform') {
		$form_id = (int) $matches[3];
		wpscf_enqueue_front_scripts($form_id);
		
		//set token
		$wpscf_token = md5(time() * rand(1000,9999));
		$_SESSION['sexycontactform_token'] = $wpscf_token;
	}
}

function wpscf_enqueue_front_scripts($form_id) {
	global $wpdb;
	
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
	
	wp_enqueue_style('wpscf-styles1', plugin_dir_url( __FILE__ ) . 'assets/css/main.css');
	wp_enqueue_style('wpscf-styles2', plugin_dir_url( __FILE__ ) . 'assets/css/sexycss-ui.css');
	wp_enqueue_style('wpscf-styles3', plugin_dir_url( __FILE__ ) . 'assets/css/sexy-scroll.css');
	wp_enqueue_style('wpscf-styles4' . $form_id, admin_url() . 'admin.php?page=sexyforms&act=submit_data&holder=generate_css&id_form='.$form_id.'&module_id=0');
	if(in_array('file-upload',$types_array)) {
		wp_enqueue_style('wpscf-styles5', plugin_dir_url( __FILE__ ) . '/assets/css/sexy-upload.css');
	}
	
	wp_enqueue_script('wpscf-script1', plugin_dir_url( __FILE__ ) . 'assets/js/sexy-mousewheel.js', array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-draggable'));
	if(in_array('file-upload',$types_array)) {
		wp_enqueue_script('wpscf-script2', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.iframe-transport.js', array('jquery','jquery-ui-core','jquery-ui-widget'));
		wp_enqueue_script('wpscf-script3', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.fileupload.js', array('jquery','jquery-ui-core','jquery-ui-widget'));
		wp_enqueue_script('wpscf-script4', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.fileupload-process.js', array('jquery','jquery-ui-core','jquery-ui-widget'));
		wp_enqueue_script('wpscf-script5', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.fileupload-validate.js', array('jquery','jquery-ui-core','jquery-ui-widget'));
	}
	wp_enqueue_script('wpscf-script6' . $form_id, admin_url() . 'admin.php?page=sexyforms&act=submit_data&holder=generate_js&id_form='.$form_id, array('jquery'));
	wp_enqueue_script('wpscf-script7', plugin_dir_url( __FILE__ ) . 'assets/js/sexycontactform.js', array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-draggable', 'jquery-effects-core'));
	
	
}

function wpscf_make_statistics() {
	if(!file_exists(ABSPATH.PLUGINDIR.'/sexy-contact-form/wpscf.log') and is_writable(ABSPATH.PLUGINDIR.'/sexy-contact-form')) {
		// send domain, for usage statistics 
		// this will run only once

		$domain = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$fh = @fopen('http://creative-solutions.net/make-statistics?ext=ccf-wp&domain='.$domain, 'r');
		@fclose($fh);

		$fh = fopen(ABSPATH.PLUGINDIR.'/sexy-contact-form/wpscf.log', 'a');
		fclose($fh);
	}
}

function wpscf_render_form($form_id) {
	global $wpdb;
	global $wpscf_token;
	
	// get IP
	$REMOTE_ADDR = null;
	if(isset($_SERVER['REMOTE_ADDR'])) {
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
	}
	elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$REMOTE_ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
		$REMOTE_ADDR = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(isset($_SERVER['HTTP_VIA'])) {
		$REMOTE_ADDR = $_SERVER['HTTP_VIA'];
	}
	else { 
		$REMOTE_ADDR = 'Unknown';
	}

	wpscf_make_statistics();
	
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
	
	$query = "
					SELECT
					sp.id,
					sp.name,
					sp.required,
					sp.ordering_field,
					sp.select_default_text,
					sp.show_parent_label,
					sp.select_no_match_text,
					sp.width,
					sp.select_show_scroll_after,
					sp.select_show_search_after,
					sp.upload_button_text,
					sp.upload_minfilesize,
					sp.upload_maxfilesize,
					sp.upload_acceptfiletypes,
					sp.upload_minfilesize_message,
					sp.upload_maxfilesize_message,
					sp.upload_acceptfiletypes_message,
					sp.captcha_wrong_message,
					st.name as type
					FROM
					`".$wpdb->prefix."sexy_fields` sp
					JOIN `".$wpdb->prefix."sexy_field_types` st ON st.id = sp.id_type
					WHERE sp.published = '1'
					AND sp.id_form = '".$form_id."'
					ORDER BY sp.ordering,sp.id
	";
	$field_data = $wpdb->get_results($query);
	
	//get user info
	global $current_user;
	$userRegistered =  $current_user->ID == 0 ? 0 : 1;
	get_currentuserinfo();
	
	$wpscf_username =  $current_user->user_login;
	$wpscf_realname = $current_user->display_name;
	$wpscf_user_email = $current_user->user_email;
	
	ob_start();
	?>
				<div class="sexycontactform_wrapper sexy_form_<?php echo $form_id;?>" <?php if($form_width != '') { echo 'style="width: '.$form_width.' !important"'; }?>>
					<div class="sexycontactform_loading_wrapper"><table style="border: none;width: 100%;height: 100%"><tr><td align="center" valign="middle" style="text-align: center;vertical-align: middle;border: none;"><img src="<?php echo plugin_dir_url( __FILE__ ).'/assets/images/ajax-loader.gif';?>" /></td></tr></table></div>
		 			<div class="sexycontactform_wrapper_inner">
		 				<form class="sexycontactform_form">
				 			<div class="sexycontactform_title"><?php echo $toptxt;?></div>
				 			<?php $pre_hidden = $pretxt == '' ? 'style="display:none"' : '';?><div <?php echo $pre_hidden;?> class="sexycontactform_pre_text"><?php echo $pretxt;?></div>
				 			<div class="sexy_title_holder">&nbsp;</div>
				 			
					 		<?php 
			 				if(sizeof($field_data) > 0) {
			 					$field_index = 1;
			 					for($i=0; $i < count( $field_data ); $i++) {
			 						$field = $field_data[$i];
			 						$field_width = $field->width != '' ? 'style="width: '.$field->width.' !important"' : '';
			 						$field_width_select = $field->width != '' ? $field->width : '';
			 						
			 						$field_name = stripslashes($field->name);
			 						$field_type = strtolower(str_replace(' ','-',str_replace('-','',$field->type)));
			 						$element_id = $field_type.'_'.$module_id.'_'.$field->id;
			 						$required_classname = $field->required == 1 ? 'sexycontactform_required' : '';
			 						$required_symbol = $field->required == 1 ? ' <span class="sexycontactform_field_required">*</span>' : '';
			 						$predefined_value = $field_type == 'name' ? $wpscf_realname : ($field_type == 'email' ? $wpscf_user_email : '');
			 						
			 						//input html
			 						$input_type_text_arrays = array('text-input','name','address','email','phone','number','url');
			 						if(in_array($field_type,$input_type_text_arrays)) {
			 							$input_html = '<div '.$field_width.' class="sexycontactform_input_element '.$required_classname.'"><div class="sexy_input_dummy_wrapper"><input class="sexy_'.$field_type.' '.$required_classname.' sexy_input_reset" pre_value="'.str_replace('"','',$predefined_value).'" value="'.str_replace('"','',$predefined_value).'" type="text" id="'.$element_id.'" name="sexycontactform_fields['.$field_index.'][0]"></div></div>';
			 						}
			 						elseif($field_type == 'text-area') {
			 							$input_html = '<div '.$field_width.' class="sexycontactform_input_element sexy_textarea_wrapper '.$required_classname.'"><div class="sexy_textarea_dummy_wrapper"><textarea class="sexy_textarea sexy_'.$field_type.' '.$required_classname.' sexy_textarea_reset" value="'.$predefined_value.'" cols="30" rows="15" id="'.$element_id.'" name="sexycontactform_fields['.$field_index.'][0]"></textarea></div></div>';
			 						}
			 						elseif($field_type == 'select' || $field_type == 'multiple-select' || $field_type == 'radio' || $field_type == 'checkbox') {
			 							//get child options
			 							$query = "
						 							SELECT
							 							spo.name,
							 							spo.id,
							 							spo.value,
							 							spo.selected
						 							FROM
						 								`".$wpdb->prefix."sexy_form_options` spo
						 							WHERE spo.id_parent = '".$field->id."'
						 							AND spo.showrow = '1'
						 							ORDER BY ";
						 							if($field->ordering_field == 0)
						 								$query .= "spo.ordering";
						 							else
						 								$query .= "spo.name";
			 							$childs_array = $wpdb->get_results($query);
			 							if (sizeof($childs_array) > 0)
			 							{
			 								$childs_length = sizeof($childs_array);
			 								if($field_type == 'select' || $field_type == 'multiple-select') {
			 									$selected_count = 0;
			 									for($key=0; $key < count( $childs_array ); $key++) {
			 										$value = $childs_array[$key];
			 										if($value->selected == 1) {
			 											$selected_count= 1;
			 											break;
			 										}
			 									}
			 									$def_selection = $selected_count == 0 ? 'selected="selected"' : '';
			 									
				 								$show_search = $childs_length >= $field->select_show_search_after ? 'show' : 'hide';
				 								$scroll_after = (int)$field->select_show_scroll_after > 3 ? (int)$field->select_show_scroll_after : 3;
				 								
				 								$multile_info = $field_type == 'multiple-select' ? 'multiple="multiple"' : '';
				 								$multile_info_val = $field_type == 'multiple-select' ? '[]' : '';
				 								$input_html = '<select show_search="'.$show_search.'" scroll_after="'.$scroll_after.'" special_width="'.$field_width_select.'" select_no_match_text="'.stripslashes(str_replace('"','',$field->select_no_match_text)).'" class="will_be_sexy_select '.$required_classname.'" '.$multile_info.' name="sexycontactform_fields['.$field_index.'][0]'.$multile_info_val.'">';
				 								$input_html .= '<option '.$def_selection.' class="def_value" value="sexy_empty">'.$field->select_default_text.'</option>';
				 								$selected = '';
			 									$pre_val='';
				 								$seted_value = false;
				 								for($key=0; $key < count( $childs_array ); $key++) {
			 										$value = $childs_array[$key];
				 									if(!$seted_value && $field_type == 'select' && $value->selected == '1') {
				 										$selected = 'selected="selected"';
				 										$pre_val = 'pre_val="selected"';
				 										$seted_value = true;
				 									}
					 								elseif($field_type == 'multiple-select'  &&  $value->selected == '1') {
				 										$selected = 'selected="selected"';
				 										$pre_val = 'pre_val="selected"';
					 								}
				 									else {
				 										$selected = '';
				 										$pre_val = '';
				 									}
				 									
				 									$input_html .= '<option id="'.$module_id.'_'.$field->id.'_'.$value->id.'" value="'.stripslashes(str_replace('"','',$value->value)).'" '.$selected.' '.$pre_val.'>'.stripslashes($value->name).'</option>';
				 								}
				 								$input_html .= '</select>';
			 								}
			 								elseif($field_type == 'radio' || $field_type == 'checkbox') {
			 									$input_html = '';
			 									$colors_array = array("black","blue","red","litegreen","yellow","liteblue","green","crimson","litecrimson");
			 									$selected = '';
			 									$pre_val='';
			 									$seted_value = false;
			 									for($key=0; $key < count( $childs_array ); $key++) {
			 										$value = $childs_array[$key];
			 										if($field_type == 'radio' && !$seted_value && $value->selected == '1') {
			 											$selected = 'checked="checked"';
			 											$pre_val = 'pre_val="checked"';
			 											$seted_value = true;
			 										}
			 										elseif($field_type == 'checkbox'  &&  $value->selected == '1') {
			 											$selected = 'checked="checked"';
														$pre_val = 'pre_val="checked"';	 											
			 										}
			 										else {
			 											$selected = '';
														$pre_val = '';	 											
			 										}
			 										
			 										$data_color_index = $key % 8;
			 										
			 										$label_class = $field->show_parent_label == 0 ? 'without_parent_label' : '';
			 										$req_symbol = ($field->show_parent_label == 0 && $key == 0) ? $required_symbol : '';
			 										$input_html .= '<div class="answer_name"><label uniq_index="'.$module_id.'_'.$field->id.'_'.$value->id.'" class="twoglux_label '.$label_class.'">'.stripslashes($value->name).' '.$req_symbol.'</label></div>';
			 										$input_html .= '<div class="answer_input">';
			 										
			 										if($field_type == 'radio')
			 											$input_html .= '<input '.$selected.' '.$pre_val.' id="'.$module_id.'_'.$field->id.'_'.$value->id.'" type="radio" class="sexy_ch_r_element sexyform_twoglux_styled elem_'.$module_id.'_'.$field->id.'" value="'.stripslashes(str_replace('"','',$value->value)).'" uniq_index="elem_'.$module_id.'_'.$field->id.'" name="remove_this_partsexycontactform_fields['.$field_index.'][0]" data-color="'.$colors_array[$data_color_index].'" />';
			 										else
			 											$input_html .= '<input '.$selected.' '.$pre_val.' id="'.$module_id.'_'.$field->id.'_'.$value->id.'" type="checkbox" class="sexy_ch_r_element sexyform_twoglux_styled" value="'.stripslashes(str_replace('"','',$value->value)).'" name="sexycontactform_fields['.$field_index.'][0][]" data-color="'.$colors_array[$data_color_index].'" />';
			 										
			 										$input_html .= '</div><div class="sexy_clear"></div>';
			 									}
			 								}
			 							}
			 							else {
			 								$input_html = 'There are no options to be shown.';
			 							}
			 						}
			 						elseif($field_type == 'captcha') {
			 							$input_html = '<img id="sexy_captcha_'.$module_id.'_'.$field->id.'" class="sexy_captcha" src='.plugin_dir_url( __FILE__ ).'captcha.php?fid='.$field->id.'&r='.rand(100000,999999).'" /><div fid="'.$field->id.'" holder="sexy_captcha_'.$module_id.'_'.$field->id.'" class="reload_sexy_captcha"></div><div class="sexy_clear"></div>';
			 							$input_html .= '<div style="width: 200px !important;" class="sexycontactform_input_element sexycontactform_required sexy_captcha_input_wrapper"><div class="sexy_input_dummy_wrapper"><input class="sexy_'.$field_type.' sexycontactform_required sexy_input_reset" value="" type="text" id="'.$element_id.'" name="sexycontactform_captcha['.$field->id.']"></div></div><div class="sexy_captcha_info" style="display:none">'.stripslashes($field->captcha_wrong_message).'</div>';
			 						}
			 						elseif($field_type == 'file-upload') {
			 							$input_html = '
			 											<div class="sexy_fileupload_wrapper">
			 												<span class="sexy_fileupload">
													        	<i class="icon_sexy_plus"></i>
													        	<span>'.$field->upload_button_text.'</span>
													        	<input class="sexy_fileupload_submit" type="file" name="files[]" multiple>
													   		</span>
													   		<div class="sexy_progress">
													       		<div class="bar"></div>
													   		</div>
													   		<div class="sexy_uploaded_files"></div>
													   		<div class="sexy_upload_info" style="display: none" 
				 												upload_maxfilesize="'.$field->upload_maxfilesize.'" 
				 												upload_minfilesize="'.$field->upload_minfilesize.'" 
				 												upload_acceptfiletypes="'.$field->upload_acceptfiletypes.'" 
				 												upload_minfilesize_message="'.str_replace('"','',$field->upload_minfilesize_message).'" 
				 												upload_maxfilesize_message="'.str_replace('"','',$field->upload_maxfilesize_message).'" 
				 												upload_acceptfiletypes_message="'.str_replace('"','',$field->upload_acceptfiletypes_message).'">
				 											</div>
													   		<div class="sexy_clear"></div>
			 											</div>';
			 						}
			 						if($field_type != 'file-upload' && $field_type != 'captcha')
			 							$input_html .= '<input type="hidden" name="sexycontactform_fields['.$field_index.'][1]" value="'.stripslashes(str_replace('"','',$field_name)).'" />';
			 						//start printing html
			 						$radio_checkbox_class = ($field_type == 'radio' || $field_type == 'checkbox' || $field_type == 'file-upload') ? 'sexy_'.$field_type : '';
			 						$radio_checkbox_req_class = ($field_type == 'radio' || $field_type == 'checkbox'  || $field_type == 'file-upload') ? $required_classname : '';
			 						echo '<div class="sexycontactform_field_box '.$radio_checkbox_class.' '.$radio_checkbox_req_class.'">';
			 							$show_label = $field->show_parent_label == 1 ? '' : 'style="display:none !important"';
			 							echo '<label class="sexycontactform_field_name" for="'.$element_id.'" '.$show_label.'>'.$field_name;
			 							if($field_type == 'captcha')
			 								echo ' <span class="sexycontactform_field_required">*</span></label>';
			 							else	
			 								echo $required_symbol.'</label>';
			 							echo $input_html;
			 						echo '</div>';
			 						
			 						$field_index ++;
			 					}
			 				}
			 				
			 				if($send_copy_enable == 1) {
			 					echo '<div class="sexycontactform_field_box">';
				 					echo '
				 							<div class="answer_name"><label uniq_index="'.$module_id.'_0_0" class="twoglux_label without_parent_label">'.$send_copy_text.'</label></div>
				 							<div class="answer_input"><input id="'.$module_id.'_0_0" type="checkbox" class="sexyform_twoglux_styled" value="1" name="sexycontactform_send_copy_enable" data-color="blue" /></div><div class="sexy_clear"></div>';
				 				echo '</div>';
			 				}
			 				?>
			 				
				 			<div class="sexycontactform_submit_wrapper">
				 				<input type="button" value="<?php echo $send_text;?>" class="sexycontactform_send" roll="<?php echo $form_id;?>" />
				 				<input type="button" value="<?php echo $send_new_text;?>" class="sexycontactform_send_new sexycontactform_hidden"  roll="<?php echo $form_id;?>"/>
				 				<div class="sexycontactform_clear"></div>
				 			</div>
				 			<div class="sexycontactform_clear"></div>
				 			<input type="hidden" name="sexycontactform_token" class="sexycontactform_token" value="<?php echo $wpscf_token;?>" />
				 			<input type="hidden" value="<?php echo $REMOTE_ADDR;?>"  name="sexycontactform_ip" />
				 			<input type="hidden" value="<?php echo the_permalink();?>"  name="sexycontactform_referrer" />
				 			<input type="hidden" value="<?php echo $module_id;?>" class="sexycontactform_module_id" name="sexycontactform_module_id" />
				 			<input type="hidden" value="<?php echo $form_id;?>" class="sexycontactform_form_id" name="sexycontactform_form_id" />
			 			</form>
			 			<?php echo '<div class="sexy_clear">&nbsp;</div><div class="powered_by powered_by_'.$templateid.'">Powered By <span>Sexy Contact Form</span></div><div class="sexy_clear">&nbsp;</div>';?>
		 			</div>
		 		</div>
<?php
return ob_get_clean();
}
?>