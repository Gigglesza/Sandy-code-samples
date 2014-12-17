<style>

	#form-settings { padding:1px 10px; margin-top:0px;}
	#form-settings tr,td,th,#email-settings tr,td,th{ padding:5px 10px!important;}
	#form-settings th{ background:#f3f3f3; padding:10px!important;}
/*	#form-settings .field-name{ font-weight: bold; width: 60px; text-align: right; }

	#form-settings .field-status{ width: 60px; text-align: center; }		*/

	#email-settings { border-top: 1px dotted #dfdfdf; width:100%; padding:10px;}

	#email-settings th { width: 140px; }	
	#email-settings td{ padding:10px;}

</style>

<div class="wrap">
 
	<h2><?php _e('RK Responsive Contact Form Settings','rkcontactform');?></h2>

	<div class="postbox" id="poststuff">

		<h3 class="title"><?php _e('Settings','rkcontactform');?></h3>

		<form method="post" action="options.php" name="RKGolbalSiteOptions">

			<?php settings_fields( 'rk-fields' ); ?>

			<table class="form-table" id="form-settings" width="100%">

				<tbody>


					<tr>

						<th class="field-name"><?php _e('<strong>Field Name</strong>','rkcontactform');?></th>

						<th class="field-status"><?php _e('<strong>Select to Show / Hide Fields on form</strong>','rkcontactform');?></th>

						<th><?php _e('<strong>Required / Not Required Fields</strong>','rkcontactform');?></th> 

					</tr>        

					<tr>

						<td class="field-name"><?php _e('Name:','rkcontactform');?></ttd>

						<td class="field-status">

							<input type="checkbox" name="rk_visible_name" onclick="validate_name()" id="rk_visible_name" <?php if(esc_attr(get_option('rk_visible_name'))=="on"){echo "checked";} ?>  />              				

						</td>

						<td>

							<input type="checkbox" name="rk_enable_require_name" <?php if(esc_attr(get_option('rk_visible_name'))==""){ echo 'disabled="disabled"';} ?> id="rk_enable_require_name" <?php if(esc_attr(get_option('rk_enable_require_name'))=="on"){echo "checked";} ?>  />              				

						</td>

					</tr>

					<tr>

						<td class="field-name"><?php _e('Phone:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" name="rk_visible_phone" onclick="validate_phone()" id="rk_visible_phone" <?php if(esc_attr(get_option('rk_visible_phone'))=="on"){echo "checked";} ?>  />              				

						</td>

						<td>

							<input type="checkbox" name="rk_enable_require_phone" <?php if(esc_attr(get_option('rk_visible_phone'))==""){ echo 'disabled="disabled"';} ?> id="rk_enable_require_phone" <?php if(esc_attr(get_option('rk_enable_require_phone'))=="on"){echo "checked";} ?>  />              				

						</td>

					</tr>            

					<tr>

						<td class="field-name"><?php _e('Website:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" name="rk_visible_website" onclick="validate_website()" id="rk_visible_website" <?php if(esc_attr(get_option('rk_visible_website'))=="on"){echo "checked";} ?>  />          				

						</td>

						<td>

							<input type="checkbox" name="rk_enable_require_website" <?php if(esc_attr(get_option('rk_visible_website'))==""){ echo 'disabled="disabled"';} ?> id="rk_enable_require_website" <?php if(esc_attr(get_option('rk_enable_require_website'))=="on"){echo "checked";} ?>  />              				

						</td>

					</tr>

					<tr>

						<td class="field-name"><?php _e('Subject:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" name="rk_visible_subject" onclick="validate_subject()" id="rk_visible_subject" <?php if(esc_attr(get_option('rk_visible_subject'))=="on"){echo "checked";} ?>  />         				

						</td>

						<td>

							<input type="checkbox" name="rk_enable_require_subject" <?php if(esc_attr(get_option('rk_visible_subject'))==""){ echo 'disabled="disabled"';} ?> id="rk_enable_require_subject" <?php if(esc_attr(get_option('rk_enable_require_subject'))=="on"){echo "checked";} ?>  />              				

						</td>

					</tr>

					<tr>

						<td class="field-name"><?php _e('Comment:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" name="rk_visible_comment" onclick="validate_comment()" id="rk_visible_comment" <?php if(esc_attr(get_option('rk_visible_comment'))=="on"){echo "checked";} ?>  />              				

						</td>

						<td>

							<input type="checkbox" name="rk_enable_require_comment" <?php if(esc_attr(get_option('rk_visible_comment'))==""){ echo 'disabled="disabled"';} ?> id="rk_enable_require_comment" <?php if(esc_attr(get_option('rk_enable_require_comment'))=="on"){echo "checked";} ?>  />              				

						</td>

					</tr>

					<tr>

						<td class="field-name"><?php _e('Captcha:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" name="rk_enable_captcha" id="rk_enable_captcha" <?php if(esc_attr(get_option('rk_enable_captcha'))=="on"){echo "checked";} ?>  />                                

						</td>

						<td><?php _e('<strong>Note: </strong>Enable captcha sets by default it to required field.','rkcontactform');?>							

						</td>

					</tr>

					<tr>

						<td class="field-name"><?php _e('Email:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" name="rk_visible_email" onclick="validate_email()" id="rk_visible_email" checked="checked" disabled="disabled" />                             				

						</td>

						<td><?php _e('<strong>Note: </strong>Email field is mandatory.','rkcontactform');?></td>

					</tr>
					<tr>

						<td class="field-name"><?php _e('Send me a copy:','rkcontactform');?></td>

						<td class="field-status">

							<input type="checkbox" align="left" name="rk_visible_sendcopy" id="rk_visible_sendcopy" <?php if(esc_attr(get_option('rk_visible_sendcopy'))=="on"){echo "checked";} ?>  />              				

						</td>
						<td><?php _e('<strong>Note: </strong>Select to show checkbox on form.','rkcontactform');?></td>					       				

					</tr>

					<tr>

						<td colspan="3"></td>                        

					</tr>            

				</tbody>

			</table>            

			<table class="form-table" id="email-settings">

				<tbody>

					<tr>

						<td colspan="3"></td>                        

					</tr> 

					<tr>

						<th><label for="rk_email_address_setting"><?php _e('Email Address:','rkcontactform');?></label></th>

						<td>

							<input type="text" name="rk_email_address_setting" class="regular-text" value="<?php echo esc_attr(get_option('rk_email_address_setting'));?>">							

						</td>

						<td>

							<?php _e('<strong>Note:</strong> You can add multiple email addresses seperated by comma, to send email to multiple users.','rkcontactform');?>

						</td>

					</tr>

					<tr>

						<th><label for="rk_subject_text"><?php _e('Subject Text:','rkcontactform');?></label></th>

						<td>

							<input type="text" name="rk_subject_text" class="regular-text" value="<?php echo esc_attr(get_option('rk_subject_text'));?>">      				

						</td>

						<td>

							<?php _e('<strong>Note:</strong> Default subject text " RK Download " will be used.','rkcontactform');?>

						</td>

					</tr>

					<tr>

						<th><label for="rk_reply_user_message"><?php _e('Reply Message for User:','rkcontactform');?></label></th>

						<td>

							<?php /* <input type="text" name="rk_reply_user_message" class="regular-text" value="<?php echo esc_attr(get_option('rk_reply_user_message'));?>"> */?>

							<textarea name="rk_reply_user_message" rows="5" cols="49" class="regular-text"><?php echo esc_attr(get_option('rk_reply_user_message'));?></textarea>              				           				

						</td>

						<td>

							<?php _e('<strong>Note:</strong> Default Reply Message " Thank you for contacting us...We will get back to you soon... " will be used.','rkcontactform');?> 

						</td>

					</tr> 

					<tr>

						<td colspan="3"></td>                        

					</tr>  

					<tr>

						<td colspan="3">

							<input class="button-primary" type="submit" value="<?php _e('Save All Changes','rkcontactform');?>">

						</td>

					</tr>
 

				</tbody>

			</table>		

		</form>
        <table width="100%">
        		
                
                <tr>

						<td colspan="3" align="left" bgcolor="#FFFF99">

							<?php _e('<p><strong>Note:</strong> You can add <strong> [rk_contact_form] </strong> shortcode where you want to display contact form in pages.</p>','rkcontactform');?>              				

							<?php  _e('<p> OR  You can add <strong> &lt;&#63;php do_shortcode("[rk_contact_form]"); &#63;&gt;</strong> shortcode in any template.</p>','rkcontactform');?>

							<?php  _e('<p> OR  You can add <strong> &lt;&#63;php echo do_shortcode("[rk_contact_form]"); &#63;&gt;</strong> shortcode in any template.</p>','rkcontactform');?>
						
                        <p>
                 <form method="post" action="https://www.paypal.com/cgi-bin/webscr" class="paypal-button" target="_blank" style="opacity: 1;"><input type="hidden" name="button" value="donate"><input type="hidden" name="business" value="nakumkuldip@gmail.com"><input type="hidden" name="item_name" value="RK Responsive contact form wordpress plugin"><input type="hidden" name="quantity" value=""><input type="hidden" name="amount" value=""><input type="hidden" name="currency_code" value=""><input type="hidden" name="shipping" value=""><input type="hidden" name="tax" value=""><input type="hidden" name="notify_url" value="http://rkdownload.com"><input type="hidden" name="cmd" value="_donations"><input type="hidden" name="bn" value="JavaScriptButton_donate"><input type="hidden" name="env" value="www"><input type="image" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!"></form>
                </p>
						</td>
						 
					</tr>
                
                  
        </table>

	</div>

</div>