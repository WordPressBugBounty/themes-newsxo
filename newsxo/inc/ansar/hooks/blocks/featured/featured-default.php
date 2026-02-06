<?php if (!function_exists('newsxo_latest_posts')) :
    /**
     *
     * @since newsxo
     *
     */
    function newsxo_latest_posts() {
        $slider_meta_enable = get_theme_mod('slider_meta_enable','true');
        $select_latest_news_category = newsxo_get_option('select_latest_news_category'); 
        $featured_latest_posts = newsxo_get_posts( 4, $select_latest_news_category);
        ?>
        <div class="col-lg-5">
            <div class="multi-post-widget mb-0 mt-3 mt-lg-0">
                <div class="inner_columns five">
                    <?php 
                    if ($featured_latest_posts->have_posts()) : 
                        while ($featured_latest_posts->have_posts()) : $featured_latest_posts->the_post();
                        global $post;
                        $newsxo_url = newsxo_get_freatured_image_url($post->ID, 'newsxo-slider-full'); 
                        $url=  !empty( $newsxo_url ) ? 'style="background-image: url(' . esc_url( $newsxo_url ) . ');"' : ''; ?> 
                        <div class="bs-blog-post three bsm bshre post-1 mb-0">
                            <figure class="bs-thumb-bg back-img" <?php echo ($url); ?>></figure>
                            <a class="link-div" href="<?php the_permalink(); ?>"> </a>
                            <div class="inner">
                                <?php if($slider_meta_enable == true) { newsxo_post_categories(); } ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($slider_meta_enable == true) { newsxo_post_meta(); } ?>
                            </div>
                        </div>
                    <?php endwhile;
                        endif;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php
    }
endif;
add_action('newsxo_action_latest_posts', 'newsxo_latest_posts');