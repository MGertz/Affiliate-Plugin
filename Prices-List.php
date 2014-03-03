<?php
function my_row_actions($id=0) {

	$page = "?page=Affiliate-Plugin/Prices/";


	$out = "<div class=\"row-actions\">
	<a href=\"".$page."Edit&ID=".$id."\">Edit</a> | 
	<a href=\"".$page."Delete&ID=".$id."\">Delete</a> | 
	<a href=\"".$page."Update&ID=".$id."\">Update</a>

	</div>";

	return $out;
}

global $wpdb;
$prefix = $wpdb->prefix;
?>
<div class="wrap">
	<h2>Priser <a href="?page=Affiliate-Plugin/Prices/Add" class="add-new-h2">Tilf&oslash;j Ny</a></h2>

	<div class="AP_Left">

	<p>Liste over alle priser</p>
	
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead>
			<tr>
				<th>Pristabel</th>
				<th>Forhandler</th>
				<th width="50px">Pris</th>
				<th width="120px">Sidst opdateret</th>
				<th>Synlig</th>
				<th width="80px">Direkte Link</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Pristabel</th>
				<th>Forhandler</th>
				<th>Pris</th>
				<th>Sidst opdateret</th>
				<th>Synlig</th>
				<th>Direkte Link</th>
			</tr>
		</tfoot>


		<tbody>

		<?php
			$sql = "SELECT * FROM `".$prefix."AP_Prices`;";
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

				$sql2 = "SELECT * FROM `".$prefix."AP_Tables` WHERE `ID` = '".$row["TableID"]."';";
				$query2 = mysql_query($sql2) or die(mysql_error());
				while( $row2 = mysql_fetch_assoc($query2) ) {
					echo "<td>".$row2["Name"]."".my_row_actions($row["ID"])."</td>";	
				}
				

				$sql2 = "SELECT * FROM `".$prefix."AP_Webshops` WHERE `ID` = '".$row["WebshopID"]."';";
				$query2 = mysql_query($sql2) or die(mysql_error());
				while( $row2 = mysql_fetch_assoc($query2) ) {
					echo "<td>".$row2["ShopName"]."</td>";	
				}

				
				echo "<td>".$row["Price"]."</td>";

//get_option('gmt_offset'

				echo "<td>".$row["LastUpdated"]."	</td>";
				echo "<td>Denne er ikke lavet endnu</td>";
				echo "<td><a href='".$row["ProductUrl"]."' target='_blank'>URL</a></td>";

				echo "</tr>";
			}
			?>
		</tbody>
	</table>

	</div>

	<div class="AP_Right">
		<? require_once"Sidebar.php"; ?>
	</div>
</div>