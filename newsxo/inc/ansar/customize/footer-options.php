<?php /*** Footer Option Panel
 *
 * @package Newsxo
 */

$newsxo_default = newsxo_get_default_theme_options();

/**
 * Create a Radio-Image control
 * 
 * This class incorporates code from the Kirki Customizer Framework and from a tutorial
 * written by Otto Wood.
 * 
 * The Kirki Customizer Framework, Copyright Aristeides Stathopoulos (@aristath),
 * is licensed under the terms of the GNU GPL, Version 2 (or later).
 * 
 * @link https://github.com/reduxframework/kirki/
 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 */
     
/**
* Layout options section
*
* @package newsxo
*/
//Footer
Newsxo_Customizer_Control::add_panel(
	'themes_footer',
	array(
		'title' => esc_html__( 'Footer', 'newsxo' ), 
        'priority' => 24,
        'capability' => 'edit_theme_options',
	)
);
//You Missed seciton
Newsxo_Customizer_Control::add_section(
	'you_missed_section',
	array(
		'title' => esc_html__( 'You Missed', 'newsxo' ),  
        'priority' => 24,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_footer',
	)
);
// you missed heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_you_missed_settings',
        'label' => esc_html__('You Missed', 'newsxo'),
		'section'  => 'you_missed_section',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
// you missed toggle
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'you_missed_enable',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'you_missed_section',
        'default' => $newsxo_default['you_missed_enable'], 
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// you missed title
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'text', 
        'settings'  => 'you_missed_title',
        'label' => esc_html__('Title', 'newsxo'),
		'section'  => 'you_missed_section',
		'transport'  => 'postMessage',
        'default' => $newsxo_default['you_missed_title'],
        'sanitize_callback' => 'sanitize_text_field',
	)
);
// Add Footer Option Section
Newsxo_Customizer_Control::add_section(
	'footer_options',
	array(
		'title' => esc_html__( 'Footer', 'newsxo' ),  
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_footer',
	)
);
//Footer logo Section 
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden',
        'settings'  => 'footer_logo_title',
        'label' => esc_html__('Logo', 'newsxo'),
		'section'  => 'footer_options',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
//Footer Custom logo width 
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'newsxo_footer_main_logo_width',
        'label' => esc_html__('Width', 'newsxo'),
		'section'  => 'footer_options', 
        'transport'   => 'postMessage',
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
                'max'           => 300,
                'step'          => 1,
                'default_value' => 170,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 210,
            ),
        ),
    ),
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-range', 
        'settings'  => 'newsxo_footer_main_logo_height',
        'label' => esc_html__('Height', 'newsxo'),
		'section'  => 'footer_options', 
        'transport'   => 'postMessage',
        'media_query'   => true,
        'input_attr'    => array(
            'mobile'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 40,
            ),
            'tablet'  => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 50,
            ),
            'desktop' => array(
                'min'           => 0,
                'max'           => 300,
                'step'          => 1,
                'default_value' => 70,
            ),
        ),
    ),
);
//Footer Content
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden',
        'settings'  => 'footer_content_title',
        'label' => esc_html__('Content', 'newsxo'),
		'section'  => 'footer_options',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
//Footer Background image
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'cropped_image', 
        'settings'  => 'newsxo_footer_bg_img',
        'label' => esc_html__('Background Image', 'newsxo'),
        'section'  => 'footer_options',
        'transport'  => 'postMessage',
        'default' => $newsxo_default['newsxo_footer_bg_img'], 
        'flex_width' => true,
        'flex_height' => true,
        'width' => 1600,
        'height' => 700,
	)
);
//Background Overlay
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'newsxo_footer_overlay_color',
        'label' => esc_html__('Overlay Color', 'newsxo'),
		'section'  => 'footer_options',
		'transport'  => 'postMessage', 
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
//Text Color 
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'newsxo_footer_text_color',
        'label' => esc_html__('Text Color', 'newsxo'),
		'section'  => 'footer_options',
		'transport'  => 'postMessage', 
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
// footer column layout
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'newsxo_footer_column_layout',
        'transport'   => 'postMessage',
        'label' => esc_html__('Select Column Layout', 'newsxo'),
		'section'  => 'footer_options', 
        'default' => '3',
        'is_text' => true, 
        'choices'   => array(
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
//Footer Copyright Section
Newsxo_Customizer_Control::add_section(
	'footer_copyright',
	array(
		'title' => esc_html__( 'Copyright', 'newsxo' ),  
        'priority' => 27,
        'capability' => 'edit_theme_options',
        'panel' => 'themes_footer',
	)
);
//Enable and disable copyright
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'hide_copyright',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'footer_copyright',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
); 
// Copyright Text
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'textarea', 
        'settings'  => 'newsxo_footer_copyright',
        'label' => esc_html__('Copyright', 'newsxo'),
		'section'  => 'footer_copyright',    
        'default' => $newsxo_default['newsxo_footer_copyright'],
        'sanitize_callback' => 'wp_kses_post',
	)
);
// Copyright bg color 
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'newsxo_footer_copy_bg',
        'label' => esc_html__('Background Color', 'newsxo'),
		'section'  => 'footer_copyright',
        'default' => $newsxo_default['newsxo_footer_copy_bg'],
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
// Copyright text color
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'newsxo_footer_copy_text',
        'label' => esc_html__('Text Color', 'newsxo'),
		'section'  => 'footer_copyright',
        'default' => $newsxo_default['newsxo_footer_copy_text'],
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);