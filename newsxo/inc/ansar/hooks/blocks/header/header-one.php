<?php function newsxo_header_default_section() { do_action('newsxo_action_header_image_section'); ?>
  <header class="bs-headtwo">
    <!-- Main Menu Area-->
    <div class="bs-head-detail d-none d-lg-flex">
    <?php do_action('newsxo_action_header_section'); ?>
    </div>
    <?php $sticky_header_toggle = get_theme_mod('sticky_header_toggle', true);
    if ($sticky_header_toggle == true) { $sticky_header = get_theme_mod('sticky_header_option', 'default') == 'default' ? ' sticky-header' : ' scroll-up'; } else { $sticky_header =''; } ?>
    <div class="bs-menu-full<?php echo esc_attr($sticky_header); ?>">
      <div class="inner">
        <div class="container">
          <div class="main d-flex align-center">
            
            <!-- logo Area-->
            <?php do_action('newsxo_action_header_logo_section'); ?>
            <!-- /logo Area-->

            <!-- Main Menu Area-->
            <?php do_action('newsxo_action_header_menu_section'); ?>
            <!-- /Main Menu Area-->

            <!-- Right Area-->
            <?php do_action('newsxo_action_header_right_menu_section'); ?>
            <!-- Right-->
          </div><!-- /main-->
        </div><!-- /container-->
      </div><!-- /inner-->
    </div><!-- /Main Menu Area-->
  </header>
<?php } ?>