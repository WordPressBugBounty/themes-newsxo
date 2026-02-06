<?php 
/**
 * Header Option Panel
 *
 * @package Newsxo
 */

$newsxo_default = newsxo_get_default_theme_options();

// Add Panel
Newsxo_Customizer_Control::add_panel(
	'newsxo_site_identity_panel',
	array(
        'title' => esc_html__('Site Identity', 'newsxo'),
        'priority' => 5,
        'capability' => 'edit_theme_options',
	)
);
// Add Section.
Newsxo_Customizer_Control::add_section(
	'title_tagline',
	array(
		'title' => esc_html__( 'Logo & Site Icon', 'newsxo' ), 
        'panel' => 'newsxo_site_identity_panel',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'side_main_logo_width',
        'label' => esc_html__('Logo Width', 'newsxo'),
		'section'  => 'title_tagline',
        'transport'         => 'postMessage',
        'media_query'   => true,
        'input_attr'    => array(
            'mobile'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 150,
            ),
            'tablet'  => array(
                'min'           => 0,
                'max'           => 350,
                'step'          => 1,
                'default_value' => 200,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 400,
                'step'          => 1,
                'default_value' => 250,
            ),
        ),
    ),
);
// Add Section.
Newsxo_Customizer_Control::add_section(
	'newsxo_site_title_section',
	array(
		'title' => esc_html__( 'Site Title & Tagline', 'newsxo' ), 
        'panel' => 'newsxo_site_identity_panel',
	)
);

$wp_customize->get_control( 'blogname' )->section = 'newsxo_site_title_section';
$wp_customize->get_control( 'display_header_text' )->section = 'newsxo_site_title_section';
$wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display site title', 'newsxo' );
$wp_customize->get_control( 'blogdescription' )->section = 'newsxo_site_title_section';

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'site_title_font_size',
        'label' => esc_html__('Site Title Size', 'newsxo'),
		'section'  => 'newsxo_site_title_section',
        'transport'         => 'postMessage',
        'media_query'   => true,
        'input_attr'    => array(
            'mobile'  => array(
                'min'           => 0,
                'max'           => 100,
                'step'          => 1,
                'default_value' => 30,
            ),
            'tablet'  => array(
                'min'           => 0,
                'max'           => 110,
                'step'          => 1,
                'default_value' => 35,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 120,
                'step'          => 1,
                'default_value' => 40,
            ),
        ),
    ),
);
// Enable/Disable header image overlay color
Newsxo_Customizer_Control::add_field( 
    array(
        'type'     => 'checkbox', 
        'settings'  => 'header_text_center',
        'label' => esc_html__('Display Center Site Title and Tagline', 'newsxo'),
        'section'  => 'newsxo_site_title_section',
        'default' => false,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
    )
);
// Theme Header Panel 
Newsxo_Customizer_Control::add_panel(
	'header_option_panel',
	array(
        'title' => esc_html__('Header Option', 'newsxo'),
        'priority' => 6,
        'capability' => 'edit_theme_options',
	)
);

