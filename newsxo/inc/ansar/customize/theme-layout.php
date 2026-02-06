<?php /*** Option Panel
*
* @package newsxo
*/
$newsxo_default = newsxo_get_default_theme_options();
/*theme option panel info*/

//Theme Layout
Newsxo_Customizer_Control::add_panel(
	'themes_layout',
	array(
		'title' => esc_html__( 'Theme Layout', 'newsxo' ), 
        'priority' => 12,
        'capability' => 'edit_theme_options',
	)
);
//Sidebar Layout
Newsxo_Customizer_Control::add_section(
	'newsxo_theme_sidebar_setting',
	array(
		'title' => esc_html__( 'Sidebar', 'newsxo' ), 
        'priority' => 11,
        'panel' => 'themes_layout',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_archive_sidebar_width_heading',
        'label' => esc_html__('Archive Pages', 'newsxo'),
		'section'  => 'newsxo_theme_sidebar_setting',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
// Sidebar Width 
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'number', 
        'settings'  => 'newsxo_archive_page_sidebar_width',
        'label' => esc_html__('Sidebar Width', 'newsxo'),
		'section'  => 'newsxo_theme_sidebar_setting',
        'sanitize_callback' => 'absint',
        'default' => '33',
        'input_attrs' => array(
            'min' => 10,
            'max' => 90,
            'step' => 1,
        )
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'radio-image', 
        'settings'  => 'newsxo_archive_page_layout',
		'section'  => 'newsxo_theme_sidebar_setting',
        'transport'         => 'postMessage',
        'default' => $newsxo_default['newsxo_archive_page_layout'],
        'choices'   => array(
            'align-content-left' => get_template_directory_uri() . '/assets/images/left-sidebar.png',  
            'full-width-content'    => get_template_directory_uri() . '/assets/images/full-content.png',
            'align-content-right'    => get_template_directory_uri() . '/assets/images/right-sidebar.png',
        ),
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings' => 'newsxo_pro_single_page_heading',
        'label' => esc_html__('Single Page', 'newsxo'),
		'section'  => 'newsxo_theme_sidebar_setting',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'radio-image', 
        'settings'  => 'newsxo_single_page_layout',
		'section'  => 'newsxo_theme_sidebar_setting',
        'transport'         => 'postMessage',
        'default' => 'single-align-content-right',
        'choices'   => array(
            'single-align-content-left' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
            'single-full-width-content'    => get_template_directory_uri() . '/assets/images/full-content.png',
            'single-align-content-right'    => get_template_directory_uri() . '/assets/images/right-sidebar.png',
        ),
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden',
        'settings' => 'newsxo_page_heading',
        'label' => esc_html__('Pages', 'newsxo'),
		'section'  => 'newsxo_theme_sidebar_setting',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'radio-image', 
        'settings'  => 'newsxo_page_layout',
		'section'  => 'newsxo_theme_sidebar_setting',
		'transport'  => 'postMessage',
        'default' => 'page-align-content-right',
        'choices'   => array(
            'page-align-content-left' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
            'page-full-width-content'    => get_template_directory_uri() . '/assets/images/full-content.png',
            'page-align-content-right'    => get_template_directory_uri() . '/assets/images/right-sidebar.png',
        ),
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);
// Blog Layout Setting
Newsxo_Customizer_Control::add_section(
	'blog_layout_section',
	array(
		'title' => esc_html__( 'Blog', 'newsxo' ),
        'capability' => 'edit_theme_options',
        'panel' => 'themes_layout',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings' => 'blog_layout_title_settings',
        'label' => esc_html__('Blog', 'newsxo'),
		'section'  => 'blog_layout_section',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'radio-image', 
        'settings'  => 'blog_post_layout',
		'section'  => 'blog_layout_section',
        'default' => 'list-layout',
        'choices'   => array(
            'list-layout' => get_template_directory_uri() . '/assets/images/blog/list-layout.png',
            'grid-layout'    => get_template_directory_uri() . '/assets/images/blog/grid-layout.png',
        ),
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);