<?

if( is_single() ) {

	// Database info
	global $wpdb;
	$user = $wpdb->dbuser;
	$pass = $wpdb->dbpassword;
	$host = $wpdb->dbhost;
	$db = $wpdb->dbname;
	$prefix = $wpdb->prefix;


	// PostID
	$postID = get_the_ID();

	//out variablen skal være tom.
	$out = "<h3 class='AP_Header'>Pris liste <span class='arrows'>&raquo;</span></h3>";

	$sql = "SELECT * FROM `".$prefix."AP_TablesPosts` WHERE `PostID` = '".$postID."'";
	$query = mysql_query($sql) or die(mysql_error());
	while( $row = mysql_fetch_assoc($query) ) {
		
		// Hent ID på tabellen
		$sql2 = "SELECT * FROM `".$prefix."AP_Tables` WHERE `ID` = '".$row["TableID"]."';";
		$query2 = mysql_query($sql2);
		while( $row2 = mysql_fetch_assoc($query2) ) {

			$out .= "<table class='AP_Outer'>";
			$out .= "<thead><tr>";
			$out .= "<th>Forhandler</th>";
			$out .= "<th colspan='2'>Pris</th>";
			$out .= "</tr></thead>";

			$out .= "<tbody>";

			// Hent priser fra tabellen.
			$sql3 = "SELECT * FROM `".$prefix."AP_Prices` WHERE `TableID` = '".$row2["ID"]."' ORDER BY `Price` ASC;";
			$query3 = mysql_query($sql3);
			while( $row3 = mysql_fetch_assoc($query3) ) {
				$ProductUrl = $row3["ProductUrl"];

				$out .= "<tr>";


				$sql4 = "SELECT * FROM `".$prefix."AP_Webshops` WHERE `ID` = '".$row3["WebshopID"]."';";
				$query4 = mysql_query($sql4) or die(mysql_error());
				while( $row4 = mysql_fetch_assoc($query4) ) {
					$out .= "<td>".$row4["ShopName"]."</td>";
					$out .= "<td>".$row3["Price"]." ".$row2["Currency"]."</td>";

					$ProgramID = $row4["ProgramID"];
					$AffiliateID = $row4["AffiliateID"];
				}

				// Generate Link

				$sql5 = "SELECT * FROM `".$prefix."AP_Affiliates` WHERE `ID` = '".$AffiliateID."';";
				$query5 = mysql_query($sql5) or die(mysql_error());
				while( $row5 = mysql_fetch_assoc($query5) ) {
					$PartnerID = $row5["PartnerID"];
					$Url = $row5["URL"];

				}

				#$ProductUrl = urlencode($ProductUrl);


				$Url = str_replace("[ProgramID]",$ProgramID,$Url);
				$Url = str_replace("[PartnerID]",$PartnerID,$Url);
				$Url = str_replace("[URL]",$ProductUrl,$Url);



				//http://clk.tradedoubler.com/click?p([ProgramID])a([PartnerID])url([URL])

				$out .= "<td class='AP_link'><a href='".$Url."' target='_blank' class='AP_button'>Køb Her »</a></td>";


				
				$out .= "</tr>";
			}

			$out .= "</tbody>";
			$out .= "</table><br>";
		}

	}

	$content = $content.$out;

}
	?>