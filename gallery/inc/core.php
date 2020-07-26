<?php
/**
 * Core functions.
 *
 * @package Photo_Perfect
 */

if ( ! function_exists( 'photo_perfect_get_option' ) ) :

	/**
	 * Get theme option from key.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 */
	function photo_perfect_get_option( $key = '' ) {

		global $photo_perfect_default_options;
		if ( empty( $key ) ) {
			return;
		}

		$default = ( isset( $photo_perfect_default_options[ $key ] ) ) ? $photo_perfect_default_options[ $key ] : '';
		$theme_options = get_theme_mod( 'theme_options', $photo_perfect_default_options );
		$theme_options = array_merge( $photo_perfect_default_options, $theme_options );
		$value = '';
		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}
		return $value;

	}

endif;

if ( ! function_exists( 'photo_perfect_get_options' ) ) :

	/**
	 * Get theme options.
	 *
	 * @since 1.5
	 */
	function photo_perfect_get_options() {

		$value = array();

		$value = get_theme_mod( 'theme_options' );

		return $value;

	}

endif;
