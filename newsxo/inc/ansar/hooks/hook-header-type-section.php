<?php if (!function_exists('newsxo_header_type_section')) :
    /**
     *  Header
     *
     * @since newsxo
     *
     */
    function newsxo_header_type_section(){
        newsxo_header_default_section();
    }
endif;
add_action('newsxo_action_header_type_section', 'newsxo_header_type_section', 6);