<?php

global $wpdb;

$user = $wpdb->dbuser;
$pass = $wpdb->dbpassword;
$host = $wpdb->dbhost;
$db = $wpdb->dbname;
$prefix = $wpdb->prefix;

mysql_connect($host,$user,$pass) or die(mysql_error());

mysql_select_db($db) or die(mysql_error());
?>
<div class="wrap">
	<h2>Tilføj ny pris</h2>

	<p>Opret en ny pris</p>

	<div class="Left">
		<form method="post">
		<input type="hidden" name="AP_Form_Post" value="AddPriceForm"> <? // denne variabel bruges til at tjekke at post kommer fra dette plugin ?>

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
								echo "<option value='".$row["ID"]."'>".$row["ShopName"]."</option>";
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
						<input name="ProductUrl" type="text" id="ProductUrl" value="" aria-required="true" style="width: 350px;">
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
								echo "<option value='".$row["ID"]."'>".$row["Name"]."</option>";
							}
						?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" name="addtable" id="addtablesub" class="button button-primary" value="Tilføj ny tabel">
		</p>

		</form>
	</div>
</div>