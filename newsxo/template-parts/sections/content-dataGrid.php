<?php if(isset($args['visibility'])){ $visibility = $args['visibility']; }else{ $visibility = ''; }
    $newsxo_archive_page_layout = esc_attr(newsxo_get_option('newsxo_archive_page_layout',)); 
    global $post; ?>

    <div id="post-<?php the_ID(); ?>" <?php if($newsxo_archive_page_layout == "grid-fullwidth") { echo post_class('c '.$visibility); } else { echo post_class(' '.$visibility); } ?>>
        <!-- bs-posts-sec bs-posts-modul-6 -->
        <div class="bs-blog-post bshre grid-card"> 
            <?php 
                $url = newsxo_get_freatured_image_url($post->ID, 'newsxo-medium');
                newsxo_post_image_display_type($post); 
                newsxo_post_title_content(); 
            ?>
        </div>
    </div>
    <?php 