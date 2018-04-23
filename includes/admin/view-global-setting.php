<?php
/**
 * View Page for Global FB pixel setting
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Save the setting
 */
if ( isset( $_POST['global_fb_pixel_setting'] ) ) :?>
	<?php if ( wp_verify_nonce( $_POST['global_fb_pixel_setting'], 'save_global_fb_pixel' ) ): ?>
		<?php require_once WPMFBP_ABSPATH . 'includes/admin/save-global-setting.php'; ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
            <p><strong>Settings saved.</strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
	<?php else: ?>
        <div id="setting-error-settings_updated" class="error settings-error notice is-dismissible">
            <p>
                <strong><?php _e( 'Something went wrong while saving. Please try again.', 'wp-multiple-fb-pixels' ); ?></strong>
            </p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
	<?php endif; ?>
<?php endif; ?>
<div class="wrap">
    <h1>Facebook Pixel Global Setting</h1>

    <form method="post" action="" novalidate="novalidate">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label for="blogname">Enable Facebook Pixel</label></th>
				<?php
				$checked = get_option( 'wpmfbp_enable_fb_pixel', '' ) === 'yes' ? 'checked' : '';
				?>
                <td><input name="wpmfbp_enable_fb_pixel" type="checkbox" id="wpmfbp_enable_fb_pixel"
                           value="yes" <?php echo $checked; ?>></td>
            </tr>
            <tr>
				<?php $wpmfbp_global_fb_pixel_id = get_option( 'wpmfbp_global_fb_pixel_id', '' ); ?>
                <th scope="row"><label for="wpmfbp_global_fb_pixel_id">Facebook Pixel ID</label></th>
                <td><input name="wpmfbp_global_fb_pixel_id" type="text" id="wpmfbp_global_fb_pixel_id"
                           value="<?php echo $wpmfbp_global_fb_pixel_id; ?>"
                           class="regular-text">
                    <p class="description" id="tagline-description">Only Digital numbers.</p>
                </td>
            </tr>
            <tr>
				<?php $wpmfbp_global_fb_events = get_option( 'wpmfbp_global_fb_events', '' ); ?>
                <th scope="row"><label for="blogname">Global FB Events</label></th>
                <td><?php echo wpmfbp_display_fb_events_select_html( $wpmfbp_global_fb_events, wpmfbp_get_fb__standard_events(), 'wpmfbp_global_fb_events[]' ); ?>
                    <p class="description"
                       id="tagline-description"><?php _e( 'Choose global FB standard events.', 'wp-multiple-fb-pixels' ); ?></p>
                </td>
            </tr>
			<?php
			/**
			 * Setting to choose the post types for multiple FB pixel IDs
			 */
			$post_types = get_post_types( array( 'public' => true ), 'object', 'and' );
			//format to executable array
			$wpmfbp_post_types = array();
			foreach ( $post_types as $key => $post_type ) {
				$wpmfbp_post_types[ $key ] = $post_type->labels->name;
			}
			//get prev $wpmfbp_post_types setting
			$prev_wpmfbp_post_types = get_option( 'wpmfbp_post_types', true );
			?>
            <tr>
                <th scope="row">
                    <label for="wpmfbp_post_types"><?php _e( 'Multiple FB Pixel', 'wp-multiple-fb-pixels' ) ?></label>
                </th>
                <td><?php echo wpmfbp_display_fb_events_select_html( $prev_wpmfbp_post_types, $wpmfbp_post_types, 'wpmfbp_post_types[]' ); ?>
                    <p class="description"
                       id="tagline-description"><?php _e( 'Choose post types to allow multiple fb pixel.', 'wp-multiple-fb-pixels' ); ?></p>
                </td>
            </tr>
            </tbody>
        </table>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
        </p>
		<?php wp_nonce_field( 'save_global_fb_pixel', 'global_fb_pixel_setting' ); ?>
    </form>

</div>