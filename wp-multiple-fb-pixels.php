<?php
/*
Plugin Name: WP Multiple FB Pixels
Plugin URI:   https://github.com/prasidhda/wp-multiple-fb-pixels
Description:  WP plugin to allow multiple FB pixel events tracking. User Defined Multiple FB Pixels Event Tracking for individual post/page
Version:      1.0.0
Author:       prasidhda
Author URI:   https://profiles.wordpress.org/prasidhda
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wp-multiple-fb-pixels
Domain Path:  /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'WPMFBP_PLUGIN_FILE' ) ) {
	define( 'WPMFBP_PLUGIN_FILE', __FILE__ );
}
if ( ! class_exists( 'WP_Multiple_FB_Pixels' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-wp-multiple-fb-pixels.php';
}
//Initialize the plugin
WP_Multiple_FB_Pixels::instance();