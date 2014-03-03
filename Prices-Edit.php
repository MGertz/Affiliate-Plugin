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

$sql = "SELECT * FROM `".$prefix."AP_Prices` WHERE `ID` = '".$ID."';";
$query = mysql_query($sql);
while( $row = mysql_fetch_assoc($query)) {
	$WebshopID = $row["WebshopID"];
	$ProductUrl = $row["ProductUrl"];
	$TableID = $row["TableID"];
	$Price = $row["Price"];
	
}


?>
<div class="wrap">
	<h2>Rediger pris</h2>

	<p>Her kan du redigere prisen</p>

	<div class="Left">
		<form method="post">
		<input type="hidden" name="AP_Form_Post" value="FormPricesEdit"> <? // denne variabel bruges til at tjekke at post kommer fra dette plugin ?>
		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="WebshopID">Forhandler <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<select name="WebshopID" id="WebshopID" style="width: 350px;">
						<?php
							$sql = "SELECT * FROM `".$prefix."AP_Webshops` ORDER BY `ShopName`";
							$query = mysql_query($sql);
							while( $row = mysql_fetch_assoc($query) ) {
								echo "<option value='".$row["ID"]."'";
								if( $row["ID"] == $WebshopID ) {
									echo " selected";
								}

								echo ">".$row["ShopName"]."</option>";
							}
						?>
						</select>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="ProductUrl">Produkt Link <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="ProductUrl" type="text" id="ProductUrl" value="<?php echo $ProductUrl; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="Price">Pris <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="Price" type="text" id="Price" value="<?php echo $Price; ?>" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="TableID">Tabel <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<select name="TableID" id="TableID" style="width: 350px;">
						<?php
							$sql = "SELECT * FROM `".$prefix."AP_Tables` ORDER BY `Name`";
							$query = mysql_query($sql);
							while( $row = mysql_fetch_assoc($query) ) {
								echo "<option value='".$row["ID"]."'";
								if( $row["ID"] == $TableID ) {
									echo " selected";
								}


								echo ">".$row["Name"]."</option>";
							}
						?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" name="addtable" id="addtablesub" class="button button-primary" value="Gem ændring">
		</p>

		</form>
	</div>
</div>