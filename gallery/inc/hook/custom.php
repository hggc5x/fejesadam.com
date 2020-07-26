<?php

if ( ! function_exists( 'photo_perfect_skip_to_content' ) ) :
  /**
   * Skip to content
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_skip_to_content() {
    ?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'photo-perfect' ); ?></a><?php
  }
endif;

add_action( 'photo_perfect_action_before', 'photo_perfect_skip_to_content', 15 );

if ( ! function_exists( 'photo_perfect_add_separator_title' ) ) :
  /**
   * Add separator heading
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_add_separator_title() {
    ?>
    <div id="separator-title">
      <?php
        if ( is_front_page() ) {
          ?>
          <span class="title-tag">
            <img src="<?php echo get_template_directory_uri(); ?>/images/title-tag.png" alt="" />
          </span><!-- .title-tag -->
          <?php
        }
        elseif( is_archive() ) {
          ?>
          <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
          <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
          <?php
        }
        elseif( is_search() ) {
          ?>
          <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'photo-perfect' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
          <?php
        }
        elseif( is_singular() ){
          global $post;
          ?>
          <?php if ( 'post' == get_post_type() ): ?>
            <div class="single-link-previous">
              <?php echo get_previous_post_link( '%link', '<i class="fa fa-long-arrow-left"></i><span class="screen-reader-text">%title</span>' ); ?>
            </div><!-- .single-link-previous -->
          <?php endif ?>

          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

          <?php if ( 'post' == get_post_type() ): ?>
            <div class="single-link-next">
              <?php echo get_next_post_link( '%link', '<i class="fa fa-long-arrow-right"></i><span class="screen-reader-text">%title</span>' ); ?>
            </div><!-- .single-link-next -->
          <?php endif ?>
          <?php if ( 'post' == get_post_type() ): ?>
            <div class="single-post-meta">
              <?php photo_perfect_posted_on_custom(); ?>
            </div><!-- .single-post-meta -->
          <?php endif ?>
          <?php
        }
       ?>
    </div><!-- #separator-title -->
    <?php
  }
endif;

add_action( 'photo_perfect_action_content', 'photo_perfect_add_separator_title' );


if( ! function_exists( 'photo_perfect_site_branding' ) ) :

  /**
   * Site branding
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_site_branding() {

    ?>
    <div class="container">

      <div class="site-branding">
        <?php
        if ( function_exists( 'the_custom_logo' ) ) {
        	echo '<div id="site-logo">';
	        the_custom_logo();
        	echo '</div>';
        }
        ?>

        <?php $show_title = photo_perfect_get_option( 'show_title' ); ?>
        <?php $show_tagline = photo_perfect_get_option( 'show_tagline' ); ?>
        <?php if ( true == $show_title || true == $show_tagline ) : ?>
          <div id="site-identity">
            <?php if ( true == $show_title ): ?>
              <?php if ( is_front_page() ) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
              <?php endif; ?>
            <?php endif; ?>

            <?php if ( true == $show_tagline ) : ?>
              <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            <?php endif; ?>
          </div><!-- #site-identity -->
        <?php endif; ?>

      </div><!-- .site-branding -->

    </div><!-- .container -->

    <?php
  }

endif;

add_action( 'photo_perfect_action_header', 'photo_perfect_site_branding' );


if( ! function_exists( 'photo_perfect_add_primary_navigation' ) ) :

  /**
   * Primary navigation
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_add_primary_navigation(){

    if ( ! has_nav_menu( 'primary' ) ) {
      return;
    }
	$header_menu_text = photo_perfect_get_option( 'header_menu_text' );
    ?>
    <div id="main-nav" class="clear-fix">
        <div class="container">
        <nav id="site-navigation" class="header-navigation" role="navigation">
          <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span><?php echo esc_html( $header_menu_text ); ?></span>
            <i class="fa fa-align-justify"></i></button>
            <div class="wrap-menu-content">
              <?php
                wp_nav_menu(
                  array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                  )
                );
              ?>
            </div><!-- .menu-content -->
        </nav><!-- #site-navigation -->
       </div> <!-- .container -->
    </div> <!-- #main-nav -->
    <?php
  }

endif;

add_action( 'photo_perfect_action_before_header', 'photo_perfect_add_primary_navigation', 20 );


if( ! function_exists( 'photo_perfect_add_category_navigation' ) ) :

  /**
   * Category navigation
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_add_category_navigation(){

	$show_category_dropdown = photo_perfect_get_option( 'show_category_dropdown' );
    if ( true !== $show_category_dropdown ) {
      return;
    }
	$header_category_text   = photo_perfect_get_option( 'header_category_text' );
    ?>
    <div id="category-menu" class="clear-fix header-navigation">
      <div class="container">
        <button class="nav-list-btn"><i class="fa fa-list"></i><span><?php echo esc_html( $header_category_text ); ?></span></button>
        <div class="category-list-wrapper">
          <ul>
          <?php wp_list_categories( 'title_li=&depth=1' ); ?>
          </ul>
        </div><!-- .category-list-wrapper -->
      </div><!-- .container -->
    </div><!-- #category-menu -->
    <?php
  }

endif;


add_action( 'photo_perfect_action_before_header', 'photo_perfect_add_category_navigation', 22 );

if( ! function_exists( 'photo_perfect_footer_copyright' ) ) :

  /**
   * Footer copyright
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_footer_copyright(){

    // Check if footer is disabled
    $footer_status = apply_filters( 'photo_perfect_filter_footer_status', true );
    if ( true !== $footer_status) {
      return;
    }

    // Footer Menu
    $footer_menu_content = wp_nav_menu( array(
      'theme_location' => 'footer',
      'container'      => 'div',
      'container_id'   => 'footer-navigation',
      'depth'          => 1,
      'fallback_cb'    => false,
      'echo'           => false,
    ) );

    // Copyright
    $copyright_text = photo_perfect_get_option( 'copyright_text' );
    $copyright_text = apply_filters( 'photo_perfect_filter_copyright_text', esc_html( $copyright_text ) );

    ?>

    <div class="inner-wrapper">

      <div class="footer-left">
      <?php the_widget( 'Photo_Perfect_Social_Widget', array() ); ?>
        <?php if ( ! empty( $copyright_text ) ): ?>
          <div class="copyright">
            <?php echo $copyright_text; ?>
          </div><!-- .copyright -->
        <?php endif ?>
      </div><!-- .footer-left -->

      <div class="footer-right">
        <?php if ( ! empty( $footer_menu_content ) ): ?>
          <?php echo $footer_menu_content; ?>
        <?php endif ?>
        <div class="site-info">
          <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'photo-perfect' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'photo-perfect' ), 'WordPress' ); ?></a>
          <span class="sep"> | </span>
          <?php printf( esc_html__( '%1$s by %2$s', 'photo-perfect' ), 'Photo Perfect', '<a href="' . esc_url( 'https://wenthemes.com/' ) . '" rel="designer" target="_blank">WEN Themes</a>' ); ?>
        </div><!-- .site-info -->

      </div><!-- .footer-right -->

    </div><!-- .inner-wrapper -->
    <?php

  }

endif;

add_action( 'photo_perfect_action_footer', 'photo_perfect_footer_copyright', 10 );


if( ! function_exists( 'photo_perfect_add_sidebar' ) ) :

  /**
   * Add sidebar
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_add_sidebar(){

    global $post;

    $global_layout = photo_perfect_get_option( 'global_layout' );

    // Check if single.
    if ( $post && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    // Include sidebar.
    if ( 'no-sidebar' !== $global_layout ) {
      get_sidebar();
    }

  }

endif;

add_action( 'photo_perfect_action_sidebar', 'photo_perfect_add_sidebar' );


if ( ! function_exists( 'photo_perfect_custom_posts_navigation' ) ) :
  /**
   * Posts navigation
   *
   * @since Photo Perfect 1.0
   */
  function photo_perfect_custom_posts_navigation() {

    $pagination_type = photo_perfect_get_option( 'pagination_type' );

    switch ( $pagination_type ) {

      case 'default':
        the_posts_navigation();
        break;

      case 'numeric':
        if ( function_exists( 'wp_pagenavi' ) ){
          wp_pagenavi();
        }
        else{
          the_posts_pagination();
        }
        break;

      default:
        break;
    }

  }
