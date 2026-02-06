<?php
if (!class_exists('Newsxo_Posts_Slider')) :
    /**
     * Adds Newsxo_Posts_Slider widget.
     */
    class Newsxo_Posts_Slider extends Newsxo_Widget_Base {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsxo-posts-slider-title');
            $this->select_fields = array('newsxo-select-category');

            $widget_ops = array(
                'classname' => 'Newsxo_Posts_Slider_widget',
                'description' => __('Displays posts slider from selected category.', 'newsxo'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('Newsxo_Posts_Slider', __('AR: Posts Slider', 'newsxo'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance) {
            $instance = parent::newsxo_sanitize_data($instance, $instance);

            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters('widget_title', $instance['newsxo-posts-slider-title'], $instance, $this->id_base);
            $category = isset($instance['newsxo-select-category']) ? $instance['newsxo-select-category'] : 0;
            
            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="col-md-12">
                <div class="slider-post-widget<?php if (!empty($title)) { echo ' wd-back'; } ?>">
                <?php newsxo_widget_title($title);
                    $all_posts = newsxo_get_posts( 5 , $category); ?>
                    <div class="wigethomemain bs swiper-container">
                        <div class="swiper-wrapper">
                        <?php
                            if ($all_posts->have_posts()) :
                                while ($all_posts->have_posts()) : $all_posts->the_post();
                                    global $post;
                                    $url = newsxo_get_freatured_image_url($post->ID, 'newsxo-slider-full');
                                    ?>
                                <div class="swiper-slide"> 
                                    <div class="bs-blog-post three lg">
                                        <?php if (!empty($url)){ ?>
                                            <figure class="bs-thumb-bg">
                                                <img src="<?php echo $url ?>" alt="<?php echo get_the_title()?>">  
                                            </figure>
                                        <?php } ?>
                                        <div class="inner">
                                            <?php newsxo_post_categories(); ?>
                                            <div class="title-wrap">
                                                <h4 class="title lg"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <div class="btn-wrap">
                                                    <a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <?php newsxo_post_meta(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div> 
                </div>   
            </div>
            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)  {
            $this->form_instance = $instance;
            $options = array(
                'true' => __('Yes', 'newsxo'),
                'false' => __('No', 'newsxo')
            );

            $categories = newsxo_get_terms();

            if (isset($categories) && !empty($categories)) {

                echo parent::newsxo_generate_text_input('newsxo-posts-slider-title', __('Title', 'newsxo'), 'Posts Slider');

                echo parent::newsxo_generate_select_options('newsxo-select-category', __('Select category', 'newsxo'), $categories);
            }
        }
    }
endif;