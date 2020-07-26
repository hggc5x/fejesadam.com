<?php
/**
 * Implement custom meta boxes.
 *
 * @package Photo_Perfect
 */

if ( ! function_exists( 'photo_perfect_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box.
	 *
	 * @since  Photo Perfect 1.0
	 */
	function photo_perfect_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'theme-settings',
				__( 'Theme Settings', 'photo-perfect' ),
				'photo_perfect_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'photo_perfect_add_theme_meta_box' );

if ( ! function_exists( 'photo_perfect_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since  Photo Perfect 1.0
	 */
	function photo_perfect_render_theme_settings_metabox() {

		global $post;
		$post_id = $post->ID;

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'photo_perfect_theme_settings_meta_box_nonce' );

		// Fetch Options list.
		$global_layout_options = photo_perfect_get_global_layout_options();
		$image_size_options    = photo_perfect_get_image_options( true, array( 'disable', 'large' ) );
		$image_alignment_options    = photo_perfect_get_image_alignment_options();

		// Fetch values of current post meta.
		$values = get_post_meta( $post_id, 'theme_settings', true );
		$theme_settings_post_layout = isset( $values['post_layout'] ) ? esc_attr( $values['post_layout'] ) : '';
		$theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
		$theme_settings_single_image_alignment = isset( $values['single_image_alignment'] ) ? esc_attr( $values['single_image_alignment'] ) : '';
	?>
    <!-- Layout option -->
    <p><strong><?php echo esc_html__( 'Choose Layout', 'photo-perfect' ); ?></strong></p>
    <select name="theme_settings[post_layout]" id="theme_settings_post_layout">
      <option value=""><?php echo esc_html__( 'Default', 'photo-perfect' ); ?></option>
		<?php if ( ! empty( $global_layout_options ) ) :  ?>
        <?php foreach ( $global_layout_options as $key => $val ) :  ?>

          <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $theme_settings_post_layout, $key ); ?> ><?php echo esc_html( $val ); ?></option>

        <?php endforeach ?>
		<?php endif ?>
    </select>
    <!-- Image in single post/page -->
    <p><strong><?php echo esc_html__( 'Choose Image Size in Single Post/Page', 'photo-perfect' ); ?></strong></p>
    <select name="theme_settings[single_image]" id="theme_settings_single_image">
      <option value=""><?php echo esc_html__( 'Default', 'photo-perfect' ); ?></option>
		<?php if ( ! empty( $image_size_options ) ) :  ?>
        <?php foreach ( $image_size_options as $key => $val ) :  ?>

          <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $theme_settings_single_image, $key ); ?> ><?php echo esc_html( $val ); ?></option>

        <?php endforeach ?>
		<?php endif ?>
    </select>
    <!-- Image Alignment in single post/page -->
    <p><strong><?php echo esc_html__( 'Alignment of Image in Single Post/Page', 'photo-perfect' ); ?></strong></p>
    <select name="theme_settings[single_image_alignment]" id="theme_settings_single_image_alignment">
      <option value=""><?php echo esc_html__( 'Default', 'photo-perfect' ); ?></option>
		<?php if ( ! empty( $image_alignment_options ) ) :  ?>
        <?php foreach ( $image_alignment_options as $key => $val ) :  ?>

          <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $theme_settings_single_image_alignment, $key ); ?> ><?php echo esc_html( $val ); ?></option>

        <?php endforeach ?>
		<?php endif ?>
    </select>
    <?php
	}

endif;

if ( ! function_exists( 'photo_perfect_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function photo_perfect_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if (
			! ( isset( $_POST['photo_perfect_theme_settings_meta_box_nonce'] )
			&& wp_verify_nonce( sanitize_key( $_POST['photo_perfect_theme_settings_meta_box_nonce'] ), basename( __FILE__ ) ) )
		) {
			return;
		}

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check permission.
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['theme_settings'] ) && is_array( $_POST['theme_settings'] ) ) {

			$raw_value = wp_unslash( $_POST['theme_settings'] );

			if ( ! array_filter( $raw_value ) ) {

				// No value.
				delete_post_meta( $post_id, 'theme_settings' );

			} else {

				$meta_fields = array(
					'post_layout' => array(
						'type' => 'select',
						),
					'single_image' => array(
						'type' => 'select',
						),
					'single_image_alignment' => array(
						'type' => 'select',
						),
					);

				$sanitized_values = array();

				foreach ( $raw_value as $mk => $mv ) {

					if ( isset( $meta_fields[ $mk ]['type'] ) ) {
						switch ( $meta_fields[ $mk ]['type'] ) {
							case 'select':
								$sanitized_values[ $mk ] = sanitize_key( $mv );
								break;
							case 'checkbox':
								$sanitized_values[ $mk ] = absint( $mv ) > 0 ? 1 : 0;
								break;
							default:
								$sanitized_values[ $mk ] = sanitize_text_field( $mv );
								break;
						}
					} // End if.

				}

				update_post_meta( $post_id, 'theme_settings', $sanitized_values );
			}
		} // End if theme settings.

	}

endif;

add_action( 'save_post', 'photo_perfect_save_theme_settings_meta', 10, 2 );
