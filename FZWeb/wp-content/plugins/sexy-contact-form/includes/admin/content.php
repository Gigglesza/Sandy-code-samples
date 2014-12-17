<div id="scf_content">
	<?php 
		if($page == 'sexycontactform')
			include('overview.php');
		elseif($page == 'sexyforms') {
			if($act == '')
				include('forms.php');
			elseif($act == 'new' || $act == 'edit')
				include('form.php');
		}
		elseif($page == 'sexyfields') {
			if($act == '')
				include('fields.php');
			elseif($act == 'new' || $act == 'edit')
				include('field.php');
		}
		elseif($page == 'sexytemplates') {
			if($act == '')
				include('templates.php');
			elseif($act == 'new')
				include('template_add.php');
			elseif($act == 'edit')
				include('template_edit.php');
		}
	?>
</div>