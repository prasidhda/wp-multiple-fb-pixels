<?php
/**
 * Handles the Global FB pixel setting
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPMFBP_Global_Setting {

	/**
	 * Constructor.
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Registers a new settings page under Settings.
	 */
	function admin_menu() {
		add_options_page(
			__( 'FB Pixel Setting', 'wp-multiple-fb-pixels' ),
			__( 'FB Pixel Setting', 'wp-multiple-fb-pixels' ),
			'manage_options',
			'fb-pixel-setting',
			array(
				$this,
				'settings_page'
			)
		);
	}

	/**
	 * Settings page display callback.
	 */
	function settings_page() {
		require_once WPMFBP_ABSPATH . 'includes/admin/view-global-setting.php';
	}
}

new WPMFBP_Global_Setting;