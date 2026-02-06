<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package Newsxo
 */

/*select page for Featured slider*/
if (!function_exists('newsxo_main_banner_section_status')) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function newsxo_main_banner_section_status($control) {
        if (true == $control->manager->get_setting('show_main_banner_section')->value()) {
            return true;
        } else {
            return false;
        }
    }

endif;
if (!function_exists('newsxo_menu_subscriber_section_status')) :

    function newsxo_menu_subscriber_section_status($control) {
        if ($control->manager->get_setting('newsxo_menu_subscriber')->value() == true) {
            return true;
        } else {
            return false;
        }
    }

endif;

if (!function_exists('newsxo_blog_content_status')) :

    function newsxo_blog_content_status($control) {
        if ($control->manager->get_setting('newsxo_blog_content')->value() == 'excerpt') {
            return true;
        } else {
            return false;
        }
    }

endif;