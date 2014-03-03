<?php

$ID = $_GET["ID"];

global $wpdb;

$user = $wpdb->dbuser;
$pass = $wpdb->dbpassword;
$host = $wpdb->dbhost;
$db = $wpdb->dbname;
$prefix = $wpdb->prefix;

mysql_connect($host,$user,$pass) or die(mysql_error());

mysql_select_db($db) or die(mysql_error());

$sql = "SELECT * FROM `".$prefix."AP_Webshops` WHERE `ID` = '".$ID."';";
$query = mysql_query($sql);
while( $row = mysql_fetch_assoc($query)) {
	$ShopName = $row["ShopName"];
	$SiteUrl = $row["SiteUrl"];
	$AffiliateID = $row["AffiliateID"];
	$ProgramID = $row["ProgramID"];
	$Shipping = $row["Shipping"];
	$Currency = $row["Currency"];
	$CrawlFrom = $row["CrawlFrom"];
	$CrawlFrom = str_replace("\"","&quot;",$CrawlFrom);


	$CrawlTo = $row["CrawlTo"];
	$CrawlTo = str_replace("\"","&quot;",$CrawlTo);
}






?>
<div class="wrap">
	<h2>Tilføj ny webshop</h2>

	<p>Edit funktionen virker ikke som den skal. den henter ikke info om den enkelte webshop, og gemmer ej heller info.</p>

	<div class="Left">
		<form method="post">
		<input type="hidden" name="AP_Form_Post" value="FormWebshopEdit"> <? // denne variabel bruges til at tjekke at post kommer fra dette plugin ?>
		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="ShopName">Shop Navn <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="ShopName" type="text" id="ShopName" value="<? echo $ShopName; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="SiteUrl">Site URL <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="SiteUrl" type="text" id="SiteUrl" value="<? echo $SiteUrl; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="AffiliateID">Affiliate <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<select name="AffiliateID" style="width: 350px;">
							<?php
								$sql = "SELECT * FROM `".$prefix."AP_Affiliates` ORDER BY `Name`";
								$query = mysql_query($sql);
								while( $row = mysql_fetch_assoc($query) ) {
									echo "<option value='".$row["ID"]."'";
									if( $row["ID"] == $AffiliateID ) {
										echo " selected";
									}

									echo ">".$row["Name"]."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="ProgramID">Program ID <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="ProgramID" type="text" id="ProgramID" value="<? echo $ProgramID; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="Shipping">Forsendelse</label>
					</th>
					<td>
						<input name="Shipping" type="text" id="Shipping" value="<? echo $Shipping; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="Currency">Valuta</label>
					</th>
					<td>
						<input name="Currency" type="text" id="Currency" value="<? echo $Currency; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="CrawlFrom">Crawl her fra <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="CrawlFrom" type="text" id="CrawlFrom" value="<? echo $CrawlFrom; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="CrawlTo">Crawl her til <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="CrawlTo" type="text" id="CrawlTo" value="<? echo $CrawlTo; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" name="addwebshop" id="addwebshopsub" class="button button-primary" value="Tilføj ny webshop">
		</p>

		</form>




	</div>
</div>