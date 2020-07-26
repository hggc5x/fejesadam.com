<?php

$default = photo_perfect_get_default_theme_options();

// Add Panel
$wp_customize->add_panel( 'theme_option_panel',
  array(
    'title'      => __( 'Theme Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
  )
);

// Header Section
$wp_customize->add_section( 'section_header',
  array(
    'title'      => __( 'Header Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);

// Search Section
$wp_customize->add_section( 'section_search',
  array(
    'title'      => __( 'Search Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);
// show_title
$wp_customize->add_setting( 'theme_options[show_title]',
  array(
    'default'           => $default['show_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_checkbox',
  )
);
$wp_customize->add_control( 'theme_options[show_title]',
  array(
    'label'    => __( 'Show Site Title', 'photo-perfect' ),
    'section'  => 'section_header',
    'type'     => 'checkbox',
    'priority' => 100,
  )
);
// show_tagline
$wp_customize->add_setting( 'theme_options[show_tagline]',
  array(
    'default'           => $default['show_tagline'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_checkbox',
  )
);
$wp_customize->add_control( 'theme_options[show_tagline]',
  array(
    'label'    => __( 'Show Tagline', 'photo-perfect' ),
    'section'  => 'section_header',
    'type'     => 'checkbox',
    'priority' => 100,
  )
);

// Setting - header_menu_text.
$wp_customize->add_setting( 'theme_options[header_menu_text]',
	array(
		'default'           => $default['header_menu_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[header_menu_text]',
	array(
		'label'    => esc_html__( 'Menu Text', 'photo-perfect' ),
		'section'  => 'section_header',
		'type'     => 'text',
		'priority' => 100,
	)
);

// show_category_dropdown
$wp_customize->add_setting( 'theme_options[show_category_dropdown]',
  array(
    'default'           => $default['show_category_dropdown'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_checkbox',
  )
);
$wp_customize->add_control( 'theme_options[show_category_dropdown]',
  array(
    'label'    => __( 'Show Category Dropdown', 'photo-perfect' ),
    'section'  => 'section_header',
    'type'     => 'checkbox',
    'priority' => 100,
  )
);

// Setting - header_category_text.
$wp_customize->add_setting( 'theme_options[header_category_text]',
	array(
		'default'           => $default['header_category_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[header_category_text]',
	array(
			'label'           => esc_html__( 'Category Text', 'photo-perfect' ),
			'section'         => 'section_header',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'photo_perfect_is_category_navigation_active',
	)
);

// search_placeholder
$wp_customize->add_setting( 'theme_options[search_placeholder]',
  array(
    'default'           => $default['search_placeholder'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  )
);
$wp_customize->add_control( 'theme_options[search_placeholder]',
  array(
    'label'    => __( 'Search Placeholder', 'photo-perfect' ),
    'section'  => 'section_search',
    'type'     => 'text',
    'priority' => 100,
  )
);

// Layout Section
$wp_customize->add_section( 'section_layout',
  array(
    'title'      => __( 'Layout Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);

// global_layout
$wp_customize->add_setting( 'theme_options[global_layout]',
  array(
    'default'           => $default['global_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_select',
  )
);
$wp_customize->add_control( 'theme_options[global_layout]',
  array(
    'label'    => __( 'Global Layout', 'photo-perfect' ),
    'section'  => 'section_layout',
    'type'     => 'select',
    'choices'  => photo_perfect_get_global_layout_options(),
    'priority' => 100,
  )
);
// archive_layout
$wp_customize->add_setting( 'theme_options[archive_layout]',
  array(
    'default'           => $default['archive_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_select',
  )
);
$wp_customize->add_control( 'theme_options[archive_layout]',
  array(
    'label'    => __( 'Archive Layout', 'photo-perfect' ),
    'section'  => 'section_layout',
    'type'     => 'select',
    'choices'  => photo_perfect_get_archive_layout_options(),
    'priority' => 100,
  )
);
// single_image
$wp_customize->add_setting( 'theme_options[single_image]',
  array(
    'default'           => $default['single_image'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_select',
  )
);
$wp_customize->add_control( 'theme_options[single_image]',
  array(
    'label'    => __( 'Image in Single Post/Page', 'photo-perfect' ),
    'section'  => 'section_layout',
    'type'     => 'select',
    'choices'  => photo_perfect_get_image_options( true, array( 'disable', 'large' ) ),
    'priority' => 100,
  )
);
// single_image_alignment
$wp_customize->add_setting( 'theme_options[single_image_alignment]',
  array(
    'default'           => $default['single_image_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_select',
  )
);
$wp_customize->add_control( 'theme_options[single_image_alignment]',
  array(
    'label'    => __( 'Image Alignment in Single Post/Page', 'photo-perfect' ),
    'section'  => 'section_layout',
    'type'     => 'select',
    'choices'  => photo_perfect_get_image_alignment_options(),
    'priority' => 100,
  )
);

// Pagination Section
$wp_customize->add_section( 'section_pagination',
  array(
    'title'      => __( 'Pagination Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);

// pagination_type
$wp_customize->add_setting( 'theme_options[pagination_type]',
  array(
    'default'           => $default['pagination_type'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_select',
  )
);
$wp_customize->add_control( 'theme_options[pagination_type]',
  array(
    'label'       => __( 'Pagination Type', 'photo-perfect' ),
    'section'     => 'section_pagination',
    'type'        => 'select',
    'choices'     => photo_perfect_get_pagination_type_options(),
    'priority'    => 100,
  )
);

// Footer Section
$wp_customize->add_section( 'section_footer',
  array(
    'title'      => __( 'Footer Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);

// copyright_text
$wp_customize->add_setting( 'theme_options[copyright_text]',
  array(
    'default'           => $default['copyright_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
  )
);
$wp_customize->add_control( 'theme_options[copyright_text]',
  array(
    'label'    => __( 'Copyright Text', 'photo-perfect' ),
    'section'  => 'section_footer',
    'type'     => 'text',
    'priority' => 100,
  )
);
// go_to_top
$wp_customize->add_setting( 'theme_options[go_to_top]',
  array(
    'default'           => $default['go_to_top'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_checkbox',
  )
);
$wp_customize->add_control( 'theme_options[go_to_top]',
  array(
    'label'    => __( 'Show Go To Top', 'photo-perfect' ),
    'section'  => 'section_footer',
    'type'     => 'checkbox',
    'priority' => 100,
  )
);

// Blog Section
$wp_customize->add_section( 'section_blog',
  array(
    'title'      => __( 'Blog Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);

// excerpt_length
$wp_customize->add_setting( 'theme_options[excerpt_length]',
  array(
    'default'           => $default['excerpt_length'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'photo_perfect_sanitize_positive_integer',
  )
);
$wp_customize->add_control( 'theme_options[excerpt_length]',
  array(
    'label'       => __( 'Excerpt Length (words)', 'photo-perfect' ),
    'description' => __( 'Default is 40 words', 'photo-perfect' ),
    'section'     => 'section_blog',
    'type'        => 'number',
    'priority'    => 100,
    'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
  )
);
// read_more_text
$wp_customize->add_setting( 'theme_options[read_more_text]',
  array(
    'default'           => $default['read_more_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
  )
);
$wp_customize->add_control( 'theme_options[read_more_text]',
  array(
    'label'    => __( 'Read More Text', 'photo-perfect' ),
    'section'  => 'section_blog',
    'type'     => 'text',
    'priority' => 100,
  )
);

// Advanced Section
$wp_customize->add_section( 'section_advanced',
  array(
    'title'      => __( 'Advanced Options', 'photo-perfect' ),
    'priority'   => 100,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
  )
);

// custom_css
$wp_customize->add_setting( 'theme_options[custom_css]',
  array(
    'default'              => $default['custom_css'],
    'capability'           => 'edit_theme_options',
    'sanitize_callback'    => 'wp_filter_nohtml_kses',
    'sanitize_js_callback' => 'wp_filter_nohtml_kses',
  )
);
$wp_customize->add_control( 'theme_options[custom_css]',
  array(
    'label'    => __( 'Custom CSS', 'photo-perfect' ),
    'section'  => 'section_advanced',
    'type'     => 'textarea',
    'priority' => 100,
  )
);

