<?php
if (!function_exists('newsxo_side_menu_section')) :
/**
 *  Header
 *
 * @since newsxo
 *
 */
function newsxo_side_menu_section() { ?>
  <aside class="bs-offcanvas end" bs-data-targeted="true">
    <div class="bs-offcanvas-close">
      <a href="#" class="bs-offcanvas-btn-close" bs-data-removable="true">
        <span></span>
        <span></span>
      </a>
    </div>
    <div class="bs-offcanvas-inner">
      <?php if( is_active_sidebar('menu-sidebar-content')){
        get_template_part('template-parts/sidebars/sidebar','menu');
      } else { 
        $title = esc_html( 'Header Toggle Sidebar', 'newsxo' );?>
      <div class="bs-card-box empty-sidebar">
      <?php newsxo_widget_title($title); ?>
        <p class='empty-sidebar-widget-text'>
          <?php echo esc_html( 'This is an example widget to show how the Header Toggle Sidebar looks by default. You can add custom widgets from the', 'newsxo' ); ?>
          <a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>' title='<?php esc_attr_e('widgets','newsxo'); ?>'>
            <?php echo esc_html( 'widgets', 'newsxo' ); ?>
          </a>
          <?php echo esc_html( 'in the admin.', 'newsxo' ); ?>
        </p>
      </div>
      <?php } ?>
    </div>
  </aside>
  <?php 
}
endif;
add_action('newsxo_action_side_menu_section', 'newsxo_side_menu_section', 5);