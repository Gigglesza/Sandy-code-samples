<?php 
global $wpdb;

if($id != 0) {
//get the rows
$sql = "SELECT * FROM ".$wpdb->prefix."sexy_contact_templates WHERE id = '".$id."'";
$row = $wpdb->get_row($sql);
}



	echo '<style>
			.colorpicker input {
				background-color: transparent !important;
				border: 1px solid transparent !important;
				position: absolute !important;
				font-size: 10px !important;
				font-family: Arial, Helvetica, sans-serif !important;
				color: #898989 !important;
				top: 4px !important;
				right: 11px !important;
				text-align: right !important;
				margin: 0 !important;
				padding: 0 !important;
				height: 11px !important;
				outline: none !important;
				box-shadow: none !important;
				width: 32px !important;
				height: 12px !important;
				top: 2px !important;
			}
			.colorpicker_hex input {
				width: 38px !important;
				right: 6px !important;
			}
	</style>';
?>

<script type="text/javascript">
(function($) {
	$(document).ready(function() {
$('.sexycontactform_input_element input,.sexycontactform_input_element textarea').focus(function() {
	$(this).parents('.sexycontactform_input_element').not('.sexy_error_input').addClass('focused');
});
$('.sexycontactform_input_element input,.sexycontactform_input_element textarea').blur(function() {
	$(this).parents('.sexycontactform_input_element').removeClass('focused');
});

})

})(jQuery);

if (typeof sexycontactform_shake_count_array === 'undefined') { var sexycontactform_shake_count_array = new Array();};sexycontactform_shake_count_array[1] = "3"; if (typeof sexycontactform_shake_distanse_array === 'undefined') { var sexycontactform_shake_distanse_array = new Array();};sexycontactform_shake_distanse_array[1] = "10"; if (typeof sexycontactform_shake_duration_array === 'undefined') { var sexycontactform_shake_duration_array = new Array();};sexycontactform_shake_duration_array[1] = "300";var sexycontactform_path = "/Joomla_3.1.1/components/com_sexycontactform/"; if (typeof sexycontactform_redirect_enable_array === 'undefined') { var sexycontactform_redirect_enable_array = new Array();};sexycontactform_redirect_enable_array[1] = "0"; if (typeof sexycontactform_redirect_array === 'undefined') { var sexycontactform_redirect_array = new Array();};sexycontactform_redirect_array[1] = ""; if (typeof sexycontactform_redirect_delay_array === 'undefined') { var sexycontactform_redirect_delay_array = new Array();};sexycontactform_redirect_delay_array[1] = "0"; if (typeof sexycontactform_thank_you_text_array === 'undefined') { var sexycontactform_thank_you_text_array = new Array();};sexycontactform_thank_you_text_array[1] = "Message successfully sent"; if (typeof sexycontactform_pre_text_array === 'undefined') { var sexycontactform_pre_text_array = new Array();};sexycontactform_pre_text_array[1] = "Contact us, if you have any questions";

//admin forever
var req = false;
function refreshSession() {
    req = false;
    if(window.XMLHttpRequest && !(window.ActiveXObject)) {
        try {
            req = new XMLHttpRequest();
        } catch(e) {
            req = false;
        }
    // branch for IE/Windows ActiveX version
    } else if(window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                req = false;
            }
        }
    }

    if(req) {
        req.onreadystatechange = processReqChange;
        req.open("HEAD", "<?php echo plugins_url( '../../../../../' , __FILE__ );?>", true);
        req.send();
    }
}

function processReqChange() {
    // only if req shows "loaded"
    if(req.readyState == 4) {
        // only if "OK"
        if(req.status == 200) {
            // TODO: think what can be done here
        } else {
            // TODO: think what can be done here
            //alert("There was a problem retrieving the XML data: " + req.statusText);
        }
    }
}
setInterval("refreshSession()", 60000);
</script>