// Top Bar
Newsxo_Customizer_Control::add_section(
	'header_top_bar',
    array(
        'title' => esc_html__( 'Top Bar', 'newsxo' ),  
        'panel' => 'header_option_panel',
        'priority' => 2,
    )
);
$wp_customize->add_setting(
    'top_bar_tabs',
    array(
        'default'           => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'top_bar_tabs',
    array(
        'label'                 => '',
        'type' => 'custom-tab-control',
        'section'               => 'header_top_bar',
        'controls_general'      => json_encode( array( 
                                                    '#customize-control-', 
                                                    '#customize-control-breaking_news_settings', 
                                                    '#customize-control-brk_news_enable',
                                                    '#customize-control-breaking_news_title',
                                                    '#customize-control-date_settings',
                                                    '#customize-control-header_date_enable', 
                                                    '#customize-control-time_settings',
                                                    '#customize-control-header_time_enable', 
                                                    '#customize-control-newsxo_date_time_show_type',
        ) ),
        'controls_design'       => json_encode( array( 
                                                    '#customize-control-header_top_bar_heading',
                                                    '#customize-control-top_bar_color',
                                                    '#customize-control-top_bar_bg_color',
                                                    '#customize-control-header_ticker_heading',
                                                    '#customize-control-ticker_color',
                                                    '#customize-control-ticker_color_bg_color',
        ) ),
    )
));

Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'breaking_news_settings',
        'label' => esc_html__('Breaking', 'newsxo'),
		'section'  => 'header_top_bar',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'brk_news_enable',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'header_top_bar',
        // 'transport' => 'postMessage',
        'default' => true, 
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'text', 
        'settings'  => 'breaking_news_title',
        'label' => esc_html__('Title', 'newsxo'),
		'section'  => 'header_top_bar',
        // 'transport' => 'postMessage',
        'default' => $newsxo_default['breaking_news_title'],
        'sanitize_callback' => 'sanitize_text_field',
	)
);

Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'date_settings',
        'label' => esc_html__('Date', 'newsxo'),
		'section'  => 'header_top_bar',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'header_date_enable',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'header_top_bar',
        'default' => true, 
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);

Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'time_settings',
        'label' => esc_html__('Time', 'newsxo'),
		'section'  => 'header_top_bar',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'header_time_enable',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'header_top_bar',
        'default' => true, 
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'newsxo_date_time_show_type',
        'label'    => esc_html__( 'Display Type:', 'newsxo' ),
		'section'  => 'header_top_bar',
        'default' => 'newsxo_default',
        'choices'  => array(
            'newsxo_default'          => esc_html__( 'Theme Default Setting', 'newsxo' ),
            'wordpress_date_setting' => esc_html__( 'From WordPress Setting', 'newsxo' ),
        ),
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
// STYLE
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'header_top_bar_heading',
        'label' => esc_html__('Top Bar', 'newsxo'),
		'section'  => 'header_top_bar',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'top_bar_color',
        'label' => esc_html__('Color', 'newsxo'),
		'section'  => 'header_top_bar',
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'top_bar_bg_color',
        'label' => esc_html__('Background Color', 'newsxo'),
		'section'  => 'header_top_bar',
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
// Header Image
Newsxo_Customizer_Control::add_section(
	'header_image',
    array(
        'title' => esc_html__( 'Header Image', 'newsxo' ),  
        'priority' => 1, 
        'panel' => 'header_option_panel',
    )
);
// Enable/Disable header image overlay color
Newsxo_Customizer_Control::add_field( 
    array(
        'type'     => 'checkbox', 
        'settings'  => 'remove_header_image_overlay',
        'label' => esc_html__('Remove Overlay Color', 'newsxo'),
        'section'  => 'header_image',
        'default' => false,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
    )
);
Newsxo_Customizer_Control::add_field( 
    array(
        'type'     => 'color-alpha', 
        'settings'  => 'newsxo_header_overlay_color',
        'label' => esc_html__('Background Color', 'newsxo'),
        'section'  => 'header_image',
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
        'active_callback'   => function( $setting ) {
            if ( $setting->manager->get_setting( 'remove_header_image_overlay' )->value() == false ) {
                return true;
            }
            return false;
        }
    )
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'header_image_height',
        'label' => esc_html__('Height', 'newsxo'),
		'section'  => 'header_image',
        'transport'         => 'postMessage',
        'media_query'   => true,
        'input_attr'    => array(
            'mobile'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 130,
            ),
            'tablet'  => array(
                'min'           => 0,
                'max'           => 400,
                'step'          => 1,
                'default_value' => 150,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 500,
                'step'          => 1,
                'default_value' => 200,
            ),
        ),
    ),
);

// Advertisement Section.
// Newsxo_Customizer_Control::add_section(
// 	'header_advert_section',
// 	array(
// 		'title' => esc_html__( 'Banner Advertisement', 'newsxo' ), 
//         'panel' => 'header_option_panel',
//         // 'priority' => 3,
// 	)
// );
// Setting banner_advertisement_section. 
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'cropped_image', 
        'settings'  => 'banner_ad_image',
        'label' => esc_html__('Banner Advertisement', 'newsxo'),
        'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'newsxo'), 930, 100),
        'section' => 'header_advert_section',
        'default' => $newsxo_default['banner_ad_image'],
        'width' => 930,
        'height' => 100,
        'flex_width' => true,
        'flex_height' => true,
        'sanitize_callback' => 'absint',
	)
);
/*banner_advertisement_section_url*/
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'text', 
        'settings'  => 'banner_ad_url',
        'label' => esc_html__('Link', 'newsxo'),
		'section'  => 'header_advert_section',
        'priority' => 15,
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'banner_open_on_new_tab',
        'label' => esc_html__('Open link in a new tab', 'newsxo'),
		'section'  => 'header_advert_section',
        'priority' => 16,
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);

