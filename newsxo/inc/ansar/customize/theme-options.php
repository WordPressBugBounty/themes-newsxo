<?php /*** Option Panel
 *
 * @package Newsxo
 */

$newsxo_default = newsxo_get_default_theme_options();
/**
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
//========== Add General Options Panel. ===============
Newsxo_Customizer_Control::add_panel(
	'theme_option_panel',
	array(
		'title' => esc_html__('Theme Options', 'newsxo'),
        'priority' => 7,
        'capability' => 'edit_theme_options',
	)
);
//Breadcrumb Settings
Newsxo_Customizer_Control::add_section(
	'newsxo_breadcrumb_settings',
	array(
		'title' => esc_html__( 'Breadcrumb', 'newsxo' ),
        'panel' => 'theme_option_panel',
        'capability' => 'edit_theme_options',
	)
);

// Hide/Show
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'breadcrumb_settings',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'newsxo_breadcrumb_settings',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//Type Of Bredcrumb 
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'newsxo_site_breadcrumb_type',
        'label' => esc_html__('Breadcrumb Type', 'newsxo'),
		'section'  => 'newsxo_breadcrumb_settings',
        'default' => 'default',
        'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb NavXT, Yoast SEO and Rank Math SEO', 'newsxo' ),
        'choices'   => array(
            'default' => __( 'Default', 'newsxo' ),
            'navxt'  => __( 'NavXT', 'newsxo' ),
            'yoast'  => __( 'Yoast SEO', 'newsxo' ),
            'rankmath'  => __( 'Rank Math', 'newsxo' )
        ),
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
// Social Icon Setting
Newsxo_Customizer_Control::add_section(
	'social_icon_options',
	array(
		'title' => esc_html__( 'Social Icons', 'newsxo' ), 
        'panel' => 'theme_option_panel',
        'capability' => 'edit_theme_options',
	)
);
//Enable and disable social icon
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'social_icon_header_enable',
        'label' => esc_html__('Hide/Show on Header', 'newsxo'),
		'section'  => 'social_icon_options',
        'priority' => 103,
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//Enable and disable social icon
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'footer_social_icon_enable',
        'label' => esc_html__('Hide/Show on Footer', 'newsxo'),
		'section'  => 'social_icon_options',
        'priority' => 103,
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Social Icon Repaeter
$wp_customize->add_setting(
    'newsxo_social_icons',
    array(
        'default'           => newsxo_get_social_icon_default(),
        'sanitize_callback' => 'newsxo_repeater_sanitize'
    )
);
$wp_customize->add_control(
    new Newsxo_Repeater_Control(
        $wp_customize,
        'newsxo_social_icons',
        array(
            'label'                            => esc_html__( 'Social Icons', 'newsxo' ),
            'section'                          => 'social_icon_options',
            'priority'                         =>  104,
            'add_field_label'                  => esc_html__( 'Add New Social', 'newsxo' ),
            'item_name'                        => esc_html__( 'Social', 'newsxo' ),
            'customizer_repeater_icon_control' => true,
            'customizer_repeater_link_control' => true,
            'customizer_repeater_checkbox_control' => true,
        )
    )
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'pro-text', 
        'settings'  => 'footer_social_icon_pro',
		'section'  => 'social_icon_options',
        'priority' => 153,
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Post Image Section
Newsxo_Customizer_Control::add_section(
	'post_image_options',
	array(
		'title' => esc_html__( 'Post Image', 'newsxo' ), 
        'panel' => 'theme_option_panel',
        'capability' => 'edit_theme_options',
	)
);

// Post Image Type
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'post_image_height_type',
        'label' => esc_html__('Post Image display type:', 'newsxo'),
		'section'  => 'post_image_options',
        'default' => 'newsxo_post_img_hei',
        'choices'   => array(
            'newsxo_post_img_hei' => esc_html__( 'Fix Height Post Image', 'newsxo' ),
            'newsxo_post_img_acc' => esc_html__( 'Auto Height Post Image', 'newsxo' ),
        ),
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
//404 Page Section
Newsxo_Customizer_Control::add_section(
	'404_options',
	array(
		'title' => esc_html__( '404 Page', 'newsxo' ), 
        'panel' => 'theme_option_panel',
        'capability' => 'edit_theme_options',
	)
);
// 404 page title
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'text', 
        'settings'  => 'newsxo_404_title',
        'label' => esc_html__('Title', 'newsxo'),
        'default' => esc_html__('Oops! Page not found','newsxo'),
		'section'  => '404_options',
        'sanitize_callback' => 'sanitize_text_field',
	)
);
// 404 page desc
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'textarea', 
        'settings'  => 'newsxo_404_desc',
        'label' => esc_html__('Description', 'newsxo'),
        'default' => esc_html__('We are sorry, but the page you are looking for does not exist.','newsxo'),
		'section'  => '404_options',
        'sanitize_callback' => 'sanitize_text_field',
	)
);
// 404 page btn title
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'text', 
        'settings'  => 'newsxo_404_btn_title',
        'label' => esc_html__('Button Title', 'newsxo'),
        'default' => esc_html__('Go Back','newsxo'),
		'section'  => '404_options',
        'sanitize_callback' => 'sanitize_text_field',
	)
);
// Blog Page Section.
Newsxo_Customizer_Control::add_section(
	'site_post_date_author_settings',
	array(
		'title' => esc_html__( 'Blog Page', 'newsxo' ), 
        'panel' => 'theme_option_panel',
        'capability' => 'edit_theme_options',
	)
);
// blog Page heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_blog_page_heading',
        'label' => esc_html__('Blog Post', 'newsxo'),
		'section'  => 'site_post_date_author_settings',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);                                            
// Settings = Drop Caps
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_drop_caps_enable',
        'label' => esc_html__('Drop Caps (First Big Letter)', 'newsxo'),
		'section'  => 'site_post_date_author_settings',
        'default' => false,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);

// blog Page category
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_post_category',
        'label' => esc_html__('Category', 'newsxo'),
		'section'  => 'site_post_date_author_settings',
        'default' => $newsxo_default['newsxo_post_category'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// blog Page meta
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_post_meta',
        'label' => esc_html__('Post Meta', 'newsxo'),
		'section'  => 'site_post_date_author_settings',
        'default' => $newsxo_default['newsxo_enable_post_meta'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden', 
        'settings'  => 'newsxo_post_meta_heading',
        'label' => esc_html__('Post Meta', 'newsxo'),
		'section'   => 'site_post_date_author_settings',
	)
);        
// Blog Post Meta
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-sortable', 
        'settings'  => 'newsxo_blog_post_meta',
		'section'  => 'site_post_date_author_settings',
        'default'    => array(
            'author',
            'date',
        ),
        'choices'    => array(
            'author'      => esc_attr__( 'Author', 'newsxo' ),
            'date'        => esc_attr__( 'Date', 'newsxo' ),
            'comments'    => esc_attr__( 'Comments', 'newsxo' ),
        ),
        // 'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden', 
        'settings'  => 'newsxo_blog_content_settings',
        'label' => esc_html__('Choose Content Option', 'newsxo'),
		'section'   => 'site_post_date_author_settings',
	)
); 
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'radio', 
        'settings'  => 'newsxo_blog_content',
        'default'  => $newsxo_default['newsxo_blog_content'],
		'section'  => 'site_post_date_author_settings',
        'choices'   =>  array(
            'excerpt'   => __('Excerpt', 'newsxo'),
            'content'   => __('Full Content', 'newsxo'),
        ),
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden',
        'settings'  => 'newsxo_post_pagination_heading',
        'label' => esc_html__('Pagination', 'newsxo'),
		'section'   => 'site_post_date_author_settings',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'newsxo_post_blog_pagination',
		'section'  => 'site_post_date_author_settings',
        'default' => 'number',
        'choices'   => array(
            'next_prev'   => __('Next-Prev', 'newsxo'),
            'number'   => __('Numbers', 'newsxo'),
        ),
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
//========== single posts options ===============
// Single Section.
Newsxo_Customizer_Control::add_section(
	'site_single_posts_settings',
	array(
		'title' => esc_html__( 'Single Page', 'newsxo' ), 
        'panel' => 'theme_option_panel',
	)
);
// Single Page heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_single_page_heading',
        'label' => esc_html__('Single Post', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
// Single Page category
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_single_post_category',
        'label' => esc_html__('Category', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_single_post_category'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Single Page meta
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_single_post_meta',
        'label' => esc_html__('Post Meta', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_single_post_meta'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Single Page meta
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_single_post_image',
        'label' => esc_html__('Featured Image', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_single_post_image'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Single Page social icon
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_blog_post_icon_enable',
        'label' => esc_html__('Hide/Show Sharing Icons', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
// Single Page Post Meta Heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden',
        'settings'  => 'single_post_meta_heading',
        'label' => esc_html__('Post Meta', 'newsxo'),
		'section'   => 'site_single_posts_settings',
	)
);
// Single Page Post Meta
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'newsxo-sortable', 
        'settings'  => 'single_post_meta',
		'section'  => 'site_single_posts_settings',
        'default'    => array(
            'author',
            'date',
            'comments',
            'tags',
        ),
        'choices'    => array(
            'author'      => esc_attr__( 'Author', 'newsxo' ),
            'date'        => esc_attr__( 'Date', 'newsxo' ),
            'comments'    => esc_attr__( 'Comments', 'newsxo' ),
            'tags'        => esc_attr__( 'Tags', 'newsxo' ),
        ),
        'unsortable' => array(''),
	)
);
// Single Page Author
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden',
        'settings'  => 'newsxo_single_post_author_heading',
        'label' => esc_html__('Author', 'newsxo'),
		'section'   => 'site_single_posts_settings',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_single_admin',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_enable_single_admin'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//Related Posts haeding
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden',
        'settings'  => 'newsxo_single_related_post_heading',
        'label' => esc_html__('Related Posts', 'newsxo'),
		'section'   => 'site_single_posts_settings',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_single_related',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_enable_single_related'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//Related Post title
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'text', 
        'settings'  => 'newsxo_related_post_title',
        'label' => esc_html__('Title', 'newsxo'),
        'default' => esc_html__('Related Posts', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'transport'=> 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
	)
);
//Related Post category
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_single_related_category',
        'label' => esc_html__('Category', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_enable_single_related_category'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//Related Post admin
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_single_related_admin',
        'label' => esc_html__('Author Details', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_enable_single_related_admin'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
); 
//Related Post date
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_single_related_date',
        'label' => esc_html__('Date', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_enable_single_related_date'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'      => 'hidden',
        'settings'  => 'newsxo_single_post_element_heading',
        'label' => esc_html__('Post Comments', 'newsxo'),
		'section'   => 'site_single_posts_settings',
	)
);
//Related Post comment
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_enable_single_comments',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'site_single_posts_settings',
        'default' => $newsxo_default['newsxo_enable_single_comments'],
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//========== Add Sidebar Option Panel. ===============     
// Sticky Sidebar
Newsxo_Customizer_Control::add_section(
	'sticky_sidebar',
	array(
		'title' => esc_html__( 'Sticky Sidebar', 'newsxo' ), 
        'capability' => 'edit_theme_options', 
        'priority' => 9, 
        'panel' => 'theme_option_panel',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'sticky_sidebar_toggle',
        'label' => esc_html__('Sticky Sidebar', 'newsxo'),
		'section'  => 'sticky_sidebar',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
//========== Add Theme colors Panel. ===============
Newsxo_Customizer_Control::add_panel(
	'Theme_colors_panel',
	array(
        'title' => esc_html__('Theme Colors', 'newsxo'),
        'priority' => 10,
        'capability' => 'edit_theme_options',
	)
);       
//Add Category Color Section 
Newsxo_Customizer_Control::add_section(
	'newsxo_cat_color_setting',
	array(
		'title' => esc_html__( 'Category Color', 'newsxo' ), 
        'panel' => 'Theme_colors_panel',
	)
);
$newsxoAllCats = get_categories();
if( $newsxoAllCats ) :
    foreach( $newsxoAllCats as $singleCat ) :
        // category colors control
        Newsxo_Customizer_Control::add_field( 
            array(
                'type'     => 'color', 
                'settings'  => 'category_' .absint($singleCat->term_id). '_color',
                'label' => $singleCat->name,
                'section'  => 'newsxo_cat_color_setting',
                'default' => '',
                'sanitize_callback' => 'newsxo_sanitize_alpha_color',
            )
        );
    endforeach;
endif;
//Add Site Title & Tagline Color Section
Newsxo_Customizer_Control::add_section(
	'newsxo_site_title_color_section',
	array(
		'title' => esc_html__( 'Site Title & Tagline', 'newsxo' ), 
        'panel' => 'Theme_colors_panel',
	)
);
// Site Title & Tagline Color Heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'site_title_tagline_title',
        'label' => esc_html__('Site Title & Tagline', 'newsxo'),
		'section'  => 'newsxo_site_title_color_section',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
$wp_customize->remove_control( 'header_textcolor');
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'header_text_color',
        'label' => esc_html__('Color', 'newsxo'),
		'section'  => 'newsxo_site_title_color_section',
        'default' => '#000',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);

Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'header_text_color_on_hover',
        'label' => esc_html__('Hover Color', 'newsxo'),
		'section'  => 'newsxo_site_title_color_section',
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'header_text_dark_color',
        'label' => esc_html__('Color (Dark Layout)', 'newsxo'),
		'section'  => 'newsxo_site_title_color_section',
        'default' => '#fff',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'color-alpha', 
        'settings'  => 'header_text_dark_color_on_hover',
        'label' => esc_html__('Hover Color (Dark Layout)', 'newsxo'),
		'section'  => 'newsxo_site_title_color_section',
        'default' => '',
        'sanitize_callback' => 'newsxo_sanitize_alpha_color',
	)
);
//Add Theme Mode Section
Newsxo_Customizer_Control::add_section(
	'newsxo_skin_section',
	array(
		'title' => esc_html__( 'Theme Mode', 'newsxo' ), 
        'panel' => 'Theme_colors_panel',
        'priority' => 10,
	)
);
// Theme Mode Heading
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_skin_mode_title',
        'label' => esc_html__('Theme Mode', 'newsxo'),
		'section'  => 'newsxo_skin_section',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'radio-image', 
        'settings'  => 'newsxo_skin_mode',
		'section'  => 'newsxo_skin_section',
        'default' => 'defaultcolor',
        'choices'   => array(
            'defaultcolor'    => get_template_directory_uri() . '/assets/images/color/white.png',
            'dark' => get_template_directory_uri() . '/assets/images/color/black.png',
        ),
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);

//Scroller Section
Newsxo_Customizer_Control::add_section(
	'scroller_options',
	array(
		'title' => esc_html__( 'Scroller', 'newsxo' ), 
        'panel' => 'theme_option_panel',
        'capability' => 'edit_theme_options',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_scroll_to_top_settings',
        'label' => esc_html__('Scroll To Top', 'newsxo'),
		'section'  => 'scroller_options',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'newsxo_scrollup_enable',
        'label' => esc_html__('Hide/Show', 'newsxo'),
		'section'  => 'scroller_options',
        'default' => true,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'radio-image', 
        'settings'  => 'scrollup_layout',
		'section'  => 'scroller_options',
        'default' => 'fa-arrow-up',
        'choices'   => array(
            'fa-angle-up' => get_template_directory_uri() . '/assets/images/fu1.png',
            'fa-angles-up'    => get_template_directory_uri() . '/assets/images/fu2.png',
            'fa-arrow-up'    => get_template_directory_uri() . '/assets/images/fu3.png',
            'fa-up-long'    => get_template_directory_uri() . '/assets/images/fu4.png',
        ),
        'sanitize_callback' => 'newsxo_sanitize_radio',
	)
);
$font_family = array('Inter'=> 'Inter', 'Open Sans'=>'Open Sans', 'Kalam'=>'Kalam', 
'Rokkitt'=>'Rokkitt', 'Jost' => 'Jost', 'Poppins' => 'Poppins', 'Lato' => 'Lato', 'Noto Serif'=>'Noto Serif', 
'Raleway'=>'Raleway', 'Roboto' => 'Roboto');

$font_weight = array('300'=>'300 (Light)','400'=>'400 (Normal)','500'=>'500 (Medium)' ,'600'=>'600 (Semi Bold)',
'700'=>'700 (Bold)','800'=>'800 (Extra Bold)','900'=>'900 (Black)');

Newsxo_Customizer_Control::add_section(
	'newsxo_general_typography',
	array(
		'title' => esc_html__( 'Typography', 'newsxo' ),  
        'priority' => 20,
        'capability' => 'edit_theme_options',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'toggle', 
        'settings'  => 'enable_newsxo_typo',
        'label' => esc_html__('Typography', 'newsxo'),
		'section'  => 'newsxo_general_typography',
        'default' => false,
        'sanitize_callback' => 'newsxo_sanitize_checkbox',
	)
);
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'heading_typo_title',
        'label' => esc_html__('Heading', 'newsxo'),
		'section'  => 'newsxo_general_typography', 
        'sanitize_callback' => 'newsxo_sanitize_text',  
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'heading_fontfamily',
        'label' => esc_html__('Font Family', 'newsxo'),
		'section'  => 'newsxo_general_typography',
        'default' => $newsxo_default['heading_fontfamily'],
        'choices'   => $font_family ,
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'heading_fontweight',
        'label' => esc_html__('Font Weight', 'newsxo'),
		'section'  => 'newsxo_general_typography',
        'default' => $newsxo_default['heading_fontweight'],
        'choices'   => $font_weight ,
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);

// Menu Typo
Newsxo_Customizer_Control::add_field(
	array(
		'type'     => 'hidden', 
        'settings'  => 'newsxo_menu_font',
        'label' => esc_html__('Menu Font', 'newsxo'),
		'section'  => 'newsxo_general_typography',
        'sanitize_callback' => 'newsxo_sanitize_text',
	)
);
Newsxo_Customizer_Control::add_field( 
	array(
		'type'     => 'select', 
        'settings'  => 'newsxo_menu_fontfamily',
        'label' => esc_html__('Font Family', 'newsxo'),
		'section'  => 'newsxo_general_typography',
        'default' => $newsxo_default['newsxo_menu_fontfamily'],
        'choices'   => $font_family ,
        'sanitize_callback' => 'newsxo_sanitize_select',
	)
);

// if ( ! function_exists( 'newsxo_sanitize_select' ) ) :
//     /**
//      * Sanitize select.
//      *
//      * @since 1.0.0
//      *
//      * @param mixed                $input The value to sanitize.
//      * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
//      * @return mixed Sanitized value.
//      */
//     function newsxo_sanitize_select( $input, $setting ) {

//         // Ensure input is a slug.
//         $input = sanitize_key( $input );

//         // Get list of choices from the control associated with the setting.
//         $choices = $setting->manager->get_control( $setting->id )->choices;

//         // If the input is a valid key, return it; otherwise, return the default.
//         return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

//     }

// endif;

function newsxo_template_page_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

}

function newsxo_header_info_sanitize_text( $input ) {
                    
    return wp_kses_post( force_balance_tags( $input ) );

}
    
if ( ! function_exists( 'newsxo_sanitize_text_content' ) ) :
    /**
     * Sanitize text content.
     *
     * @since 1.0.0
     *
     * @param string               $input Content to be sanitized.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return string Sanitized content.
     */
    function newsxo_sanitize_text_content( $input, $setting ) {

        return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

    }
endif;
    
function newsxo_header_sanitize_checkbox( $input ) {
    // Boolean check 
    return ( ( isset( $input ) && true == $input ) ? true : false );
        
}
