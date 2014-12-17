(function($) {
$(document).ready(function() {
	
	var disableBlur = false;
	
    $.fn.shake = function (options) {
        // defaults
        var settings = {
            'shakes': 3,
            'distance': 10,
            'duration':300
        };
        // merge options
        if (options) {
            $.extend(settings, options);
        };
        // make it so
        var pos;
        return this.each(function () {
            $this = $(this);
            // position if necessary
            pos = $this.css('position');
            if (!pos || pos === 'static') {
                $this.css('position', 'relative');
            };
            // shake it
            for (var x = 1; x <= settings.shakes; x++) {
                $this.animate({ left: settings.distance * -1 }, (settings.duration / settings.shakes) / 4)
                    .animate({ left: settings.distance }, (settings.duration / settings.shakes) / 2)
                    .animate({ left: 0 }, (settings.duration / settings.shakes) / 4);
            };
        });
    };
    
	//function to validate name types
	 function validate_name($t,shakeEnable) {
	    var required = $t.hasClass('sexycontactform_required') ? true : false;
	    var value = $.trim( $t.val() );
	    if((!required && value == '') || value.length > 0)
	    	$t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		else {
			$t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		}
	 };
	 
	 //function to validate address types
	 function validate_address($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 if((!required && value == '') || value.length > 0)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate text-input types
	 function validate_simple_text($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 if((!required && value == '') || value.length > 0)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate text-input types
	 function validate_text_area($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 if((!required && value == '') || value.length > 0)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate name types
	 function validate_email($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 var i = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value);
		 if((!required && value == '') || i)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate phone types
	 function validate_phone($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 var i = /^[0-9\-\(\)\_\:\+ ]+$/i.test(value);
		 if((!required && value == '') || i)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate number types
	 function validate_number($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 var i = /^[0-9]+$/i.test(value);
		 if((!required && value == '') || i)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate url types
	 function validate_url($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var value = $.trim( $t.val() );
		 var i = /^(((ht|f){1}(tp:[/][/]){1})|((www.){1}))[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+$/i.test(value);

		 if((!required && value == '') || i)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				$t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate select types
	 function validate_select($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 $t.prev('select').addClass('sss');
		 var value = '';
		 $t.prev('select').find('option').each(function() {
			 var sel = $(this).attr('selected');
			 if(sel == 'selected')
				 value = $(this).val();
		 });
		 if(!required || value !='sexy_empty')
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				 $t.shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate multiple select types
	 function validate_multiple_select($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var selected = $t.prev('select').find('option:first-child').attr("selected");
		 
		 var has_option = selected == 'selected' ? false : true;
		 
		 if(!required || has_option)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				 $t.shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate radio types
	 function validate_radio($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var checked_count = 0;
		 $t.find('input.sexy_ch_r_element').each(function() {
			 if($(this).attr('checked') == 'checked')
				 checked_count ++;
		 });
		 
		 if(!required || checked_count == 1)
			 $t.removeClass('sexycontactform_error');
		 else {
			 $t.addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				 $t.find('.answer_input').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate checkbox types
	 function validate_checkbox($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var checked_count = 0;
		 $t.find('input.sexy_ch_r_element').each(function() {
			 if($(this).attr('checked') == 'checked')
				 checked_count ++;
		 });
		 if(!required || checked_count >= 1)
			 $t.removeClass('sexycontactform_error');
		 else {
			 $t.addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				 $t.find('.answer_input').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate file upload
	 function validate_file_upload($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var uploads_count = $t.find('.sexy_active_upload').length;
		 if(!required || uploads_count >= 1)
			 $t.removeClass('sexycontactform_error');
		 else {
			 $t.addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				 $t.find('.sexy_fileupload').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
	 
	 //function to validate captcha
	 function validate_captcha($t,shakeEnable) {
		 var required = $t.hasClass('sexycontactform_required') ? true : false;
		 var captcha_length = $.trim($t.val()).length;
		 if(!required || captcha_length >= 3)
			 $t.parents('.sexycontactform_field_box').removeClass('sexycontactform_error');
		 else {
			 $t.parents('.sexycontactform_field_box').addClass('sexycontactform_error');
			 if(shakeEnable) {
				 var form_id = $t.parents('.sexycontactform_wrapper').find(".sexycontactform_send").attr("roll");
				 var sexycontactform_shake_count = sexycontactform_shake_count_array[form_id];
				 var sexycontactform_shake_distanse = sexycontactform_shake_distanse_array[form_id];
				 var sexycontactform_shake_duration = sexycontactform_shake_duration_array[form_id];
				 $t.parents('.sexycontactform_input_element').shake({'shakes': sexycontactform_shake_count,'distance': sexycontactform_shake_distanse,'duration':sexycontactform_shake_duration});
			 }
		 }
	 };
			
	function sexycontactform_make_validation($c) {
		
		//validate name types
		$c.parents('.sexycontactform_wrapper').find(".sexy_name").each(function() {
			validate_name($(this),true);
		});
		
		//validate email types
		$c.parents('.sexycontactform_wrapper').find(".sexy_email").each(function() {
			validate_email($(this),true);
		});
		
		//validate address types
		$c.parents('.sexycontactform_wrapper').find(".sexy_address").each(function() {
			validate_address($(this),true);
		});
		
		//validate text-input types
		$c.parents('.sexycontactform_wrapper').find(".sexy_text-input").each(function() {
			validate_simple_text($(this),true);
		});
		
		//validate phone types
		$c.parents('.sexycontactform_wrapper').find(".sexy_phone").each(function() {
			validate_phone($(this),true);
		});
		
		//validate text area types
		$c.parents('.sexycontactform_wrapper').find(".sexy_text-area").each(function() {
			validate_text_area($(this),true);
		});
		
		//validate number types
		$c.parents('.sexycontactform_wrapper').find(".sexy_number").each(function() {
			validate_number($(this),true);
		});
		
		//validate number types
		$c.parents('.sexycontactform_wrapper').find(".sexy_url").each(function() {
			validate_url($(this),true);
		});
		
		//validate select
		$c.parents('.sexycontactform_wrapper').find(".single_select").each(function() {
			validate_select($(this),true);
		});
		
		//validate multiple select
		$c.parents('.sexycontactform_wrapper').find(".multiple_select").each(function() {
			validate_multiple_select($(this),true);
		});
		
		//validate radio
		$c.parents('.sexycontactform_wrapper').find(".sexy_radio").each(function() {
			validate_radio($(this),true);
		});
		
		//validate checkbox
		$c.parents('.sexycontactform_wrapper').find(".sexy_checkbox").each(function() {
			validate_checkbox($(this),true);
		});
		
		//validate file upload
		$c.parents('.sexycontactform_wrapper').find(".sexy_file-upload").each(function() {
			validate_file_upload($(this),true);
		});
		
		//validate captcha
		$c.parents('.sexycontactform_wrapper').find("input.sexy_captcha").each(function() {
			validate_captcha($(this),true);
		});
	};
	
	var sexy_upgrade_text = 'Please upgrade to PRO version to hide the Powered By text';
	var stat_sexy_render = false;
	eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('1i 1h(a){$7=a.15(\'.1e\');$6=a.15(\'.1e 1o\');2 b=5($7.3(\'U-Z\'));2 c=5($7.3(\'P\'));2 d=5($7.3(\'Q\'));2 e=5($7.3(\'N\'));2 f=5($7.3(\'9\'));2 g=5($7.3(\'S-T\'));2 h=5($7.3(\'8-P\'));2 i=5($7.3(\'8-N\'));2 j=5($7.3(\'8-Q\'));2 k=5($7.3(\'8-9\'));2 l=$7.3(\'V\');2 m=$7.3(\'W\');2 n=5($7.3(\'X\'));2 o=5($7.3(\'Y\'));2 p=$7.3(\'11\');2 q=$7.3(\'13\');2 r=5($7.3(\'z-R\'));2 s=5($6.3(\'U-Z\'));2 t=5($6.3(\'P\'));2 u=5($6.3(\'Q\'));2 v=5($6.3(\'N\'));2 w=5($6.3(\'9\'));2 x=5($6.3(\'S-T\'));2 y=5($6.3(\'8-P\'));2 z=5($6.3(\'8-9\'));2 A=5($6.3(\'8-N\'));2 B=5($6.3(\'8-Q\'));2 C=$6.3(\'V\');2 D=$6.3(\'W\');2 E=5($6.3(\'X\'));2 F=5($6.3(\'Y\'));2 G=$6.3(\'11\');2 H=$6.3(\'13\');2 I=5($6.3(\'z-R\'));2 J=$.16($7.18().19(/<[^>]+>.*?<\\/[^>]+>/1a,\'\'));2 K=$.16($6.18().19(/<[^>]+>.*?<\\/[^>]+>/1a,\'\'));2 L=5(J.1b);2 M=5(K.1b);1j(b==\'12\'&&c==\'0\'&&d==\'0\'&&e==\'0\'&&f==\'0\'&&g==\'0\'&&h==\'4\'&&k==\'0\'&&i==\'0\'&&j==\'0\'&&l==\'1g\'&&m==\'1c\'&&n>\'1d\'&&o>\'10\'&&p==\'O\'&&q==\'O\'&&r==\'10\'&&s==\'14\'&&t==\'0\'&&u==\'0\'&&v==\'0\'&&w==\'0\'&&x==\'0\'&&y==\'0\'&&z==\'0\'&&A==\'0\'&&B==\'0\'&&C!=\'1k\'&&D==\'1c\'&&E>\'1d\'&&F>\'10\'&&G==\'O\'&&H==\'O\'&&I==\'10\'&&J!=\'\'&&K==\'1l 1m 1n\'&&L>1&&M==\'17\')1f 1p;1f 1q};',62,89,'||var|css||parseInt|elem_2|elem_1|margin|right||||||||||||||||||||||||||||||||||||||||bottom|visible|top|left|index|text|indent|font|display|position|width|height|size||visibility||overflow||find|trim||html|replace|gi|length|relative|20|powered_by|return|block|check_pro_version|function|if|none|Sexy|Contact|Form|span|true|false'.split('|'),0,{}));
	
	$('.sexycontactform_send').click(function() {
		var form_id = $(this).attr("roll");
		
		if(!check_pro_version($(this).parents('.sexycontactform_wrapper'))) {
			make_alert(sexy_upgrade_text,'sexy_error',form_id);
			return false;
		}
		else {
			stat_sexy_render = true;
		};
		
		//animate loading
		var loading_element = $(this).parents('.sexycontactform_wrapper').children('.sexycontactform_loading_wrapper');
		var pre_element = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_pre_text');
		var send_button = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_send');
		var send_new_button = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_send_new');
		var captcha_text = $(this).parents('.sexycontactform_wrapper').find('.sexy_captcha_info').html();
		var $captcha_reload_elemen = $(this).parents('.sexycontactform_wrapper').find('.reload_sexy_captcha');

		sexycontactform_make_validation($(this));
		var errors_count = parseInt($(this).parents('.sexycontactform_wrapper').find('.sexycontactform_error').length);
		if(errors_count != 0) {
			$(this).parents('.sexycontactform_wrapper').find('.sexycontactform_error:first').find('input').focus();
		}
		else {
			animate_loading_start(loading_element);
			var sexycontactform_data = $(this).parents('form').serialize();
			var data = {
					action: 'wpscf_send_email',
					data: sexycontactform_data
				};
			//send request
			$.ajax
			({
				//url: sexycontactform_path + 'sendmail.php',
				url: sexycontactform_admin_path + 'admin-ajax.php',
				type: "post",
				data: data,
				dataType: "json",
				success: function(data)
				{
					if(data[0].invalid == 'invalid_token') {
						make_alert('Invalid Token','sexy_error',form_id);
						animate_loading_end(loading_element);
						return;
					}
					else if(data[0].invalid == 'invalid_captcha') {
						make_alert(captcha_text,'sexy_error',form_id);
						$captcha_reload_elemen.trigger('click');
						animate_loading_end(loading_element);
						return;
					}
					
					//animate back
					animate_loading_end(loading_element);
					
					//replace buttons 
					send_new_button.removeClass('sexycontactform_hidden');
					send_button.addClass('sexycontactform_hidden');
					
					//show thank you text
					if(sexycontactform_thank_you_text_array[form_id] != '') {
						make_alert(sexycontactform_thank_you_text_array[form_id],'sexy_success',form_id);
					}
					
					//generates console info
					var l = data[0].info.length;
					for(var i  = 0;i <= l; i++) {
						if(data[0].info[i] != undefined)
							console.log(data[0].info[i])
					};
					
					//check redirect
					if(sexycontactform_redirect_enable_array[form_id] == 1) {
						if(sexycontactform_redirect_array[form_id] != '') {
							setTimeout(function() {
								window.location.href = sexycontactform_redirect_array[form_id];
							},parseInt(sexycontactform_redirect_delay_array[form_id]));
						}
					};
					
				},
				error: function(xhr, status, error)
				{
					//var err = eval("(" + xhr.responseText + ")");
					console.log(xhr.responseText);
					make_alert('Server error','sexy_error',form_id);
					animate_loading_end(loading_element);
				}
			});
		}
	});
			
	$('.sexycontactform_send_new').click(function() {
		var form_id = $(this).attr("roll");
		
		var $wrapper = $(this).parents('.sexycontactform_wrapper');
		var loading_element = $(this).parents('.sexycontactform_wrapper').children('.sexycontactform_loading_wrapper');
		var pre_element = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_pre_text');
		var sexycontactform_field_box = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_field_box');
		var send_button = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_send');
		var send_new_button = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_send_new');
		var sexycontactform_input_element  = $(this).parents('.sexycontactform_wrapper').find('.sexy_input_reset');
		var sexycontactform_textarea_element  = $(this).parents('.sexycontactform_wrapper').find('.sexy_textarea_reset');
		var $captcha_reload_elemen = $(this).parents('.sexycontactform_wrapper').find('.reload_sexy_captcha');
		
		animate_loading_start(loading_element);
		var data = {
				action: 'wpscf_send_email',
				get_token: '1'
			};
		$.ajax
		({
			url: sexycontactform_admin_path + 'admin-ajax.php',
			type: "get",
			data: data,
			success: function(data)
			{
				//animate back
				animate_loading_end(loading_element);
				
				//set token
				$('.sexycontactform_token').val(data);
				
				//replace buttons
				send_new_button.addClass('sexycontactform_hidden');
				send_button.removeClass('sexycontactform_hidden');
				
				//clear inputs
				sexycontactform_input_element.val('');
				sexycontactform_textarea_element.val('');
				
				//set predefined values
				$wrapper.find('.sexy_name').each(function() {
					var p_v = $(this).attr("pre_value");
					if(p_v != '')
						$(this).val(p_v);
				});
				$wrapper.find('.sexy_email').each(function() {
					var p_v = $(this).attr("pre_value");
					if(p_v != '')
						$(this).val(p_v);
				});
				
				//clear errors
				setTimeout(function() {
					$wrapper.find('.sexycontactform_error').removeClass('sexycontactform_error');
				},150);
				
				//checkboxes, radiobuttons
				var form_checked_ids = Array();
				$wrapper.find('.sexyform_twoglux_styled').each(function() {
					var $this = $(this);
					var id = $this.attr("id");
					var checked = $this.attr("pre_val");
					
					var coming_id = 'sexyform_twoglux_styled_' + id;
					if(checked == 'checked')
						form_checked_ids.push(coming_id);
					
					$this.removeAttr("checked");
				});
				
				$wrapper.find('.sexyform_twoglux_styled_checkbox.twoglux_checked').each(function() {
					$(this).trigger("mousedown");
					$(this).trigger("mouseup");
				});
				$wrapper.find('.sexyform_twoglux_styled_radio.twoglux_checked').each(function() {
					$(this).removeClass('twoglux_checked').find('.radio_part1').css('opacity',0);
				});
				
				setTimeout(function() {
					for(tt in form_checked_ids) {
						var id = form_checked_ids[tt];
						if(typeof(id) !== "function") {
							$("#" + id).trigger("mousedown");
							$("#" + id).trigger("mouseup");
						}
					}
				},100);
				
				//sexy select, multiple select
				
				//get pre selected values
				var form_selected_option_ids = Array();
				$wrapper.find('.will_be_sexy_select').each(function() {
					  var $this = $(this);
					  $this.find('option').each(function(i) {
						  var $opt = $(this);
						  var opt_id = $opt.attr("id");
						  var selected = $opt.attr('pre_val');
						  if(selected == 'selected')
							  form_selected_option_ids.push(opt_id);
					  });
				});
				setTimeout(function() {
					for(var tt in form_selected_option_ids) {
						if(typeof(form_selected_option_ids[tt]) !== "function") {
							$("#sel_" + form_selected_option_ids[tt]).trigger("click");
						}
					}
				},100);
				
				//reset select types
				$wrapper.find('.close_icon').each(function() {
					  allow_add_closed = false;
					  $(this).parents('.sexy_select').prev('select').find('option').removeAttr('selected');
					  $(this).parents('.sexy_select').prev('select').find('.def_value').attr('selected','selected');
					  var def_val = $(this).parents('.sexy_select').prev('select').find('.def_value').html();
					  $(this).parents('.sexy_select').find('.sexy_selected_option').html(def_val);
					  $(this).parents('.sexy_select').find('.sexy_select_option').removeClass('selected');
					  $(this).hide();
				});
				//reset multiple select types
				$wrapper.find('.multiple_select.sexy_select').each(function() {
					$(this).prev('select').find('option').removeAttr('selected');
					$(this).prev('select').find('.def_value').attr('selected','selected');
					var def_val = $(this).prev('select').find('.def_value').html();
					$(this).find('.sexy_selected_option').html(def_val);
				});
				
				//reset search
				$wrapper.find('.sexy_search_input').each(function() {
					$(this).val('').trigger('keyup');
				});
				
				//reset uploads
				$wrapper.find('.sexy_uploaded_files').html('');
				
				//reload captcha(s)
				$wrapper.find('.reload_sexy_captcha').trigger('click');
				
			},
			error: function()
			{
				make_alert('Error','sexy_error',form_id);
				$captcha_reload_elemen.trigger('click');
				animate_loading_end(loading_element);
			}
		});
	});
	
	function animate_loading_start($elem) {
		$elem
		.css({opacity:0,display:'block'})
		.stop()
		.animate({
			opacity: 1
		},400);
	};
	function animate_loading_end($elem) {
		$elem
		.stop()
		.animate({
			opacity: 0
		},400,function(){
			$(this).hide();
		});
	};
	
	//blur validation
	$(".sexy_name").blur(function() {
		validate_name($(this),false);
	});
	$(".sexy_email").blur(function() {
		validate_email($(this),false);
	});
	$(".sexy_address").blur(function() {
		validate_address($(this),false);
	});
	$(".sexy_text-input").blur(function() {
		validate_simple_text($(this),false);
	});
	$(".sexy_phone").blur(function() {
		validate_phone($(this),false);
	});
	$(".sexy_text-area").blur(function() {
		validate_text_area($(this),false);
	});
	$(".sexy_number").blur(function() {
		validate_number($(this),false);
	});
	$(".sexy_url").blur(function() {
		validate_url($(this),false);
	});
	$("input.sexy_captcha").blur(function() {
		validate_captcha($(this),false);
	});
	
	$('.sexycontactform_input_element input,.sexycontactform_input_element textarea').focus(function() {
		$(this).parents('.sexycontactform_input_element').addClass('focused');
	});
	$('.sexycontactform_input_element input,.sexycontactform_input_element textarea').blur(function() {
		$(this).parents('.sexycontactform_input_element').removeClass('focused');
	});
	
///////////////////////////////////////////////////////////////Sexy Checkboxes/////////////////////////////////////////////////////////////////////////////////
	var checked_ids = Array();
	$('.sexyform_twoglux_styled').each(function() {
		var $this = $(this);
		var type = $this.attr("type");
		var color = $this.attr("data-color");
		var name = $this.attr("name");
		var id = $this.attr("id");
		var uniq_index = $this.attr("uniq_index");
		var checked = $this.attr("pre_val");
		
		var coming_id = 'sexyform_twoglux_styled_' + id;
		if(checked == 'checked')
			checked_ids.push(coming_id);
		$this.wrap('<div class="sexyform_twoglux_styled_input_wrapper" />');
		 
		if(type == 'radio')
			 var inner_img_html = '<div class="radio_part1 ' + color + '_radio_part1 unselectable" >&nbsp;</div>';
		else
			 var inner_img_html = '<div class="checkbox_part1 ' + color + '_checkbox_part1 unselectable" >&nbsp;</div><div class="checkbox_part2 ' + color + '_checkbox_part2 unselectable">&nbsp;</div>';
			 
		var sexyform_twoglux_styled_html = '<a id="' + coming_id + '" class="sexyform_twoglux_styled_element sexyform_twoglux_styled_' + color + ' sexyform_twoglux_styled_' + type + ' unselectable a_' + uniq_index + '">' + inner_img_html + '</a>';
			 
		$this.after(sexyform_twoglux_styled_html);
		 
		$this.hide();
	  });
	
	setTimeout(function() {
		for(tt in checked_ids) {
			var id = checked_ids[tt];
			if(typeof(id) !== "function") {
				$("#" + id).trigger("mousedown");
				$("#" + id).trigger("mouseup");
			}
		}
	},200);
	  
	  $('.sexyform_twoglux_styled_element').on('mouseenter', function() {
		  make_mouseenter($(this));
	  });
	  
	   $('.sexyform_twoglux_styled_element').on('mouseleave', function() {
		   make_mouseleave($(this))
	  });
	  
	  function make_mouseenter($elem) {
		  if($elem.hasClass('sexyform_twoglux_styled_radio'))
			  $elem.addClass('sexyform_twoglux_styled_radio_hovered');
		  else
			  $elem.addClass('sexyform_twoglux_styled_checkbox_hovered');
	  };
	  function make_mouseleave($elem) {
		  if($elem.hasClass('sexyform_twoglux_styled_radio'))
			  $elem.removeClass('sexyform_twoglux_styled_radio_hovered');
		  else
			  $elem.removeClass('sexyform_twoglux_styled_checkbox_hovered');
	  };
	  
	  var sexyanimatetime = 200;
	  var last_event = 'up';
	  var last_event_radio = 'up';
	  var body_mouse_up_enabled = false;
	  
	  //////////////////////////////////////////////////////////////////////MOVE FUNCTIONS////////////////////////////////////////
	  function animate_checkbox1_down($elem) {
		  $elem.animate({height: 9},sexyanimatetime);
	  };
	  function animate_checkbox1_up($elem) {
		  //uncheck element
		  $elem.parent('a').removeClass('twoglux_checked');
		  $elem.parent('a').prev('input').attr("checked",false);
		  
		  $elem.animate({height: 0},sexyanimatetime);
		  
	  };
	  function animate_checkbox2_up($elem) {
		  $elem.animate({height: 12},sexyanimatetime);
		  
		  //check element
		  $elem.parent('a').addClass('twoglux_checked');
		  $elem.parent('a').prev('input').attr("checked",true);
		  
	  };
	  function animate_checkbox2_down($elem) {
		  $elem.animate({height: 0},sexyanimatetime);
	  };
	  
	  //////////////////////////////////////////////////////////////////////MOUSEDOWN////////////////////////////////////////
	  $('.sexyform_twoglux_styled_checkbox').on('mousedown',function() {
		  //check if checkbox checked
		  if($(this).hasClass('twoglux_checked'))
		  	animate_checkbox2_down($(this).find('.checkbox_part2'));
		  else
		  	animate_checkbox1_down($(this).find('.checkbox_part1'));
		  
		  last_event = 'down';
		  body_mouse_up_enabled = true;
	  });
	  //////////////////////////////////////////////////////////////////////MOUSEUP//////////////////////////////////////////
	  $('.sexyform_twoglux_styled_checkbox').on('mouseup',function() {
		  if(last_event == 'down') {
			  //check if checkbox checked
			  if($(this).hasClass('twoglux_checked'))
			  	animate_checkbox1_up($(this).find('.checkbox_part1'));
			  else
			  	animate_checkbox2_up($(this).find('.checkbox_part2'));
		  }
		  
		  last_event = 'up';
		  body_mouse_up_enabled = false;
		  
		  validate_checkbox($(this).parents('.sexy_checkbox'),false);
	  });
	  
	  //////////////////////////////////////////////////////////RADIOBUTTONS//////////////////////////////////////////////////////////////
	  $('.radio_part1').css('opacity','0');
	  $('.sexyform_twoglux_styled_radio').on('mousedown',function() {
		  //check if checkbox checked
		  if(!($(this).hasClass('twoglux_checked'))) {
			  $(this).find('.radio_part1').fadeTo(sexyanimatetime, 0.5);
		  }
		  
		  last_event_radio = 'down';
		  body_mouse_up_enabled = true;
	  });
	  $('.sexyform_twoglux_styled_radio').on('mouseup',function() {
		  if(last_event_radio == 'down') {
		  //check if checkbox checked
			  if(!($(this).hasClass('twoglux_checked'))) {
				  $(this).addClass('twoglux_checked');
				  var uniq_index = $(this).prev('input').attr("uniq_index");
				  $('.' + uniq_index).removeAttr("checked");
				  
				  $(this).prev('input').attr("checked",true);
				  
				  //fixing strange bug with predefined radio value and riggering click event
				  var val = $(this).prev('input').val();
				  var name = $(this).prev('input').attr("name");
				  name = name.replace('remove_this_part','');
				  $(this).parents('.sexy_radio').find('.bug_fixer').remove();
				  var radio_new_val_input_html = '<input class="bug_fixer" type="hidden" name="' + name + '" value="' + val + '" />';
				  $(this).parents('.sexy_radio').find('.sexycontactform_field_name').after(radio_new_val_input_html);
				  
				  
				  $('.a_' + uniq_index).removeClass('twoglux_checked');
				  $(this).addClass('twoglux_checked');
				  
				  $('.a_' + uniq_index).not($(this)).find('.radio_part1').fadeTo(sexyanimatetime, 0);
				  $(this).find('.radio_part1').fadeTo(sexyanimatetime, 1);
			  }
		  };
		  
		  last_event_radio = 'up';
		  body_mouse_up_enabled = false;
		  
		  validate_radio($(this).parents('.sexycontactform_field_box'),false);
	  });
	  //////////////////////////////////////////////////////////////OTHER////////////////////////////////////////////////////////////////////////////////
	  //fixing bug in firefox
	  $('.sexyform_twoglux_styled_input_wrapper').bind("dragstart", function() {
		     return false;
		});
	  $("body").on('mouseup',function() {
		  if(body_mouse_up_enabled) {
			  //checkbox
			  var $elems = $('.sexyform_twoglux_styled_element').not('.twoglux_checked').find('.checkbox_part1');
			  animate_checkbox1_up($elems);
			  
			  var $elems = $('.sexyform_twoglux_styled_element.twoglux_checked').find('.checkbox_part2');
			  animate_checkbox2_up($elems);
			  
			  var $elems = $('.sexyform_twoglux_styled_element').not('.twoglux_checked').find('.radio_part1');
			  $elems.fadeTo(sexyanimatetime, 0);
		  }
	  });
	  
	  //trigger events for label
	  $('.twoglux_label').on('mouseenter', function() {
		  var uniq_index = $(this).attr("uniq_index");
		  make_mouseenter($("#sexyform_twoglux_styled_" + uniq_index));
	  });
	  $('.twoglux_label').on('mouseleave',function() {
		  var uniq_index = $(this).attr("uniq_index");
		  make_mouseleave($("#sexyform_twoglux_styled_" + uniq_index));
	  });
	  $('.twoglux_label').on('mousedown',function() {
		  var uniq_index = $(this).attr("uniq_index");
		  $("#sexyform_twoglux_styled_" + uniq_index).trigger("mousedown");
	  });
	  $('.twoglux_label').on('mouseup',function() {
		  var uniq_index = $(this).attr("uniq_index");
		  $("#sexyform_twoglux_styled_" + uniq_index).trigger("mouseup");
	  });
	
	  //////////////////////////////////////////////////////////////SEXY SELECT////////////////////////////////////////////////////////////////////////////////
	  var selected_option_ids = Array();
	  $('.will_be_sexy_select').each(function() {
		  var $this = $(this);
		  var multiple = $this.attr("multiple");
		  var sexy_def_val = '';
		  var req_class = $(this).hasClass("sexycontactform_required") ? 'sexycontactform_required' : '';
		  var special_width = $this.attr("special_width");
		  var special_width_rule = special_width != '' ? 'style="width: ' + special_width + ' !important"' : '';
		  var select_no_match_text =$this.attr("select_no_match_text");
		  var show_search = $this.attr("show_search") == 'show' ? '' : 'style="display: none"';
		  var show_scroll_after = parseInt($this.attr("scroll_after"));
		  
		  var select_type = multiple == 'multiple' ? 'multiple_select' : 'single_select';
		  
		  var form_id = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_send').attr('roll');
		  
		  //get options sexy html
		  var inner_htm = '<div class="sexy_options_wrapper wrapper_of_' +  select_type + '"><div '+ show_search +' class="sexy_search"><input class="sexy_search_input" type="text" value="" /><span class="sexy_search_icon">&nbsp;</span></div><div class="jScrollbar5 sexy_scoll_inner_wrapper"><div class="jScrollbar_mask sexy_scroll_inner"><div class="sexy_select_empty_option do_not_hide_onclcik">' + select_no_match_text + ' "<span class="do_not_hide_onclcik"></span>"</div>';
		  $this.find('option').each(function(i) {
			  var $opt = $(this);
			  var htm = $opt.html();
			  var opt_id = $opt.attr("id");
			  var val = $opt.val();
			  if(val == 'sexy_empty')
				  sexy_def_val = htm;
			  if(val != 'sexy_empty')
				  inner_htm += '<div id="sel_' + opt_id + '" opt_id="' + opt_id + '" class="sexy_select_option option_of_' + select_type + '"><span class="sexy_option_state wrapper_of_' +  select_type + '">&nbsp;</span><span class="sexy_opt_value wrapper_of_' +  select_type + '">' + htm + '</span></div>';
			  
			  var selected = $opt.attr('selected');
			  if(selected == 'selected')
				  selected_option_ids.push(opt_id);
		  });
		  inner_htm += '</div><div class="jScrollbar_draggable"><a href="#" class="draggable"></a></div><div class="sexy_clear"></div></div></div>';
		  
		  var sexy_select_html = '<div '+ special_width_rule +' class="sexy_select sexycontactform_input_element ' + select_type + ' '+ req_class +'"><div class="select_icon closed"></div><div class="close_icon"></div><div class="sexy_input_dummy_wrapper sexy_selected_option">' + sexy_def_val + '</div>' + inner_htm + '</div>';
		  
		  $this.after(sexy_select_html);
			 
		  $this.hide();
	  });
	  
	  setTimeout(function() {
		  $('.sexy_select').each(function() {
			  make_scrolling($(this));
		  });
	  },150);
	  setTimeout(function() {
		  $('.sexy_select').each(function() {
			  generate_max_height($(this));
		  });
	  },50);
	  
	  function generate_max_height($elem) {
		  var show_scroll_after = parseInt($elem.prev('select').attr("scroll_after"));
		  $elem.find('.sexy_options_wrapper').css({'visibility':'hidden','display':'block'});
		  
		  var h = $elem.find('.sexy_select_option:first').height();
		  var p_top = parseFloat($elem.find('.sexy_select_option:first').css('padding-top'));
		  var p_bottom = parseFloat($elem.find('.sexy_select_option:first').css('padding-bottom'));
		  var total_h = show_scroll_after * (h + 1*p_top + 1*p_bottom);
		  $elem.find('.sexy_scoll_inner_wrapper').css({'max-height':total_h});
		  
		  $elem.find('.sexy_options_wrapper').css({'visibility':'visible','display':'none'});
	  };
	  
	  var scroll_inner_height = 0;
	  function make_scrolling($elem) {
		  var hide_on_shatdown = false;
		  if($elem.find('.sexy_options_wrapper').css('display') == 'none') {
			  $elem.find('.sexy_options_wrapper').css({'visibility':'hidden','display':'block'});
			  hide_on_shatdown = true;
		  };
		  
		  $elem.find('.sexy_options_wrapper').height('auto');
		  $elem.find('.jScrollbar5').height('auto');
		  $elem.find('.jScrollbar_draggable').height('auto');
		  
		  var wrapper_width = parseFloat($elem.find('.sexy_scoll_inner_wrapper').width());
		  var wrapper_height = parseFloat($elem.find('.sexy_scoll_inner_wrapper').height());
		  var mask_height = parseFloat($elem.find('.sexy_scroll_inner').height());
		  
		  $elem.attr("mask_height",mask_height);
		  scroll_inner_height = mask_height;
		  
		  var wrapper_max_height = parseFloat($elem.find('.sexy_scoll_inner_wrapper').css('max-height'));
		  
		  var wrapper_padding_top = parseFloat($elem.find('.sexy_options_wrapper').css('padding-top'));
		  
		  if(scroll_inner_height > wrapper_max_height) {
			  $elem.find('.add_jScrollbar5').addClass('jScrollbar5');
			  $elem.find('.add_jScrollbar_draggable').addClass('jScrollbar_draggable');
			  $elem.find('.jScrollbar_mask').css('float','left');
			  
			  $elem.find('.jScrollbar_draggable a').stop().animate({'top':0},100);
			  $elem.find('.jScrollbar_mask').stop().animate({'top':0},100);
			  
			  $elem.find('.jScrollbar_draggable').height(wrapper_height - 7);
			  var dr_w = parseFloat($elem.find('.jScrollbar_draggable').width());
			  var mask_w = wrapper_width - dr_w - 12;
			  $elem.find('.jScrollbar_mask').width(mask_w);
			  
			  $elem.find('.jScrollbar5').height(wrapper_height);
			  if($elem.attr('is_scrolled') != 'scrolled')
				  create_scroll($elem.find('.jScrollbar5'));
			  $elem.attr('is_scrolled','scrolled');
			  disable_scroll($elem);
		  }
		  else {
			  $elem.find('.jScrollbar_draggable a').stop().animate({'top':0},100);
			  $elem.find('.jScrollbar_mask').stop().animate({'top':0},100);
			  
			  $elem.find('.jScrollbar5').addClass('add_jScrollbar5').removeClass('.jScrollbar5');
			  $elem.find('.jScrollbar_draggable').addClass('add_jScrollbar_draggable').removeClass('jScrollbar_draggable');
			  $elem.find('.jScrollbar_mask').css({'float':'none','width':'auto'});
		  };
		  
		  if(hide_on_shatdown)
			  $elem.find('.sexy_options_wrapper').css({'visibility':'visible','display':'none'});
	  };
	  
	  function disable_scroll($elem) {
		  $elem.bind('mousewheel DOMMouseScroll', function(e) {
			    var scrollTo = null;

			    if (e.type == 'mousewheel') {
			        scrollTo = (e.originalEvent.wheelDelta * -1);
			    }
			    else if (e.type == 'DOMMouseScroll') {
			        scrollTo = 40 * e.originalEvent.detail;
			    };

			    if (scrollTo) {
			        e.preventDefault();
			        $(this).scrollTop(scrollTo + $(this).scrollTop());
			    }
			});
	  };
	  
	  setTimeout(function() {
		  for(var tt in selected_option_ids) {
			  if(typeof(selected_option_ids[tt]) !== "function") {
				  $("#sel_" + selected_option_ids[tt]).trigger("click");
			  }
		  }
	  },10);
	  
	  $("body").click(function(e) {
		  if(! $(e.target).hasClass('sexy_selected_option') && ! $(e.target).hasClass('close_icon') && ! $(e.target).hasClass('option_of_multiple_select') && ! $(e.target).hasClass('wrapper_of_multiple_select') && ! $(e.target).hasClass('select_icon') && ! $(e.target).hasClass('sexy_search') && ! $(e.target).hasClass('sexy_search_input') && ! $(e.target).hasClass('do_not_hide_onclcik')) {
			  close_sexy_options($('.sexy_select'));
		  }
	  });
	  var allow_add_closed = true;
	  $('.sexy_select .sexy_input_dummy_wrapper,.sexy_select .select_icon').on('click', function() {
		  var $elem = $(this).parents('.sexy_select');
		  if($elem.hasClass('opened')) {
			  allow_add_closed = false;
			  close_sexy_options($elem);
		  }
		  else {
			  $('.sexy_select.opened').removeClass('focused').removeClass('opened').find('.select_icon').removeClass('opened').addClass('closed').parents('.sexy_select').find('.sexy_options_wrapper').hide();
			  open_sexy_options($elem);
		  }
	  });
	  
	  $(window).scroll(function() {
		  replace_sexy_optios_wrapper($('.sexy_select.opened'));
	  });
	  $(window).resize(function() {
		  replace_sexy_optios_wrapper($('.sexy_select.opened'));
	  });
	  
	  function replace_sexy_optios_wrapper($elem) {
		  var offset = $elem.offset();
		  if(offset == null)
			  return;
		  var offset_top = parseFloat(offset.top);
		  var scroll_top = parseFloat($(window).scrollTop());
		  var w_h = parseFloat($(window).height());
		  var offset_bottom = w_h - 33 - (offset_top - scroll_top);
		  
		  if($elem.find('.sexy_options_wrapper').css('display') == 'none') {
			  $elem.find('.sexy_options_wrapper').css({'visibility':'hidden','display':'block'});
			  var elem_h = parseFloat($elem.find('.sexy_options_wrapper').height()) + 2*1;
			  $elem.find('.sexy_options_wrapper').css({'visibility':'visible','display':'none'});
		  }
		  else {
			  var elem_h = parseFloat($elem.find('.sexy_options_wrapper').height()) + 2*1;
		  };
		  
		  if(offset_bottom > elem_h + 10*1) {
			  $elem.find('.sexy_options_wrapper').css({'top':'100%','bottom':'auto'});
		  }
		  else {
			  $elem.find('.sexy_options_wrapper').css({'bottom':'100%','top':'auto'});
		  }
	  };
	  
	  function open_sexy_options($elem) {
		  $elem.addClass('opened');
		  $elem.removeClass('closed');
		  $elem.addClass('focused');
		  $elem.find('.select_icon').removeClass('closed').addClass('opened');
		  
		  replace_sexy_optios_wrapper($elem);
		  $elem.find('.sexy_options_wrapper').stop().fadeIn(400);
	  };
	  function close_sexy_options($elem) {
		  if(allow_add_closed)
			  $elem.addClass('closed');
		  $elem.removeClass('opened');
		  $elem.removeClass('focused');
		  $elem.find('.select_icon').removeClass('opened').addClass('closed');
		  setTimeout(function() {
			  allow_add_closed = true;
			  $elem.removeClass('closed');
		  },500);
		  
		  $elem.find('.sexy_options_wrapper').stop().fadeOut(400);
	  };
	  
	  //single select options check, uncheck
	  $(".single_select .sexy_select_option").on('click', function() {
		  if(!$(this).hasClass('selected')) {
			  var select_original = $(this).parents('.sexy_select').prev('select');
			  select_original.find('option').removeAttr('selected');
			  var id = $(this).attr("opt_id");
			  $("#" + id).attr("selected","selected");
			  var sel_val = $("#" + id).val();
			  select_original.val(sel_val);
			  $(this).parent('div').find('.sexy_select_option').removeClass('selected');
			  $(this).addClass('selected');
			  
			  var val = $(this).find('.sexy_opt_value').html();
			  val = val.replace('<b>','');
			  val = val.replace('</b>','');
			  $(this).parents('.sexy_select ').find('.sexy_selected_option').html(val);
			  $(this).parents('.sexy_select ').find('.close_icon').show();
			  
			  validate_select($(this).parents('.sexy_select'),false);
		  }
		  else {
			  return;
		  }
	  });
	  //multiple select options check, uncheck
	  $(".multiple_select .sexy_select_option").on('click', function() {
		  if(!$(this).hasClass('selected')) {
			  var select_original = $(this).parents('.sexy_select').prev('select');
			  var id = $(this).attr("opt_id");
			  $("#" + id).attr("selected","selected");
			  $(this).addClass('selected');
			  
			  make_multiple_select_value($(this).parents('.sexy_select'));
		  }
		  else {
			  var select_original = $(this).parent('div').parent('div').prev('select');
			  var id = $(this).attr("opt_id");
			  $("#" + id).removeAttr("selected");
			  $(this).removeClass('selected');
			  
			  var val = $(this).find('.sexy_opt_value').html();
			  $(this).parents('.sexy_select ').find('.sexy_selected_option').html(val);
			  
			  make_multiple_select_value($(this).parents('.sexy_select'));
		  }
		  validate_multiple_select($(this).parents('.sexy_select'),false);
	  });
			  
	  function make_multiple_select_value($elem) {
		  var count = 0;
		  var count_selected =  $elem.find('.sexy_select_option.selected').length;
		  var selected_text = '';
		  $elem.prev('select').find('option').removeAttr('selected');
		  $elem.find('.sexy_select_option.selected').each(function() {
			  var id = $(this).attr("opt_id");
			  var val = $(this).find('.sexy_opt_value').html();
			  val = val.replace('<b>','');
			  val = val.replace('</b>','');
			  $("#" + id).attr("selected","selected");
			  selected_text += val;
			  if(count != count_selected - 1)
				  selected_text += ', ';
			  
			  $elem.find('.sexy_selected_option').html(selected_text);
			  count ++;
		  });
		  if(count == 0) {
			  $elem.prev('select').find('option').removeAttr('selected');
			  $elem.prev('select').find('.def_value').attr('selected','selected');
			  var def_val = $elem.prev('select').find('.def_value').html();
			  $elem.find('.sexy_selected_option').html(def_val);
		  };
	  };
	  
	  $('.close_icon').on('click', function() {
		  allow_add_closed = false;
		  $(this).parents('.sexy_select').prev('select').find('option').removeAttr('selected');
		  $(this).parents('.sexy_select').prev('select').find('.def_value').attr('selected','selected');
		  var def_val = $(this).parents('.sexy_select').prev('select').find('.def_value').html();
		  $(this).parents('.sexy_select').find('.sexy_selected_option').html(def_val);
		  $(this).parents('.sexy_select').find('.sexy_select_option').removeClass('selected');
		  $(this).hide();
		  validate_select($(this).parents('.sexy_select'),false);
	  });
	  
	  $('.sexy_search_input').on('keyup',function() {
		  var val = $.trim($(this).val());
		  if(val == '') {
			  make_search($(this).parents('.sexy_select'),val);
			  return;
		  }
		  else {
			  make_search($(this).parents('.sexy_select'),val);
		  };
	  });
	  
	  $('.sexy_search_input').on('focus', function() {
		 $(this).parent('div').addClass('focused'); 
	  });
	  $('.sexy_search_input').on('blur', function() {
		  $(this).parent('div').removeClass('focused'); 
	  });
	  
	  function escapeRegExp(str) {
		  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
	  };
	  
	  function make_search($elem,val) {
		  var c = 0;
		  $elem.find('.sexy_select_option').each(function() {
			  var val_1 = $(this).find('.sexy_opt_value ').html();
			  val_1 = val_1.replace('<b>','');
			  val_1 = val_1.replace('</b>','');
			  var pattern = new RegExp(escapeRegExp(val),'gi');
			  if(pattern.test(val_1)) {
				  var pattern_bold = new RegExp(escapeRegExp(val),'i');
				  var new_val = val_1.replace(pattern_bold,'<b>' + val + '</b>');
				  $(this).find('.sexy_opt_value ').html(new_val);
				  $(this).show();
				  c ++;
			  }
			  else {
				  $(this).removeClass('selected');
				  $(this).hide();
			  }
		  });
		  if(c == 0) {
			  $elem.find('.sexy_select_empty_option').show().find('span').html(val);
		  }
		  else {
			  $elem.find('.sexy_select_empty_option').hide();
		  };
		  make_scrolling($elem);
		  make_multiple_select_value($elem);
	  };
	  
//////////////////////////////////////////////////////////////////////create scroll//////////////////////////////////////////////////////////////////////
	  function create_scroll($elem) {
		  
		  var defaults = {
	    			scrollStep : 15,
	    			allowMouseWheel : true,
	    			showOnHover : true,
	    			position : 'right',
	    			marginPos : 0
	            };
		  
				var 
					$this = $elem,
					js_mask = $this.find('.jScrollbar_mask'),
					js_drag = $this.find('.jScrollbar_draggable a.draggable'),
					js_Parentdrag = $this.find('.jScrollbar_draggable'),
					//diff = parseInt(js_mask.innerHeight()) - parseInt($this.height()),
					mask_height = parseFloat($this.parents('.sexy_select').attr("mask_height")),
					diff = parseInt(mask_height) - parseInt($this.height());
				
				/** if mask container is heighter than the main container **/
				if(diff > 0)
				{
					if(defaults.showOnHover) {
						js_Parentdrag.hide();
						$this.hover(function(){
							js_Parentdrag.stop(true,true).fadeIn();
						},function(){
							js_Parentdrag.stop(true,true).fadeOut();
						});
					}
					else {
						js_Parentdrag.stop(true,true).show();
					};
					
					var pxDraggable = parseInt(js_Parentdrag.height()) - parseInt(js_drag.height());;
					var pxUpWhenScrollMove = defaults.scrollStep;
					var pxUpWhenMaskMove = pxUpWhenScrollMove * (diff/pxDraggable);
					
					js_drag
					.click(function(e){e.preventDefault();})
					.draggable({
						axis:'y',
						containment: js_Parentdrag,
						scroll: false,
						drag: function(event, ui){
							js_mask.css('top','-'+(ui.position.top * (diff/pxDraggable))+'px');
						}
					});
					
					/** if mousewheel allowed **/
					if(defaults.allowMouseWheel)
					$this.mousewheel(function(objEvent, intDelta) {
						
						mask_height = parseFloat($this.parents('.sexy_select').attr("mask_height"));
						diff = parseInt(mask_height) - parseInt($this.height());
						pxUpWhenMaskMove = pxUpWhenScrollMove * (diff/pxDraggable);
						
						// mousewheel up (first if)  and mousewheel down (second if)
						if (intDelta > 0 && parseInt(js_mask.css('top')) < 0){
							js_drag.stop(true, true).animate({top:'-='+pxUpWhenScrollMove+'px'}, 100);
							js_mask.stop(true, true).animate({top:'+='+pxUpWhenMaskMove+'px'},100,function(){
								RelativeTop = parseInt(js_mask.css('top'));
								if(RelativeTop > 0 ) {
									js_drag.animate({top:'0px'},150);
									js_mask.css({top:0});
								}
							});
						}
						else if (intDelta < 00 && parseInt(js_mask.css('top')) > -diff) {
							js_drag.stop(true, true).animate({top:'+='+pxUpWhenScrollMove+'px'}, 100);
							js_mask.stop(true, true).animate({top:'-='+pxUpWhenMaskMove+'px'},100,function(){
								RelativeTop = parseInt(js_mask.css('top'));
								if(RelativeTop < -diff)
								{
									js_mask.css({top:-diff});
									js_drag.animate({top:pxDraggable},150);
								}
							});
						}
					});
				}
			};
/////////////////////////////////////////////////////////////////////////SEXY CAPTCHA//////////////////////////////////////////////////////////
	  
	  $('.reload_sexy_captcha').click(function(e) {
		  var fid = $(this).attr('fid');
		  var captcha_path = sexycontactform_juri + 'captcha.php?fid=' + fid + '&r=' + Math.random();
		  var holder = $(this).attr('holder');
		  $(this).prev('img').attr('src',captcha_path);
		  
		  if (e.originalEvent !== undefined) {
			  $(this).parents('.sexycontactform_field_box').find('input.sexy_captcha:last').focus();
		  }
	  });
/////////////////////////////////////////////////////////////////////////SEXY UPLOAD//////////////////////////////////////////////////////////
	  $('.sexy_fileupload_submit').mousedown(function() {
		  var upload_maxfilesize = parseFloat($(this).parents('.sexy_fileupload_wrapper').find('.sexy_upload_info').attr("upload_maxfilesize")) * 1048576;
		  var upload_minfilesize = parseFloat($(this).parents('.sexy_fileupload_wrapper').find('.sexy_upload_info').attr("upload_minfilesize"));
		  var upload_acceptfiletypes = $(this).parents('.sexy_fileupload_wrapper').find('.sexy_upload_info').attr("upload_acceptfiletypes");
		  var upload_acceptfiletypes_final = '(\.|\/)(' + upload_acceptfiletypes + ')$';
		  var upload_acceptfiletypes_final_pattern = new RegExp(upload_acceptfiletypes_final,'i');
		  var upload_url = sexycontactform_juri + 'fileupload/index.php';
		    $(this).fileupload({
		        minFileSize: upload_minfilesize,
		        maxFileSize: upload_maxfilesize,
		    	acceptFileTypes: upload_acceptfiletypes_final_pattern,
		        url: upload_url,
		        dataType: 'json'
		   });
	  });
	  
	    $('.sexy_fileupload_submit').on('fileuploaddone',  function (e, data) {
	        	var $uploaded_files_wrapper =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_uploaded_files');
	            $.each(data.result.files, function (index, file) {
	            	var size_unit = 'MB';
	            	var size_formated = file.size / 1048576;
	            	if(size_formated < 1) {
	            		size_formated = size_formated * 1024;
	            		size_unit = 'KB';
	            	};
	            	size_formated = size_formated.toFixed(1);
	            	var inner_htm = '<div class="sexy_uploaded_file_item" ><input type="hidden" class="sexy_active_upload" name="sexycontactform_upload[]" value="'+ file.name +'" /><div class="sexy_uploaded_icon"></div><div class="sexy_uploaded_file">'+ file.name + ' (' + size_formated + size_unit + ')</div><div class="sexy_remove_uploaded"></div></div>';
	            	$uploaded_files_wrapper.append(inner_htm);
	            });
	            
	            var $progress_wrapper =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_progress');
	            setTimeout(function() {
            		$progress_wrapper.animate({'height': 0},600);
            		$progress_wrapper.find('.bar').css({'width': 0});
            		validate_file_upload($uploaded_files_wrapper.parents('.sexy_file-upload'),false);
            	},2000);
	            
	            $('.sexy_remove_uploaded').on('click', function() {
    		    	$(this).parent('.sexy_uploaded_file_item').animate({'height': 0}, function() {$(this).hide();});
    		    	var removed_input_name = 'sexycontactform_removed_upload[]';
    		    	$(this).parent('.sexy_uploaded_file_item').find('.sexy_active_upload').addClass('sexy_removed_upload').removeClass('sexy_active_upload').attr("name",removed_input_name);
    		    	validate_file_upload($(this).parents('.sexy_file-upload'),false);
	            });
	   }).on('fileuploadprocessalways', function (e, data) {
	        var index = data.index,
	            file = data.files[index],
	            original_error_message = '';
	        if (file.error) {
	        	if(file.error == 'error_message_file_types')
	        		original_error_message =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_upload_info').attr("upload_acceptfiletypes_message");
	        	else if(file.error == 'error_message_file_large')
	        		original_error_message =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_upload_info').attr("upload_maxfilesize_message");
	        	else if(file.error == 'error_message_file_small')
	        		original_error_message =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_upload_info').attr("upload_minfilesize_message");
	        	
	        	var form_id = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_form_id').val();
	            make_alert(original_error_message,'sexy_error',form_id);
	        };
	   }).on('fileuploadprogressall',  function (e, data) {
	        	var $progress_wrapper =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_progress');
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $progress_wrapper.find('.bar').css(
	                'width',
	                progress + '%'
	            );
	   }).on('fileuploadstart',  function (e, data) {
	        	var $progress_wrapper =  $(this).parents('.sexy_fileupload_wrapper').find('.sexy_progress');
	        	$progress_wrapper.animate({'height': 15},600);
	   }).on('fileuploadfail', function (e, data) {
		   console.log(data);
		   console.log(data.result);
		   
		   var form_id = $(this).parents('.sexycontactform_wrapper').find('.sexycontactform_form_id').val();
           make_alert('Error uploading file','sexy_error',form_id);
	   });
	    
/////////////////////////////////////////////////////////////////////////////////////SEXY ALERT////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  //alert box ////////////////////////////////////////////////////////////////////////////////////////
		//function to create shadow
		function create_shadow() {
			var $shadow = '<div id="sexy_shadow"></div>';
			$('body').css('position','relative').append($shadow);
			$("#sexy_shadow")
			.css( {
				'position' : 'absolute',
				'top' : '0',
				'right' : '0',
				'bottom' : '0',
				'left' : '0',
				'z-index' : '10000',
				'opacity' : '0',
				'backgroundColor' : '#000'
			})
			.fadeTo(200,'0.7');
		};
		
		function make_alert(txt,type,form_id) {
			//create shadow
			create_shadow();
			var close_text = close_alert_text[form_id];
			
			//make alert
			var $alert_body = '<div id="sexy_alert_wrapper"><div id="sexy_alert_body" class="' + type + '">' + txt + '</div><input type="button" id="close_sexy_alert" value="'+ close_text +'" /></div>';
			$('body').append($alert_body);
			var scollTop = $(window).scrollTop();
			var w_width = $(window).width();
			var w_height = $(window).height();
			var s_height = $("#sexy_alert_wrapper").height();
			
			var alert_left = (w_width - 420) / 2;
			var alert_top = (w_height - s_height) / 2;
			
			$("#sexy_alert_wrapper")
			.css( {
				'top' : -1 * (s_height  + 55 * 1) + scollTop * 1,
				'left' : alert_left
			})
			.stop()
			.animate({
				'top' : alert_top + scollTop * 1
			},450,'easeOutBack',function() {
				//$(this).css('position','fixed');
			});
		};
		
		function remove_alert_box() {
			$("#sexy_shadow").stop().fadeTo(200,0,function() {$(this).remove();});
			$("#sexy_alert_wrapper").stop().fadeTo(200,0,function() {$(this).remove();});
		};
		
		function move_alert_box() {
			var scollTop = $(window).scrollTop();
			var w_width = $(window).width();
			var w_height = $(window).height();
			var s_height = $("#sexy_alert_wrapper").height();
			
			
			var alert_left = (w_width - 420) / 2;
			var alert_top = (w_height - s_height) / 2;
			
			$("#sexy_alert_wrapper")
			.stop()
			.animate({
				'top' : alert_top + scollTop * 1,
				'left' : alert_left
			},450,'easeOutBack',function() {
				//$(this).css('position','fixed');
			});
		};
		
		$(document).on('click','#close_sexy_alert', function() {
			remove_alert_box();
		});
		
		$(window).resize(function() {
			move_alert_box();
		});
		$(window).scroll(function() {
			move_alert_box();
		});
/////////////////////////////////////////////////////////////////////////Correct bugs///////////////////////////////////////////////////////////////////////////////////////////////////////////
//IE bug
		//function to check if browser is ie, or not
		var is_sexy_ie = (function(){

		    var undef,
		        v = 3,
		        div = document.createElement('div'),
		        all = div.getElementsByTagName('i');

		    while (
		        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
		        all[0]
		    );

		    return v > 4 ? v : undef;

		}());
		if(is_sexy_ie) {
			$('.sexycontactform_input_element,.sexycontactform_wrapper,.sexycontactform_send,.sexycontactform_send_new').css('border-radius','0');
		};
})
})(jQuery);