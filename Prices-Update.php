<?php

global $wpdb;
$user = $wpdb->dbuser;
$pass = $wpdb->dbpassword;
$host = $wpdb->dbhost;
$db = $wpdb->dbname;
$prefix = $wpdb->prefix;

mysql_connect($host,$user,$pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());

$ID = $_GET["ID"];

// hent først url til produktet
$sql = "SELECT * FROM `".$prefix."AP_Prices` WHERE `ID` = '".$ID."';";
$query = mysql_query($sql) or die(mysql_error());
while( $row = mysql_fetch_assoc($query) ) {
	$ProductUrl = $row["ProductUrl"];
	$WebshopID = $row["WebshopID"];
}

// hent crawler info
$sql = "SELECT * FROM `".$prefix."AP_Webshops` WHERE `ID` = '".$WebshopID."';";
$query = mysql_query($sql) or die(mysql_error());
while( $row = mysql_fetch_assoc($query) ) {
	$CrawlFrom = $row["CrawlFrom"];
	$CrawlTo = $row["CrawlTo"];
}





require_once"Crawler.php";

$NewPrice = AP_Crawler($ProductUrl,$CrawlFrom,$CrawlTo);

$update = "UPDATE `".$prefix."AP_Prices` Set `Price` = '".$NewPrice."', `LastUpdated` = '".date("Y-m-d H:i:s")."' WHERE `ID` = '".$ID."';";
mysql_query($update) or die(mysql_error() );

header('Location: ?page=Affiliate-Plugin/Prices/List');
exit();

?>