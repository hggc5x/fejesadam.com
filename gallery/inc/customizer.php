<?php
/**
 * Photo Perfect Theme Customizer.
 *
 * @package Photo_Perfect
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_perfect_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/control.php';

	// Load customize helpers.
	require get_template_directory() . '/inc/helper/options.php';

	// Load customize sanitize.
	require get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize callback.
	require get_template_directory() . '/inc/customizer/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Load customize option.
	require get_template_directory() . '/inc/customizer/option.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'Photo_Perfect_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Photo_Perfect_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Photo Perfect Pro', 'photo-perfect' ),
				'pro_text' => esc_html__( 'Buy Pro', 'photo-perfect' ),
				'pro_url'  => 'https://themepalace.com/downloads/photo-perfect-pro/',
				'priority' => 1,
			)
		)
	);
}
add_action( 'customize_register', 'photo_perfect_customize_register' );

/**
 * Load styles for Customizer.
 */
function photo_perfect_load_customizer_styles() {

	global $pagenow;

	if ( 'customize.php' === $pagenow ) {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'photo-perfect-customizer-style', get_template_directory_uri() . '/css/customizer' . $min . '.css', false, '1.8.0' );
	}

}

add_action( 'admin_enqueue_scripts', 'photo_perfect_load_customizer_styles' );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.8.0
 */
function photo_perfect_customizer_control_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'photo-perfect-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'photo-perfect-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'photo_perfect_customizer_control_scripts', 0 );

/**
 * Customizer partials.
 *
 * @since 1.8.0
 */
function photo_perfect_customizer_partials( WP_Customize_Manager $wp_customize ) {

    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
        return;
    }

    // Load customizer partials callback.
    require get_template_directory() . '/inc/customizer/partials.php';

    // Partial blogname.
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'photo_perfect_customize_partial_blogname',
    ) );

    // Partial blogdescription.
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'photo_perfect_customize_partial_blogdescription',
    ) );

}
add_action( 'customize_register', 'photo_perfect_customizer_partials', 99 );


/**
 * Hide Custom CSS.
 *
 * @since 1.8.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photo_perfect_hide_custom_css( $wp_customize ) {

	// Bail if not WP 4.7.
	if ( ! function_exists( 'wp_get_custom_css_post' ) ) {
		return;
	}

	$wp_customize->remove_control( 'theme_options[custom_css]' );

}

add_action( 'customize_register', 'photo_perfect_hide_custom_css', 99 );
