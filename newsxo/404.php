<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Newsxo
 */
get_header();?>
<!--container--> 
  <div id="content" class="404-class container content">
    <!--container-->
    <div class="container">
      <?php do_action('newsxo_action_archive_page_title'); ?>
    </div>
    <!--row-->
    <div class="row">
      <div class="col-lg-12 text-center bs-section"> 
        <!--mg-error-404-->
          <div class="bs-error-404">
            <h1 class="title">
              <?php echo esc_html__('4', 'newsxo') . '<i class="fa-solid fa-face-sad-tear"></i>' . esc_html__('4', 'newsxo'); ?>
            </h1>
            <h4 class="subtitle"><?php echo esc_html(get_theme_mod('newsxo_404_title', __('Oops! Page not found', 'newsxo'))); ?></h4>
            <p class="description"><?php echo esc_html(get_theme_mod('newsxo_404_desc', __('We are sorry, but the page you are looking for does not exist.', 'newsxo'))); ?></p>
            <a href="<?php echo esc_url(home_url());?>" onClick="history.back();" class="btn btn-theme">
              <?php echo esc_html(get_theme_mod('newsxo_404_btn_title', __('Go Back', 'newsxo'))); ?>
            </a>
          </div>
        <!--/mg-error-404--> 
      </div>
      <!--/col-lg-12--> 
    </div>
    <!--/row--> 
  </div>
<!--/container-->
<?php get_footer();