<?php
/**
 * The template for displaying search results pages.
 *
 * @package Newsxo
 */
get_header();
$blog_post_layout = (get_theme_mod('blog_post_layout','list-layout')); ?>
<!--==================== main content section ====================-->
<main id="content" class="search-class content">
    <!--container-->
    <div class="container">
        <!--==================== breadcrumb section ====================-->
        <?php do_action('newsxo_action_archive_page_title'); ?>
        <!--row-->
        <div class="row">
            <div class="col-lg-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?>">
                <?php if ( have_posts() ) { /* Start the Loop */
                    if($blog_post_layout == 'grid-layout'){
                        get_template_part('template-parts/content','grid');
                    } else { get_template_part('template-parts/content',''); }
                } else { ?>
                    <h2><?php esc_html_e( "Nothing Found", 'newsxo' ); ?></h2>
                    <div class="">
                        <p>
                            <?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'newsxo' ); ?>
                        </p>
                        <?php get_search_form(); ?>
                    </div><!-- .blog_con_mn -->
                <?php } ?>
            </div>
            <aside class="col-lg-4 sidebar-right">
                <?php get_sidebar();?>
            </aside>
        </div><!--/row-->
    </div><!--/container-->
</main>
<?php
get_footer();