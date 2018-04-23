<?php
/**
 * Main Class
 * Handles everything from here.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
if ( ! class_exists( 'WP_Multiple_FB_Pixels' ) ) {
	class WP_Multiple_FB_Pixels {
		public static $_instance;

		public function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
		}

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		private function define_constants() {

			$this->define( 'WPMFBP_ABSPATH', dirname( WPMFBP_PLUGIN_FILE ) . '/' );
			$this->define( 'WPMFB_PLUGIN_BASENAME', plugin_basename( WPMFBP_PLUGIN_FILE ) );
			$this->define( 'WPMFB_PLUGIN_URL', plugins_url( WPMFBP_ABSPATH, __FILE__ ) );
		}

		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		private function init_hooks() {
			add_filter( 'plugin_action_links_' . plugin_basename( WPMFBP_PLUGIN_FILE ), array(
				$this,
				'action_links'
			) );
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		public static function action_links( $links ) {
			$links[] = '<a href="' . esc_url( get_admin_url( null, 'admin.php?page=fb-pixel-setting' ) ) . '">Settings</a>';

			return $links;
		}

		public function load_text_domain() {
			load_plugin_textdomain( 'wp-multiple-fb-pixels', WPMFBP_PLUGIN_FILE, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Function to enqueue the admin scripts / styles
		 */
		public function enqueue_scripts() {
			$min = SCRIPT_DEBUG === true ? '' : '.min';
			wp_enqueue_style( 'select2-style', plugins_url( '/assets/css/select2' . $min . '.css', WPMFBP_PLUGIN_FILE ) );
			wp_enqueue_script( 'select2-script', plugins_url( '/assets/js/select2' . $min . '.js', WPMFBP_PLUGIN_FILE ), array( 'jquery' ), '', true );

			wp_enqueue_script( 'wpmfbp-admin-scripts', plugins_url( '/assets/js/admin.js', WPMFBP_PLUGIN_FILE ), array( 'jquery' ), '', true );
		}

		public function includes() {
			if ( is_admin() ) {
				/**
				 * Include Global FB Pixel Setting
				 *
				 */
				include_once WPMFBP_ABSPATH . 'includes/helper-functions.php';
				include_once WPMFBP_ABSPATH . 'includes/admin/class-global-setting.php';
			}
		}
	}
}