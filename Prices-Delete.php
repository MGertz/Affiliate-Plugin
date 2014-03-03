<?php
if( isset($_GET["ID"]) ) {

	$ID = $_GET["ID"];

	global $wpdb;
	$user = $wpdb->dbuser;
	$pass = $wpdb->dbpassword;
	$host = $wpdb->dbhost;
	$db = $wpdb->dbname;
	$prefix = $wpdb->prefix;

	mysql_connect($host,$user,$pass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());

	$delete = "DELETE FROM `".$prefix."AP_Prices` WHERE `ID` = '".$ID."'";
	mysql_query($delete) or die(mysql_error());

	Header("Location: ?page=Affiliate-Plugin/Prices/List");
	exit();
}

?>