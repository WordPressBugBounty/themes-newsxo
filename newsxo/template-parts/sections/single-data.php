<?php
$single_meta_orders = get_theme_mod(
    'single_post_meta',
    array(
        'author',
        'date',
        'comments',
        'tags',
    )
);
$enable_category = newsxo_get_option('newsxo_single_post_category');
$enable_meta = newsxo_get_option('newsxo_single_post_meta');
$enable_image = newsxo_get_option('newsxo_single_post_image');
$enable_admin = newsxo_get_option('newsxo_enable_single_admin');
$enable_related = newsxo_get_option('newsxo_enable_single_related');
$enable_comments = newsxo_get_option('newsxo_enable_single_comments');
if(have_posts()) {
    while(have_posts()) { the_post(); ?>
        <div class="bs-blog-post bshre single"> 
            <div class="bs-header">
                <?php
                    if ($enable_category == true ) { 
                        newsxo_post_categories(); 
                    } ?>
                    <h1 class="title" title="<?php the_title_attribute();?>">
                        <?php the_title(); ?>
                    </h1>
                    <?php

                    if ($enable_meta == true) { ?>
                        <div class="bs-info-author-block">
                            <div class="bs-blog-meta mb-0">
                                <?php foreach($single_meta_orders as $key=> $single_meta_order) {

                                    if ($single_meta_order == 'author') {
                            
                                        do_action('newsxo_action_single_small_admin');
                                    }
                            
                                    if ($single_meta_order == 'date') {
                            
                                        newsxo_date_content();
                                    }
                        
                                    if ($single_meta_order == 'comments') {
                            
                                        newsxo_post_comments();
                                    }

                                    if ($single_meta_order == 'tags') {
                            
                                        newsxo_post_item_tag();
                                    }
                                } ?>
                            </div>
                        </div>
                    <?php }

                    if ($enable_image == true) {
                        do_action('newsxo_action_single_featured_image'); 
                    } ?>
            </div>
            <article class="small single">
                <?php the_content();
                    newsxo_edit_link();
                    newsxo_social_share_post($post); ?>
                    <div class="clearfix mb-3"></div>
                    <?php
                    do_action('newsxo_action_single_next_prev_links');
                    
                    wp_link_pages(array(
                        'before' => '<div class="single-nav-links">',
                        'after' => '</div>',
                    ));
                ?>
            </article>
        </div>
    <?php }

    if ($enable_admin == true) {
        get_template_part('template-parts/sections/single','author');
    }

    if ($enable_related == true) {
        get_template_part('template-parts/sections/single','related');
    }

    if ($enable_comments == true) {
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif; 
    }
}