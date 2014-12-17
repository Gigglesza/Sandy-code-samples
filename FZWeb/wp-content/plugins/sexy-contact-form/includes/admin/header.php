<div class="purchase_block">
	<div class="purchase_block_txt">Get Sexy Contact Form Pro and gain access to unlimited fields, unlimited forms, more features and professional support.</div>
    <a href="http://creative-solutions.net/wordpress/creative-contact-form" id="scf_buy_pro" target="_blank">Get Sexy Contact Form PRO</a>

</div>
<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'sexycontactform';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$id = isset($_REQUEST['id']) ?  $_REQUEST['id'] : 0;
//get the active text
switch ($page) {
	case 'sexycontactform':
		$active_text = 'Overview';
		break;
	case 'sexyforms':
		$active_text = $act == '' ? 'Forms' : ($act == 'new' ? 'Forms : New' : 'Forms : Edit');
		break;
	case 'sexyfields':
		$active_text = $act == '' ? 'Fields' : ($act == 'new' ? 'Fields : New' : 'Fields : Edit');
		break;
	case 'sexytemplates':
		$active_text = 'Templates';
		break;
}
?>
    <div id="scf_logo" class="icon32"></div>
    <h2>Sexy Contact Form : <?php echo $active_text;?></h2>
    <p></p>
    <div id="scf-toolbar">
        <ul id="scf-toolbar-links">
	        <li><div class="scf-toolbar-link-bg" id="scf-toolbar-link-overview<?php echo $page == 'sexycontactform' ? '_active' : '';?>" style="margin-left: 5px;"></div><a class="<?php echo $page == 'sexycontactform' ? 'scf-toolbar-active' : '';?>" href="admin.php?page=sexycontactform">Overview</a></li>
	        <li><div class="scf-toolbar-link-bg" id="scf-toolbar-link-forms<?php echo $page == 'sexyforms' ? '_active' : '';?>"></div><a class="<?php echo $page == 'sexyforms' ? 'scf-toolbar-active' : '';?>" href="admin.php?page=sexyforms">Forms</a></li>
	        <li><div class="scf-toolbar-link-bg" id="scf-toolbar-link-fields<?php echo $page == 'sexyfields' ? '_active' : '';?>"></div><a class="<?php echo $page == 'sexyfields' ? 'scf-toolbar-active' : '';?>" href="admin.php?page=sexyfields">Fields</a></li>
	        <li><div class="scf-toolbar-link-bg" id="scf-toolbar-link-templates<?php echo $page == 'sexytemplates' ? '_active' : '';?>"></div><a class="<?php echo $page == 'sexytemplates' ? 'scf-toolbar-active' : '';?>" href="admin.php?page=sexytemplates">Templates</a></li>
        </ul>
    </div>
    <div style="clear:both;"></div>