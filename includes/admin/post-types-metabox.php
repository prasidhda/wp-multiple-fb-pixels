<?php
/**
 * Include multiple facebook pixel events for enabled post types
 */
function wpmfbp_register_metabox_for_fb_pixel_events() {
	//enable this setting option only for enabled post types
	$wpmfbp_post_types = get_option( 'wpmfbp_post_types', '' );
	add_meta_box( 'wpmfbp-facebook-pixel-setting', __( 'Multiple Facebook Pixel', 'wp-multiple-fb-pixels' ), 'wpmfbp_facebook_pixel_setting', unserialize( $wpmfbp_post_types ) );
}

add_action( 'add_meta_boxes', 'wpmfbp_register_metabox_for_fb_pixel_events' );

/**
 * Meta box display callback for facebook pixel event setting
 *
 * @param WP_Post $post Current post object.
 */
function wpmfbp_facebook_pixel_setting( $post ) {
	die('here');
	//Get facebook stadard events
	$prev_events = get_post_meta( $post->ID, 'fb_events_to_track', true );
	$fb_events   = blocks_id_get_fb_events();

	$label_note = 'Note: Main Pixel will be in the last sequence. This is important to make sure that any button tracking event will be attributed to this main pixel';
	$outline    = '<div id="facebook-pixels-metabox">';
	$outline    .= '<h2 style="padding-left: 0"><strong>Facebook Pixel Event (Main Pixel from Appearance - Customize Page)</strong></h2>';
	$outline    .= '<label for="fb-events">' . esc_html__( $label_note, 'blocks-id' ) . '</label>';
	$outline    .= blocks_id_dispplay_fb_events_select_html( $prev_events, $fb_events, 'fb_events_to_track[]' );
	$outline    .= '<h1>' . __( "Multiple Facebook Pixels" ) . '</h1>';
	$outline    .= blocksid_multiple_fb_pixel_setting();
	$outline    .= wp_nonce_field( 'fb_event_tracking', 'fb_event_nonce' );
	$outline    .= '<input type="hidden" name="fb-pixel-counter" id="fb-pixel-counter" value="0" \>';
	$outline    .= '</div>';
	echo $outline;
}