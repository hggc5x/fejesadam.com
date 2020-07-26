<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Photo_Perfect
 */

/**
 * Set up the WordPress core custom header feature.
 */
function photo_perfect_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'photo_perfect_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/banner-image.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1600,
		'height'                 => 650,
		'flex-height'            => true,
		'header-text'            => false,
		'wp-head-callback'       => '',
	) ) );

	register_default_headers( array(
		'redrose' => array(
			'url'           => '%s/images/banner-image.jpg',
			'thumbnail_url' => '%s/images/banner-image.jpg',
			'description'   => _x( 'Red Rose', 'header image description', 'photo-perfect' ),
		),
	) );
}
add_action( 'after_setup_theme', 'photo_perfect_custom_header_setup' );
