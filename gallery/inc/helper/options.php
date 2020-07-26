<?php

if( ! function_exists( 'photo_perfect_get_global_layout_options' ) ) :

  /**
   * Returns global layout options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_global_layout_options(){

    $choices = array(
      'left-sidebar'  => __( 'Primary Sidebar - Content', 'photo-perfect' ),
      'right-sidebar' => __( 'Content - Primary Sidebar', 'photo-perfect' ),
      'no-sidebar'    => __( 'No Sidebar', 'photo-perfect' ),
    );
    $output = apply_filters( 'photo_perfect_filter_layout_options', $choices );
    return $output;

  }

endif;

if( ! function_exists( 'photo_perfect_get_site_layout_options' ) ) :

  /**
   * Returns site layout options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_site_layout_options(){

    $choices = array(
      'fluid' => __( 'Fluid', 'photo-perfect' ),
      'boxed' => __( 'Boxed', 'photo-perfect' ),
    );
    $output = apply_filters( 'photo_perfect_filter_site_layout_options', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;

  }

endif;

if( ! function_exists( 'photo_perfect_get_pagination_type_options' ) ) :

  /**
   * Returns pagination type options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_pagination_type_options(){

    $choices = array(
      'default' => __( 'Default (Older / Newer Post)', 'photo-perfect' ),
      'numeric' => __( 'Numeric', 'photo-perfect' ),
    );
    return $choices;

  }

endif;

if( ! function_exists( 'photo_perfect_get_archive_layout_options' ) ) :

  /**
   * Returns archive layout options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_archive_layout_options(){

    $choices = array(
      'masonry' => __( 'Masonry', 'photo-perfect' ),
      'excerpt' => __( 'Post Excerpt', 'photo-perfect' ),
    );
    $output = apply_filters( 'photo_perfect_filter_archive_layout_options', $choices );
    if ( ! empty( $output ) ) {
      ksort( $output );
    }
    return $output;

  }

endif;


if( ! function_exists( 'photo_perfect_get_image_sizes_options' ) ) :

  /**
   * Returns image size options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_image_sizes_options( $add_disable = true ){

    global $_wp_additional_image_sizes;
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
    $choices = array();
    if ( true == $add_disable ) {
      $choices['disable'] = __( 'No Image', 'photo-perfect' );
    }
    foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
      $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
    }
    $choices['full'] = __( 'full (original)', 'photo-perfect' );
    if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

      foreach ($_wp_additional_image_sizes as $key => $size ) {
        $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
      }

    }
    return $choices;

  }

endif;

if( ! function_exists( 'photo_perfect_get_image_options' ) ) :

  /**
   * Returns image options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_image_options( $add_disable = true, $allowed = array() ){

    global $_wp_additional_image_sizes;
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
    $choices = array();
    if ( true == $add_disable ) {
      $choices['disable'] = __( 'No Image', 'photo-perfect' );
    }
    $choices['thumbnail'] = __( 'Thumbnail', 'photo-perfect' );
    $choices['medium']    = __( 'Medium', 'photo-perfect' );
    $choices['large']     = __( 'Large', 'photo-perfect' );
    $choices['full']      = __( 'Full', 'photo-perfect' );

    if ( ! empty( $allowed ) ) {
      foreach ( $choices as $key => $value ) {
        if ( ! in_array( $key, $allowed ) ) {
          unset( $choices[ $key ] );
        }
      }
    }

    return $choices;

  }

endif;


if( ! function_exists( 'photo_perfect_get_image_alignment_options' ) ) :

  /**
   * Returns image options.
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_get_image_alignment_options(){

    $choices = array(
      'none'   => _x( 'None', 'Alignment', 'photo-perfect' ),
      'left'   => _x( 'Left', 'Alignment', 'photo-perfect' ),
      'center' => _x( 'Center', 'Alignment', 'photo-perfect' ),
      'right'  => _x( 'Right', 'Alignment', 'photo-perfect' ),
    );
    return $choices;

  }

endif;
