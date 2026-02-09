<?php 
$enable_category = newsxo_get_option('newsxo_enable_single_related_category');
$enable_date = newsxo_get_option('newsxo_enable_single_related_date');
$enable_admin = newsxo_get_option('newsxo_enable_single_related_admin');
$related_post_title = get_theme_mod('newsxo_related_post_title', esc_html__('Related Posts','newsxo'))
?>
<!--Start bs-realated-slider -->
<div class="bs-related-post-info bs-card-box">
 <?php newsxo_widget_title($related_post_title);?>
    <!-- // bs-sec-title -->
    <div class="d-grid column3">
        <?php global $post;
            $categories = get_the_category($post->ID);
            $number_of_related_posts = 3;
            if ($categories) {
                $cat_ids = array();
                foreach ($categories as $category) $cat_ids[] = $category->term_id;
                $args = array(
                    'category__in' => $cat_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page' => $number_of_related_posts, // Number of related posts to display.
                    'ignore_sticky_posts' => 1
                );
                $related_posts = new wp_query($args);
                while ($related_posts->have_posts()) {
                    $related_posts->the_post();
                    global $post;
                    $newsxo_url = newsxo_get_freatured_image_url($post->ID, 'newsxo-featured');
                    $url=  !empty( $newsxo_url ) ? 'style="background-image: url(' . esc_url( $newsxo_url ) . ');"' : ''; ?>
                    <div class="bs-blog-post three md bshre mb-lg-0">
                        <figure class="bs-thumb-bg back-img" <?php echo ($url); ?>></figure>
                        <div class="inner">
                            <?php if($enable_category == true) { newsxo_post_categories(); } ?>
                            <h4 class="title md"> 
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4> 
                            <div class="bs-blog-meta">
                                <?php if($enable_admin == true){ 
                                    newsxo_author_content(); 
                                    } if($enable_date == true) {
                                        newsxo_date_content(); 
                                        } ?>
                            </div>
                            <a class="link-div" href="<?php the_permalink(); ?>"></a>
                        </div>
                    </div> 
                <?php }
            }
            wp_reset_postdata(); ?>
    </div>
</div>
<!--End bs-realated-slider -->