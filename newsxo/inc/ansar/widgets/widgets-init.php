<?php
/**
 * Newsxo Widgets - Loader.
 *
 * @package newsxo Widget
 * @since 1.0.0
 */

if ( ! class_exists( 'Newsxo_Widgets_Loader' ) ) {

    /**
     * Widgets Loader Class
     *
     * @since 1.0.0
     */
    class Newsxo_Widgets_Loader {

        /**
         * Member Variable
         *
         * @var instance
         */
        private static $instance;

        /**
         *  Initiator
         */
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self;
                self::$instance->includes();
            }
            return self::$instance;
        }

        /**
         *  Constructor
         */
        public function __construct() {

            // Add Widget.
            add_action( 'widgets_init', array( $this, 'newsxo_widgets') );

        }

        /**
         * Include Widget files.
         *
         * @since  1.0.0
         * @return void
         */

        public function includes() {
            // Load widget base.
            require_once get_template_directory() . '/inc/ansar/widgets/widgets-base.php';
            
            /* Theme Widget sidebars. */
            require get_template_directory() . '/inc/ansar/widgets/widgets-common-functions.php';
            
            /* Theme Widgets*/
            require get_template_directory() . '/inc/ansar/widgets/widget-posts-carousel.php';
            
            require get_template_directory() . '/inc/ansar/widgets/widget-latest-news.php';
            require get_template_directory() . '/inc/ansar/widgets/widget-posts-list.php';
            require get_template_directory() . '/inc/ansar/widgets/widget-posts-slider.php';
            require get_template_directory() . '/inc/ansar/widgets/widget-3-column-slider.php';
            require get_template_directory() . '/inc/ansar/widgets/widget-author-info.php';
            require get_template_directory() . '/inc/ansar/widgets/widget-posts-double-category.php';
            require get_template_directory() . '/inc/ansar/widgets/widget-featured-post-widget.php';
            require get_template_directory() . '/inc/ansar/widgets/popular_tab_widget.php';
        }

        /**
         * Register widgets.
         *
         * @since 1.0.0
         */

        public function newsxo_widgets() {
            register_widget('Three_Column_Slider' );
            register_widget('Newsxo_Posts_Carousel' );
            register_widget('Newsxo_Latest_Post' );
            register_widget('Newsxo_Posts_List' );
            register_widget('Newsxo_Posts_Slider' );
            register_widget('Popular_Tab_Widget' );
            register_widget('Newsxo_Dbl_Col_Cat_Posts');
            register_widget('Newsxo_author_info');
            register_widget('featured_post_Widget' );
        }
        
    }
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Newsxo_Widgets_Loader::get_instance();