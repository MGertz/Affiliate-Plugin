<?php

if( $_SERVER["REQUEST_METHOD"] == "POST" AND isset( $_POST["AP_Form_Post"] ) ) {
	#echo "<pre>";
	#print_r($_POST);

	global $wpdb;
	$user = $wpdb->dbuser;
	$pass = $wpdb->dbpassword;
	$host = $wpdb->dbhost;
	$db = $wpdb->dbname;
	$prefix = $wpdb->prefix;

	mysql_connect($host,$user,$pass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());


	// denne del kaldes når der oprettes en webshop i systemet.
	if( $_POST["AP_Form_Post"] == "AddWebshopFrom" ) {
		

		$ShopName = $_POST["ShopName"];
		$SiteUrl = $_POST["SiteUrl"];
		$AffiliateID = $_POST["AffiliateID"];
		$ProgramID = $_POST["ProgramID"];
		$Shipping = $_POST["Shipping"];
		$Currency = $_POST["Currency"];
		$CrawlFrom = $_POST["CrawlFrom"];
		$CrawlTo = $_POST["CrawlTo"];

		$insert = "INSERT INTO `".$prefix."AP_Webshops` (`ShopName`,`SiteUrl`,`AffiliateID`,`ProgramID`,`Shipping`,`Currency`,`CrawlFrom`,`CrawlTo`) VALUES ('".$ShopName."','".$SiteUrl."','".$AffiliateID."','".$ProgramID."','".$Shipping."','".$Currency."','".$CrawlFrom."','".$CrawlTo."');";
		mysql_query($insert) or die(mysql_error());

		header("Location: ?page=Affiliate-Plugin/Webshops/List");
		exit();
	}


	if( $_POST["AP_Form_Post"] == "AddtablesFrom" ) {
		$Name = $_POST["Name"];

		$insert = "INSERT INTO `".$prefix."AP_Tables` (`Name`) VALUES ('".$Name."');";
		mysql_query($insert) or die(mysql_error());

		header("Location: ?page=Affiliate-Plugin/Tables/List");
		exit();
	}


	if( $_POST["AP_Form_Post"] == "AddPriceForm" ) {
		$WebshopID = $_POST["WebshopID"];
		$TableID = $_POST["TableID"];
		$ProductUrl = $_POST["ProductUrl"];
		$date = date("Y-m-d H:i:s");


		// hent crawler info
		$sql = "SELECT * FROM `".$prefix."AP_Webshops` WHERE `ID` = '".$WebshopID."';";
		$query = mysql_query($sql) or die(mysql_error());
		while( $row = mysql_fetch_assoc($query) ) {
			$CrawlFrom = $row["CrawlFrom"];
			$CrawlTo = $row["CrawlTo"];
		}

		

		require_once"Crawler.php";
		$Price = AP_Crawler($ProductUrl,$CrawlFrom,$CrawlTo);



		$insert = "INSERT INTO `".$prefix."AP_Prices` (`WebshopID`,`TableID`,`ProductUrl`,`Price`,`LastUpdated`,`Added`) VALUES ('".$WebshopID."','".$TableID."','".$ProductUrl."','".$Price."','".$date."','".$date."');";
		mysql_query($insert) or die(mysql_error());

		header("Location: ?page=Affiliate-Plugin/Prices/List");
		exit();
	}

	if( $_POST["AP_Form_Post"] == "FormPricesEdit" ) {


		$WebshopID = $_POST["WebshopID"];
		$TableID = $_POST["TableID"];
		$ProductUrl = $_POST["ProductUrl"];
		$Price = $_POST["Price"];
		$ID = $_POST["ID"];




		$update = "UPDATE `".$prefix."AP_Prices` Set `WebshopID` = '".$WebshopID."', `Price` = '".$Price."', `TableID` = '".$TableID."', `ProductUrl` = '".$ProductUrl."' WHERE `ID` = '".$ID."';";
		mysql_query($update) or die(mysql_error() );

		header("Location: ?page=Affiliate-Plugin/Prices/List");
		exit();

	}



	if( $_POST["AP_Form_Post"] == "FormWebshopEdit") {
		$ID = $_POST["ID"];
		$ShopName = $_POST["ShopName"];
		$SiteUrl = $_POST["SiteUrl"];
		$AffiliateID = $_POST["AffiliateID"];
		$ProgramID = $_POST["ProgramID"];
		$Shipping = $_POST["Shipping"];
		$Currency = $_POST["Currency"];
		$CrawlFrom = $_POST["CrawlFrom"];
		$CrawlFrom = str_replace("&quot;","\"",$CrawlFrom);
		$CrawlTo = $_POST["CrawlTo"];
		$CrawlTo = str_replace("&quot;","\"",$CrawlTo);

		$update = "UPDATE `".$prefix."AP_Webshops` Set `ShopName` = '".$ShopName."',`SiteUrl` = '".$SiteUrl."',`AffiliateID` = '".$AffiliateID."',`ProgramID` = '".$ProgramID."',`Shipping` = '".$Shipping."',`Currency` = '".$Currency."',`CrawlFrom` = '".$CrawlFrom."',`CrawlTo` = '".$CrawlTo."' WHERE `ID` = '".$ID."';";
		mysql_query($update) or die(mysql_error() );

		header("Location: ?page=Affiliate-Plugin/Webshops/List");
		exit();
	}

	if( $_POST["AP_Form_Post"] == "FormAffiliateAdd" ) {
		$Name = $_POST["Name"];
		$URL = $_POST["URL"];
		$PartnerID = $_POST["PartnerID"];



		$insert = "INSERT INTO `".$prefix."AP_Affiliates` (`Name`,`URL`,`PartnerID`) VALUES ('".$Name."','".$URL."','".$PartnerID."');";
		mysql_query($insert) or die(mysql_error());

		header("Location: ?page=Affiliate-Plugin/Affiliate/List");
		exit();

	}


	if( $_POST["AP_Form_Post"] == "FormAffiliateEdit" ) {
		$Name = $_POST["Name"];
		$URL = $_POST["URL"];
		$PartnerID = $_POST["PartnerID"];
		$ID = $_GET["ID"];
		
		$update = "UPDATE `".$prefix."AP_Affiliates` Set `Name` = '".$Name."',`URL` = '".$URL."',`PartnerID` = '".$PartnerID."'WHERE `ID` = '".$ID."';";
		mysql_query($update) or die(mysql_error() );

		header("Location: ?page=Affiliate-Plugin/Affiliate/List");
		exit();

	}




}

?>