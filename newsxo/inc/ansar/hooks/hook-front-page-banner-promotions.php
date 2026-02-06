<?php
if (!function_exists('newsxo_banner_advertisement')):
    /**
     *
     * @since newsxo 1.0.0
     *
     */
    function newsxo_banner_advertisement() {

        if (('' != newsxo_get_option('banner_ad_image')) ) {

            $newsxo_banner_advertisement = newsxo_get_option('banner_ad_image');
            $newsxo_banner_advertisement = absint($newsxo_banner_advertisement);
            $newsxo_banner_advertisement = wp_get_attachment_image($newsxo_banner_advertisement, 'full');
            $banner_ad_url = newsxo_get_option('banner_ad_url');
            $banner_open_on_new_tab = newsxo_get_option('banner_open_on_new_tab');
            $banner_open_on_new_tab = ('' != $banner_open_on_new_tab) ? '_blank' : '';
            ?>
            <div class="advertising-banner"> 
                <a class="pull-right img-fluid" href="<?php echo esc_url($banner_ad_url); ?>" target="<?php echo esc_attr($banner_open_on_new_tab); ?>">
                    <?php echo $newsxo_banner_advertisement; ?>
                </a>  
            </div>
            <?php
        }
    }
endif;

add_action('newsxo_action_banner_advertisement', 'newsxo_banner_advertisement', 10);