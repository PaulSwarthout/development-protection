<?php
/**
 * Plugin Name:     Development Protection
 * Plugin URI:
 * Description:     Prevent WordPress from deleting your symlinked development environments for your plugins. Hides the 'Delete' link on the plugins page for any plugin folder that has a .git subfolder. THIS MUST STAY ACTIVATED AND INSTALLED TO PROTECT YOUR SYMLINKed DEVELOPMENT FOLDERS.
 * Author:          Paul Swarthout
 * Author URI:      http://paulswarthout.com/wordpress/
 * Text Domain:     development-protection
 * Version:         0.3.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'plugin_action_links', 'check_for_git_folder', 10, 2 );

function check_for_git_folder( $actions, $plugin_file ) {
	if ( array_key_exists( 'delete', $actions ) ) {

		$full_path = dirname( WP_PLUGIN_DIR . "/{$plugin_file}" ) . "/.git";

		if ( file_exists( $full_path ) ) {
			unset( $actions['delete'] );
		}
	}
	return $actions;
}
