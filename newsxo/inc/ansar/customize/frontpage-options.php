<?php
$newsxo_default = newsxo_get_default_theme_options(); 
/**
 * Frontpage options section
 *
 * @package Newsxo
 */

// Main banner Slider Section.
Newsxo_Customizer_Control::add_section(
	'frontpage_main_banner_section_settings',
	array(
		'title' => esc_html__( 'Featured Slider', 'newsxo' ),  
        'priority' => 15,
        'capability' => 'edit_theme_options',
	)
);

// Featured Slider Tab
$wp_customize->add_setting(
    'slider_tabs',
    array(
        'default'           => '',
        'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'slider_tabs',
    array(
        'label'                 => '',
        'type' => 'custom-tab-control',
        'priority' => 1,
        'section'               => 'frontpage_main_banner_section_settings',
        'controls_general'      => json_encode( array(
            '#customize-control-show_main_banner_section', 
            '#customize-control-newsxo_main_banner_section_background_image',
            '#customize-control-main_slider_section_title', 
            '#customize-control-select_slider_news_category',
            '#customize-control-main_latest_post_section_title', 
            '#customize-control-select_latest_news_category',
        ) ),
        'controls_design'       => json_encode( array(  
            '#customize-control-main_slider_section_title',
            '#customize-control-newsxo_slider_title_font_size',
            '#customize-control-slider_meta_enable',
            '#customize-control-tren_edit_section_title',
            '#customize-control-newsxo_tren_edit_title_font_size',
        ) ),
    )
));
//Slider Section title 
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden', 
        'settings'  => 'main_slider_section_title',
        'label' => esc_html__('Featured Slider', 'newsxo'),
		'section'   => 'frontpage_main_banner_section_settings',
	)
);
// Setting - show_main_banner_section.
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'show_main_banner_section',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Setting newsxo_main_banner_section_background_image.
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'image', 
        'settings'  => 'newsxo_main_banner_section_background_image',
        'label' => esc_html__('Background image', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'sanitize_callback' => 'esc_url_raw', 
        'active_callback' => 'newsxo_main_banner_section_status'
	)
);
// Setting - drop down category for slider.
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'taxonomies', 
        'settings'  => 'select_slider_news_category',
        'label' => esc_html__('Select Category', 'newsxo'),
        'description' => esc_html__('Posts to be shown on banner slider section', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'taxonomy' => 'category', 
        'default' => $newsxo_default['select_slider_news_category'],
        'sanitize_callback' => 'absint', 
        'active_callback' => 'newsxo_main_banner_section_status'
	)
);
//Latest Post Section title
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden',
        'settings'  => 'main_latest_post_section_title',
        'label' => esc_html__('Latest Post Section', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'sanitize_callback' => 'newsxo_sanitize_text',
        'active_callback' => 'newsxo_main_banner_section_status',
	)
);
// Setting - drop down category for slider.
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'taxonomies', 
        'settings'  => 'select_latest_news_category',
        'label' => esc_html__('Select Category', 'newsxo'),
        'description' => esc_html__('Posts to be shown on latest slider section', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'taxonomy' => 'category', 
        'default' => $newsxo_default['select_latest_news_category'],
        'sanitize_callback' => 'absint', 
        'active_callback' => 'newsxo_main_banner_section_status'
	)
);
// STYLE
// Slider Title Font Size
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'newsxo_slider_title_font_size',
        'label' => esc_html__('Title Font Size', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'transport'   => 'postMessage',
        'media_query'   => true,
        'input_attr'    => array(
            'mobile'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 24,
            ),
            'tablet'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 32,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 38,
            ),
        ),
    ),
);
// Hide/Show Author,Date,Comment
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'slider_meta_enable',
        'label' => esc_html__('Hide/Show Meta', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//Latest/Editor Section title
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'tren_edit_section_title',
        'label' => esc_html__('Latest Post Section', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
); 
// Latest/Editor Title Font Size
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'newsxo_tren_edit_title_font_size',
        'label' => esc_html__('Title Font Size', 'newsxo'),
		'section'  => 'frontpage_main_banner_section_settings',
        'transport'   => 'postMessage',
        'media_query'   => true,
        'input_attr'    => array(
            'mobile'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 16,
            ),
            'tablet'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 20,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 22,
            ),
        ),
    ),
);