// Header Rightbar
Newsxo_Customizer_Control::add_section(
	'header_rightbar',
	array(
		'title' => esc_html__( 'Menu', 'newsxo' ), 
        'panel' => 'header_option_panel',
        'priority' => 5,
	)
);
Newsxo_Customizer_Control::add_field(
    array(
        'type'     => 'hidden', 
        'settings'  => 'header_rightbar_settings',
        'label'     => esc_html__('Menu', 'newsxo'),
        'section'  => 'header_rightbar',
        'sanitize_callback' => 'newsxo_sanitize_text',
    )
);
// Hide/Show Menu Sidebar
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_menu_sidebar',
        'label' => esc_html__('Header Toggle Icon', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_menu_search',
        'label' => esc_html__('Search Icon', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_lite_dark_switcher',
        'label' => esc_html__('Dark/Light Icon', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
if( class_exists( 'WooCommerce' ) ) { 
    // Cart Icon Section Heading 
    Newsxo_Customizer_Control::add_field(
        array(
            'type'      => 'hidden', 
            'settings'  => 'shop_cart_btn_heading',
            'label'     => esc_html__('Shopping Cart', 'newsxo'),
            'section'   => 'header_rightbar',
        )
    );
    // Cart Hide/Show
    Newsxo_Customizer_Control::add_field( 
        array(
            'type'     => 'toggle', 
            'settings'  => 'newsxo_cart_enable',
            'label' => esc_html__('Hide/Show', 'newsxo'),
            'section'  => 'header_rightbar',
            'default' => true,
            'sanitize_callback' => 'newsxo_sanitize_checkbox',
        )
    );
}

// Subscribe Section Heading 
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden', 
        'settings'  => 'subscriber_btn_settings',
        'label'     => esc_html__('Subscribe', 'newsxo'),
		'section'   => 'header_rightbar',
	)
);
// Hide/Show Subscribe
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_menu_subscriber',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Subscribe Icon Layout
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'radio-image',
		'settings' => 'subsc_icon_layout',
        'label' => esc_html__('Icon', 'newsxo'),
		'section'  => 'header_rightbar',
		'default'  => 'bell',
        'choices'       => array(
            'bell' => get_template_directory_uri() . '/assets/images/subs1.png',
            'play'    => get_template_directory_uri() . '/assets/images/subs3.png', 
        ),
        'active_callback'   => 'newsxo_menu_subscriber_section_status',
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'text', 
        'settings'  => 'subs_news_title',
        'label' => esc_html__('Title', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => esc_html__('Subscribe','newsxo'),
        'sanitize_callback' => 'sanitize_text_field',
        'active_callback'   => 'newsxo_menu_subscriber_section_status',
	)
);
// Subscribe Link
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'text', 
        'settings'  => 'newsxo_subsc_link',
        'label' => esc_html__('Link', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
        'active_callback'   => 'newsxo_menu_subscriber_section_status',
	)
);
// Subscribe Open in New Tab
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'subsc_open_in_new',
        'label' => esc_html__('Open link in a new tab', 'newsxo'),
		'section'  => 'header_rightbar',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
        'active_callback'   => 'newsxo_menu_subscriber_section_status',
	)
);
// Sticky Header
Newsxo_Customizer_Control::add_section(
	'sticky_header',
	array(
		'title' => esc_html__( 'Sticky Header', 'newsxo' ), 
        'panel' => 'header_option_panel',
        'priority' => 6,
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'sticky_header_toggle',
        'label' => esc_html__('Sticky Header', 'newsxo'),
		'section'  => 'sticky_header',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);