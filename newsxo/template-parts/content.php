<?php
/**
 * The template for displaying the content.
 * @package Newsxo
 */
?>

<div id="list" <?php post_class('align_cls d-grid'); ?>>
    <?php while(have_posts()){ the_post();
        get_template_part('template-parts/sections/content','data'); 
    }
    newsxo_post_pagination(); ?>
</div>
<?php