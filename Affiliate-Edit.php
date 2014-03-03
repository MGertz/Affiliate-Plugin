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

$sql = "SELECT * FROM `".$prefix."AP_Affiliates` WHERE `ID` = '".$ID."';";
$query = mysql_query($sql);
while( $row = mysql_fetch_assoc($query)) {
	$Name = $row["Name"];
	$URL = $row["URL"];
	$PartnerID = $row["PartnerID"];
	
}
?><div class="wrap">
	<h2>Tilføj ny tabel</h2>

	<p>Opret en ny tabel, som priserne kan bindes op på</p>

	<div class="Left">
		<form method="post">
		<input type="hidden" name="AP_Form_Post" value="FormAffiliateEdit"> <? // denne variabel bruges til at tjekke at post kommer fra dette plugin ?>
		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="Name">Navn <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="Name" type="text" id="Name" value="<?php echo $Name; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="PartnerID">PartnerID <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="PartnerID" type="text" id="PartnerID" value="<?php echo $PartnerID; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="URL">Affiliate Link <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="URL" type="text" id="URL" value="<?php echo $URL; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" class="button button-primary" value="Opdater Affiliate">
		</p>

		</form>
	</div>
</div>