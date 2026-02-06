<!-- =========================
  Page Breadcrumb   
============================== -->
<?php get_header(); ?>
<main id="content" class="single-class content">
  <!--/container-->
    <div class="container"> 
      <!--==================== breadcrumb section ====================-->
        <?php do_action('newsxo_action_archive_page_title'); ?>
      <!--row-->
        <div class="row"> 
          <?php do_action('newsxo_action_single_main_content_layouts'); ?>
        </div>
      <!--/row-->
    </div>
  <!--/container-->
</main> 
<?php get_footer(); ?>