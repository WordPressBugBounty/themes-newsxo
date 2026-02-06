<?php
/*** Customizer Core Panel
 *
 * @package Newsxo
 */

$newsxo_default = newsxo_get_default_theme_options();
// Adding customizer home page setting

// Add Background Settings Section
Newsxo_Customizer_Control::add_section(
    'background_image',
    array(
        'title' => esc_html__('Background Settings', 'newsxo'),
        'priority' => 35,
        'capability' => 'edit_theme_options',
	)
);
// Background Color Heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'body_bg_color_heading',
        'label' => esc_html__('Background Color', 'newsxo'),
        'section' => 'colors',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
$wp_customize->remove_control('background_color');
//Theme Background Color
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'body_background_color',
        'label' => esc_html__('Background Color', 'newsxo'),
		'section'  => 'colors',
        'default' => $newsxo_default['body_background_color'],
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);