<script>
(function($) {
	$(document).ready(function() {

		var active_element;
		$('.colorSelector').click(function() {
			active_element = $(this);
		})
		
		//magic functions
		function create_backround_gradient() {

		}
		
		$('.colorSelector').ColorPicker({
			onBeforeShow: function () {
				$color = $(active_element).next('input').val();
				$(this).ColorPickerSetColor($color);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {

				$(active_element).children('div').css('backgroundColor', '#' + hex);
				$(active_element).next('input').val('#' + hex);
				roll = $(active_element).next('input').attr('roll');

				//main wrapper
				if(roll == 0 || roll == 130) {
					$(".sexycontactform_wrapper").css('backgroundColor' , '#' + hex);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
					$(".sexycontactform_wrapper").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-0").val() + '), to('  + $("#elem-130").val() + '))';
					$(".sexycontactform_wrapper").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
					$(".sexycontactform_wrapper").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
					$(".sexycontactform_wrapper").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-0").val() + ', '  + $("#elem-130").val() + ')';
					$(".sexycontactform_wrapper").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-0").val() + ', endColorstr='  + $("#elem-130").val() + ')';
					$(".sexycontactform_wrapper").css('filter' , fil);

				}
				else if(roll == 1) {
					$(".sexycontactform_wrapper").css('borderColor' , '#' + hex);
				}
				else if(roll == 8) {
					var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
					var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();

					$(".sexycontactform_wrapper").css('boxShadow' , boxShadow);
					$(".sexycontactform_wrapper").hover(function() {
						$(this).css('boxShadow' , boxShadow_);
					},function() {
						$(this).css('boxShadow' , boxShadow);
					});

				}
				else if(roll == 14) {
					var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
					var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
					
					$(".sexycontactform_wrapper").css('boxShadow' , boxShadow);
					$(".sexycontactform_wrapper").hover(function() {
						$(this).css('boxShadow' , boxShadow_);
					},function() {
						$(this).css('boxShadow' , boxShadow);
					});
				}
				//top text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 20) {
					$(".sexycontactform_title").css('color' , '#' + hex);
				}
				else if(roll == 27) {
					var textShadow = $("#elem-28").val() + 'px '  + $("#elem-29").val() + 'px '  + $("#elem-30").val() + 'px ' + $("#elem-27").val();
					$(".sexycontactform_title").css('textShadow' , textShadow);
				}
				//field text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 31) {
					$(".sexycontactform_field_name").css('color' , '#' + hex);
				}
				else if(roll == 37) {
					var textShadow = $("#elem-38").val() + 'px '  + $("#elem-39").val() + 'px '  + $("#elem-40").val() + 'px ' + $("#elem-37").val();
					$(".sexycontactform_field_name").css('textShadow' , textShadow);
				}
				//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 41) {
					$(".sexycontactform_field_required").css('color' , '#' + hex);
				}
				else if(roll == 46) {
					var textShadow = $("#elem-47").val() + 'px '  + $("#elem-48").val() + 'px '  + $("#elem-49").val() + 'px ' + $("#elem-46").val();
					$(".sexycontactform_field_required").css('textShadow' , textShadow);
				}

				//sexycontactform_send////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 91 || roll == 50 || roll == 51 || roll == 52) {//answer animation backgroundColor
					var backColor_ = $("#elem-91").val();
					$(".sexycontactform_send").css('backgroundColor' , backColor_);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".sexycontactform_send").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-91").val() + '), to('  + $("#elem-50").val() + '))';
					$(".sexycontactform_send").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".sexycontactform_send").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".sexycontactform_send").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
					$(".sexycontactform_send").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-91").val() + ', endColorstr='  + $("#elem-50").val() + ')';
					$(".sexycontactform_send").css('filter' , fil);
					
					$(".sexycontactform_send").hover(function() {
						var back = '-webkit-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-51").val() + '), to('  + $("#elem-52").val() + '))';
						$(".sexycontactform_send").css('background' , back);
						back = '-moz-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						back = '-ms-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						back = '-o-linear-gradient(top, ' + $("#elem-51").val() + ', '  + $("#elem-52").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-51").val() + ', endColorstr='  + $("#elem-52").val() + ')';
						$(".sexycontactform_send").css('filter' , fil);
					},function() {
						var back = '-webkit-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-91").val() + '), to('  + $("#elem-50").val() + '))';
						$(".sexycontactform_send").css('background' , back);
						back = '-moz-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						back = '-ms-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						back = '-o-linear-gradient(top, ' + $("#elem-91").val() + ', '  + $("#elem-50").val() + ')';
						$(".sexycontactform_send").css('background' , back);
						fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-91").val() + ', endColorstr='  + $("#elem-50").val() + ')';
						$(".sexycontactform_send").css('filter' , fil);
					});

				}
				else if(roll == 100) {//answer animation backgroundColor
					var borderColor = $("#elem-126").val();
					var borderColor_ = $("#elem-100").val();
					$(".sexycontactform_send").css('borderColor' , borderColor_);
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('borderColor' , borderColor);
					},function() {
						$(this).css('borderColor' , borderColor_);
					});
				}
				else if(roll == 94) { //poll answer name text shadow

					var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' +  $("#elem-117").val();
					var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
					$(".sexycontactform_send").css('boxShadow' , boxShadow_);
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('boxShadow' , boxShadow);
					},function() {
						$(this).css('boxShadow' , boxShadow_);
					});
				}
				else if(roll == 106) {
					var textColor = $("#elem-124").val();
					var textColor_ = $("#elem-106").val();
					$(".sexycontactform_send").css('color' , textColor_);
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('color' , textColor);
					},function() {
						$(this).css('color' , textColor_);
					});
				}
				else if(roll == 113) { 
					var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-125").val();
					var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-113").val();
					$(".sexycontactform_send").css('textShadow' , textShadow_);
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('textShadow' , textShadow);
					},function() {
						$(this).css('textShadow' , textShadow_);
					});
				}
				else if(roll == 123) {
					var backColor = '#' + hex;
					var backColor_ = $("#elem-91").val();
					
					$(".sexycontactform_send").hover(function() {
						$(".sexycontactform_send").css('backgroundColor' , backColor);
					},function() {
						$(".sexycontactform_send").css('backgroundColor' , backColor_);
					});
				}
				else if(roll == 124) {
					var textColor = '#' + hex;
					var textColor_ = $("#elem-106").val();
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('color' , textColor);
					},function() {
						$(this).css('color' , textColor_);
					});
				}
				else if(roll == 125) {
					var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px #' + hex;
					var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px #' + $("#elem-113").val();
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('textShadow' , textShadow);
					},function() {
						$(this).css('textShadow' , textShadow_);
					});
				}
				else if(roll == 126) {
					var borderColor = '#' + hex;
					var borderColor_ = $("#elem-100").val();
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('borderColor' , borderColor);
					},function() {
						$(this).css('borderColor' , borderColor_);
					});
				}
				else if(roll == 117) {
					var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px  #' + hex;
					var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
					
					$(".sexycontactform_send").hover(function() {
						$(this).css('boxShadow' , boxShadow);
					},function() {
						$(this).css('boxShadow' , boxShadow_);
					});
				}

				//sexycontactform text inputs////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				else if(roll == 132 || roll == 133 || roll == 157 || roll == 158) {//answer animation backgroundColor
					var backColor_ = $("#elem-132").val();
					$(".sexycontactform_input_element").not('.sexy_error_input').css('backgroundColor' , backColor_);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-132").val() + '), to('  + $("#elem-133").val() + '))';
					$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
					$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-132").val() + ', endColorstr='  + $("#elem-133").val() + ')';
					$(".sexycontactform_input_element").not('.sexy_error_input').css('filter' , fil);
					
					$(".sexycontactform_input_element").hover(function() {
						var back = '-webkit-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-157").val() + '), to('  + $("#elem-158").val() + '))';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-moz-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-ms-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-o-linear-gradient(top, ' + $("#elem-157").val() + ', '  + $("#elem-158").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-157").val() + ', endColorstr='  + $("#elem-158").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('filter' , fil);
					},function() {
						var back = '-webkit-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-132").val() + '), to('  + $("#elem-133").val() + '))';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-moz-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-ms-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						back = '-o-linear-gradient(top, ' + $("#elem-132").val() + ', '  + $("#elem-133").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('background' , back);
						fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-132").val() + ', endColorstr='  + $("#elem-133").val() + ')';
						$(".sexycontactform_input_element").not('.sexy_error_input').css('filter' , fil);
					});

				}
				else if(roll == 134 || roll == 161) {//answer animation backgroundColor
					var borderColor = $("#elem-134").val();
					var borderColor_ = $("#elem-161").val();
					$(".sexycontactform_input_element").not('.sexy_error_input').css('borderColor' , borderColor);
					
					$(".sexycontactform_input_element").not('.sexy_error_input').hover(function() {
						$(this).css('borderColor' , borderColor_);
					},function() {
						$(this).css('borderColor' , borderColor);
					});
				}
				else if(roll == 141 || roll == 162) { 

					var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
					var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
					$(".sexycontactform_input_element").not('.sexy_error_input').css('boxShadow' , boxShadow);
					
					$(".sexycontactform_input_element").not('.sexy_error_input').hover(function() {
						$(this).css('boxShadow' , boxShadow_);
					},function() {
						$(this).css('boxShadow' , boxShadow);
					});
				}
				else if(roll == 147 || roll == 159) {
					var textColor = $("#elem-147").val();
					var textColor_ = $("#elem-159").val();
					$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('color' , textColor);
					
					$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").hover(function() {
						$(this).css('color' , textColor_);
					},function() {
						$(this).css('color' , textColor);
					});
				}
				else if(roll == 153 || roll == 160) { 
					var textShadow = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-153").val();
					var textShadow_ = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-160").val();
					$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('textShadow' , textShadow);
					
					$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").hover(function() {
						$(this).css('textShadow' , textShadow_);
					},function() {
						$(this).css('textShadow' , textShadow);
					});
				}
				//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        	
	        	else if(roll == 171) {
					$(".sexycontactform_error .sexycontactform_field_name").css('color' , '#' + hex);
				}
				else if(roll == 172) {
					var textShadow = $("#elem-173").val() + 'px '  + $("#elem-174").val() + 'px '  + $("#elem-175").val() + 'px ' + $("#elem-172").val();
					$(".sexycontactform_error .sexycontactform_field_name").css('textShadow' , textShadow);
				}
				
				else if(roll == 176 || roll == 177) {
					var backColor = $("#elem-176").val();
					$(".sexycontactform_error .sexycontactform_input_element").css('backgroundColor' , backColor);

					var back = '-webkit-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".sexycontactform_error .sexycontactform_input_element").css('background' , back);
					back = '-webkit-gradient(linear, 0% 0%, 0% 100%, from(' + $("#elem-176").val() + '), to('  + $("#elem-177").val() + '))';
					$(".sexycontactform_error .sexycontactform_input_element").css('background' , back);
					back = '-moz-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".sexycontactform_error .sexycontactform_input_element").css('background' , back);
					back = '-ms-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".sexycontactform_error .sexycontactform_input_element").css('background' , back);
					back = '-o-linear-gradient(top, ' + $("#elem-176").val() + ', '  + $("#elem-177").val() + ')';
					$(".sexycontactform_error .sexycontactform_input_element").css('background' , back);
					fil = ' progid:DXImageTransform.Microsoft.gradient(startColorstr=' + $("#elem-176").val() + ', endColorstr='  + $("#elem-177").val() + ')';
					$(".sexycontactform_error .sexycontactform_input_element").css('filter' , fil);

				}
				else if(roll == 178) {
					var borderColor = $("#elem-178").val();
					$(".sexycontactform_error .sexycontactform_input_element").css('borderColor' , borderColor);
				}
				else if(roll == 179) {
					var fontColor = $("#elem-179").val();
					$(".sexycontactform_error input").css('color' , fontColor);
				}
				else if(roll == 184) { 
					var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
					$(".sexycontactform_error .sexycontactform_input_element").css('boxShadow' , boxShadow);
				}
				else if(roll == 180) { 
					var textShadow = $("#elem-181").val() + 'px '  + $("#elem-182").val() + 'px '  + $("#elem-183").val() + 'px ' + $("#elem-180").val();
					$(".sexycontactform_error input").css('textShadow' , textShadow);
				}
				/*pre text ********************************************************************************************************************************************************************************/
	        	else if(roll == 195) { 
					var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
					$(".sexycontactform_pre_text").css('borderTop' , borderTop);
				}
	        	else if(roll == 197) {
					$(".sexycontactform_pre_text").css('color' , $("#elem-197").val());
				}
	        	else if(roll == 203) { 
					var textShadow = $("#elem-204").val() + 'px '  + $("#elem-205").val() + 'px '  + $("#elem-206").val() + 'px ' + $("#elem-203").val();
					$(".sexycontactform_pre_text").css('textShadow' , textShadow);
				}
	        	
			}
		});

		//size up
		var up_int,down_int,curr_up,curr_down;
		$('.size_up').mousedown(function() {
			
			var $this = $(this);
			curr_up = parseInt($this.parent('div').prev('input').val());
			up_int = setInterval(function() {
				max_val = parseInt($this.attr("maxval"));
				val = parseInt($this.parent('div').prev('input').val());
				if(val < max_val) {
					$this.parent('div').prev('input').val(val*1 + 1);
					roll = $this.parent('div').prev('input').attr('roll');
					move_up(roll,val);
				}
			},100);
		})
		
		$('.size_up').mouseup(function() {
			clearInterval(up_int);
			var $this = $(this);
			max_val = parseInt($this.attr("maxval"));
			val = parseInt($this.parent('div').prev('input').val());
			if((val < max_val) && (curr_up == val)) {
				$this.parent('div').prev('input').val(val*1 + 1);
				roll = $this.parent('div').prev('input').attr('roll');
				move_up(roll,val);
			}
		});

		$('.size_up').mouseleave(function() {
			clearInterval(up_int);
		});

		function move_up(roll,val) {
			if(roll == 2) {
				$(".sexycontactform_wrapper").css({
					borderLeftWidth : val*1 + 1,
					borderRightWidth : val*1 + 1,
					borderBottomWidth : val*1 + 1,
					borderTopWidth : val*1 + 1
				});
			}
			else if(roll == 4) {
				$(".sexycontactform_wrapper").css('border-top-left-radius' , val*1 + 1);
			}
			else if(roll == 5) {
				$(".sexycontactform_wrapper").css('border-top-right-radius' , val*1 + 1);
			}
			else if(roll == 6) {
				$(".sexycontactform_wrapper").css('border-bottom-left-radius' , val*1 + 1);
			}
			else if(roll == 7) {
				$(".sexycontactform_wrapper").css('border-bottom-right-radius' , val*1 + 1);
			}
			else if(roll == 10 || roll == 11 || roll == 12 || roll == 13  || roll == 16  || roll == 17  || roll == 18  || roll == 19  ) { 
				var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
				var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
				
				$(".sexycontactform_wrapper").css('boxShadow' , boxShadow);
				$(".sexycontactform_wrapper").hover(function() {
					$(this).css('boxShadow' , boxShadow_);
				},function() {
					$(this).css('boxShadow' , boxShadow);
				});
			}
			//top text
			else if(roll == 21) {
				$(".sexycontactform_title").css('fontSize' , val*1 + 1);
			}
			else if(roll == 28 || roll == 29 || roll == 30 ) {
				var textShadow = $("#elem-28").val() + 'px '  + $("#elem-29").val() + 'px '  + $("#elem-30").val() + 'px ' + $("#elem-27").val();
				$(".sexycontactform_title").css('textShadow' , textShadow);
			}
			//field text
			else if(roll == 32) {
				$(".sexycontactform_field_name").css('fontSize' , val*1 + 1);
			}
			else if(roll == 38 || roll == 39 || roll == 40) {
				var textShadow = $("#elem-38").val() + 'px '  + $("#elem-39").val() + 'px '  + $("#elem-40").val() + 'px ' + $("#elem-37").val();
				$(".sexycontactform_field_name").css('textShadow' , textShadow);
			}
			//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 42) {
				$(".sexycontactform_field_required").css('fontSize' , val*1 + 1);
			}
			else if(roll == 47 || roll == 48 || roll == 49) {
				var textShadow = $("#elem-47").val() + 'px '  + $("#elem-48").val() + 'px '  + $("#elem-49").val() + 'px ' + $("#elem-46").val();
				$(".sexycontactform_field_required").css('textShadow' , textShadow);
			}


			//send///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 92) {
				$(".sexycontactform_send").css('paddingTop' , val*1 + 1);
				$(".sexycontactform_send").css('paddingBottom' , val*1 + 1);
			}
			else if(roll == 93) {
				$(".sexycontactform_send").css('paddingLeft' , val*1 + 1);
				$(".sexycontactform_send").css('paddingRight' , val*1 + 1);
			}
			else if(roll == 101) { //box border width
				$(".sexycontactform_send").css({
					borderLeftWidth : val*1 + 1,
					borderRightWidth : val*1 + 1,
					borderBottomWidth : val*1 + 1,
					borderTopWidth : val*1 + 1
				});
			}
			else if(roll == 102) {
				$(".sexycontactform_send").css('border-top-left-radius' , val*1 + 1);
			}
			else if(roll == 103) {
				$(".sexycontactform_send").css('border-top-right-radius' , val*1 + 1);
			}
			else if(roll == 104) {
				$(".sexycontactform_send").css('border-bottom-left-radius' , val*1 + 1);
			}
			else if(roll == 105) {
				$(".sexycontactform_send").css('border-bottom-right-radius' , val*1 + 1);
			}
			else if(roll == 96 || roll == 97 || roll == 98 || roll == 99) {
				var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' +  $("#elem-117").val();
				var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
				$(".sexycontactform_send").css('boxShadow' , boxShadow_);
				
				$(".sexycontactform_send").hover(function() {
					$(this).css('boxShadow' , boxShadow);
				},function() {
					$(this).css('boxShadow' , boxShadow_);
				});
			}
			else if(roll == 107) {
				$(".sexycontactform_send").css('fontSize' , val*1 + 1);
			}
			else if(roll == 114 || roll == 115 || roll == 116 ) {
				var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-125").val();
				var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-113").val();
				$(".sexycontactform_send").css('textShadow' , textShadow_);
				
				$(".sexycontactform_send").hover(function() {
					$(this).css('textShadow' , textShadow);
				},function() {
					$(this).css('textShadow' , textShadow_);
				});
			}
			else if(roll == 119 || roll == 120 || roll == 121 || roll == 122) {
				var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
				var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
				
				$(".sexycontactform_send").hover(function() {
					$(this).css('boxShadow' , boxShadow);
				},function() {
					$(this).css('boxShadow' , boxShadow_);
				});
			}
			
			//text inputs///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 135) { //box border width
				$(".sexycontactform_input_element").css({
					borderLeftWidth : val*1 + 1,
					borderRightWidth : val*1 + 1,
					borderBottomWidth : val*1 + 1,
					borderTopWidth : val*1 + 1
				});
			}
			else if(roll == 137) {
				$(".sexycontactform_input_element").css('border-top-left-radius' , val*1 + 1);
			}
			else if(roll == 138) {
				$(".sexycontactform_input_element").css('border-top-right-radius' , val*1 + 1);
			}
			else if(roll == 139) {
				$(".sexycontactform_input_element").css('border-bottom-left-radius' , val*1 + 1);
			}
			else if(roll == 140) {
				$(".sexycontactform_input_element").css('border-bottom-right-radius' , val*1 + 1);
			}

			else if(roll == 143 || roll == 144 || roll == 145 || roll == 146) { 

				var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
				var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
				$(".sexycontactform_input_element").not('.sexy_error_input').css('boxShadow' , boxShadow);
				
				$(".sexycontactform_input_element").not('.sexy_error_input').hover(function() {
					$(this).css('boxShadow' , boxShadow_);
				},function() {
					$(this).css('boxShadow' , boxShadow);
				});
			}
			else if(roll == 154 || roll == 155 || roll == 156) { 
				var textShadow = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-153").val();
				var textShadow_ = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-160").val();
				$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('textShadow' , textShadow);
				
				$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").hover(function() {
					$(this).css('textShadow' , textShadow_);
				},function() {
					$(this).css('textShadow' , textShadow);
				});
			}

			else if(roll == 148) {
				$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('fontSize' , val*1 + 1);
			}
			
			else if(roll == 168) {
				var w = val*1 + 1 + '%';
				$(".sexycontactform_input_element").not('.sexy_textarea_wrapper').css('width' , w);
			}
			else if(roll == 169) {
				var w = val*1 + 1 + '%';
				$(".sexy_textarea_wrapper").css('width' , w);
			}
			else if(roll == 170) {
				$(".sexy_textarea_wrapper").css('height' , val*1 + 1);
			}
			
			//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 173 || roll == 174 || roll == 175) {
				var textShadow = $("#elem-173").val() + 'px '  + $("#elem-174").val() + 'px '  + $("#elem-175").val() + 'px ' + $("#elem-172").val();
				$(".sexycontactform_error .sexycontactform_field_name").css('textShadow' , textShadow);
			}
			else if(roll == 186 || roll == 187 || roll == 188 || roll == 189) { 
				var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
				$(".sexycontactform_error .sexycontactform_input_element").css('boxShadow' , boxShadow);
			}
			else if(roll == 181 || roll == 182 || roll == 183) { 
				var textShadow = $("#elem-181").val() + 'px '  + $("#elem-182").val() + 'px '  + $("#elem-183").val() + 'px ' + $("#elem-180").val();
				$(".sexycontactform_error input").css('textShadow' , textShadow);
			}
			/*pre text ********************************************************************************************************************************************************************************/
        	else if(roll == 190) { 
				var marginTop = $("#elem-190").val() + 'px';
				$(".sexycontactform_pre_text").css('marginTop' , marginTop);
			}
        	else if(roll == 191) { 
				var marginBottom = $("#elem-191").val() + 'px';
				$(".sexycontactform_pre_text").css('marginBottom' , marginBottom);
			}
        	else if(roll == 193) { 
				var paddingTop = $("#elem-193").val() + 'px';
				$(".sexycontactform_pre_text").css('paddingTop' , paddingTop);
			}
        	else if(roll == 192) { 
				var w = $("#elem-192").val() + '%';
				$(".sexycontactform_pre_text").css('width' , w);
			}
        	else if(roll == 198) { 
				var f = $("#elem-198").val();
				$(".sexycontactform_pre_text").css('fontSize' ,val*1 + 1);
			}
        	else if(roll == 194) { 
				var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
				$(".sexycontactform_pre_text").css('borderTop' , borderTop);
			}
        	else if(roll == 204 || roll == 205 || roll == 206) { 
				var textShadow = $("#elem-204").val() + 'px '  + $("#elem-205").val() + 'px '  + $("#elem-206").val() + 'px ' + $("#elem-203").val();
				$(".sexycontactform_pre_text").css('textShadow' , textShadow);
			}
			/*sexycontactform_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 207 || roll == 208 || roll == 213 || roll == 214) { 
        		var padding = $("#elem-207").val() + 'px ' + $("#elem-214").val() + 'px ' + $("#elem-213").val() + 'px ' + $("#elem-208").val() + 'px';
				$(".sexycontactform_wrapper_inner").css('padding' , padding);
			}
			/*field name ********************************************************************************************************************************************************************************/
        	else if(roll == 215 || roll == 216 || roll == 217 || roll == 218) { 
				var margin = $("#elem-215").val() + 'px ' + $("#elem-216").val() + 'px ' + $("#elem-217").val() + 'px ' + $("#elem-218").val() + 'px';
				$(".sexycontactform_field_name").css('margin' , margin);
			}
			/*sexycontactform_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 210 || roll == 211 || roll == 219 || roll == 220) { 
        		var margin = $("#elem-210").val() + 'px ' + $("#elem-211").val() + 'px ' + $("#elem-219").val() + 'px ' + $("#elem-220").val() + 'px';
				$(".sexycontactform_submit_wrapper").css('margin' , margin);
        	}
        	else if(roll == 209) { 
				var w = $("#elem-209").val() + '%';
				$(".sexycontactform_submit_wrapper").css('width' , w);
			}
			
		}
			
			
		$('.size_down').mousedown(function() {
			var $this = $(this);
			curr_down = parseInt($this.parent('div').prev('input').val());
			down_int = setInterval(function() {
				min_val = parseInt($this.attr("minval"));
				val = parseInt($this.parent('div').prev('input').val());
				if(val > min_val) {
					$this.parent('div').prev('input').val(val*1 - 1);
					roll = $this.parent('div').prev('input').attr('roll');
					move_down(roll,val);
				}
			},100);
		})
		
		$('.size_down').mouseup(function() {
			clearInterval(down_int);
			var $this = $(this);
			min_val = parseInt($this.attr("minval"));
			val = parseInt($this.parent('div').prev('input').val());
			if((val > min_val) && (curr_down == val)) {
				$this.parent('div').prev('input').val(val*1 - 1);
				roll = $this.parent('div').prev('input').attr('roll');
				move_down(roll,val);
			}
		})
		
		$('.size_down').mouseleave(function() {
			clearInterval(down_int);
		});

		function move_down(roll,val) {
			if(roll == 2) {
				$(".sexycontactform_wrapper").css({
					borderLeftWidth : val*1 - 1,
					borderRightWidth : val*1 - 1,
					borderBottomWidth : val*1 - 1,
					borderTopWidth : val*1 - 1
				});
			}
			else if(roll == 4) {
				$(".sexycontactform_wrapper").css('border-top-left-radius' , val*1 - 1);
			}
			else if(roll == 5) {
				$(".sexycontactform_wrapper").css('border-top-right-radius' , val*1 - 1);
			}
			else if(roll == 6) {
				$(".sexycontactform_wrapper").css('border-bottom-left-radius' , val*1 - 1);
			}
			else if(roll == 7) {
				$(".sexycontactform_wrapper").css('border-bottom-right-radius' , val*1 - 1);
			}
			else if(roll == 10 || roll == 11 || roll == 12 || roll == 13  || roll == 16  || roll == 17  || roll == 18  || roll == 19  ) { 
				var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
				var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
				
				$(".sexycontactform_wrapper").css('boxShadow' , boxShadow);
				$(".sexycontactform_wrapper").hover(function() {
					$(this).css('boxShadow' , boxShadow_);
				},function() {
					$(this).css('boxShadow' , boxShadow);
				});
			}
			//top text
			else if(roll == 21) {
				$(".sexycontactform_title").css('fontSize' , val*1 - 1);
			}
			else if(roll == 28 || roll == 29 || roll == 30 ) {
				var textShadow = $("#elem-28").val() + 'px '  + $("#elem-29").val() + 'px '  + $("#elem-30").val() + 'px ' + $("#elem-27").val();
				$(".sexycontactform_title").css('textShadow' , textShadow);
			}
			//field text
			else if(roll == 32) {
				$(".sexycontactform_field_name").css('fontSize' , val*1 + 1);
			}
			else if(roll == 38 || roll == 39 || roll == 40) {
				var textShadow = $("#elem-38").val() + 'px '  + $("#elem-39").val() + 'px '  + $("#elem-40").val() + 'px ' + $("#elem-37").val();
				$(".sexycontactform_field_name").css('textShadow' , textShadow);
			}

			//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 42) {
				$(".sexycontactform_field_required").css('fontSize' , val*1 + 1);
			}
			else if(roll == 47 || roll == 48 || roll == 49) {
				var textShadow = $("#elem-47").val() + 'px '  + $("#elem-48").val() + 'px '  + $("#elem-49").val() + 'px ' + $("#elem-46").val();
				$(".sexycontactform_field_required").css('textShadow' , textShadow);
			}

			//send///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 92) {
				$(".sexycontactform_send").css('paddingTop' , val*1 - 1);
				$(".sexycontactform_send").css('paddingBottom' , val*1 - 1);
			}
			else if(roll == 93) {
				$(".sexycontactform_send").css('paddingLeft' , val*1 - 1);
				$(".sexycontactform_send").css('paddingRight' , val*1 - 1);
			}
			else if(roll == 101) { //box border width
				$(".sexycontactform_send").css({
					borderLeftWidth : val*1 - 1,
					borderRightWidth : val*1 - 1,
					borderBottomWidth : val*1 - 1,
					borderTopWidth : val*1 - 1
				});
			}
			else if(roll == 102) {
				$(".sexycontactform_send").css('border-top-left-radius' , val*1 - 1);
			}
			else if(roll == 103) {
				$(".sexycontactform_send").css('border-top-right-radius' , val*1 - 1);
			}
			else if(roll == 104) {
				$(".sexycontactform_send").css('border-bottom-left-radius' , val*1 - 1);
			}
			else if(roll == 105) {
				$(".sexycontactform_send").css('border-bottom-right-radius' , val*1 - 1);
			}
			else if(roll == 96 || roll == 97 || roll == 98 || roll == 99) {
				var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' +  $("#elem-117").val();
				var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
				$(".sexycontactform_send").css('boxShadow' , boxShadow_);
				
				$(".sexycontactform_send").hover(function() {
					$(this).css('boxShadow' , boxShadow);
				},function() {
					$(this).css('boxShadow' , boxShadow_);
				});
			}
			else if(roll == 107) {
				$(".sexycontactform_send").css('fontSize' , val*1 - 1);
			}
			else if(roll == 114 || roll == 115 || roll == 116 ) {
				var textShadow = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-125").val();
				var textShadow_ = $("#elem-114").val() + 'px '  + $("#elem-115").val() + 'px '  + $("#elem-116").val() + 'px ' + $("#elem-113").val();
				$(".sexycontactform_send").css('textShadow' , textShadow_);
				
				$(".sexycontactform_send").hover(function() {
					$(this).css('textShadow' , textShadow);
				},function() {
					$(this).css('textShadow' , textShadow_);
				});
			}
			else if(roll == 119 || roll == 120 || roll == 121 || roll == 122) {
				var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
				var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
				
				$(".sexycontactform_send").hover(function() {
					$(this).css('boxShadow' , boxShadow);
				},function() {
					$(this).css('boxShadow' , boxShadow_);
				});
			}

			//text inputs///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 135) { //box border width
				$(".sexycontactform_input_element").css({
					borderLeftWidth : val*1 - 1,
					borderRightWidth : val*1 - 1,
					borderBottomWidth : val*1 - 1,
					borderTopWidth : val*1 - 1
				});
			}
			else if(roll == 137) {
				$(".sexycontactform_input_element").css('border-top-left-radius' , val*1 - 1);
			}
			else if(roll == 138) {
				$(".sexycontactform_input_element").css('border-top-right-radius' , val*1 - 1);
			}
			else if(roll == 139) {
				$(".sexycontactform_input_element").css('border-bottom-left-radius' , val*1 - 1);
			}
			else if(roll == 140) {
				$(".sexycontactform_input_element").css('border-bottom-right-radius' , val*1 - 1);
			}

			else if(roll == 143 || roll == 144 || roll == 145 || roll == 146) { 

				var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
				var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
				$(".sexycontactform_input_element").not('.sexy_error_input').css('boxShadow' , boxShadow);
				
				$(".sexycontactform_input_element").not('.sexy_error_input').hover(function() {
					$(this).css('boxShadow' , boxShadow_);
				},function() {
					$(this).css('boxShadow' , boxShadow);
				});
			}
			else if(roll == 154 || roll == 155 || roll == 156) { 
				var textShadow = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-153").val();
				var textShadow_ = $("#elem-154").val() + 'px '  + $("#elem-155").val() + 'px '  + $("#elem-156").val() + 'px ' + $("#elem-160").val();
				$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('textShadow' , textShadow);
				
				$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").hover(function() {
					$(this).css('textShadow' , textShadow_);
				},function() {
					$(this).css('textShadow' , textShadow);
				});
			}
			else if(roll == 148) {
				$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('fontSize' , val*1 - 1);
			}
			else if(roll == 168) {
				var w = val*1 - 1 + '%';
				$(".sexycontactform_input_element").not('.sexy_textarea_wrapper').css('width' , w);
			}
			else if(roll == 169) {
				var w = val*1 - 1 + '%';
				$(".sexy_textarea_wrapper").css('width' , w);
			}
			else if(roll == 170) {
				$(".sexy_textarea_wrapper").css('height' , val*1 - 1);
			}
			
			//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			else if(roll == 173 || roll == 174 || roll == 175) {
				var textShadow = $("#elem-173").val() + 'px '  + $("#elem-174").val() + 'px '  + $("#elem-175").val() + 'px ' + $("#elem-172").val();
				$(".sexycontactform_error .sexycontactform_field_name").css('textShadow' , textShadow);
			}
			else if(roll == 186 || roll == 187 || roll == 188 || roll == 189) { 
				var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
				$(".sexycontactform_error .sexycontactform_input_element").css('boxShadow' , boxShadow);
			}
			else if(roll == 181 || roll == 182 || roll == 183) { 
				var textShadow = $("#elem-181").val() + 'px '  + $("#elem-182").val() + 'px '  + $("#elem-183").val() + 'px ' + $("#elem-180").val();
				$(".sexycontactform_error input").css('textShadow' , textShadow);
			}
			/*pre text ********************************************************************************************************************************************************************************/
        	else if(roll == 190) { 
				var marginTop = $("#elem-190").val() + 'px';
				$(".sexycontactform_pre_text").css('marginTop' , marginTop);
			}
        	else if(roll == 191) { 
				var marginBottom = $("#elem-191").val() + 'px';
				$(".sexycontactform_pre_text").css('marginBottom' , marginBottom);
			}
        	else if(roll == 193) { 
				var paddingTop = $("#elem-193").val() + 'px';
				$(".sexycontactform_pre_text").css('paddingTop' , paddingTop);
			}
        	else if(roll == 192) { 
				var w = $("#elem-192").val() + '%';
				$(".sexycontactform_pre_text").css('width' , w);
			}
        	else if(roll == 198) { 
				$(".sexycontactform_pre_text").css('fontSize' , val*1 - 1);
			}
        	else if(roll == 194) { 
				var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
				$(".sexycontactform_pre_text").css('borderTop' , borderTop);
			}
        	else if(roll == 204 || roll == 205 || roll == 206) { 
				var textShadow = $("#elem-204").val() + 'px '  + $("#elem-205").val() + 'px '  + $("#elem-206").val() + 'px ' + $("#elem-203").val();
				$(".sexycontactform_pre_text").css('textShadow' , textShadow);
			}
			/*sexycontactform_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 207 || roll == 208 || roll == 213 || roll == 214) { 
        		var padding = $("#elem-207").val() + 'px ' + $("#elem-214").val() + 'px ' + $("#elem-213").val() + 'px ' + $("#elem-208").val() + 'px';
				$(".sexycontactform_wrapper_inner").css('padding' , padding);
			}
			/*field name ********************************************************************************************************************************************************************************/
        	else if(roll == 215 || roll == 216 || roll == 217 || roll == 218) { 
				var margin = $("#elem-215").val() + 'px ' + $("#elem-216").val() + 'px ' + $("#elem-217").val() + 'px ' + $("#elem-218").val() + 'px';
				$(".sexycontactform_field_name").css('margin' , margin);
			}
			/*sexycontactform_wrapper_inner ********************************************************************************************************************************************************************************/
        	else if(roll == 210 || roll == 211 || roll == 219 || roll == 220) { 
        		var margin = $("#elem-210").val() + 'px ' + $("#elem-211").val() + 'px ' + $("#elem-219").val() + 'px ' + $("#elem-220").val() + 'px';
				$(".sexycontactform_submit_wrapper").css('margin' , margin);
        	}
        	else if(roll == 209) { 
				var w = $("#elem-209").val() + '%';
				$(".sexycontactform_submit_wrapper").css('width' , w);
			}
		}
		
		$('.sexycontactform_error').hover(function(event) {
			event.stopPropagation();
		})
		
		$('.temp_family').blur(function() {
			var val = $(this).val().replace('|','');
			val = val.replace('~','');
			$(this).val(val);
		})
		
		//main box
		$("#elem-3").change(function() {
			var borderStyle = $(this).val();
			$(".sexycontactform_wrapper").css('borderStyle' , borderStyle);
		})
		$("#elem-9").change(function() {
			var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
			var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
			
			$(".sexycontactform_wrapper").css('boxShadow' , boxShadow);
			$(".sexycontactform_wrapper").hover(function() {
				$(this).css('boxShadow' , boxShadow_);
			},function() {
				$(this).css('boxShadow' , boxShadow);
			});
		})
		$("#elem-15").change(function() {
			var boxShadow = $("#elem-9").val() + ' ' + $("#elem-10").val() + 'px '  + $("#elem-11").val() + 'px '  + $("#elem-12").val() + 'px ' + $("#elem-13").val() + 'px ' + $("#elem-8").val();
			var boxShadow_ = $("#elem-15").val() + ' ' + $("#elem-16").val() + 'px '  + $("#elem-17").val() + 'px '  + $("#elem-18").val() + 'px ' + $("#elem-19").val() + 'px  ' + $("#elem-14").val();
			
			$(".sexycontactform_wrapper").css('boxShadow' , boxShadow);
			$(".sexycontactform_wrapper").hover(function() {
				$(this).css('boxShadow' , boxShadow_);
			},function() {
				$(this).css('boxShadow' , boxShadow);
			});
		})
		$("#elem-131").blur(function() {
			$(".sexycontactform_wrapper").css('fontFamily' , $(this).val());
		})
		
		//top text
		$("#elem-22").change(function() {
			$(".sexycontactform_title").css('fontWeight' , $(this).val());
		})
		$("#elem-23").change(function() {
			$(".sexycontactform_title").css('fontStyle' , $(this).val());
		})
		$("#elem-24").change(function() {
			$(".sexycontactform_title").css('textDecoration' , $(this).val());
		})
		$("#elem-25").change(function() {
			$(".sexycontactform_title").css('textAlign' , $(this).val());
		})
		
		//field text
		$("#elem-33").change(function() {
			$(".sexycontactform_field_name").css('fontWeight' , $(this).val());
		})
		$("#elem-34").change(function() {
			$(".sexycontactform_field_name").css('fontStyle' , $(this).val());
		})
		$("#elem-35").change(function() {
			$(".sexycontactform_field_name").css('textDecoration' , $(this).val());
		})
		$("#elem-36").change(function() {
			$(".sexycontactform_field_name").css('textAlign' , $(this).val());
		})
		
		//asterisk text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-43").change(function() {
			$(".sexycontactform_field_required").css('fontWeight' , $(this).val());
		})
		$("#elem-44").change(function() {
			$(".sexycontactform_field_required").css('fontStyle' , $(this).val());
		})
		
		
		//Send///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-127").change(function() {
			var borderStyle = $(this).val();
			$(".sexycontactform_send").css('border' , $("#elem-101").val() + 'px ' +  borderStyle + $("#elem-100").val());
		})
		$("#elem-112").blur(function() {
			$(".sexycontactform_send").css('fontFamily' , $(this).val());
		})
		$("#elem-108").change(function() {
			$(".sexycontactform_send").css('fontWeight' , $(this).val());
		})
		$("#elem-109").change(function() {
			$(".sexycontactform_send").css('fontStyle' , $(this).val());
		})
		$("#elem-110").change(function() {
			$(".sexycontactform_send").css('textDecoration' , $(this).val());
		})
		$("#elem-95").change(function() {
			var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
			var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
			$(".sexycontactform_send").css('boxShadow' , boxShadow_);
			$(".sexycontactform_send").hover(function() {
				$(this).css('boxShadow' , boxShadow);
			},function() {
				$(this).css('boxShadow' , boxShadow_);
			});

		})
		$("#elem-118").change(function() {
			var boxShadow = $("#elem-118").val() + ' ' + $("#elem-119").val() + 'px '  + $("#elem-120").val() + 'px '  + $("#elem-121").val() + 'px ' + $("#elem-122").val() + 'px ' + $("#elem-117").val();
			var boxShadow_ = $("#elem-95").val() + ' ' + $("#elem-96").val() + 'px '  + $("#elem-97").val() + 'px '  + $("#elem-98").val() + 'px ' + $("#elem-99").val() + 'px ' + $("#elem-94").val();
			
			$(".sexycontactform_send").hover(function() {
				$(this).css('boxShadow' , boxShadow);
			},function() {
				$(this).css('boxShadow' , boxShadow_);
			});
		})
		
		//input text///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-136").change(function() {
			var borderStyle = $(this).val();
			$(".sexycontactform_input_element").not('.sexy_error_input').css('border' , $("#elem-135").val() + 'px ' +  borderStyle + $("#elem-134").val());
		})
		$("#elem-152").blur(function() {
			$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('fontFamily' , $(this).val());
		})
		$("#elem-149").change(function() {
			$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('fontWeight' , $(this).val());
		})
		$("#elem-150").change(function() {
			$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('fontStyle' , $(this).val());
		})
		$("#elem-151").change(function() {
			$(".sexycontactform_input_element input,.sexycontactform_input_element textarea").css('textDecoration' , $(this).val());
		})
		$("#elem-163").change(function() {
			var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
			var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
			$(".sexycontactform_input_element").not('.sexy_error_input').css('boxShadow' , boxShadow);
			
			$(".sexycontactform_input_element").not('.sexy_error_input').hover(function() {
				$(this).css('boxShadow' , boxShadow_);
			},function() {
				$(this).css('boxShadow' , boxShadow);
			});
		})
		$("#elem-142").change(function() {
			var boxShadow = $("#elem-142").val() + ' ' + $("#elem-143").val() + 'px '  + $("#elem-144").val() + 'px '  + $("#elem-145").val() + 'px ' + $("#elem-146").val() + 'px ' +  $("#elem-141").val();
			var boxShadow_ = $("#elem-163").val() + ' ' + $("#elem-164").val() + 'px '  + $("#elem-165").val() + 'px '  + $("#elem-166").val() + 'px ' + $("#elem-167").val() + 'px ' +  $("#elem-162").val();
			$(".sexycontactform_input_element").not('.sexy_error_input').css('boxShadow' , boxShadow);
			
			$(".sexycontactform_input_element").not('.sexy_error_input').hover(function() {
				$(this).css('boxShadow' , boxShadow_);
			},function() {
				$(this).css('boxShadow' , boxShadow);
			});
		})
		//Error State////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-185").change(function() {
			var boxShadow = $("#elem-185").val() + ' ' + $("#elem-186").val() + 'px '  + $("#elem-187").val() + 'px '  + $("#elem-188").val() + 'px ' + $("#elem-189").val() + 'px ' +  $("#elem-184").val();
			$(".sexycontactform_error .sexycontactform_input_element").css('boxShadow' , boxShadow);
		})
		//Pre text////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#elem-196").change(function() {
			var borderTop = $("#elem-194").val() + 'px '  + $("#elem-196").val() + $("#elem-195").val();
			$(".sexycontactform_pre_text").css('borderTop' , borderTop);
		})
		$("#elem-202").blur(function() {
			$(".sexycontactform_pre_text").css('fontFamily' , $(this).val());
		})
		$("#elem-199").change(function() {
			$(".sexycontactform_pre_text").css('fontWeight' , $(this).val());
		})
		$("#elem-200").change(function() {
			$(".sexycontactform_pre_text").css('fontStyle' , $(this).val());
		})
		$("#elem-201").change(function() {
			$(".sexycontactform_pre_text").css('textDecoration' , $(this).val());
		})
		/*sexycontactform_wrapper_inner ********************************************************************************************************************************************************************************/
        $("#elem-212").change(function() {
    		$(".sexycontactform_send").css('float' , $(this).val());
    	})

		

		var top_offset = parseInt($(".preview_box").css('top'));
		top_offset_moove = top_offset + 15;
		//animate preview
		$(window).scroll(function() {
			var off = $("#preview_dummy").offset().top;

			var off_0 = $("#c_div").offset().top;
			if(off > off_0 && !($('.answers_switcher').hasClass('active')) ) {
				delta = off - off_0 + top_offset_moove*1;
				$(".preview_box").stop(true).animate( {
					top: delta
				},500);
			}
			else {
				$(".preview_box").stop(true).animate( {
					top: top_offset
				},500);
			}
			
		})

		$('.temp_block.opened').live('click',function() {
			$(this).removeClass('opened');
			$(this).addClass('closed');
			$(this).next('div').slideUp(600);
		})
		$('.temp_block.closed').live('click',function() {
			$(this).removeClass('closed');
			$(this).addClass('opened');
			$(this).next('div').slideDown(600);
		})


		//answers switcher
		$('.answers_switcher').click(function() {
			if($(this).hasClass('active')) {
				$("#answers_styles_table").height("");
				$(this).removeClass('active');
				$(this).html('Switch to Answers');

				$('.main_view').slideDown(600);
				$('.answers_view').slideUp(600);
				$('#main_styles_table').slideDown(600);
				$('#answers_styles_table').slideUp(600);
			}
			else {
				setTimeout(function() {
					var h = $("#answers_styles_table").height();
					var h1 = $('.preview_box').height();
					if(parseInt(h1) > parseInt(h))
						$("#answers_styles_table").height(h1 + 50*1);
				},650)
				
				$('.preview_box').animate({'top':'26px'},600);
				$('html, body').animate({scrollTop:0}, 600);
				$(this).addClass('active');
				$(this).html('Switch to Main View');

				$('.main_view').slideUp(600);
				$('.answers_view').slideDown(600);
				$('#main_styles_table').slideUp(600);
				$('#answers_styles_table').slideDown(600);

			}
				
		})

	})
})(jQuery);
</script>

