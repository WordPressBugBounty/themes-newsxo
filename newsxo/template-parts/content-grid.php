<?php
/**
 * The template for displaying the content.
 * @package Newsxo
 */
$layout = esc_attr(newsxo_get_option('newsxo_archive_page_layout')) == 'full-width-content' ? '3': '2';
?>
<div id="grid" class="d-grid column<?php echo esc_attr($layout)?>">
    <?php while(have_posts()){ the_post(); ?>
        <?php get_template_part('template-parts/sections/content','dataGrid'); ?>
    <?php } ?> 
</div>
<?php newsxo_post_pagination();