<?php
 
global $wpdb;
$table_name = $wpdb->prefix . "rk_contact";
$act=$_REQUEST["act"];	
	$startdate=$_POST['start_date'];
	$enddate=$_POST['end_date'];	
	$stdateold=split("/",$startdate);
	$stdatenew=$stdateold[2]."-".$stdateold[0]."-".$stdateold[1];
	$endateold=split("/",$enddate);
	$endatenew=$endateold[2]."-".$endateold[0]."-".$endateold[1];
	$export_result = $wpdb->get_results("select * from $table_name where contact_date >= '$stdatenew' and contact_date <= '$endatenew' order by user_id ASC");
	$rs =' 
		<table border="1" cellspacing="1" cellpadding="0">
			<tr>
				<th align="center" valign="middle" colspan="4">'.__('List Of Users Contacted Site','rkcontactform').'</th>				
			</tr>
			<tr>
				<th align="left" valign="middle">'.__('User ID','rkcontactform').'</th>
				<th align="left" valign="middle">'.__('Username','rkcontactform').'</th>
				<th align="left" valign="middle">'.__('Email Address','rkcontactform').'</th>
				<th align="left" valign="middle">'.__('Message','rkcontactform').'</th>
				<th align="left" valign="middle">'.__('Contact Date','rkcontactform').'</th>
			</tr>';
			foreach($export_result as $row)
			{ 								  
				$rs.= '<tr>
					<td align="left" valign="middle">'.$row->user_id.'</td>
					<td align="left" valign="middle">'.$row->username.'</td>
					<td align="left" valign="middle">'.$row->email_id.'</td>
					<td align="left" valign="middle">'.$row->message.'</td>
					<td align="left" valign="middle">'.$row->contact_date.'</td>
				</tr>';
			}
		$rs.= '</table>';
	$filename = "User-list" . date('Y-m-d g-i');
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: xls" . date("Y-m-d") . ".xls");
	header( "Content-disposition: filename=".$filename.".xls");
	echo $rs;
	exit;	
?>