<?php 
function create_accordion($txt,$state,$title='') {
	$dis = $state == 'opened' ? '' : 'display:none;';
	echo '<tr>
			<td colspan="2">
				<div class="temp_data_container">
				<div class="temp_block '.$state.'" title="'.$title.'">'.$txt.'</div><div style="'.$dis.'margin-bottom:6px;">
					<table>';
}
function close_accordion() {
	echo '</table></div></div></td></tr>';
}
function echo_font_tr($txt,$i,$value) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <input class="temp_family" value="'.$value.'" name="styles['.$i.']" roll="'.$i.'"  id="elem-'.$i.'"/>	               
            </td>
        </tr>
	';
}
function echo_select_tr($txt,$i,$values,$value) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <select name="styles['.$i.']"  id="elem-'.$i.'" class="temp_select">';
                	foreach($values as $k => $val) {
                		$selected = $value == $k ? 'selected="selected"' : '';
                		echo '<option value="'.$k.'" '.$selected.'>'.$val.'</option>';
                	}
			echo '</select>	               
            </td>
        </tr>
	';
}
function echo_color_tr($txt,$i,$color) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
            <td class="st_td">
	               <div id="colorSelector" class="colorSelector" style="float: left;"><div style="background-color: '.$color.'"></div></div>
	               <input type="hidden" value="'.$color.'" name="styles['.$i.']" roll="'.$i.'"  id="elem-'.$i.'" />
            </td>
        </tr>
	';
}
function echo_size_tr($txt,$i,$size,$min,$max) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
             <td class="st_td">
            	<div class="size_container">
	            	<input class="size_input" type="text" value="'. $size .'" name="styles['.$i.']" readonly="readonly" roll="'.$i.'" id="elem-'.$i.'" />
	            	<div class="size_arrows">
	            		<div class="size_up" maxval="'.$max.'" title="'; echo  'Up'; echo '"></div>
	            		<div class="size_down" minval="'.$min.'" title="'; echo  'Down';echo '"></div>
	            	</div>
	            	<div class="pix_info">px</div>
	            </div>
            </td>
        </tr>
	';
}
function echo_size_perc_tr($txt,$i,$size,$min,$max) {
	echo '
			<tr>
            <td width="180" align="right" class="key">
                <label for="name">';
                    echo $txt;
                echo '</label>
            </td>
             <td class="st_td">
            	<div class="size_container">
	            	<input class="size_input" type="text" value="'. $size .'" name="styles['.$i.']" readonly="readonly" roll="'.$i.'" id="elem-'.$i.'" />
	            	<div class="size_arrows">
	            		<div class="size_up" maxval="'.$max.'" title="'; echo  'Up'; echo '"></div>
	            		<div class="size_down" minval="'.$min.'" title="'; echo  'Down';echo '"></div>
	            	</div>
	            	<div class="pix_info">%</div>
	            </div>
            </td>
        </tr>
	';
}

