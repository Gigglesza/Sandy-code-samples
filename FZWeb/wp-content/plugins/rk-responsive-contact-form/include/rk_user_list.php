<?php 
	global $wpdb;
	$table_name = $wpdb->prefix . "rk_contact";
	$info=$_GET["info"];
	if($info=="del")
	{
		$delid=$_GET["did"];
		
		$wpdb->query("delete from ".$table_name." where `user_id`=".$delid);
		echo "<div style='clear:both;'></div><div class='updated' id='message'><p><strong>:".__('User Record Deleted.','rkcontactform')."</strong>.</p></div>";
	}
?>
<div class="wrap"> 
	 
	<h2><?php _e('List of User Records','rkcontactform');?>
		<a class="button add-new-h2 dateshow" href="#"><?php _e('Export User Records','rkcontactform');?></a>
	</h2>
	<form method="post" name="exportdate" id="exportdateform" action="<?php echo plugins_url();?>/rk-responsive-contact-form/include/userlist_export.php" >	
         <div id="dateexport" style="display:none;width:100%;margin-bottom:10px;">
             <div class="form-wrap">
             <div style="float:left;">
           		  <label><?php _e('From Date','rkcontactform');?></label><input type="text" name="start_date" id="startdate" class="input-txt" value=""/><br/><?php _e('(Format: MM-DD-YYYY)','rkcontactform');?>
             </div>
			 <div style="float:left;margin-left:50px;">
	             <label><?php _e('To Date','rkcontactform');?></label><input type="text" name="end_date" id="enddate" class="input-txt" value=""/><br/><?php _e('(Format: MM-DD-YYYY)','rkcontactform');?>
             </div>
             <div style="float:left;margin-left:50px;margin-top:22px;">
	             <input type="submit" value="<?php _e('Go','rkcontactform');?>" class="button add-new-h2 checkdate" id="submit" name="submit"/>
	             <a class="button add-new-h2 checkcancel" href="#"><?php _e('Cancel','rkcontactform');?></a>
           	 </div>             
             </div>
         </div>
  	</form>
			<?php settings_fields( 'rk-fields' ); ?>	
			<table class="wp-list-table widefat fixed display" id="userlist">
			<caption style="color:#9CC;"><?php _e('Please click on column\'s title to sort the data according to specific column !!!','rkcontactform');?> </caption>
				<thead style="cursor: pointer;">
					<tr>
						<th style="width:50px;text-align:left;"><u><?php _e('Sr. No','rkcontactform');?></u></th>
						<th style="text-align:left;"><u><?php _e('Username','rkcontactform');?></u></th> 
						<th><u><?php _e('Email Address','rkcontactform');?></u></th>                                  
						<th><u><?php _e('Message','rkcontactform');?></u></th>                                  
						<th style="width:95px;text-align:left;"><u><?php _e('Contact Date','rkcontactform');?></u></th>                              
						<th style="width:50px;text-align:center;"><?php _e('Action','rkcontactform');?></th>
					</tr>
				</thead>
				<tbody>				     
					<?php
					$sql = $wpdb->get_results( "select * from ".$table_name." order by user_id DESC" );								
					$no = 1;
					if ( ! empty( $sql ) ) { ?>
						<script type="text/javascript">
							/* <![CDATA[ */
							jQuery(document).ready(function(){
								jQuery('#userlist').dataTable({ "aaSorting": [[ 0, "desc" ]]	});
								jQuery( "#startdate").datepicker();
								jQuery( "#enddate").datepicker();
							});
							jQuery('.dateshow').click(function(){
								jQuery('#dateexport').show();
							});
							jQuery('.checkdate').click(function(){
								if(jQuery('#startdate').val() == '' || jQuery('#enddate').val() == '')
								{
									alert("please select the date");
									return false;
								}
							});
							jQuery('.checkcancel').click(function(){
								var str='';
								jQuery('#dateexport').hide();
								jQuery('#startdate').val(str);
								jQuery('#enddate').val(str);
							});
							/* ]]> */						
						</script><?php
						foreach ( $sql as $user ) {
							$id        = $user->user_id;
							$username  = $user->username;
							$email     = $user->email_id;
							$message   = $user->message;
							$date      = $user->contact_date; ?>
							<tr>
								<td style="width:40px;text-align:center;"><?php echo $no; ?></td>
								<td nowrap><?php echo urldecode($username); ?></td>
								<td nowrap><?php echo $email; ?></td> 
								<td><?php echo $message; ?></td> 
								<td style="text-align:center;"><?php echo $date; ?></td>                
								<td style="width:40px;text-align:center;">								
									<a onclick="javascript:return confirm('Are you sure, want to delete record of <?php echo $username; ?>?')" href="admin.php?page=rk_user_lists&info=del&did=<?php echo $id;?>">
									<img src="<?php echo plugins_url(); ?>/rk-responsive-contact-form/images/delete.png" title="Delete" alt="Delete" style="height:18px;" />
									</a>
								</td>                
							</tr>
						<?php $no += 1;							
						}
					} else {
						echo __('No User Records Found !!! ','rkcontactform');
					} ?>					
				</tbody>
			</table>
</div>			