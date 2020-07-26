<?php

if ( ! function_exists( 'photo_perfect_doctype' ) ) :
  /**
   * Doctype Declaration
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_doctype() {
    ?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
  }
endif;

add_action( 'photo_perfect_action_doctype', 'photo_perfect_doctype', 10 );


if ( ! function_exists( 'photo_perfect_head' ) ) :
  /**
   * Header Codes
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_head() {
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
  }
endif;
add_action( 'photo_perfect_action_head', 'photo_perfect_head', 10 );

if ( ! function_exists( 'photo_perfect_page_start' ) ) :
  /**
   * Page Start
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_page_start() {
    ?>
    <div id="page" class="container hfeed site">
    <?php
  }
endif;
add_action( 'photo_perfect_action_before', 'photo_perfect_page_start' );

if ( ! function_exists( 'photo_perfect_page_end' ) ) :
  /**
   * Page End
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_page_end() {
    ?></div><!-- #page --><?php
  }
endif;

add_action( 'photo_perfect_action_after', 'photo_perfect_page_end' );

if ( ! function_exists( 'photo_perfect_content_start' ) ) :
  /**
   * Content Start
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_content_start() {
    ?><div id="content" class="site-content"><div class="container"><div class="inner-wrapper"><?php
  }
endif;
add_action( 'photo_perfect_action_before_content', 'photo_perfect_content_start' );


if ( ! function_exists( 'photo_perfect_content_end' ) ) :
  /**
   * Content End
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_content_end() {
    ?></div><!-- .inner-wrapper --></div><!-- .container --></div><!-- #content --><?php
  }
endif;
add_action( 'photo_perfect_action_after_content', 'photo_perfect_content_end' );


if ( ! function_exists( 'photo_perfect_header_start' ) ) :
  /**
   * Header Start
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_header_start() {
    ?><header id="masthead" class="site-header" role="banner"><?php
  }
endif;
add_action( 'photo_perfect_action_before_header', 'photo_perfect_header_start' );

if ( ! function_exists( 'photo_perfect_header_end' ) ) :
  /**
   * Header End
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_header_end() {
    ?></header><!-- #masthead --><?php
  }
endif;
add_action( 'photo_perfect_action_after_header', 'photo_perfect_header_end' );



if ( ! function_exists( 'photo_perfect_footer_start' ) ) :
  /**
   * Footer Start
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_footer_start() {
    $footer_status = apply_filters( 'photo_perfect_filter_footer_status', true );
    if ( true !== $footer_status) {
      return;
    }
    ?><footer id="colophon" class="site-footer" role="contentinfo"><div class="container"><?php
  }
endif;
add_action( 'photo_perfect_action_before_footer', 'photo_perfect_footer_start' );


if ( ! function_exists( 'photo_perfect_footer_end' ) ) :
  /**
   * Footer End
   *
   * @since Photo Perfect 1.0
   *
   */
  function photo_perfect_footer_end() {
    $footer_status = apply_filters( 'photo_perfect_filter_footer_status', true );
    if ( true !== $footer_status) {
      return;
    }
    ?></div><!-- .container --></footer><!-- #colophon --><?php
  }
endif;
add_action( 'photo_perfect_action_after_footer', 'photo_perfect_footer_end' );

if ( ! function_exists( 'photo_perfect_add_masonry_wrap_start' ) ) :
  /**
   * Masonry Start
   *
   * @since photo perfect 1.0
   *
   */
  function photo_perfect_add_masonry_wrap_start() {

    $archive_layout = photo_perfect_get_option( 'archive_layout' );
    if ( 'masonry' != $archive_layout ) {
      return;
    }

    ?><div class="masonry-wrapper"><div id="masonry-loop"><?php
  }
endif;

add_action( 'photo_perfect_action_before_loop', 'photo_perfect_add_masonry_wrap_start' );

if ( ! function_exists( 'photo_perfect_add_masonry_wrap_end' ) ) :
  /**
   * Masonry End
   *
   * @since photo perfect 1.0
   *
   */
  function photo_perfect_add_masonry_wrap_end() {

    $archive_layout = photo_perfect_get_option( 'archive_layout' );
    if ( 'masonry' != $archive_layout ) {
      return;
    }
    ?></div><!-- #masonry-loop --></div><!-- .masonry-wrapper --><?php
  }
endif;

add_action( 'photo_perfect_action_after_loop', 'photo_perfect_add_masonry_wrap_end' );
