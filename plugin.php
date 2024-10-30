<?php

/*
Plugin Name: Keywords to Amazon Links
Plugin URI: http://www.savingadvice.com/tools/wordpress/keywords-amazon-links/
Description: Automatically change keywords in posts or pages to Amazon Affiliate Links
Author: Nate Sanden
Version: 1.01
Author URI: http://www.natesanden.com
*/

//error_reporting(0); // Turn off all error reporting


$kal_db_version = "1.0";

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'KAL_Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'KAL_Plugin', 'deactivate' ) );
register_uninstall_hook( __FILE__, array( 'KAL_Plugin', 'uninstall' ) );
add_action( 'plugins_loaded', array( 'KAL_Plugin', 'upgrade' ) );

require_once( plugin_dir_path( __FILE__ ) . 'class-plugin.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/includes.php' );

KAL_Plugin::get_instance();