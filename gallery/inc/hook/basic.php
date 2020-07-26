<?php

if ( ! function_exists( 'photo_perfect_customize_search_form' ) ) :
  /**
   * Customize search form.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_customize_search_form() {

    $search_placeholder = photo_perfect_get_option( 'search_placeholder' );
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
      <label>
        <span class="screen-reader-text">' . _x( 'Search for:', 'label', 'photo-perfect' ) . '</span>
        <input type="search" class="search-field" placeholder="' . esc_attr( $search_placeholder ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'photo-perfect' ) . '" />
      </label>
      <input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'photo-perfect' ) .'" />
    </form>';

    return $form;

  }

endif;

add_filter( 'get_search_form', 'photo_perfect_customize_search_form', 15 );


if( ! function_exists( 'photo_perfect_add_custom_css' ) ) :

  /**
   * Add custom CSS.
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_add_custom_css(){

    $custom_css = photo_perfect_get_option( 'custom_css' );
    $output = '';
    if ( ! empty( $custom_css ) ) {
      $output = "\n" . '<style type="text/css">' . "\n";
      $output .= esc_textarea( $custom_css ) ;
      $output .= "\n" . '</style>' . "\n" ;
    }
    echo $output;

  }

endif;

add_action( 'wp_head', 'photo_perfect_add_custom_css' );


if( ! function_exists( 'photo_perfect_implement_excerpt_length' ) ) :

  /**
   * Implement excerpt length
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_implement_excerpt_length( $length ){

    $excerpt_length = photo_perfect_get_option( 'excerpt_length' );
    if ( empty( $excerpt_length) ) {
      $excerpt_length = $length;
    }
    return apply_filters( 'photo_perfect_filter_excerpt_length', esc_attr( $excerpt_length ) );

  }

endif;
add_filter( 'excerpt_length', 'photo_perfect_implement_excerpt_length', 999 );


if( ! function_exists( 'photo_perfect_implement_read_more' ) ) :

  /**
   * Implement read more in excerpt.
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_implement_read_more( $more ){

    $flag_apply_excerpt_read_more = apply_filters( 'photo_perfect_filter_excerpt_read_more', true );
    if ( true !== $flag_apply_excerpt_read_more ) {
      return $more;
    }

    $output = $more;
    $read_more_text = photo_perfect_get_option( 'read_more_text' );
    if ( ! empty( $read_more_text ) ) {
      $output = '... <a href="'. esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '</a>';
      $output = apply_filters( 'photo_perfect_filter_read_more_link' , $output );
    }
    return $output;

  }

endif;
add_filter( 'excerpt_more', 'photo_perfect_implement_read_more' );


if( ! function_exists( 'photo_perfect_content_more_link' ) ) :

  /**
   * Implement read more in content.
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_content_more_link( $more_link, $more_link_text ) {

    $flag_apply_excerpt_read_more = apply_filters( 'photo_perfect_filter_excerpt_read_more', true );
    if ( true !== $flag_apply_excerpt_read_more ) {
      return $more_link;
    }

    $read_more_text = photo_perfect_get_option( 'read_more_text' );
    if ( ! empty( $read_more_text ) ) {
      $more_link =  str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
    }
    return $more_link;

  }

endif;

add_filter( 'the_content_more_link', 'photo_perfect_content_more_link', 10, 2 );


if ( ! function_exists( 'photo_perfect_custom_body_class' ) ) :
  /**
   * Custom body class
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_custom_body_class( $input ) {

    // Site layout.
    $site_layout = photo_perfect_get_option( 'site_layout' );
    $input[] = 'site-layout-' . esc_attr( $site_layout );

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
    	$input[] = 'group-blog';
    }

    // Archive layout.
    $archive_layout = photo_perfect_get_option( 'archive_layout' );
    $input[] = 'archive-layout-' . esc_attr( $archive_layout );

    // Custom header status.
    $custom_header_status = get_header_image() ? 'enabled' : 'disabled';
    $input[] = 'custom-header-' . $custom_header_status;

    // Global layout.
    global $post;
    $global_layout = photo_perfect_get_option( 'global_layout' );
    // Check if single.
    if ( $post  && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    $input[] = 'global-layout-' . esc_attr( $global_layout );

    return $input;
  }
endif;

add_filter( 'body_class', 'photo_perfect_custom_body_class' );

if ( ! function_exists( 'photo_perfect_import_custom_css' ) ) :

	/**
	 * Import Custom CSS.
	 *
	 * @since 1.0.5
	 */
	function photo_perfect_import_custom_css() {

		// Bail if not WP 4.7.
		if ( ! function_exists( 'wp_get_custom_css_post' ) ) {
			return;
		}

		$custom_css = photo_perfect_get_option( 'custom_css' );

		// Bail if there is no Custom CSS.
		if ( empty( $custom_css ) ) {
			return;
		}

		$core_css = wp_get_custom_css();
		$return = wp_update_custom_css_post( $core_css . $custom_css );

		if ( ! is_wp_error( $return ) ) {

			// Remove from theme.
			$options = photo_perfect_get_options();
			$options['custom_css'] = '';
			set_theme_mod( 'theme_options', $options );
		}

	}
endif;

add_action( 'after_setup_theme', 'photo_perfect_import_custom_css', 99 );

