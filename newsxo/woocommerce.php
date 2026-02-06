<?php
/**
 * The template for displaying all WooCommerce pages.
 *
 * @package Newsxo
 */
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->

<!-- #main -->
<main id="content" class="woocommerce-class content">
	<div class="container">
		<?php do_action('newsxo_action_archive_page_title'); ?>
		<div class="row">
			<div class="col-lg-12">
				<?php woocommerce_content(); ?>
			</div>
		</div><!-- .container -->
	</div>	
</main><!-- #main -->
<?php get_footer(); ?>