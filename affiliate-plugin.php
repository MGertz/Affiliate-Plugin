<?php
/*
Plugin Name: Affiliate Plugin
Plugin URI: http://wordpress.org/plugins/affiliate-plugin
Description: this is the best affilaite plugin you ever can get, it will automaticly update prices from shops.
Author: Michael Ringhus Gertz
Version: 0.2 Beta
Date 07-02-2014
Author URI: http://ringhus.dk/
*/

function AP_menu() {
	add_menu_page(
		'Affiliate Plugin', 					//Page Title
		'Affiliate Plugin',						//Menu Title
		'manage_options',						//Capability
		'Affiliate-Plugin',						// Menu Slug
		'',										// function 
		plugin_dir_url(__FILE__)."icon16.png",	// Icon
		'50'									// Position
	);

	add_submenu_page(
		'Affiliate-Plugin',					// Parent Slug
		'Affiliate Priser',					// Page Title
		'Priser',							// Menu Title
		'manage_options',					// Capability
		'Affiliate-Plugin/Prices/List',	// MenuSlug
		'AP_Prices_List'
	);

	add_submenu_page(
		'Affiliate-Plugin',					// Parent Slug
		'Affiliate Pristabeller',			// Page Title
		'Pristabeller',							// Menu Title
		'manage_options',					// Capability
		'Affiliate-Plugin/Tables/List',	// MenuSlug
		'AP_Tables_List'
	);

	add_submenu_page(
		'Affiliate-Plugin',					// Parent Slug
		'Affiliate Forhandlere',				// Page Title
		'Forhandlere',							// Menu Title
		'manage_options',					// Capability
		'Affiliate-Plugin/Webshops/List',	// MenuSlug
		'AP_WebShops_List'
	);

	add_submenu_page(
		'Affiliate-Plugin',					// Parent Slug
		'Affiliate Netværk',				// Page Title
		'Affiliates',						// Menu Title
		'manage_options',					// Capability
		'Affiliate-Plugin/Affiliate/List',	// MenuSlug
		'AP_Affiliate_List'
	);
	

	remove_submenu_page('Affiliate-Plugin','Affiliate-Plugin');


	# This function add a hidden page
	global $_registered_pages;

	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Affiliate/Add','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Affiliate_Add');
	}
	$_registered_pages[$hookname] = true;
	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Affiliate/Edit','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Affiliate_Edit');
	}
	$_registered_pages[$hookname] = true;


	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Webshops/Add','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Webshops_Add');
	}
	$_registered_pages[$hookname] = true;
	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Webshops/Edit','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Webshops_Edit');
	}
	$_registered_pages[$hookname] = true;

	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Tables/Add','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Tables_Add');
	}
	$_registered_pages[$hookname] = true;
	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Tables/Edit','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Tables_Edit');
	}
	$_registered_pages[$hookname] = true;

	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Prices/Add','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Prices_Add');
	}
	$_registered_pages[$hookname] = true;
	$hookname = get_plugin_page_hookname('Affiliate-Plugin/Prices/Edit','admin.php');
	if( !empty($hookname)) {
		add_action($hookname,'AP_Prices_Edit');
	}
	$_registered_pages[$hookname] = true;




	unset($hoosname);







}
add_action('admin_menu','AP_menu');



function AP_Affiliate_List() {
	require_once"Affiliate-List.php";
}

function AP_Affiliate_Add() {
	require_once"Affiliate-Add.php";
}
function AP_Affiliate_Edit() {
	require_once"Affiliate-Edit.php";
}


function AP_Webshops_List() {
	require_once"Webshops-List.php";
}
function AP_Webshops_Add() {
	require_once"Webshops-Add.php";
}
function AP_Webshops_Edit() {
	require_once"Webshops-Edit.php";
}

function AP_Tables_List() {
	require_once"Tables-List.php";
}
function AP_Tables_Add() {
	require_once"Tables-Add.php";
}
function AP_Prices_List() {
	require_once"Prices-List.php";
}
function AP_Prices_Update() {
	
}
function AP_Prices_Add() {
	require_once"Prices-Add.php";
}
function AP_Prices_Edit() {
	require_once"Prices-Edit.php";
}




// denne funktion kaldes når dette plugin aktiveres.
function AP_Activation_Hook() {
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$prefix = $wpdb->prefix;

	$tablename = $prefix."AP_Affiliates";
	$sql = "CREATE TABLE ".$tablename." (
		ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		Name varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		PartnerID int(10) UNSIGNED NOT NULL,
		URL varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		PRIMARY KEY (`ID`)
	)  ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";

	dbDelta($sql);

	$tablename = $prefix."AP_Webshops";
	$sql = "CREATE TABLE ".$tablename." (
		ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		ShopName varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		SiteUrl varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		AffiliateID int(10) UNSIGNED NOT NULL,
		ProgramID int(10) UNSIGNED NOT NULL,
		Shipping varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		Currency varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		CrawlFrom varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		CrawlTo varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		PRIMARY KEY (`ID`)
	)  ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";

	dbDelta($sql);

	$tablename = $prefix."AP_Prices";
	$sql = "CREATE TABLE ".$tablename." (
		ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		WebshopID int(10) UNSIGNED NOT NULL,
		TableID int(10) UNSIGNED NOT NULL,
		ProductUrl varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		Price varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		ShowInTable char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y',
		AutoUpdatePrice char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y',
		LastUpdated datetime NULL,
		Added datetime NULL,
		PRIMARY KEY (`ID`)
	) ENGINE  = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	dbDelta($sql);

	$tablename = $prefix."AP_Tables";
	$sql = "CREATE TABLE ".$tablename." (
		ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		Name varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
		PRIMARY KEY (`ID`)
	)  ENGINE  = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	dbDelta($sql);


	$tablename = $prefix."AP_TablesPosts";
	$sql = "CREATE TABLE ".$tablename." (
		ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		PostID int(10) UNSIGNED NOT NULL,
		TableID int(10) UNSIGNED NOT NULL,
		PRIMARY KEY (`ID`)
	)  ENGINE  = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	dbDelta($sql);


	
}

register_activation_hook(__FILE__,'AP_Activation_Hook');






// DENne den skulle kunne fange posts
add_action('wp_loaded','AP_wp_loaded');
function AP_wp_loaded() {
	require_once"Post-Handle.php";



	if( $_GET["page"] == "Affiliate-Plugin/Prices/Update" ) {
		require_once"Prices-Update.php";
	}

	if( $_GET["page"] == "Affiliate-Plugin/Prices/Delete") {
		require_once"Prices-Delete.php";
	}

	if( $_GET["page"] == "Affiliate-Plugin/Tables/Delete") {
		require_once"Tables-Delete.php";
	}

	if( $_GET["page"] == "Affiliate-Plugin/Affiliate/Delete") {
		require_once"Affiliate-Delete.php";
	}

	if( $_GET["page"] == "Affiliate-Plugin/Webshops/Delete") {
		require_once"Webshops-Delete.php";
	}



}


add_filter('the_content','AP_Content');

function AP_Content($content) {
	require_once"AP_Content.php";

	return $content;
}



function AP_Add_Style() {
	$theme = get_current_theme();

	wp_enqueue_style('',plugins_url('css/style-'.$theme.'.css',__FILE__));
}
add_action('wp_enqueue_scripts','AP_Add_Style');


function AP_Add_Style_Admin() {
	wp_enqueue_style('',plugins_url('css/style-admin.css',__FILE__));
}
add_action('admin_init','AP_Add_Style_Admin');








// Include file with Meta Box for edit post
require_once"AP_Meta_Box.php";
