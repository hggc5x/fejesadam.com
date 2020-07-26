<?php
/**
 * Customizer partials.
 *
 * @package Photo_Perfect
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.4.0
 *
 * @return void
 */
function photo_perfect_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site description for the selective refresh partial.
 *
 * @since 1.4.0
 *
 * @return void
 */
function photo_perfect_customize_partial_blogdescription() {

	bloginfo( 'description' );

}
