<?php
if (!function_exists('newsxo_header_logo_section')) :
/**
 *  Header
 *
 * @since newsxo
 *
 */
function newsxo_header_logo_section() { ?>
<!-- logo-->
<div class="logo">
  <div class="site-logo">
    <?php if(get_theme_mod('custom_logo') !== ""){ the_custom_logo(); } ?>
  </div>
  <div class="site-branding-text<?php echo esc_attr( display_header_text() ? '' : ' d-none'); ?>">
  <?php if (is_front_page() || is_home()) { ?>
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></h1>
    <?php } else { ?>
    <p class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a></p>
    <?php } ?>
    <p class="site-description"><?php  echo esc_html(get_bloginfo( 'description' )); ?></p>
  </div>
</div><!-- /logo-->
<?php  }
endif;
add_action('newsxo_action_header_logo_section', 'newsxo_header_logo_section', 4);

// Offcanvas Menu
if (!function_exists('newsxo_sidebar_menu_function')):
  function newsxo_sidebar_menu_function() { 
    $newsxo_menu_sidebar  = get_theme_mod('newsxo_menu_sidebar',true); 
    if($newsxo_menu_sidebar == true){ ?>
    <!-- Off Canvas -->
      <div class="hedaer-offcanvas d-none d-lg-block">
        <button class="offcanvas-trigger" bs-data-clickable-end="true">
          <i class="fa-solid fa-bars-staggered"></i>
        </button>
      </div>
    <!-- /Off Canvas -->
    <?php } ?>

  <?php }
endif;
add_action('newsxo_action_sidebar_menu_function', 'newsxo_sidebar_menu_function', 5);

// Dar/Light Switch
if (!function_exists('newsxo_header_dark_switch_section')) :

  function newsxo_header_dark_switch_section() {
    $newsxo_lite_dark_switcher = get_theme_mod('newsxo_lite_dark_switcher', true);
    if($newsxo_lite_dark_switcher == true){ 
      if ( isset( $_COOKIE["newsxo-site-mode-cookie"] ) ) {
        $newsxo_skin_mode = $_COOKIE["newsxo-site-mode-cookie"];
      } else {
        $newsxo_skin_mode = get_theme_mod( 'newsxo_skin_mode', 'defaultcolor' );
      } ?>
      <label class="switch d-none d-lg-inline-block" for="switch">
        <input type="checkbox" name="mode-switch" id="mode-switcher" class="<?php echo esc_attr( $newsxo_skin_mode ); ?>" data-skin-mode="<?php echo esc_attr( $newsxo_skin_mode ); ?>">
      </label>
    <?php } 
  }
endif;
add_action('newsxo_action_header_dark_switch_section', 'newsxo_header_dark_switch_section', 5);

// Search
if (!function_exists('newsxo_header_search_section')) :

  function newsxo_header_search_section() { 
    $newsxo_menu_search  = get_theme_mod('newsxo_menu_search',true);
    if($newsxo_menu_search == true) { ?>
      <!-- search-->
      <a class="msearch element" href="#" bs-search-clickable="true">
        <i class="fa-solid fa-magnifying-glass"></i>
      </a>
      <!-- /search-->
    <?php } 
  }
endif;
add_action('newsxo_action_header_search_section', 'newsxo_header_search_section', 5);

// Subscriber Button
if (!function_exists('newsxo_header_subs_section')) :

  function newsxo_header_subs_section() {  
    $subsc_link = get_theme_mod('newsxo_subsc_link', '#'); 
    $newsxo_menu_subscriber  = get_theme_mod('newsxo_menu_subscriber',true);
    $subsc_icon  = get_theme_mod('subsc_icon_layout','bell');
    $subsc_open_in_new  = get_theme_mod('subsc_open_in_new',true) == true ? ' target="_blank"' : '';
    $subs_title  = get_theme_mod('subs_news_title','Subscribe');
    if($newsxo_menu_subscriber == true) { ?> 
    <a href="<?php echo esc_attr($subsc_link) ?>" class="subscribe-btn btn btn-five d-flex" data-text="<?php echo $subs_title; ?>" <?php echo $subsc_open_in_new ?>>
      <i class="fas fa-<?php echo esc_html($subsc_icon) ?>"></i> <?php if(!empty($subs_title)){ echo '<span>'.$subs_title.'</span>';  } ?>
    </a>
    <?php }
  }
endif;
add_action('newsxo_action_header_subs_section', 'newsxo_header_subs_section', 5);

