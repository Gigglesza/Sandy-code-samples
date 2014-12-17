(function($) {
$(document).ready(function() {
	
	/////////////////////////////////////////////////////////////////////////TASKS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//check/uncheck all
	$("#wpscf_check_all").click(function() {
		if($(this).is(":checked")) {
			$('.wpscf_row_ch').attr('checked',true);
		}
		else {
			$('.wpscf_row_ch').attr('checked',false);
		}
		
		wpscf_check_the_selection();
	});
	
	//unpublish task
	$(".wpscf_unpublish").click(function() {
		var id = $(this).attr("wpscf_id");
		$("#wpscf_def_id").val(id);
		$("#wpscf_task").val('unpublish');
		$("#wpscf_form").submit();
		return false;
	});
	//publish task
	$(".wpscf_publish").click(function() {
		var id = $(this).attr("wpscf_id");
		$("#wpscf_def_id").val(id);
		$("#wpscf_task").val('publish');
		$("#wpscf_form").submit();
		return false;
	});
	//publish list task
	$("#wpscf_publish_list").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpscf_row_ch:checked').length);
		if(l > 0) {
			$("#wpscf_task").val('publish');
			$("#wpscf_form").submit();
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	//unpublish list task
	$("#wpscf_unpublish_list").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpscf_row_ch:checked').length);
		if(l > 0) {
			$("#wpscf_task").val('unpublish');
			$("#wpscf_form").submit();
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	//edit list task
	$("#wpscf_edit").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpscf_row_ch:checked').length);
		if(l > 0) {
			var id = $('.wpscf_row_ch:checked').first().val();
			var url_part1 =$("#wpscf_form").attr("action");
			var url = url_part1 + '&act=edit&id=' + id;
			window.location.replace(url);
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	//delete task
	$("#wpscf_delete").click(function(e) {
		e.preventDefault();
		var l = parseInt($('.wpscf_row_ch:checked').length);
		if(l > 0) {
			if(confirm('Delete selected items?')) {
				$("#wpscf_task").val('delete');
				$("#wpscf_form").submit();
			}
			return false;
		}
		else {
			alert('Please first make a selection from the list');
			return false;
		}
	});
	
	
	//filter select
	$(".wpscf_select").change(function() {
		$("#wpscf_form").submit();
	});
	//filter search
	$("#wpscf_filter_search_submit").click(function() {
		$("#wpscf_form").submit();
	});
	
	//list of checkbox
	$('.wpscf_row_ch').click(function() {
		if(!($(this).is(':checked'))) {
			$("#wpscf_check_all").attr('checked',false);
		}
		wpscf_check_the_selection();
	});
	
	function wpscf_check_the_selection() {
		var l = parseInt($('.wpscf_row_ch:checked').length);
		if(l == 0) {
			$('.wpscf_disabled').addClass('button-disabled');
			$('.wpscf_disabled').attr('title','Please make a selection from the list, to activate this button');
		}
		else {
			$('.wpscf_disabled').removeClass('button-disabled');
			$('.wpscf_disabled').attr('title','');
		}
	};
	
	/////////////////////////////////////////////////////Add form//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#wpscf_form_save").click(function() {
		if(!wpscf_validate_form())
			return false;
		$("#wpscf_task").val('save');
		$("#wpscf_form").submit();
		return false;
	});
	$("#wpscf_form_save_close").click(function() {
		if(!wpscf_validate_form())
			return false;
		$("#wpscf_task").val('save_close');
		$("#wpscf_form").submit();
		return false;
	});
	$("#wpscf_form_save_new").click(function() {
		if(!wpscf_validate_form())
			return false;
		$("#wpscf_task").val('save_new');
		$("#wpscf_form").submit();
		return false;
	});
	
	//function to validate forms form
	function wpscf_validate_form() {
		var tested = true;
		$("#wpscf_form").find('.required').each(function() {
			var val = $.trim($(this).val());
			if(val == '') {
				$(this).addClass('wpscf_error');
				tested = false;
			}
			else
				$(this).removeClass('wpscf_error');
		});
		if(tested)
			return true;
		else
			return false;
	};
	
	//////////////////////////////////////////////////Table list sortable///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var wpscf_selected_tr_id = 0;
	function wpscf_make_sortable() {
		var table_name = $("#wpscf_sortable").attr("table_name");
		var reorder_type = $("#wpscf_sortable").attr("reorder_type");
		
		//sortable
		$("#wpscf_sortable").sortable();
		$("#wpscf_sortable").disableSelection();
		$("#wpscf_sortable").sortable( "option", "disabled", true );
		$("#wpscf_sortable .wpscf_reorder").mousedown(function()
		{
			wpscf_selected_tr_id = $(this).parents('tr').attr("id");
			$( "#wpscf_sortable" ).sortable( "option", "disabled", false );
		});
		$( "#wpscf_sortable" ).sortable(
		{
			update: function(event, ui) 
			{
				var order = $("#wpscf_sortable").sortable('toArray').toString();
				$.post
				(
						"admin.php?page=sexyforms&act=submit_data&holder=sexyajax",
						{order: order,type: reorder_type,table_name: table_name},
						function(data)
						{
							//window.location.reload();
							return false;
						}
				);
			}
		});
		$( "#wpscf_sortable" ).sortable(
		{
			stop: function(event, ui) 
			{
				$( "#wpscf_sortable" ).sortable( "option", "disabled", true );
			}
		});
	}
	wpscf_make_sortable();
	
	function wpscf_generate_td_width() {
		$('.ui-state-default').each(function() {
			$(this).find('td').each(function(i) {
				if(i == $(this).find('td').length)
					var w = $(this).width()-2;
				else
					var w = $(this).width();
				$(this).attr("w",w);
				$(this).css('width',w);
			});
		})
	};
	wpscf_generate_td_width();
	
	//field type limit
	$("#wpscf_id_type").change(function() {
		var id = $(this).val();
		if(id == 13 || id == 14) {
			alert('Please Upgrade to PRO Version to use this field type');
			$(this).val(1);
			return false;
		}
	});
	
					
});
})(jQuery);