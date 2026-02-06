<?php /**
 // Template Name: Frontpage
 */
get_header(); ?>
<main id="content" class="front-page-class content">
    <!--container-->
    <div class="container">
        <!--row-->
        <div class="row">
            <?php 
                get_template_part('template-parts/sidebars/sidebar','frontpageleft');
                get_template_part('template-parts/sidebars/sidebar','frontcontent');
                get_template_part('template-parts/sidebars/sidebar','frontpageright'); 
            ?>
        </div><!--row-->
    </div><!--container-->
</main>
<?php get_footer(); ?>