// Woo Cart

if (!function_exists('newsxo_header_woo_cart_section')) :

  function newsxo_header_woo_cart_section() {  
    $enable_cart  = get_theme_mod('newsxo_cart_enable',1);
    if($enable_cart == 1){ ?>
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="bs-cart element">
        <span class='bs-cart-total'>
          <?php echo WC()->cart->get_cart_subtotal(); ?>
        </span>
        <span class="bs-cart-icon">
          <i class="fa-solid fa-cart-arrow-down"></i>
        </span>
        <span class='bs-cart-count'>
          <?php echo WC()->cart->get_cart_contents_count(); ?>
        </span>
      </a>
    <?php  
    } 
  } 
endif;
add_action('newsxo_action_header_cart_section', 'newsxo_header_woo_cart_section', 5);

if (!function_exists('newsxo_header_menu_cont_section')) :
/**
 *  Header
 *
 * @since newsxo
 *
 */
function newsxo_header_menu_cont_section() {
  
  $header_menu_layout = get_theme_mod('header_menu_layout','default');
  $home_icon_disable = get_theme_mod('newsxo_home_icon',true); ?>
  <!-- Header bottom -->
    <?php $sticky_header_toggle = get_theme_mod('sticky_header_toggle', true);
      if ($sticky_header_toggle == true) { $sticky_header = get_theme_mod('sticky_header_option', 'default') == 'default' ? ' sticky-header' : ' scroll-up'; } else { $sticky_header =''; } ?>
      <div class="bs-menu-full<?php echo esc_attr($sticky_header); ?>">
        <div class="container">
          <div class="main-nav d-flex align-center"> 
            <?php do_action('newsxo_action_header_menu_section'); 
              do_action('newsxo_action_header_right_menu_section'); 
            ?>
          </div>
        </div>
      </div> 
  <!-- Header bottom -->
<?php  }
endif;
add_action('newsxo_action_header_menu_cont_section', 'newsxo_header_menu_cont_section', 6);


if (!function_exists('newsxo_header_top_section')) :
  /**
   *  Header
   *
   * @since newsxo
   *
   */
  function newsxo_header_top_section(){  ?>
    <!--top-bar-->
    <div class="container">
      <div class="row align-items-center">
          <!--col-md-5-->
          <div class="col-md-12 col-xs-12">
            <div class="tobbar-right d-flex-space flex-wrap ">
              <?php
              newsxo_date_display_type();
          if(get_theme_mod('header_menu_layout') !== 'three' ){
            if(get_theme_mod('social_icon_header_enable', true) == true) { do_action('newsxo_action_social_section'); } 
          } ?>
          </div>
        </div>
        <!--/col-md-5-->
      </div>
    </div>
    <!--/top-bar-->
    <?php
  }
endif;
add_action('newsxo_action_header_section', 'newsxo_header_top_section', 5);


function newsxo_news_ticker_section(){ ?>
 <!--container-->
 <div class="container">
  <!-- bs-latest-news -->
  <div class="bs-latest-news">
    <?php $category = newsxo_get_option('select_flash_news_category');
    $slider_post_order_by = newsxo_get_option('slider_post_order_by');
    $breaking_news_title = newsxo_get_option('breaking_news_title');
    $all_posts = newsxo_get_posts(5, $category, $slider_post_order_by);
    $count = 1;
    if ((!empty($breaking_news_title))){ ?>
      <div class="bn_title">
        <h5 class="title"><i class="fas fa-bolt"></i><?php if (!empty($breaking_news_title)){ echo '<span>'.$breaking_news_title.'</span>'; } ?></h5>
      </div>
    <?php } ?>
    <!-- bs-latest-news_slider -->
    <div class="bs-latest-news-slider swipe bs swiper-container">
      <div class="swiper-wrapper">
        <?php if ($all_posts->have_posts()) :
          while ($all_posts->have_posts()) : $all_posts->the_post(); ?>
            <div class="swiper-slide">
              <a href="<?php the_permalink(); ?>">
                <span><?php the_title(); ?></span>
              </a>
            </div> 
            <?php $count++;
          endwhile;
        endif;
        wp_reset_postdata(); ?> 
      </div>
      <div class="bs-latest-news-nav">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
    <!-- // bs-latest-news_slider -->
  </div>
  <!-- bs-latest-news -->
  </div><!--/container-->
  <?php
}
add_action('newsxo_action_news_ticker_section', 'newsxo_news_ticker_section', 5);