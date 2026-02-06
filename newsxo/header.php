<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Newsxo
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php 
    if ( is_front_page() || is_home() ) {
        $newsxo_preload_image = get_theme_mod('newsxo_main_banner_section_background_image', '');
        if ( $newsxo_preload_image ) {
            echo '<link rel="preload" as="image" href="' . esc_url( $newsxo_preload_image ) . '">';
        }
    }
    ?>
    <?php wp_head(); ?>
</head>
<?php $theme_layout = get_theme_mod('newsxo_theme_layout_options','wide');
$newsxo_main_banner_section_background_image = get_theme_mod('newsxo_main_banner_section_background_image', '');

if($theme_layout == "boxed"){ $class="boxed bodyback"; }
else{ $class="wide"; } ?>

<body <?php body_class($class); ?> >
    
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">
        <?php esc_html_e( 'Skip to content', 'newsxo' ); ?>
    </a>

    <!--wrapper-->
    <div class="wrapper" id="custom-background-css">
    <!--==================== Header ====================-->
    <?php do_action('newsxo_action_header_type_section'); ?>
    <!--news ticker start-->
    <div class="bs-latest-ticker-news">
        <?php do_action('newsxo_action_news_ticker_section'); ?>
    </div>
    <!--news ticker end-->
    <?php
    $newsxo_enable_main_slider = newsxo_get_option('show_main_banner_section');
    $slider_position = get_theme_mod('main_slider_position', 'left') == 'left' ? '' : ' row-reverse';
    if(is_home() || is_front_page()) {  
        if($newsxo_enable_main_slider){ ?>
            <!--mainfeatured start-->
            <div class="mainfeatured five<?php if (!empty($newsxo_main_banner_section_background_image)) { echo' over mt-0';?>" style="background-image: url('<?php echo $newsxo_main_banner_section_background_image; ?>')" <?php } else { echo '"';} ?>>
                <div class="featinner">
                    <!--container-->
                    <div class="container">
                        <!--row-->  
                        <div class="row gap-1 gap-md-0<?php echo esc_attr($slider_position)?>">
                            <?php do_action('newsxo_action_front_page_main_section_1'); ?>
                        </div><!--/row-->
                    </div><!--/container-->
                </div>
            </div>
            <!--mainfeatured end-->
            <?php
        }
        if(is_active_sidebar('magazine-content')){
            get_template_part('sidebar','magazine');
        }
    } 
    ?>