<?php
/**
 * Photo Perfect functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Photo_Perfect
 */

if ( ! function_exists( 'photo_perfect_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function photo_perfect_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'photo-perfect', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in four location.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'photo-perfect' ),
			'footer'   => esc_html__( 'Footer Menu', 'photo-perfect' ),
			'social'   => esc_html__( 'Social Menu', 'photo-perfect' ),
			'notfound' => esc_html__( '404 Menu', 'photo-perfect' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		* Add editor style.
		*/
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		add_editor_style( array( 'css/editor-style' . $min . '.css' ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'photo_perfect_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		/*
		 * Enable support for selective refresh of widgets in Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Enable support for footer widgets
		 */
		add_theme_support( 'footer-widgets', 4 );

		/**
		 * Load Supports.
		 */
		require get_template_directory() . '/inc/support.php';

		global $photo_perfect_default_options;
		$photo_perfect_default_options = photo_perfect_get_default_theme_options();

		global $photo_perfect_post_count;
		$photo_perfect_post_count = 1;

	}
endif;

add_action( 'after_setup_theme', 'photo_perfect_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photo_perfect_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photo_perfect_content_width', 640 );
}
add_action( 'after_setup_theme', 'photo_perfect_content_width', 0 );

/**
 * Register widget area.
 */
function photo_perfect_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'photo-perfect' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'photo-perfect' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'photo_perfect_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function photo_perfect_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'photo-perfect-google-fonts', photo_perfect_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	wp_enqueue_style( 'photo-perfect-style', get_stylesheet_uri() );

	wp_enqueue_style( 'photo-perfect-photobox-css', get_template_directory_uri() . '/third-party/photobox/photobox' . $min . '.css', array(), '1.6.3' );

	wp_enqueue_script( 'photo-perfect-navigation', get_template_directory_uri() . '/js/navigation' . $min . '.js', array(), '20120206', true );

	wp_enqueue_script( 'photo-perfect-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'photo-perfect-imageloaded', get_template_directory_uri() . '/third-party/imageloaded/imagesloaded.pkgd' . $min . '.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'photo-perfect-photobox', get_template_directory_uri() . '/third-party/photobox/jquery.photobox' . $min . '.js', array( 'jquery' ), '1.6.3', true );

	wp_enqueue_script( 'photo-perfect-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery', 'masonry', 'photo-perfect-imageloaded', 'photo-perfect-photobox' ), '1.0.0', true );
	wp_localize_script( 'photo-perfect-custom', 'PhotoPerfectScreenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'photo-perfect' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'photo-perfect' ) . '</span>',
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'photo_perfect_scripts' );

if ( ! function_exists( 'photo_perfect_fonts_url' ) ) :
	/**
	 * Register Google fonts for Photo Perfect
	 *
	 * Create your own photo_perfect_fonts_url() function to override in a child theme.
	 *
	 * @since Photo Perfect 1.9.1
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function photo_perfect_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans: on or off', 'photo-perfect' );

		/* Translators: If there are characters in your language that are not
		* supported by Arizonia Display, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$arizonia = _x( 'on', 'Arizonia: on or off', 'photo-perfect' );

		if ( 'off' !== $open_sans || 'off' !== $arizonia ) {
			$font_families = array();

			if ( 'off' !== $open_sans ) {
			$font_families[] = 'Open Sans:300,400,600,700,800,300italic,400italic,600italic,700italic,800italic';
			}

			if ( 'off' !== $arizonia ) {
			$font_families[] = 'Arizonia:400';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Load init.
 */
require get_template_directory() . '/inc/init.php';
