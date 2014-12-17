<?php
function contactFormShortcode(){ 
wp_register_script( 'jquery.validate', plugins_url().'/rk-responsive-contact-form/js/jquery.validate.js',array('jquery'));

wp_enqueue_script( 'jquery.validate' );

wp_enqueue_style('wp-contact',  plugins_url('/rk-responsive-contact-form/css/contact.css'));

wp_head();

?>

<script type="text/javascript">

	var MyAjax = "<?php echo home_url(); ?>/wp-admin/admin-ajax.php";

	function refreshCaptcha(){

		var img = document.images['captchrkmg'];		

		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;

	}

	function replaceName() 

	{

	   var pattern = /\bscript\b/ig;

	   var mystring = document.getElementById('rk_name').value;

	   var newString = mystring.replace(pattern, " script ");

	   document.getElementById('rk_name').value = newString;

	}

	function replaceWeburl() 

	{

	   var pattern = /\bscript\b/ig;

	   var mystring = document.getElementById('rk_website').value;

	   var newString = mystring.replace(pattern, " script ");

	   document.getElementById('rk_website').value = newString;

	}

	function replaceSubject() 

	{

	   var pattern = /\bscript\b/ig;

	   var mystring = document.getElementById('rk_subject').value;

	   var newString = mystring.replace(pattern, " script ");

	   document.getElementById('rk_subject').value = newString;

	}

	function replaceComment() 

	{

	   var pattern = /\bscript\b/ig;

	   var mystring = document.getElementById('rk_comment').value;

	   var newString = mystring.replace(pattern, " script ");

	   document.getElementById('rk_comment').value = newString;

	}

</script>
<?php 
$data = '
	<div class="responsive-contact-form">
	<div class="alert alert-success" id="smsg" style="display:none">'.__("<strong>Succeed :</strong>Your details are submitted successfully!","rkcontactform").'</div>
	<form class="form-horizontal" name="formValidate" id="ResponsiveContactForm" method="post" >
    <fieldset>';
	if(esc_attr(get_option("rk_visible_name"))=="on") {
    	$data .= '<div class="control-group"><label class="control-label" for="rk_name">'.__('Name','rkcontactform');
		if(esc_attr(get_option('rk_enable_require_name'))=="on"){ 
			$data .= '<span class="req">*</span>'; 
		}
		$data .= '</label>
	      <div class="controls">
		      <input id="rk_name" name="rk_name" maxlength="50" title="'.__('Name','rkcontactform').'" type="text" class="input-xlarge text ';		  
			  if(esc_attr(get_option('rk_enable_require_name'))=="on") { $data .= 'required '; }  $data .= '"onblur="replaceName();">
	      </div>
    </div>';
	}      
	$data .= '
	<div class="control-group">
	<label class="control-label" for="rk_email">'.__('Email','rkcontactform').'<span class="req">*</span></label>
	    <div class="controls">
	    	<input id="rk_email" maxlength="255" name="rk_email" title="'.__('Email ID','rkcontactform').'" type="text"class="input-xlarge email required">
	    </div>
    </div>'; 
	if(esc_attr(get_option('rk_visible_phone'))=="on") { 	
	$data .= '	
    <div class="control-group">
	<label class="control-label" for="rk_phone">'.__('Phone','rkcontactform');
	if(esc_attr(get_option('rk_enable_require_phone'))=="on"){ $data .= '<span class="req">*</span>'; } $data .= '</label>
	    <div class="controls">
		    <input id="rk_phone" maxlength="15" name="rk_phone" title="'.__('Phone','rkcontactform').'" type="text" class="input-xlarge number '; 
			if(esc_attr(get_option('rk_enable_require_phone'))=="on") {$data .= 'required';} $data .= '">
	    </div>
    </div>';
    }	  

    if(esc_attr(get_option('rk_visible_website'))=="on") {       
	$data .= '
	<div class="control-group">
	<label class="control-label" for="rk_website">'.__('URL','rkcontactform');
	if(esc_attr(get_option("rk_enable_require_website"))=="on"){ $data .= '<span class="req">*</span>'; } $data .= '</label>
	    <div class="controls">
		    <input id="rk_website" name="rk_website" title="'.__('Website Url','rkcontactform').'" type="text" class="input-xlarge ';
			if(esc_attr(get_option('rk_enable_require_website'))=="on") { $data .= 'required';} $data .= '"onblur="replaceWeburl();">
	    </div>
    </div>';
    }

    if(esc_attr(get_option('rk_visible_subject'))=="on") { 
    $data .= '<div class="control-group">
	<label class="control-label" for="rk_subject">'.__('Subject','rkcontactform');
	if(esc_attr(get_option('rk_enable_require_subject'))=="on"){ $data .= '<span class="req">*</span>'; } $data .= '</label>
	    <div class="controls">
	    	<input id="rk_subject" name="rk_subject" title="'.__('Subject','rkcontactform').'" type="text" class="input-xlarge '; 
			if(esc_attr(get_option('rk_enable_require_subject'))=="on") {$data .= 'required';} $data .= '"onblur="replaceSubject();">
	    </div>
    </div>';
    }      

    if(esc_attr(get_option('rk_visible_comment'))=="on") { 
    $data .= '<div class="control-group">
	<label class="control-label" for="rk_comment">'.__('Comment','rkcontactform');
	if(esc_attr(get_option('rk_enable_require_comment'))=="on"){ $data .= '<span class="req">*</span>'; } $data .= '</label>
      	<div class="controls">
          <textarea id="rk_comment" name="rk_comment" title="'.__('Comment','rkcontactform').'" rows="4" class="';if(esc_attr(get_option('rk_enable_require_comment'))=="on"){$data .= 'required';} $data .= '" onblur="replaceComment();"></textarea>
        </div>
    </div>';
	} 

    $captcha = get_option('rk_enable_captcha');
    if($captcha)
    {
	$data .= '
    <div class="control-group">
    	<label class="control-label" for="captcha">'.__('Captcha','rkcontactform').'<span class="req">*</span></label>
    <div class="controls">
    <div class="captcha-div"> 
    	<img class="captcha" src="'.plugins_url("/rk-responsive-contact-form/include").'/captcha_code_file.php?rand='.rand().'" id="captchrkmg" onclick="javascript: refreshCaptcha();" alt="'.__('Captcha','rkcontactform').'">
        <a href="javascript: refreshCaptcha();" data-toggle="tooltip" class="ttip" data-placement="right" data-original-title="'.__('Refresh Captcha Code','rkcontactform').'">
        <img id="refresh" src="'.plugins_url("/rk-responsive-contact-form/images/refresh.png").'" alt="Refresh Code">
        </a>
        <input type="text" id="captcha" title="'.__('Captcha Code','rkcontactform').'" class="input-txt required" name="rk_captcha" maxlength="4" style="width:60px;">  
    </div>
    <span id="note"><small>'.__("Captcha is not case sensitive.","rkcontactform").'</small></span> 
    <div class="alert alert-error" id="fmsg" style="display:none">'.__("<strong>Alert :</strong> Invalid captcha code!","rkcontactform").'</div>
    <div class="clear"></div>
    </div>
    </div>';
    }
	
	if(esc_attr(get_option('rk_visible_sendcopy'))=="on") { 
    $data .= '<div class="control-group">
	  	<div class="controls">
		<input type="checkbox" name="rk_sendcopy" id="rk_sendcopy" value="1">'.__('Send me a copy','rkcontactform').'           
        </div>
    </div>';
	} 
    $data .= '<div class="control-group">
		<div class="controls">
			<button id="submit" name="submit" title="'.__('Click to submit the form','rkcontactform').'" class="btn-submit" >
			'.__('Submit','rkcontactform').'
		    </button>
		</div>
	</div>
	</fieldset>
  </form>
</div>';
return $data;
}
?>