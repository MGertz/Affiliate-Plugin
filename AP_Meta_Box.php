<?php

// Sørg for at meta boksene kun loades på post edit/new siden
add_action('load-post.php','AP_Meta_Box_Setup');
add_action('load-post-new.php','AP_Meta_Box_Setup');

// functionen som kaldes for at add boksene.
function AP_Meta_Box_Setup() {
	add_action('add_meta_boxes','AP_Meta_Box_Add');

	add_action( 'save_post', 'AP_Meta_Box_Save', 10, 2 );
}

// Boks setup funktionen.
function AP_Meta_Box_Add() {
	add_meta_box(
		'AP_Meta_Box',
		'Affiliate Plugin',
		'AP_Meta_Box_Content',
		'post',
		'side',
		'default'
	);
}


// Content til boksen

function AP_Meta_Box_Content($object,$box) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$postID = get_the_ID();

	$sql = "SELECT * FROM `".$prefix."AP_Tables` ORDER BY `Name`";
	$query = mysql_query($sql) or die(mysql_error());
	while( $row = mysql_fetch_assoc($query)) {

		$tables[$row["ID"]] = $row["Name"];
	}

	$tablesPosts = array();
	$sql = "SELECT * FROM `".$prefix."AP_TablesPosts` WHERE `PostID` = '".$postID."'";
	$query = mysql_query($sql) or die(mysql_error());
	while( $row = mysql_fetch_assoc($query) ) {
		$tablesPosts[] = $row["TableID"];
	}

	// Hent info om hvilke tables der er valgt.

	echo "<ul>";
	foreach( $tables as $key => $val ) {
		echo "<li id='table-".$key."'>";
		echo "<label class='selectit'><input type='checkbox' value='".$key."' name='post_tables[]' id='in-tables-".$key."'";
		
		if( in_array( $key , $tablesPosts ) ) {
			echo " checked='checked'";
		}


		echo ">".$val." (".$key.")</label></li>";
		echo "</li>";
	}
	echo "</ul>";

}

// bruges til at gemme indholdet i meta boksen
function AP_Meta_Box_Save($postid,$post) {
	global $wpdb;
	$prefix = $wpdb->prefix;


	if( isset($_POST["post_tables"]) ) {
		$post_tables = $_POST["post_tables"];

		// først slet alle tables der er bundet op på denne post
		$delete = "DELETE FROM `".$prefix."AP_TablesPosts` WHERE `PostID` = '".$postid."'";
		mysql_query($delete) or die(mysql_error());


		// indsæt så de posts som der skal bruges.
		$rows = count($post_tables);

		$insert = "INSERT INTO `".$prefix."AP_TablesPosts` (`PostID`,`TableID`) VALUES ";

		foreach( $post_tables as $key => $val ) {
			$insert .= "('".$postid."','".$val."')";

			if( $rows != 1 ) {
				$insert .= ", ";
				$rows--;
			}
		}
		mysql_query($insert) or die(mysql_error());
	}
}