<?php
  $newsxo_slider_category = newsxo_get_option('select_slider_news_category');
  $newsxo_number_of_post = 5;
  $newsxo_all_posts_main = newsxo_get_posts($newsxo_number_of_post, $newsxo_slider_category);
  ?>
  <!--row-->
  <div class="col-lg-7">
    <div class="mb-0">
      <div class="homemain bs swiper-container">
        <div class="swiper-wrapper">
          <?php
          if ($newsxo_all_posts_main->have_posts()) :
            while ($newsxo_all_posts_main->have_posts()) : $newsxo_all_posts_main->the_post(); 
              newsxo_slider_default_section();   
            endwhile;
          endif;
          wp_reset_postdata(); ?>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- <div class="swiper-pagination"></div> -->
      </div>
      <!--/swipper-->
    </div>
  </div>
  <!--/col-12-->