function seperate_tr($txt,$title='') {
	echo '<tr><td colspan="2"><div class="sep_td" title="'.$title.'">'.$txt.'</div></td></tr>';
}

?>
<div class="col100" style="position: relative;" id="c_div">
	 <div id="preview_dummy"></div>
	 
	 <div class="preview_box">
	 	<div class="main_view">
	
	
	
	
			<div class="sexycontactform_wrapper" >
 				<div class="sexycontactform_wrapper_inner">
 					<form class="sexycontactform_form">
			 			<div class="sexycontactform_title">Contact Us</div>
			 			<div  class="sexycontactform_pre_text">Contact us, if you have any questions</div>
			 			<div class="sexy_title_holder">&nbsp;</div>
		 			
				 		<div class="sexycontactform_field_box">
				 			<label class="sexycontactform_field_name" for="name_0_1">Name <span class="sexycontactform_field_required">*</span></label>
				 			<div class="sexycontactform_input_element sexycontactform_required">
				 				<div class="sexy_input_dummy_wrapper">
				 					<input class="sexy_name sexycontactform_required sexy_input_reset" value="" type="text" id="name_0_1" name="sexycontactform_fields[1][0]">
				 				</div>
				 			</div>
				 			<input type="hidden" name="sexycontactform_fields[1][1]" value="Name" />
				 		</div>
				 		<div class="sexycontactform_field_box">
				 			<label class="sexycontactform_field_name" for="email_0_2">Email</label>
				 			<div class="sexycontactform_input_element ">
					 			<div class="sexy_input_dummy_wrapper">
					 				<input class="sexy_email  sexy_input_reset" value="" type="text" id="email_0_2" name="sexycontactform_fields[2][0]">
					 			</div>
				 			</div>
				 			<input type="hidden" name="sexycontactform_fields[2][1]" value="Email" />
				 		</div>
				 		<div class="sexycontactform_field_box sexycontactform_error">
				 			<label class="sexycontactform_field_name" for="phone_0_3">Phone (Error state)<span class="sexycontactform_field_required">*</span></label>
				 			<div class="sexycontactform_input_element sexycontactform_required sexy_error_input">
				 				<div class="sexy_input_dummy_wrapper">
				 					<input class="sexy_phone  sexy_input_reset sexycontactform_required" value="" type="text" id="phone_0_3" name="sexycontactform_fields[3][0]">
				 				</div>
				 			</div>
				 			<input type="hidden" name="sexycontactform_fields[3][1]" value="Phone" />
				 		</div>
				 		<div class="sexycontactform_field_box">
				 			<label class="sexycontactform_field_name" for="url_0_4">Website</label>
				 			<div class="sexycontactform_input_element ">
				 				<div class="sexy_input_dummy_wrapper">
				 					<input class="sexy_url  sexy_input_reset" value="" type="text" id="url_0_4" name="sexycontactform_fields[4][0]">
				 				</div>
				 			</div>
				 			<input type="hidden" name="sexycontactform_fields[4][1]" value="Website" />
				 		</div>
				 		<div class="sexycontactform_field_box">
				 			<label class="sexycontactform_field_name" for="text-area_0_5">Message <span class="sexycontactform_field_required">*</span></label>
				 			<div class="sexycontactform_input_element sexy_textarea_wrapper sexycontactform_required">
				 				<div class="sexy_textarea_dummy_wrapper">
				 					<textarea class="sexy_textarea sexy_text-area sexycontactform_required sexy_textarea_reset" value="" cols="30" rows="15" id="text-area_0_5" name="sexycontactform_fields[5][0]"></textarea>
				 				</div>
				 			</div>
				 			<input type="hidden" name="sexycontactform_fields[5][1]" value="Message" />
				 		</div>	 				
			 			<div class="sexycontactform_submit_wrapper">
			 				<input type="button" value="Send" class="sexycontactform_send" roll="1" />
			 				<div class="sexycontactform_clear"></div>
			 			</div>
			 			<div class="sexycontactform_clear"></div>
	 			</form>
 			</div>
 		</div>
	</div>
