<?php 
global $wpdb;
delete_option('wpscf_db_version');

require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."sexy_contact_templates`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."sexy_forms`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."sexy_fields`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."sexy_field_types`";
$wpdb->query($sql);

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."sexy_form_options`";
$wpdb->query($sql);
?>