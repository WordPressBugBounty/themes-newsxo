<?php function newsxo_slider_default_section() {
global $post;
$newsxo_url = newsxo_get_freatured_image_url($post->ID, 'newsxo-slider-full');
$slider_meta_enable = get_theme_mod('slider_meta_enable','true');
$slider_overlay_enable = get_theme_mod('slider_overlay_enable','true'); ?>
<div class="swiper-slide">
  <div class="bs-slide bs-blog-post three lg">
    <?php if (!empty($newsxo_url)){ ?>
      <figure class="bs-thumb-bg">
        <img src="<?php echo $newsxo_url ?>" alt="<?php echo get_the_title()?>">  
      </figure>
    <?php } ?>
    <a class="link-div" href="<?php the_permalink(); ?>"> </a>
    <?php if ($slider_overlay_enable != false){ ?>
      <div class="inner">
    <?php if($slider_meta_enable == true) { newsxo_post_categories(); } ?>
      <h4 class="title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <?php if($slider_meta_enable == true) { newsxo_post_meta(); } ?>
    </div>
    <?php } ?>
  </div> 
</div>
<?php }