endif;

add_action( 'photo_perfect_action_posts_navigation', 'photo_perfect_custom_posts_navigation' );


if( ! function_exists( 'photo_perfect_add_image_in_single_display' ) ) :

  /**
   * Add image in single post.
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_add_image_in_single_display(){

    global $post;

    if ( has_post_thumbnail() ){

      $values = get_post_meta( $post->ID, 'theme_settings', true );
      $theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
      $theme_settings_single_image_alignment = isset( $values['single_image_alignment'] ) ? esc_attr( $values['single_image_alignment'] ) : '';

      if ( ! $theme_settings_single_image ) {
        $theme_settings_single_image = photo_perfect_get_option( 'single_image' );
      }
      if ( ! $theme_settings_single_image_alignment ) {
        $theme_settings_single_image_alignment = photo_perfect_get_option( 'single_image_alignment' );
      }

      if ( 'disable' !== $theme_settings_single_image ) {

      	$featured_image_full_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

        echo '<a href=" ' . esc_url( $featured_image_full_url ) .'">';
        $args = array(
          'class' => 'align' . esc_attr( $theme_settings_single_image_alignment ),
        );
        the_post_thumbnail( esc_attr( $theme_settings_single_image ), $args );
        echo '</a>';
      }

    }

  }

endif;

add_action( 'photo_perfect_single_image', 'photo_perfect_add_image_in_single_display' );

if( ! function_exists( 'photo_perfect_footer_goto_top' ) ) :

  /**
   * Go to top
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_footer_goto_top(){

    $go_to_top = photo_perfect_get_option( 'go_to_top' );
    if ( true !== $go_to_top ) {
      return;
    }
    echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-level-up"></i></a>';

  }

endif;

add_action( 'photo_perfect_action_after', 'photo_perfect_footer_goto_top', 20 );

if( ! function_exists( 'photo_perfect_add_custom_header' ) ) :

  /**
   * Add Custom Header
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_add_custom_header(){

    if ( ! get_header_image() ) {
      return;
    }
    ?>
    <div id="featured-banner" class="featured-banner">
      <div class="item">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        </a>
      </div><!-- .item -->
    </div><!-- #featured-banner -->
    <?php

  }

endif;

add_action( 'photo_perfect_action_after_header', 'photo_perfect_add_custom_header', 15 );

if( ! function_exists( 'photo_perfect_load_archive_loop_content' ) ) :

  /**
   * Load Archive Loop Content
   *
   * @since  Photo Perfect 1.0
   */
  function photo_perfect_load_archive_loop_content(){

    $archive_layout = photo_perfect_get_option( 'archive_layout' );
    if ( 'masonry' === $archive_layout ) {
      get_template_part( 'template-parts/content', 'masonry' );
    }
    else if ( 'full' === $archive_layout ) {
      get_template_part( 'template-parts/content', 'full' );
    }
    else{
      get_template_part( 'template-parts/content', get_post_format() );
    }

  }

endif;

add_action( 'photo_perfect_action_loop', 'photo_perfect_load_archive_loop_content' );
