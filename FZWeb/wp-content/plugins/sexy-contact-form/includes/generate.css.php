<?php
error_reporting(0);
header('Content-Type: text/css');

global $wpdb;

$id_form = isset($_GET['id_form']) ? (int)$_GET['id_form'] : 0;

$query = 
						'SELECT '.
						'st.styles styles '.
					'FROM '.
						'`'.$wpdb->prefix.'sexy_forms` sp '.
					'LEFT JOIN '.
						'`'.$wpdb->prefix.'sexy_contact_templates` st ON st.id = sp.id_template ';
$query .=
					'WHERE sp.published = \'1\' AND sp.id = \''.$id_form.'\' ';

$styles_value = $wpdb->get_var($query);

$styles_array = explode('|',$styles_value);
$styles = array();
foreach ($styles_array as $val) {
	$arr = explode('~',$val);
	$styles[$arr[0]] = $arr[1];
}

?>
.sexy_form_<?php echo $id_form;?>.sexycontactform_wrapper {
	border: <?php echo $styles[2];?>px <?php echo $styles[3];?> <?php echo $styles[1];?>;
	background-color: <?php echo $styles[0];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[0];?>', endColorstr='<?php echo $styles[130];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[0];?>), to(<?php echo $styles[130];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[0];?>, <?php echo $styles[130];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[9];?> <?php echo $styles[10];?>px <?php echo $styles[11];?>px <?php echo $styles[12];?>px <?php echo $styles[13];?>px  <?php echo $styles[8];?>;
	-webkit-box-shadow: <?php echo $styles[9];?> <?php echo $styles[10];?>px <?php echo $styles[11];?>px <?php echo $styles[12];?>px <?php echo $styles[13];?>px  <?php echo $styles[8];?>;
	box-shadow: <?php echo $styles[9];?> <?php echo $styles[10];?>px <?php echo $styles[11];?>px <?php echo $styles[12];?>px <?php echo $styles[13];?>px  <?php echo $styles[8];?>;
	
	-webkit-border-top-left-radius: <?php echo $styles[4];?>px;
	-moz-border-radius-topleft: <?php echo $styles[4];?>px;
	border-top-left-radius: <?php echo $styles[4];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[5];?>px;
	-moz-border-radius-topright: <?php echo $styles[5];?>px;
	border-top-right-radius: <?php echo $styles[5];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[6];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[6];?>px;
	border-bottom-left-radius: <?php echo $styles[6];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[7];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[7];?>px;
	border-bottom-right-radius: <?php echo $styles[7];?>px;
	font-family: <?php echo $f = $styles[131] != '' ? $styles[131] : 'inherit';?>;
}
.sexy_form_<?php echo $id_form;?> .sexycontactform_loading_wrapper {
	-webkit-border-top-left-radius: <?php echo $styles[4];?>px;
	-moz-border-radius-topleft: <?php echo $styles[4];?>px;
	border-top-left-radius: <?php echo $styles[4];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[5];?>px;
	-moz-border-radius-topright: <?php echo $styles[5];?>px;
	border-top-right-radius: <?php echo $styles[5];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[6];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[6];?>px;
	border-bottom-left-radius: <?php echo $styles[6];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[7];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[7];?>px;
	border-bottom-right-radius: <?php echo $styles[7];?>px;
}
.sexy_form_<?php echo $id_form;?>.sexycontactform_wrapper:hover {
	-moz-box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
	-webkit-box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
	box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
}
.sexy_form_<?php echo $id_form;?> .sexycontactform_wrapper_inner {
	padding:  <?php echo $styles[207];?>px  <?php echo $styles[214];?>px <?php echo $styles[213];?>px <?php echo $styles[208];?>px;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_title {
	color: <?php echo $styles[20];?>;
	font-size: <?php echo $styles[21];?>px;
	font-style: <?php echo $styles[23];?>;
	font-weight: <?php echo $styles[22];?>;
	text-align: <?php echo $styles[25];?>;
	text-decoration: <?php echo $styles[24];?>;
	text-shadow: <?php echo $styles[28];?>px <?php echo $styles[29];?>px <?php echo $styles[30];?>px <?php echo $styles[27];?>;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_field_name {
	color: <?php echo $styles[31];?>;
	font-size: <?php echo $styles[32];?>px;
	font-style: <?php echo $styles[34];?>;
	font-weight: <?php echo $styles[33];?>;
	text-align: <?php echo $styles[36];?>;
	text-decoration: <?php echo $styles[35];?>;
	text-shadow: <?php echo $styles[38];?>px <?php echo $styles[39];?>px <?php echo $styles[40];?>px <?php echo $styles[37];?>;
	margin:  <?php echo $styles[215];?>px  <?php echo $styles[216];?>px <?php echo $styles[217];?>px <?php echo $styles[218];?>px;
}

.sexy_form_<?php echo $id_form;?> .answer_name label {
	color: <?php echo $styles[31];?>;
	font-size: <?php echo $styles[32] - 1;?>px;
	font-style: <?php echo $styles[34];?>;
	font-weight: <?php echo $styles[33];?>;
	text-decoration: <?php echo $styles[35];?>;
	text-shadow: <?php echo $styles[38];?>px <?php echo $styles[39];?>px <?php echo $styles[40];?>px <?php echo $styles[37];?>;
}
.sexy_form_<?php echo $id_form;?> .answer_name label.without_parent_label {
	font-size: <?php echo $styles[32];?>px;
}

.sexy_form_<?php echo $id_form;?> .sexy_uploaded_file {
	color: <?php echo $styles[31];?>;
	font-size: <?php echo $styles[32] - 1;?>px;
	font-style: <?php echo $styles[34];?>;
	font-weight: <?php echo $styles[33];?>;
	text-decoration: <?php echo $styles[35];?>;
	text-shadow: <?php echo $styles[38];?>px <?php echo $styles[39];?>px <?php echo $styles[40];?>px <?php echo $styles[37];?>;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_field_required {
	color: <?php echo $styles[41];?>;
	font-size: <?php echo $styles[42];?>px;
	font-style: <?php echo $styles[44];?>;
	font-weight: <?php echo $styles[43];?>;
	text-shadow: <?php echo $styles[47];?>px <?php echo $styles[48];?>px <?php echo $styles[49];?>px <?php echo $styles[46];?>;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_send,.sexy_form_<?php echo $id_form;?> .sexycontactform_send_new {
	background-color: <?php echo $styles[91];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[91];?>', endColorstr='<?php echo $styles[50];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[91];?>), to(<?php echo $styles[50];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[91];?>, <?php echo $styles[50];?>);/* Opera 11.10+ */
	
	padding: <?php echo $styles[92];?>px <?php echo $styles[93];?>px;
	-moz-box-shadow: <?php echo $styles[95];?> <?php echo $styles[96];?>px <?php echo $styles[97];?>px <?php echo $styles[98];?>px <?php echo $styles[99];?>px  <?php echo $styles[94];?>;	
	-webkit-box-shadow: <?php echo $styles[95];?> <?php echo $styles[96];?>px <?php echo $styles[97];?>px <?php echo $styles[98];?>px <?php echo $styles[99];?>px  <?php echo $styles[94];?>;	
	box-shadow: <?php echo $styles[95];?> <?php echo $styles[96];?>px <?php echo $styles[97];?>px <?php echo $styles[98];?>px <?php echo $styles[99];?>px  <?php echo $styles[94];?>;	
	border-style: <?php echo $styles[127];?>;
	border-width: <?php echo $styles[101];?>px;
	border-color: <?php echo $styles[100];?>;
	
	-webkit-border-top-left-radius: <?php echo $styles[102];?>px;
	-moz-border-radius-topleft: <?php echo $styles[102];?>px;
	border-top-left-radius: <?php echo $styles[102];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[103];?>px;
	-moz-border-radius-topright: <?php echo $styles[103];?>px;
	border-top-right-radius: <?php echo $styles[103];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[104];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[104];?>px;
	border-bottom-left-radius: <?php echo $styles[104];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[105];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[105];?>px;
	border-bottom-right-radius: <?php echo $styles[105];?>px;
	float: <?php echo $styles[212];?>;

	font-size: <?php echo $styles[107];?>px;
	color: <?php echo $styles[106];?>;
	font-style: <?php echo $styles[109];?>;
	font-weight: <?php echo $styles[108];?>;
	text-decoration: <?php echo $styles[110];?>;
	font-family: <?php echo $f = $styles[112] != '' ? $styles[112] : 'inherit';?>;
	text-shadow: <?php echo $styles[114];?>px <?php echo $styles[115];?>px <?php echo $styles[116];?>px <?php echo $styles[113];?>;
}
.sexy_form_<?php echo $id_form;?> .sexycontactform_send:hover,.sexy_form_<?php echo $id_form;?> .sexycontactform_send_new:hover, 
.sexy_form_<?php echo $id_form;?> .sexycontactform_send:active,.sexy_form_<?php echo $id_form;?> .sexycontactform_send_new:active, 
.sexy_form_<?php echo $id_form;?> .sexycontactform_send:focus,.sexy_form_<?php echo $id_form;?> .sexycontactform_send_new:focus
{
	padding: <?php echo $styles[92];?>px <?php echo $styles[93];?>px;
	font-size: <?php echo $styles[107];?>px;
	background-color: <?php echo $styles[51];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[51];?>', endColorstr='<?php echo $styles[52];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[51];?>), to(<?php echo $styles[52];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[51];?>, <?php echo $styles[52];?>);/* Opera 11.10+ */
	
	color: <?php echo $styles[124];?>;
	text-shadow: <?php echo $styles[114];?>px <?php echo $styles[115];?>px <?php echo $styles[116];?>px <?php echo $styles[125];?>;
	-moz-box-shadow: <?php echo $styles[118];?> <?php echo $styles[119];?>px <?php echo $styles[120];?>px <?php echo $styles[121];?>px <?php echo $styles[122];?>px  <?php echo $styles[117];?>;
	-webkit-box-shadow: <?php echo $styles[118];?> <?php echo $styles[119];?>px <?php echo $styles[120];?>px <?php echo $styles[121];?>px <?php echo $styles[122];?>px  <?php echo $styles[117];?>;
	box-shadow: <?php echo $styles[118];?> <?php echo $styles[119];?>px <?php echo $styles[120];?>px <?php echo $styles[121];?>px <?php echo $styles[122];?>px  <?php echo $styles[117];?>;
	border-style: <?php echo $styles[127];?>;
	border-width: <?php echo $styles[101];?>px;
	border-color: <?php echo $styles[126];?>;
}
		        	
.sexy_form_<?php echo $id_form;?> .sexycontactform_submit_wrapper {
	width: 	<?php echo $styles[209];?>%;
	margin: <?php echo $styles[210];?>px <?php echo $styles[211];?>px <?php echo $styles[219];?>px <?php echo $styles[220];?>px;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element input,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element textarea,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element{
	font-size: <?php echo $styles[148];?>px;
	color: <?php echo $styles[147];?>;
	font-style: <?php echo $styles[150];?>;
	font-weight: <?php echo $styles[149];?>;
	text-decoration: <?php echo $styles[151];?>;
	font-family: <?php echo $f = $styles[152] != '' ? $styles[152] : 'inherit';?>;
	text-shadow: <?php echo $styles[154];?>px <?php echo $styles[155];?>px <?php echo $styles[156];?>px <?php echo $styles[153];?>;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element:hover,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element:focus,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element.focused {
	background-color: <?php echo $styles[157];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[157];?>', endColorstr='<?php echo $styles[158];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[157];?>), to(<?php echo $styles[158];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[157];?>, <?php echo $styles[158];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[163];?> <?php echo $styles[164];?>px <?php echo $styles[165];?>px <?php echo $styles[166];?>px <?php echo $styles[167];?>px  <?php echo $styles[162];?>;
	-webkit-box-shadow: <?php echo $styles[163];?> <?php echo $styles[164];?>px <?php echo $styles[165];?>px <?php echo $styles[166];?>px <?php echo $styles[167];?>px  <?php echo $styles[162];?>;
	box-shadow: <?php echo $styles[163];?> <?php echo $styles[164];?>px <?php echo $styles[165];?>px <?php echo $styles[166];?>px <?php echo $styles[167];?>px  <?php echo $styles[162];?>;
	border-style: <?php echo $styles[136];?>;
	border-width: <?php echo $styles[135];?>px;
	border-color: <?php echo $styles[161];?>;
}
.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element.closed:hover {
	width:<?php echo $styles[168];?>%;
	background-color: <?php echo $styles[132];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[132];?>', endColorstr='<?php echo $styles[133];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[132];?>), to(<?php echo $styles[133];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[132];?>, <?php echo $styles[133];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[142];?> <?php echo $styles[143];?>px <?php echo $styles[144];?>px <?php echo $styles[145];?>px <?php echo $styles[146];?>px  <?php echo $styles[141];?>;	
	-webkit-box-shadow: <?php echo $styles[142];?> <?php echo $styles[143];?>px <?php echo $styles[144];?>px <?php echo $styles[145];?>px <?php echo $styles[146];?>px  <?php echo $styles[141];?>;		
	box-shadow: <?php echo $styles[142];?> <?php echo $styles[143];?>px <?php echo $styles[144];?>px <?php echo $styles[145];?>px <?php echo $styles[146];?>px  <?php echo $styles[141];?>;		
	border-style: <?php echo $styles[136];?>;
	border-width: <?php echo $styles[135];?>px;
	border-color: <?php echo $styles[134];?>;
	
	-webkit-border-top-left-radius: <?php echo $styles[137];?>px;
	-moz-border-radius-topleft: <?php echo $styles[137];?>px;
	border-top-left-radius: <?php echo $styles[137];?>px;
	
	-webkit-border-top-right-radius: <?php echo $styles[138];?>px;
	-moz-border-radius-topright: <?php echo $styles[138];?>px;
	border-top-right-radius: <?php echo $styles[138];?>px;
	
	-webkit-border-bottom-left-radius: <?php echo $styles[139];?>px;
	-moz-border-radius-bottomleft: <?php echo $styles[139];?>px;
	border-bottom-left-radius: <?php echo $styles[139];?>px;
	
	-webkit-border-bottom-right-radius: <?php echo $styles[140];?>px;
	-moz-border-radius-bottomright: <?php echo $styles[140];?>px;
	border-bottom-right-radius: <?php echo $styles[140];?>px;

}
.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element input:hover,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element input:focus,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element textarea:hover,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element textarea:focus,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element.focused input,.sexy_form_<?php echo $id_form;?> .sexycontactform_input_element.focused textarea {
	color: <?php echo $styles[159];?>;
	text-shadow: <?php echo $styles[154];?>px <?php echo $styles[155];?>px <?php echo $styles[156];?>px <?php echo $styles[160];?>;
}

.sexy_form_<?php echo $id_form;?> .sexy_textarea_wrapper {
	width:<?php echo $styles[169];?>%;
	height:<?php echo $styles[170];?>px;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_error .sexycontactform_field_name,.sexy_form_<?php echo $id_form;?> .sexycontactform_error .sexycontactform_field_name:hover {
	color: <?php echo $styles[171];?>;
	text-shadow: <?php echo $styles[173];?>px <?php echo $styles[174];?>px <?php echo $styles[175];?>px <?php echo $styles[172];?>;
}
.sexy_form_<?php echo $id_form;?> .sexycontactform_error .sexycontactform_input_element,.sexy_form_<?php echo $id_form;?> .sexycontactform_error .sexycontactform_input_element:hover {
	background-color: <?php echo $styles[176];?>;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $styles[176];?>', endColorstr='<?php echo $styles[177];?>'); /* for IE */
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $styles[176];?>), to(<?php echo $styles[177];?>));/* Safari 4-5, Chrome 1-9 */
	background: -webkit-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>); /* Safari 5.1, Chrome 10+ */
	background: -moz-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>);/* Firefox 3.6+ */
	background: -ms-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>);/* IE 10 */
	background: -o-linear-gradient(top, <?php echo $styles[176];?>, <?php echo $styles[177];?>);/* Opera 11.10+ */
	
	-moz-box-shadow: <?php echo $styles[185];?> <?php echo $styles[186];?>px <?php echo $styles[187];?>px <?php echo $styles[188];?>px <?php echo $styles[189];?>px  <?php echo $styles[184];?>;	
	-webkit-box-shadow: <?php echo $styles[185];?> <?php echo $styles[186];?>px <?php echo $styles[187];?>px <?php echo $styles[188];?>px <?php echo $styles[189];?>px  <?php echo $styles[184];?>;		
	box-shadow: <?php echo $styles[185];?> <?php echo $styles[186];?>px <?php echo $styles[187];?>px <?php echo $styles[188];?>px <?php echo $styles[189];?>px  <?php echo $styles[184];?>;		
	border-color: <?php echo $styles[178];?>;
	
}
.sexy_form_<?php echo $id_form;?> .sexycontactform_error input,.sexy_form_<?php echo $id_form;?> .sexycontactform_error .sexy_input_dummy_wrapper,.sexy_form_<?php echo $id_form;?> .sexycontactform_error input:hover,.sexy_form_<?php echo $id_form;?> .sexycontactform_error .focused input:hover,.sexy_form_<?php echo $id_form;?> .sexycontactform_error .focused input,.sexy_form_<?php echo $id_form;?> .sexycontactform_error .focused textarea,.sexy_form_<?php echo $id_form;?> .sexycontactform_error textarea,.sexy_form_<?php echo $id_form;?> .sexycontactform_error textarea:hover {
	
	color: <?php echo $styles[179];?>;
	text-shadow: <?php echo $styles[181];?>px <?php echo $styles[182];?>px <?php echo $styles[183];?>px <?php echo $styles[180];?>;
}

.sexy_form_<?php echo $id_form;?> .sexycontactform_pre_text {
	margin: <?php echo $styles[190];?>px 0 <?php echo $styles[191];?>px 0;
	padding: <?php echo $styles[193];?>px 0 0 0;
	width: <?php echo $styles[192];?>%;
	
	font-size: <?php echo $styles[198];?>px;
	color: <?php echo $styles[197];?>;
	font-style: <?php echo $styles[200];?>;
	font-weight: <?php echo $styles[199];?>;
	text-decoration: <?php echo $styles[201];?>;
	font-family: <?php echo $f = $styles[202] != '' ? $styles[202] : 'inherit';?>;
	text-shadow: <?php echo $styles[204];?>px <?php echo $styles[205];?>px <?php echo $styles[206];?>px <?php echo $styles[203];?>;
	
	border-top: <?php echo $styles[194];?>px <?php echo $styles[196];?> <?php echo $styles[195];?>;
}