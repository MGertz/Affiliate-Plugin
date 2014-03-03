<?php
function my_row_actions($id=0) {

	$page = "?page=Affiliate-Plugin/Webshops/";


	$out = "<div class=\"row-actions\">
	<a href=\"".$page."Edit&ID=".$id."\">Edit</a> | 
	<a href=\"".$page."Delete&ID=".$id."\">Delete</a>
	</div>";

	return $out;
}
global $wpdb;

$user = $wpdb->dbuser;
$pass = $wpdb->dbpassword;
$host = $wpdb->dbhost;
$db = $wpdb->dbname;
$prefix = $wpdb->prefix;

mysql_connect($host,$user,$pass) or die(mysql_error());

mysql_select_db($db) or die(mysql_error());


$sql = "SELECT * FROM `".$prefix."AP_Affiliates` ORDER BY `Name`";
$query = mysql_query($sql);
while( $row = mysql_fetch_assoc($query)) {
	$affiliates[$row["ID"]] = $row["Name"];
}




?>
<div class="wrap">
	<h2>Webshops <a href="?page=Affiliate-Plugin/Webshops/Add" class="add-new-h2">Tilf&oslash;j Ny</a></h2>

	<div class="AP_Left">

	<p>Liste over alle webshops</p>
	
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead>
			<tr>
				<th>Navn</th>
				<th>Affiliate Network</th>
				<th>Forsendelse</th>
				<th>Valuta</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Navn</th>
				<th>Affiliate Network</th>
				<th>Forsendelse</th>
				<th>Valuta</th>
			</tr>
		</tfoot>



		<tbody>

		<?php
			$sql = "SELECT * FROM `".$prefix."AP_Webshops` ORDER BY `ShopName`;";
			$query = mysql_query($sql) or die(mysql_error());

			$alternate = true;

			while( $row = mysql_fetch_assoc($query) ) {
				if( $alternate == true ) {
					echo "<tr class='alternate'>";
					$alternate = false;
				} else {
					echo "<tr>";
					$alternate = true;
				}

				echo "<td>".$row["ShopName"]." (".$row["ProgramID"].")".my_row_actions($row["ID"])."</td>";


				echo "<td>".$affiliates[$row["AffiliateID"]]."</td>";
				
				echo "<td>".$row["Shipping"]."</td>";
				echo "<td>".$row["Currency"]."</td>";
				echo "</tr>";

			}



		?>


		</tbody>
	</table>

	</div>

	<div class="AP_Right"><? require_once"Sidebar.php"; ?></div>
</div>