<?php
if (!function_exists('newsxo_front_page_banner_section')) :
  /**
   *
   * @since newsxo
   *
   */
  function newsxo_front_page_banner_section() {
    if (is_front_page() || is_home()) {
              
      get_template_part('inc/ansar/hooks/blocks/featured/featured','default');
      get_template_part('inc/ansar/hooks/blocks/block','banner-list');
      do_action('newsxo_action_latest_posts');
    }
  }
endif;
add_action('newsxo_action_front_page_main_section_1', 'newsxo_front_page_banner_section', 40); 