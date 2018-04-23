<?php
/**
 * Function to get the facebook standard events
 */
function wpmfbp_get_fb__standard_events() {
	$events = [
		'PageView'             => 'Page View (default)',
		'ViewContent'          => 'View Content',
		'Search'               => 'Search',
		'AddToCart'            => 'Add to Cart',
		'AddToWishlist'        => 'Add to Wishlist',
		'InitiateCheckout'     => 'Initiate Checkout',
		'AddPaymentInfo'       => 'Add Payment Info',
		'Purchase'             => 'Purchase',
		'Lead'                 => 'Lead',
		'CompleteRegistration' => 'Complete Registration',
	];

	return apply_filters( 'wpmfbp_standard_events', $events );
}

function wpmfbp_display_fb_events_select_html( $prev_events, $all_events, $selector ) {
	$html = '<select name="' . $selector . '" class="fb_events_selector" id="' . $selector . '" multiple=""multiple>';
	//Select the previous selected events
	//if it empty, make sure to add pageView event selected as default
	foreach ( $all_events as $fb_event_key => $fb_event_name ):

		$selected = is_array( unserialize( $prev_events ) ) && in_array( $fb_event_key, unserialize( $prev_events ) ) ? 'selected' : '';
		$selected = ! unserialize( $prev_events ) && $fb_event_key === 'PageView' ? 'selected' : $selected;

		$html .= '<option value="' . $fb_event_key . '"' . $selected . '>' . $fb_event_name . '</option>';
	endforeach;

	$html .= '</select>';

	return $html;
}