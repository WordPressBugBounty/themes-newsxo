<?php
/**
 * Theme functions and definitions.
 * 
 * Main Newsxo class.
 *
 */
final class Newsxo {

	public $options;

	public $fonts;

	public $icons;

	public $customizer;

	public $admin;

	private static $instance;

	public $version = '0.2';

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Newsxo ) ) {
			self::$instance = new Newsxo();
			self::$instance->constants();
			self::$instance->includes();
		}
		return self::$instance;
	}

	/**
	 * Setup constants.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private function constants() {
		// Theme version.
		$newsxo_theme = wp_get_theme();
		if ( ! defined( 'NEWSXO_THEME_DIR' ) ) {
			define( 'NEWSXO_THEME_DIR', get_template_directory() . '/' );
		}
		if ( ! defined( 'NEWSXO_THEME_URI' ) ) {
			define( 'NEWSXO_THEME_URI', get_template_directory_uri() . '/' );
		}
		if ( ! defined( 'NEWSXO_THEME_VERSION' ) ) {
			define( 'NEWSXO_THEME_VERSION', $newsxo_theme->get( 'Version' ) );
		} 
		if ( ! defined( 'NEWSXO_THEME_NAME' ) ) {
			define( 'NEWSXO_THEME_NAME'   , $newsxo_theme->get( 'Name' ) );
		} 
	}
	/**
	 * Include files.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function includes() {
	
		$newsxo_theme_path = NEWSXO_THEME_DIR . '/inc/ansar/';
	
		require( $newsxo_theme_path . '/custom-navwalker-class.php' );
		require( $newsxo_theme_path . '/default_menu_walker.php' );
		require( $newsxo_theme_path . '/font/font.php');
		require( $newsxo_theme_path . '/template-tags.php');
		require( $newsxo_theme_path . '/template-functions.php');
		require( $newsxo_theme_path . '/widgets/widgets-common-functions.php');
		require( $newsxo_theme_path . '/custom-control/custom-control.php');
		require( $newsxo_theme_path . '/custom-control/font/font-control.php');
		require_once NEWSXO_THEME_DIR . '/inc/ansar/customizer-admin/admin-plugin-install.php';
		require_once( trailingslashit( NEWSXO_THEME_DIR ) . 'inc/ansar/customize-pro/class-customize.php' );
	
		/*-----------------------------------------------------------------------------------*/
		/*	Enqueue scripts and styles.
		/*-----------------------------------------------------------------------------------*/

		require( $newsxo_theme_path .'/core/class-newsxo-enqueue.php');

		new Newsxo_Enqueue_Scripts();

		/* ----------------------------------------------------------------------------------- */
		/* Customizer Layout*/
		/* ----------------------------------------------------------------------------------- */

		require( $newsxo_theme_path . '/custom-control/customize_layout.php');

		/* ----------------------------------------------------------------------------------- */
		/* Customizer */
		/* ----------------------------------------------------------------------------------- */

		require( $newsxo_theme_path . '/customize/customizer.php');

		/* ----------------------------------------------------------------------------------- */
		/* Load customize control classes */
		/* ----------------------------------------------------------------------------------- */

		require( $newsxo_theme_path . '/customize/customize-control-class.php');
	
		/* ----------------------------------------------------------------------------------- */
		/* Widget initialize */
		/* ----------------------------------------------------------------------------------- */
	
		require( $newsxo_theme_path  . '/widgets/widgets-init.php');
	
		/* ----------------------------------------------------------------------------------- */
		/* Hook Initialize */
		/* ----------------------------------------------------------------------------------- */
	
		require( $newsxo_theme_path  . '/hooks/hooks-init.php');
	
		/* ----------------------------------------------------------------------------------- */
		/* custom-color file */
		/* ----------------------------------------------------------------------------------- */

		require( NEWSXO_THEME_DIR . '/assets/css/colors/theme-options-color.php');
	
		/* ----------------------------------------------------------------------------------- */
		/* custom-dark-color file */
		/* ----------------------------------------------------------------------------------- */

		require( NEWSXO_THEME_DIR . '/assets/css/colors/theme-options-dark-color.php');

		/* ----------------------------------------------------------------------------------- */
		/* Load theme setup class */
		/* ----------------------------------------------------------------------------------- */

		require_once NEWSXO_THEME_DIR . '/inc/ansar/core/class-newsxo-theme-setup.php';
	}
}

function newsxo() {
	return Newsxo::instance();
}

newsxo();