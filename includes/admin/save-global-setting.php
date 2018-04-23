<?php
/**
 * Save the Global Setting
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
update_option( 'wpmfbp_enable_fb_pixel', $_POST['wpmfbp_enable_fb_pixel'] );
update_option( 'wpmfbp_global_fb_pixel_id', $_POST['wpmfbp_global_fb_pixel_id'] );
update_option( 'wpmfbp_global_fb_events', serialize( $_POST['wpmfbp_global_fb_events'] ) );
update_option( 'wpmfbp_post_types', serialize( $_POST['wpmfbp_post_types'] ) );
