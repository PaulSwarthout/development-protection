<?php
/**
 * Plugin Name:     Development Protection
 * Plugin URI:
 * Description:     Prevent WordPress from deleting your symlinked development environments for your plugins. Hides the 'Delete' link on the plugins page for any plugin folder that has a .git subfolder. THIS MUST STAY ACTIVATED AND INSTALLED TO PROTECT YOUR SYMLINKed DEVELOPMENT FOLDERS.
 * Author:          Paul Swarthout
 * Author URI:      http://www.paulswarthout.com
 * Text Domain:     development-protection
 * Version:         0.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'plugin_action_links', 'look_see', 10, 2 );

function look_see( $actions, $plugin_file ) {
	if (array_key_exists('delete', $actions) ) {
		/*
		 * Many WordPress functions and constants, such as wp_plugin_dir() and WP_PLUGIN_DIR
		 * Do not yet exist when this function is called. We have to figure out the full path
		 * manually.
		 */
		$full_path = dirname(dirname(__FILE__) . "/../" . $plugin_file) . "/.git";
		if (file_exists($full_path)) {
			unset($actions['delete']);
		}
	}
	return $actions;
}
