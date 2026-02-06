<?php
/**
 * Newsxo Theme Setup Class.
 *
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Newsxo_Theme_Setup' ) ) :

	/**
	 * Newsxo Options Class.
	 */
	class Newsxo_Theme_Setup {

		/**
		 * Singleton instance of the class.
		 *
		 * @since 1.0.0
		 * @var object
		 */
		private static $instance;

		/**
		 * Main Newsxo_Theme_Setup Instance.
		 *
		 * @since 1.0.0
		 * @return Newsxo_Theme_Setup
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Newsxo_Theme_Setup ) ) {
				self::$instance = new Newsxo_Theme_Setup();
			}
			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Add theme supports.
			add_action('after_setup_theme', array( $this, 'setup' ), 10 );

			// Replace Custom Logo class
			add_filter('get_custom_logo' ,array( $this, 'newsxo_logo_class' ));

			// Content width.
			add_action('after_setup_theme', array( $this, 'content_width' ) );

			//Register widget areas
			add_action('widgets_init' ,array( $this, 'newsxo_widgets_init' ) );

			//Editor Styling 
			add_editor_style( array( 'css/editor-style.css') );
			
			//custom background
			add_action('wp_head', array( $this, 'newsxo_custom_background' ) ,10 ,0);
			
			// Theme Customizer Script
			add_action('customize_controls_enqueue_scripts', array( $this, 'newsxo_customizer_script' )  );

			// Enqueue User Custom styles
			add_action( 'wp_enqueue_scripts', array( $this, 'newsxo_range_style' )  );

		}

		public function newsxo_logo_class($html){
			$html = str_replace('custom-logo-link', 'navbar-brand', $html);
			return $html;
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.0
		 */
		public function setup() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on newsxo, use a find and replace
			 * to change 'newsxo' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'newsxo', NEWSXO_THEME_DIR . '/languages' );
		
			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
		
			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );
		
			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );
		
			// Add featured image sizes
				add_image_size('newsxo-slider-full', 1280, 720, true); // width, height, crop
				add_image_size('newsxo-featured', 1024, 0, false ); // width, height, crop
				add_image_size('newsxo-medium', 720, 380, true); // width, height, crop
		
			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary' => __( 'Primary Menu', 'newsxo' ),
				'footer' => __( 'Footer Menu', 'newsxo' ),
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
		
			$args = array(
			'default-color' => '#eee',
			'default-image' => '',
			);
			add_theme_support( 'custom-background', $args );
		
			// Set up the woocommerce feature.
			add_theme_support( 'woocommerce');
		
			// Woocommerce Gallery Support
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		
			// Added theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );
			
			/* Add theme support for gutenberg block */
			add_theme_support( 'align-wide' );
			
			/* Add theme support for responsive embeds */
			add_theme_support( 'responsive-embeds' );
		
			add_theme_support('custom-spacing');
			add_theme_support('appearance-tools');
			add_theme_support('custom-units');
			add_theme_support('custom-line-height');
			add_theme_support('border');
			add_theme_support( 'link-color' );
			
			//Custom logo
			add_theme_support( 'custom-logo');

			//Block Style
			add_theme_support( 'wp-block-styles');
			
			// custom header Support
			$args = array(
				'default-image'		=> '',
				'width'			=> '1600',
				'height'		=> '600',
				'flex-height'		=> false,
				'flex-width'		=> false,
				'header-text'		=> true,
				'default-text-color'	=> '000',
				'wp-head-callback'       => 'newsxo_header_color',
			);
			add_theme_support( 'custom-header', $args );
		
			/*
			 * Enable support for Post Formats on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/post-formats/
			 */
			add_theme_support( 'post-formats', array( 'image', 'video', 'gallery', 'audio' ) );
			
		
		}

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		public function content_width() {
			$GLOBALS['content_width'] = apply_filters( 'newsxo_content_width', 640 );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function newsxo_widgets_init() {
			
			$newsxo_footer_column_layout = esc_attr(get_theme_mod('newsxo_footer_column_layout',3));
			
			$newsxo_footer_column_layout = 12 / $newsxo_footer_column_layout;
		
			register_sidebar( array(
				'name'          => esc_html__( 'Header Toggle Sidebar', 'newsxo' ),
				'id'            => 'menu-sidebar-content',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="bs-widget-title one"><h2 class="title"><span><i class="fas fa-arrow-right"></i></span>',
				'after_title'   => '</h2><div class="border-line"></div></div>',
			) );
			
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar Widget Area', 'newsxo' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="bs-widget-title one"><h2 class="title"><span><i class="fas fa-arrow-right"></i></span>',
				'after_title'   => '</h2><div class="border-line"></div></div>',
			) );
		
			register_sidebar( array(
				'name'          => esc_html__( 'Frontpage Left Content', 'newsxo'),
				'id'            => 'front-page-left',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="bs-widget-title one"><h2 class="title"><span><i class="fas fa-arrow-right"></i></span>',
				'after_title'   => '</h2><div class="border-line"></div></div>',
			) );
		
			register_sidebar( array(
				'name'          => esc_html__( 'Frontpage Content', 'newsxo'),
				'id'            => 'front-page-content',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="bs-widget-title one"><h2 class="title"><span><i class="fas fa-arrow-right"></i></span>',
				'after_title'   => '</h2><div class="border-line"></div></div>',
			) );
		
			register_sidebar( array(
				'name'          => esc_html__( 'Frontpage Right Content', 'newsxo'),
				'id'            => 'front-page-right',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="bs-widget-title one"><h2 class="title"><span><i class="fas fa-arrow-right"></i></span>',
				'after_title'   => '</h2><div class="border-line"></div></div>',
			) );
			
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Widget Area', 'newsxo' ),
				'id'            => 'footer_widget_area',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="col-lg-'.$newsxo_footer_column_layout.' col-sm-6 rotateInDownLeft animated bs-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="bs-widget-title one"><h2 class="title"><span><i class="fas fa-arrow-right"></i></span>',
				'after_title'   => '</h2><div class="border-line"></div></div>',
			) );
		
		}

		/*-----------------------------------------------------------------------------------*/
		/*  custom background
		/*-----------------------------------------------------------------------------------*/

		public function newsxo_custom_background(){
			$page_bg_image_url = get_theme_mod('newsxo_default_bg_image','');
			if($page_bg_image_url!=''){
				echo '<style>body{ background-image:url("'.get_template_directory_uri().'/assets/images/bg-pattern/'.$page_bg_image_url.'");}</style>';
			}
		}

		// Theme Customizer Script
		public function newsxo_customizer_script() {
			wp_enqueue_script( 'customizer-script', get_template_directory_uri() . '/inc/ansar/customize/js/customizer.js', array( 'jquery', 'customize-controls' ), '', true );
		}

		// Enqueue User Custom styles
		public function newsxo_range_style() {
	
			$newsxo_range_output = '';
			
			$newsxo_range_output   .= newsxo_customizer_value( 'site_title_font_size', '.site-branding-text .site-title a', array( 'font-size' ), array( 40, 35, 30 ), 'px' );
			$newsxo_range_output   .= newsxo_customizer_value( 'side_main_logo_width', '.site-logo a.navbar-brand img', array( 'width' ), array( 250, 200, 150 ), 'px' );
			
			$newsxo_range_output   .= newsxo_customizer_value( 'header_image_height', '.header-image-section .overlay', array( 'height' ), array( 200, 150, 130 ), 'px' );
			
			$newsxo_range_output   .= newsxo_customizer_value( 'newsxo_slider_title_font_size', '.bs-slide .inner .title', array( 'font-size' ), array( 38, 32, 24 ), 'px !important' );
			$newsxo_range_output   .= newsxo_customizer_value( 'newsxo_tren_edit_title_font_size', '.multi-post-widget .bs-blog-post.three.bsm .title', array( 'font-size' ), array( 22, 20, 16 ), 'px !important' );
			$newsxo_range_output   .= newsxo_customizer_value( 'newsxo_footer_main_logo_width', 'footer .bs-footer-bottom-area .custom-logo, footer .bs-footer-copyright .custom-logo', array( 'width' ), array( 210, 170, 130 ), 'px' );
			$newsxo_range_output   .= newsxo_customizer_value( 'newsxo_footer_main_logo_height', 'footer .bs-footer-bottom-area .custom-logo, footer .bs-footer-copyright .custom-logo', array( 'height' ), array( 70, 50, 40 ), 'px' );
			
			wp_add_inline_style( 'newsxo-style', $newsxo_range_output );
		}
	}

endif;

/**
 * The function which returns the one Newsxo_Options instance.
 *
 * @since 1.0.0
 * @return object
 */
function newsxo_theme_setup() {
	return Newsxo_Theme_Setup::instance();
}

newsxo_theme_setup();
