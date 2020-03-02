<?php
/**
 * Plugin Name:     Development Protection
 * Plugin URI:
 * Description:     Hides the 'Delete' option on the WordPress dashboard Installed Plugins page for plugins with a '.git' subfolder.
 * Author:          Paul Swarthout
 * Author URI:      http://paulswarthout.com/wordpress/
 * Version:         1.1
 */

/*
 * The WordPress Installed Plugins page on your dashboard is a really handy tool for installing, activating, deactivating,
 * and finally deleting and removing all traces of the plugin from your WordPress installation.
 * However, if you are like me, you might use a symbolic link (ln command in Linux or MKLINK in Windows)
 * to your plugin development folder in the /wp-content/plugins folder. This lets you make changes to your plugin
 * and test those changes immediately.
 *
 * Unfortunately, when it comes time to test your plugin's activate, deactivate, and uninstall functionality,
 * you might forget that your plugin folder in your WordPress test environment is symbolically linked to
 * your development folder -- even for just a few minutes.
 *
 * You can activate and deactivate your development plugin as often as you wish with no harm to your development folder.
 * But the moment you tap the 'Delete' option, after deactivating, WordPress will nicely delete the plugin folder
 * and all of its files and subfolders, as it was designed to do.
 *
 * Unfortunately, if that plugin folder was symbolically linked to your development folder,
 * then WordPress will have just deleted your development folder and all of its files, subfolders,
 * including your '.git' folder. You will have just lost all of the changes that you have made to your plugin
 * since your last push to your favorite central repository like GitHub or BitBucket.
 *
 *
 *
 * This simple little plugin for WordPress will help you to avoid that scenario by eliminating the
 * 'Delete' option for any deactivated plugin that has a '.git' subfolder.
 *
 *
 *
 * There is no way to detect that any given folder is a symbolically linked folder, but if you have a .git subfolder,
 * then most likely it is a development folder that you would like to prevent WordPress from automatically deleting.
 *
 * I have accidentally deleted my development folder more than once. It's not a good feeling. Now I don't have to worry about it.
 * And if you install and activate this plugin in any WordPress installation where you symbolically link your
 * plugin development folder, you won't have to worry about it, either.
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'admin_menu', 'pas_dp_dashboard_menu' );
add_filter( 'plugin_action_links', 'check_for_git_folder', 10, 2 );

function check_for_git_folder( $actions, $plugin_file ) {
	$full_path = dirname( WP_PLUGIN_DIR . "/{$plugin_file}" ) . "/.git";
	if ( array_key_exists( 'delete', $actions ) ) {
		if ( file_exists( $full_path ) ) {
			unset( $actions['delete'] );
		}
	}
	if ( array_key_exists('deactivate', $actions) && strpos($plugin_file, 'development-protection') !== false) {
		unset($actions['deactivate']);
	}
	if (file_exists($full_path)) {
		$path = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $_SERVER['PHP_SELF'];
//		$actions['development'] = "<a href='{$path}'>Development</a>";
		$actions['development'] = "<font style='color:red;'>SYMLINK</font>";
	}
	return $actions;
}
function pas_dp_dashboard_menu() {
	$page_title = 'pas-dp-development-protection-menu';
	add_menu_page($page_title, "<font style='color:red;background-color:white;font-weight:bold;'>&nbsp;&nbsp;DevProt&nbsp;&nbsp;</font>", 'manage_options', 'development-protection', 'pas_dp_dev_prot', 'dashicons-arrow-right-alt', 0);
}
function pas_dp_dev_prot() {
	echo <<< "PROTECT"
	<div style='font-size:14pt;width:800px;height:100%;border:solid 2pt red;border-radius:15px;box-shadow:10px 10px 10px rgba(255, 0, 0, .7);padding:10px;'>
	The WordPress Installed Plugins page on your dashboard is a really handy tool for installing, activating, deactivating,
	and finally deleting and removing all traces of the plugin from your WordPress installation.
	However, if you are like me, you might use a symbolic link ('ln' command in Linux or 'MKLINK' in Windows)
	to your plugin development folder in the /wp-content/plugins folder. This lets you make changes to your plugin
	and test those changes immediately.

	<br><br><br>

	Unfortunately, when it comes time to test your plugin's activate, deactivate, and uninstall functionality,
	you might forget that your plugin folder in your WordPress test environment is symbolically linked to
	your development folder -- even for just a few minutes.

	<br><br><br>

	You can activate and deactivate your development plugin as often as you wish with no harm to your development folder.
	But the moment you tap the 'Delete' option, after deactivating, WordPress will nicely delete the plugin folder
	and all of its files and subfolders, as it was designed to do.

	<br><br><br>

	Unfortunately, if that plugin folder was symbolically linked to your development folder,
	then WordPress will have just deleted your development folder and all of its files, subfolders,
	including your '.git' subfolder. You will have just lost all of the changes that you have made to your plugin
	since your last push to your favorite central repository like GitHub or BitBucket, and lost your local .git repository.

	<br><br><br>

	This simple little plugin for WordPress will help you to avoid that scenario by eliminating the
	'Delete' option for any deactivated plugin that has a '.git' subfolder.

	<br><br><br>

	There is no way to detect that any given folder is a symbolically linked folder, but if you have a .git subfolder,
	then most likely it is a development folder that you would like to prevent WordPress from automatically deleting.

	<br><br><br>

	I have accidentally deleted my development folder more than once. It's not a good feeling. Now I don't have to worry about it.
	And if you install and activate this plugin in any WordPress installation where you symbolically link your
	plugin development folder, you won't have to worry about it, either.

	<br><br><br>

	<b>Note: Continuous protection requires this plugin to stay installed and activated. If you deactivate this plugin, then 
	you will again be able to 'delete' your plugins and completely remove them, including all files, subfolders, and/or git
	repositories.</b>

	<br><br><br>

	This plugin has no options. The dashboard menu item is meant as a visual reminder / clue that the development protection
	plugin is installed and activated (meaning: you're symbolically linked folders with .git subfolders are protected).

	<br><br><br>

	If you do not use a local git repository, you could modify the code herein to look for something that you do have, or
	you could just create an empty .git subfolder.

	<br><br><br>

	You should not use this plugin in a production environment. Actually, you should not use symbolically linked subfolders 
	or have git repositories in a production environment either.

	</div>
PROTECT;
}


