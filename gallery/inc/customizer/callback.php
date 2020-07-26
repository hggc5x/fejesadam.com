<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package Photo_Perfect
 */

if ( ! function_exists( 'photo_perfect_is_category_navigation_active' ) ) :

	/**
	 * Check if category navigation is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function photo_perfect_is_category_navigation_active( $control ) {

		if ( $control->manager->get_setting( 'theme_options[show_category_dropdown]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