</div>
	
<form action="admin.php?page=sexytemplates&act=submit_data&holder=templates" method="post" id="wpscf_form">
	<div style="float:right;">
		<button  id="wpscf_form_save" class="button-primary">Save</button>
		<button id="wpscf_form_save_close" class="button">Save & Close</button>
		<button id="wpscf_form_save_new" class="button">Save & New</button>
		<a href="admin.php?page=sexytemplates" id="wpscf_add" class="button">Close</a>
	</div>
    <fieldset class="adminform" style="position: relative;">
        <div id="main_styles_table">
	        <table class="temp_table">
	        <?php seperate_tr("Template Name");
	        	create_accordion('Name','closed');?>
	        <tr>
	            <td width="180" align="right" class="key" style="width: 230px;">
	                <label for="name">
	                    <?php echo  'Name'; ?>:
	                </label>
	            </td>
	            <td class="st_td">
	                <input class="text_area" type="text" name="name" id="name" size="60" maxlength="250" value="<?php echo $row->name;?>" />
	            </td>
	            <?php close_accordion();?>
	        </tr>
	        <?php 
	        	$styles_array = explode('|',$row->styles);
	        	$max = 0;
	        	foreach ($styles_array as $val) {
	        		$arr = explode('~',$val);
	        		$styles[$arr[0]] = $arr[1];
	        		$max = $arr[0]> $max ? $arr[0] : $max;
	        	}
	        	
	        	/*
	        	*/
	        	$keys = array_keys($styles);
	        	sort($keys);
	        	
	        	//Main Box//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Main Box");
	        	create_accordion('Styles','closed');
		        	echo_color_tr('Backround Color Start:','0',$styles[0]);
		        	echo_color_tr('Backround Color End:','130',$styles[130]);
		        	echo_size_tr('Top Offset:','207',$styles[207],'-50','50');
		        	echo_size_tr('Right Offset:','214',$styles[214],'-50','50');
		        	echo_size_tr('Bottom Offset:','213',$styles[213],'-50','50');
		        	echo_size_tr('Left Offset:','208',$styles[208],'-50','50');
		        	echo_font_tr('Font Family','131',$styles[131]);
	        	close_accordion();
	        	
	        	create_accordion('Border','closed');
		        	echo_color_tr('Border Color:','1',$styles[1]);
		        	echo_size_tr('Border Size:','2',$styles[2],'0','30');
		        	echo_select_tr('Border Style','3',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[3]);
		        	echo_size_tr('Border Top Left Radius:','4',$styles[4],'0','80');
		        	echo_size_tr('Border Top Right Radius:','5',$styles[5],'0','80');
		        	echo_size_tr('Border Bottom Left Radius:','6',$styles[6],'0','80');
		        	echo_size_tr('Border Bottom Right Radius:','7',$styles[7],'0','80');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','8',$styles[8]);
		        	echo_select_tr('Box Shadow Type','9',array("" => "Default","inset" => "Inset"),$styles[9]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','10',$styles[10],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','11',$styles[11],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','12',$styles[12],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','13',$styles[13],'-120','120');
	        	close_accordion();
	        	
	        	create_accordion('Hover State','closed','Change values and hover over container');
		        	echo_color_tr('Box Shadow Hover Color:','14',$styles[14]);
		        	echo_select_tr('Box Shadow Hover Type','15',array("" => "Default","inset" => "Inset"),$styles[15]);
		        	echo_size_tr('Box Shadow Hover Horizontal Offset:','16',$styles[16],'-80','80');
		        	echo_size_tr('Box Shadow Hover Vertical Offset:','17',$styles[17],'-80','80');
		        	echo_size_tr('Box Shadow Hover Blur Radius:','18',$styles[18],'-120','120');
		        	echo_size_tr('Box Shadow Hover Spread Radius:','19',$styles[19],'-120','120');
	        	close_accordion();
	        	
	        	//poll name////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Top text");
	        	create_accordion('Font Styles','closed');
	        		echo_color_tr('Font Color:','20',$styles[20]);
	        		echo_size_tr('Font Size:','21',$styles[21],'8','36');
	        		echo_select_tr('Font Weight','22',array("normal" => "Normal","bold" => "Bold"),$styles[22]);
	        		echo_select_tr('Font Style','23',array("normal" => "Normal","italic" => "Italic"),$styles[23]);
	        		echo_select_tr('Text Decoration','24',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[24]);
	        		echo_select_tr('Text Align','25',array("left" => "Left","right" => "Right","center" => "Center"),$styles[25]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
	        		echo_color_tr('Text Shadow Color:','27',$styles[27]);
	        		echo_size_tr('Text Shadow Horizontal Offset:','28',$styles[28],'-50','50');
	        		echo_size_tr('Text Shadow Vertical Offset:','29',$styles[29],'-50','50');
	        		echo_size_tr('Text Shadow Blur Radius:','30',$styles[30],'0','50');
	        	close_accordion();
	        	
	        	//pre text
	        	seperate_tr("Pre-text");
	        	create_accordion('Styles','closed','');
		        	echo_size_tr('Offset Top:','190',$styles[190],'-500','500');
		        	echo_size_tr('Offset Bottom:','191',$styles[191],'-500','500');
		        	echo_size_perc_tr('Width:','192',$styles[192],'0','100');
	        	close_accordion();
	        	create_accordion('Horizontal Line','closed');
		        	echo_size_tr('Horizontal Line Offset:','193',$styles[193],'-500','500');
		        	echo_size_tr('Horizontal Line Size:','194',$styles[194],'0','10');
		        	echo_color_tr('Horizontal Line Color:','195',$styles[195]);
		        	echo_select_tr('Horizontal Line Style','196',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[196]);
	        	close_accordion();
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','197',$styles[197]);
		        	echo_size_tr('Font Size:','198',$styles[198],'8','22');
		        	echo_select_tr('Font Weight','199',array("normal" => "Normal","bold" => "Bold"),$styles[199]);
		        	echo_select_tr('Font Style','200',array("normal" => "Normal","italic" => "Italic"),$styles[200]);
		        	echo_select_tr('Text Decoration','201',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[201]);
		        	echo_font_tr('Font Family','202',$styles[202]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','203',$styles[203]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','204',$styles[204],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','205',$styles[205],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','206',$styles[206],'0','50');
	        	close_accordion();
	        	
	        	//Label text////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Label text");
	        	create_accordion('Offsets','closed');
		        	echo_size_tr('Top Offset:','215',$styles[215],'-50','50');
		        	echo_size_tr('Right Offset:','216',$styles[216],'-50','50');
		        	echo_size_tr('Bottom Offset:','217',$styles[217],'-50','50');
		        	echo_size_tr('Left Offset:','218',$styles[218],'-50','50');
	        	close_accordion();
	        	create_accordion('Font Styles','closed');
	        		echo_color_tr('Font Color:','31',$styles[31]);
	        		echo_size_tr('Font Size:','32',$styles[32],'8','36');
	        		echo_select_tr('Font Weight','33',array("normal" => "Normal","bold" => "Bold"),$styles[33]);
	        		echo_select_tr('Font Style','34',array("normal" => "Normal","italic" => "Italic"),$styles[34]);
	        		echo_select_tr('Text Decoration','35',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[35]);
	        		echo_select_tr('Text Align','36',array("left" => "Left","right" => "Right","center" => "Center"),$styles[36]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
	        		echo_color_tr('Text Shadow Color:','37',$styles[37]);
	        		echo_size_tr('Text Shadow Horizontal Offset:','38',$styles[38],'-50','50');
	        		echo_size_tr('Text Shadow Vertical Offset:','39',$styles[39],'-50','50');
	        		echo_size_tr('Text Shadow Blur Radius:','40',$styles[40],'0','50');
	        	close_accordion();
	        	
	        	//Asterisk Styles////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Asterisk Styles");
	        	create_accordion('Font Styles','closed');
	        		echo_color_tr('Font Color:','41',$styles[41]);
	        		echo_size_tr('Font Size:','42',$styles[42],'8','36');
	        		echo_select_tr('Font Weight','43',array("normal" => "Normal","bold" => "Bold"),$styles[43]);
	        		echo_select_tr('Font Style','44',array("normal" => "Normal","italic" => "Italic"),$styles[44]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
	        		echo_color_tr('Text Shadow Color:','46',$styles[46]);
	        		echo_size_tr('Text Shadow Horizontal Offset:','47',$styles[47],'-50','50');
	        		echo_size_tr('Text Shadow Vertical Offset:','48',$styles[48],'-50','50');
	        		echo_size_tr('Text Shadow Blur Radius:','49',$styles[49],'0','50');
	        	close_accordion();
	        	
	        	//Input Elements /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Text Inputs");
	        	create_accordion('Styles','closed','Background Color, Paddings');
		        	echo_color_tr('Background Color Start:','132',$styles[132]);
		        	echo_color_tr('Background Color End:','133',$styles[133]);
		        	echo_size_perc_tr('Input Width:','168',$styles[168],'10','100');
		        	echo_size_perc_tr('Textarea Width:','169',$styles[169],'10','100');
		        	echo_size_tr('Textarea Height:','170',$styles[170],'10','500');
	        	close_accordion();
	        	
	        	create_accordion('Border','closed');
		        	echo_color_tr('Border Color:','134',$styles[134]);
		        	echo_size_tr('Border Size:','135',$styles[135],'0','3');
		        	echo_select_tr('Border Style','136',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[136]);
		        	echo_size_tr('Border Top Left Radius:','137',$styles[137],'0','80');
		        	echo_size_tr('Border Top Right Radius:','138',$styles[138],'0','80');
		        	echo_size_tr('Border Bottom Left Radius:','139',$styles[139],'0','80');
		        	echo_size_tr('Border Bottom Right Radius:','140',$styles[140],'0','80');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','141',$styles[141]);
		        	echo_select_tr('Box Shadow Type','142',array("" => "Default","inset" => "Inset"),$styles[142]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','143',$styles[143],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','144',$styles[144],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','145',$styles[145],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','146',$styles[146],'-120','120');
	        	close_accordion();
	        	
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','147',$styles[147]);
		        	echo_size_tr('Font Size:','148',$styles[148],'8','22');
		        	echo_select_tr('Font Weight','149',array("normal" => "Normal","bold" => "Bold"),$styles[149]);
		        	echo_select_tr('Font Style','150',array("normal" => "Normal","italic" => "Italic"),$styles[150]);
		        	echo_select_tr('Text Decoration','151',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[151]);
		        	echo_font_tr('Font Family','152',$styles[152]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','153',$styles[153]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','154',$styles[154],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','155',$styles[155],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','156',$styles[156],'0','50');
	        	close_accordion();
	        	create_accordion('Hover State','closed','Shadow, Background Color, Font Color');
	        		echo_color_tr('Background Color Start:','157',$styles[157]);
	        		echo_color_tr('Background Color End:','158',$styles[158]);
	        		echo_color_tr('Text Color:','159',$styles[159]);
	        		echo_color_tr('Text Shadow Color:','160',$styles[160]);
	        		echo_color_tr('Border Color:','161',$styles[161]);
		        	echo_color_tr('Box Shadow Color:','162',$styles[162]);
		        	echo_select_tr('Box Shadow Type','163',array("" => "Default","inset" => "Inset"),$styles[163]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','164',$styles[164],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','165',$styles[165],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','166',$styles[166],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','167',$styles[167],'-120','120');
	        	close_accordion();
	        	
	        	//Error State/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Error State");
	        	
	        	create_accordion('Label Text Styles','closed');
		        	echo_color_tr('Font Color:','171',$styles[171]);
		        	echo_color_tr('Text Shadow Color:','172',$styles[172]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','173',$styles[173],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','174',$styles[174],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','175',$styles[175],'0','50');
	        	close_accordion();
	        	
	        	create_accordion('Input Styles','closed','');
		        	echo_color_tr('Background Color Start:','176',$styles[176]);
		        	echo_color_tr('Background Color End:','177',$styles[177]);
		        	echo_color_tr('Border Color:','178',$styles[178]);
		        	echo_color_tr('Font Color:','179',$styles[179]);
	        	close_accordion();
	        	
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','180',$styles[180]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','181',$styles[181],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','182',$styles[182],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','183',$styles[183],'0','50');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','184',$styles[184]);
		        	echo_select_tr('Box Shadow Type','185',array("" => "Default","inset" => "Inset"),$styles[185]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','186',$styles[186],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','187',$styles[187],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','188',$styles[188],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','189',$styles[189],'-120','120');
	        	close_accordion();
	        	
	        	//Vote button/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	        	seperate_tr("Send Button");
	        	create_accordion('Styles','closed','Background Color, Paddings');
		        	echo_color_tr('Background Color Start:','91',$styles[91]);
		        	echo_color_tr('Background Color End:','50',$styles[50]);
		        	echo_select_tr('Button Alignment','212',array("left" => "Left", "right" => "Right"),$styles[212]);
		        	echo_size_tr('Padding Top,Bottom:','92',$styles[92],'0','30');
		        	echo_size_tr('Padding Left,Right:','93',$styles[93],'0','500');
		        	echo_size_tr('Top Offset:','210',$styles[210],'-50','50');
		        	echo_size_tr('Right Offset:','211',$styles[211],'-50','50');
		        	echo_size_tr('Bottom Offset:','219',$styles[219],'-50','50');
		        	echo_size_tr('Left Offset:','220',$styles[220],'-50','50');
		        	echo_size_perc_tr('Wrapper Width:','209',$styles[209],'0','100');
	        	close_accordion();
	        	
	        	create_accordion('Border','closed');
		        	echo_color_tr('Border Color:','100',$styles[100]);
		        	echo_size_tr('Border Size:','101',$styles[101],'0','3');
		        	echo_select_tr('Border Style','127',array("solid" => "Solid", "dotted" => "Dotted","dashed" => "Dashed", "double" => "Double", "groove" => "Groove", "ridge" => "Ridge", "inset" => "Inset", "outset" => "Outset"),$styles[127]);
		        	echo_size_tr('Border Top Left Radius:','102',$styles[102],'0','80');
		        	echo_size_tr('Border Top Right Radius:','103',$styles[103],'0','80');
		        	echo_size_tr('Border Bottom Left Radius:','104',$styles[104],'0','80');
		        	echo_size_tr('Border Bottom Right Radius:','105',$styles[105],'0','80');
	        	close_accordion();
	        	
	        	create_accordion('Box Shadow','closed');
		        	echo_color_tr('Box Shadow Color:','94',$styles[94]);
		        	echo_select_tr('Box Shadow Type','95',array("" => "Default","inset" => "Inset"),$styles[95]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','96',$styles[96],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','97',$styles[97],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','98',$styles[98],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','99',$styles[99],'-120','120');
	        	close_accordion();
	        	
	        	create_accordion('Font Styles','closed');
		        	echo_color_tr('Font Color:','106',$styles[106]);
		        	echo_size_tr('Font Size:','107',$styles[107],'8','22');
		        	echo_select_tr('Font Weight','108',array("normal" => "Normal","bold" => "Bold"),$styles[108]);
		        	echo_select_tr('Font Style','109',array("normal" => "Normal","italic" => "Italic"),$styles[109]);
		        	echo_select_tr('Text Decoration','110',array("none" => "None","underline" => "Underline","overline" => "Overline","line-through"=>"Line Through"),$styles[110]);
		        	echo_font_tr('Font Family','112',$styles[112]);
	        	close_accordion();
	        	create_accordion('Text Shadow','closed');
		        	echo_color_tr('Text Shadow Color:','113',$styles[113]);
		        	echo_size_tr('Text Shadow Horizontal Offset:','114',$styles[114],'-50','50');
		        	echo_size_tr('Text Shadow Vertical Offset:','115',$styles[115],'-50','50');
		        	echo_size_tr('Text Shadow Blur Radius:','116',$styles[116],'0','50');
	        	close_accordion();
	        	create_accordion('Hover State','closed','Shadow, Background Color, Font Color');
		        	echo_color_tr('Background Color Start:','51',$styles[51]);
		        	echo_color_tr('Background Color End:','52',$styles[52]);
		        	echo_color_tr('Text Color:','124',$styles[124]);
		        	echo_color_tr('Text Shadow Color:','125',$styles[125]);
		        	echo_color_tr('Border Color:','126',$styles[126]);
		        	echo_color_tr('Box Shadow Color:','117',$styles[117]);
		        	echo_select_tr('Box Shadow Type','118',array("" => "Default","inset" => "Inset"),$styles[118]);
		        	echo_size_tr('Box Shadow Horizontal Offset:','119',$styles[119],'-80','80');
		        	echo_size_tr('Box Shadow Vertical Offset:','120',$styles[120],'-80','80');
		        	echo_size_tr('Box Shadow Blur Radius:','121',$styles[121],'-120','120');
		        	echo_size_tr('Box Shadow Spread Radius:','122',$styles[122],'-120','120');
	        	close_accordion();
	        ?>
	    </table>
	  </div>
    </fieldset>
</div>
 
<div class="clr"></div>
 
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="task" value="" id="wpscf_task">
</form>
<style>
.sexycontactform_wrapper {
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
.sexycontactform_wrapper:hover {
	-moz-box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
	-webkit-box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
	box-shadow: <?php echo $styles[15];?> <?php echo $styles[16];?>px <?php echo $styles[17];?>px <?php echo $styles[18];?>px <?php echo $styles[19];?>px  <?php echo $styles[14];?>;
}
.sexycontactform_wrapper_inner {
	padding:  <?php echo $styles[207];?>px  <?php echo $styles[214];?>px <?php echo $styles[213];?>px <?php echo $styles[208];?>px;
}

.sexycontactform_title {
	color: <?php echo $styles[20];?>;
	font-size: <?php echo $styles[21];?>px;
	font-style: <?php echo $styles[23];?>;
	font-weight: <?php echo $styles[22];?>;
	text-align: <?php echo $styles[25];?>;
	text-decoration: <?php echo $styles[24];?>;
	text-shadow: <?php echo $styles[28];?>px <?php echo $styles[29];?>px <?php echo $styles[30];?>px <?php echo $styles[27];?>;
}

.sexycontactform_field_name {
	color: <?php echo $styles[31];?>;
	font-size: <?php echo $styles[32];?>px;
	font-style: <?php echo $styles[34];?>;
	font-weight: <?php echo $styles[33];?>;
	text-align: <?php echo $styles[36];?>;
	text-decoration: <?php echo $styles[35];?>;
	text-shadow: <?php echo $styles[38];?>px <?php echo $styles[39];?>px <?php echo $styles[40];?>px <?php echo $styles[37];?>;
	margin:  <?php echo $styles[215];?>px  <?php echo $styles[216];?>px <?php echo $styles[217];?>px <?php echo $styles[218];?>px;
}

.sexycontactform_field_required {
	color: <?php echo $styles[41];?>;
	font-size: <?php echo $styles[42];?>px;
	font-style: <?php echo $styles[44];?>;
	font-weight: <?php echo $styles[43];?>;
	text-shadow: <?php echo $styles[47];?>px <?php echo $styles[48];?>px <?php echo $styles[49];?>px <?php echo $styles[46];?>;
}

.sexycontactform_send {
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
.sexycontactform_send:hover {
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
		        	
.sexycontactform_submit_wrapper {
	width: 	<?php echo $styles[209];?>%;
	margin: <?php echo $styles[210];?>px <?php echo $styles[211];?>px <?php echo $styles[219];?>px <?php echo $styles[220];?>px;
}

.sexycontactform_input_element {
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
.sexycontactform_input_element input,.sexycontactform_input_element textarea{
	font-size: <?php echo $styles[148];?>px;
	color: <?php echo $styles[147];?>;
	font-style: <?php echo $styles[150];?>;
	font-weight: <?php echo $styles[149];?>;
	text-decoration: <?php echo $styles[151];?>;
	font-family: <?php echo $styles[152];?>;
	font-family: <?php echo $f = $styles[152] != '' ? $styles[152] : 'inherit';?>;
	text-shadow: <?php echo $styles[154];?>px <?php echo $styles[155];?>px <?php echo $styles[156];?>px <?php echo $styles[153];?>;
}

.sexycontactform_input_element:hover,.sexycontactform_input_element:focus,.sexycontactform_input_element.focused {
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
.sexycontactform_input_element input:hover,.sexycontactform_input_element input:focus,.sexycontactform_input_element textarea:hover,.sexycontactform_input_element textarea:focus,.sexycontactform_input_element.focused input,.sexycontactform_input_element.focused textarea {
	color: <?php echo $styles[159];?>;
	text-shadow: <?php echo $styles[154];?>px <?php echo $styles[155];?>px <?php echo $styles[156];?>px <?php echo $styles[160];?>;
}

.sexycontactform_input_element.sexy_textarea_wrapper {
	width:<?php echo $styles[169];?>%;
	height:<?php echo $styles[170];?>px;
}

.sexycontactform_error .sexycontactform_field_name,.sexycontactform_error .sexycontactform_field_name:hover {
	color: <?php echo $styles[171];?>;
	text-shadow: <?php echo $styles[173];?>px <?php echo $styles[174];?>px <?php echo $styles[175];?>px <?php echo $styles[172];?>;
}
.sexycontactform_error .sexycontactform_input_element,.sexycontactform_error .sexycontactform_input_element:hover {
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
.sexycontactform_error input,.sexycontactform_error input:hover, .sexycontactform_error .focused input:hover, .sexycontactform_error .focused input, .sexycontactform_error textarea,.sexycontactform_error textarea:hover {
	
	color: <?php echo $styles[179];?>;
	text-shadow: <?php echo $styles[181];?>px <?php echo $styles[182];?>px <?php echo $styles[183];?>px <?php echo $styles[180];?>;
}

.sexycontactform_pre_text {
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

</style>