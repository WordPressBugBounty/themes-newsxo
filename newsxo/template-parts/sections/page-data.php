<?php if( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout())) { ?>
<div class="col-lg-12">
    <div class="bs-card-box wd-back">
    <?php if (have_posts()) {  
        while (have_posts()) : the_post();
            the_content();
        endwhile; 
    } 

} else { 
    $newsxo_page_layout = get_theme_mod('newsxo_page_layout','page-align-content-right');

    if($newsxo_page_layout == "page-align-content-left") { ?> 
            <!--col-lg-4-->
                <aside class="col-lg-4 sidebar-left">
                    <?php get_sidebar();?>
                </aside>
            <!--/col-lg-4--> 
    <?php } ?>
        
    <div class="<?php echo esc_attr(($newsxo_page_layout == "page-full-width-content") ? 'col-lg-12' : 'col-lg-8 content-right'); ?>">
        <div class="bs-card-box bs-blog-post bshre wd-back">
            <?php if( have_posts()) {
                the_post();
                if(has_post_thumbnail()) {
                    echo '<figure class="post-thumbnail">';
                        the_post_thumbnail( '', array( 'class'=>'img-responsive img-fluid' ) );
                    echo '</figure>';
                }
                the_content();
            } 
            while ( have_posts() ) : the_post();
                // Include the page
                the_content();
                comments_template( '', true ); // show comments 
                wp_link_pages(array(
                    'before' => '<div class="link btn-theme">' . esc_html__('Pages:', 'newsxo'),
                    'after' => '</div>',
                ));
            endwhile;
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif; 
            newsxo_edit_link(); ?>	
        </div>
    </div> <?php  

    if($newsxo_page_layout == "page-align-content-right") { ?> 
        <!--col-lg-4-->
            <aside class="col-lg-4 sidebar-right">
                <?php get_sidebar(); ?>
            </aside>
        <!--/col-lg-4--> 
    <?php }
}