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
	<h2>Tilføj ny webshop</h2>

	<p>Opret en webshop til som du kan binde priser op på</p>

	<div class="Left">
		<form method="post">
		<input type="hidden" name="AP_Form_Post" value="AddWebshopFrom"> <? // denne variabel bruges til at tjekke at post kommer fra dette plugin ?>

		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="ShopName">Shop Navn <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="ShopName" type="text" id="ShopName" value="" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="SiteURL">Site URL <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="SiteURL" type="text" id="SiteURL" value="" aria-required="true" style="width: 350px;">
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
									echo "<option value='".$row["ID"]."'>".$row["Name"]."</option>";
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
						<input name="ProgramID" type="text" id="ProgramID" value="" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="Shipping">Forsendelse</label>
					</th>
					<td>
						<input name="Shipping" type="text" id="Shipping" value="0" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row">
						<label for="Currency">Valuta</label>
					</th>
					<td>
						<input name="Currency" type="text" id="Currency" value="Kr" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="CrawlFrom">Crawl her fra <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="CrawlFrom" type="text" id="CrawlFrom" value="" aria-required="true" style="width: 350px;">
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="CrawlTo">Crawl her til <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="CrawlTo" type="text" id="CrawlTo" value="" aria-required="true" style="width: 350px;">
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