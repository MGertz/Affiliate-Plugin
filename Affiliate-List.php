<?php
function my_row_actions($id=0) {

	$page = "?page=Affiliate-Plugin/Affiliate/";


	$out = "<div class=\"row-actions\">
	<a href=\"".$page."Edit&ID=".$id."\">Edit</a> | 
	<a href=\"".$page."Delete&ID=".$id."\">Delete</a>
	</div>";

	return $out;
}

global $wpdb;
$prefix = $wpdb->prefix;
?>
<div class="wrap">
	<h2>Netværk <a href="?page=Affiliate-Plugin/Affiliate/Add" class="add-new-h2">Tilf&oslash;j Ny</a></h2>

	<div class="AP_Left">

	<p>Liste over alle netværk</p>
	
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead>
			<tr>
				<th>Network Name</th>
				<th>Partner ID</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Network Name</th>
				<th>Partner ID</th>
			</tr>
		</tfoot>


		<tbody>

		<?php
			$sql = "SELECT * FROM `".$prefix."AP_Affiliates` ORDER BY `Name`;";
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

				echo "<td>".$row["Name"]."".my_row_actions($row["ID"])."</td>";
				echo "<td>".$row["PartnerID"]."</td>";
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