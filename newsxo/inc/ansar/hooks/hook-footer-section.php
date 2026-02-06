<?php if (!function_exists('newsxo_social_section')) :
/**
 *  Header
 *
 * @since newsxo pro
 *
 */
function newsxo_social_section($align = '') { 
  $align = $align == 'center' ? 'center' : 'md-end'; ?>
  <ul class="bs-social">
    <?php $social_icons = get_theme_mod( 'newsxo_social_icons', newsxo_get_social_icon_default() );
      $social_icons = json_decode( $social_icons );
    if ( $social_icons != '' ) {
      foreach ( $social_icons as $social_item ) {
        $social_icon = ! empty( $social_item->icon_value ) ? apply_filters( 'newsxo_translate_single_string', $social_item->icon_value, 'Footer section' ) : '';
                    
        $open_new_tab = ! empty( $social_item->open_new_tab ) ? apply_filters( 'newsxo_translate_single_string', $social_item->open_new_tab, 'Footer section' ) : '';

        $social_link = ! empty( $social_item->link ) ? apply_filters( 'newsxo_translate_single_string', $social_item->link, 'Footer section' ) : '';
        ?>
        <li>
          <a <?php if ($open_new_tab == 'yes') { echo 'target="_blank"'; } ?> href="<?php echo esc_url( $social_link ); ?>">
            <i class="<?php echo esc_attr( $social_icon ); ?>"></i>
          </a>
        </li>
        <?php
      }
    }
  echo '</ul>';
}
endif;
add_action('newsxo_action_social_section', 'newsxo_social_section', 2);