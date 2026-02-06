<?php
if (!class_exists('Newsxo_Posts_Carousel')) :
    /**
     * Adds Newsxo_Posts_Carousel widget.
     */
    class Newsxo_Posts_Carousel extends Newsxo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 0.1
         */
        function __construct()
        {
            $this->text_fields = array('newsxo-posts-slider-title');
            $this->select_fields = array('newsxo-select-category');

            $widget_ops = array(
                'classname' => 'bs-slider-widget',
                'description' => __('Displays posts carousel from selected category.', 'newsxo'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsxo_posts_carousel', __('AR: Posts Carousel', 'newsxo'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::newsxo_sanitize_data($instance, $instance);
            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['newsxo-posts-slider-title'], $instance, $this->id_base);
            $category = isset($instance['newsxo-select-category']) ? $instance['newsxo-select-category'] : '0';

            // open the widget container
            echo  '<!-- Start Post Carousel Widget -->' .$args['before_widget'];
            ?> 
            <div class="bs-slider-widget wd-back">
            <?php newsxo_widget_title($title);
                $all_posts = newsxo_get_posts(5 , $category);
                ?>
                <!-- bs-posts-sec-inner -->
                <div class="bs-posts-sec-inner">
                    <!-- featured_cat_slider -->
                    <div class="featured_cat_slider bs swiper-container">
                        <div class="swiper-wrapper ">
                            <?php
                            if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                                global $post;
                                $url = newsxo_get_freatured_image_url($post->ID, 'newsxo-medium'); ?>
                                <!-- item -->
                                <div class="swiper-slide">
                                    <!-- blog card-->
                                    <div class="bs-blog-post bshre grid-card">
                                        <div class="bs-blog-thumb lg back-img">
                                            <div class="bs-blog-thumb lg">
                                                <figure class="bs-thumb-bg back-img" style="background-image: url('<?php echo esc_url($url); ?>'); background-color:#333;"></figure>
                                                <a href="<?php the_permalink(); ?>" class="link-div"></a>
                                                <?php newsxo_post_categories(); ?>
                                            </div>
                                        </div> 
                                        <article class="small">
                                            <div class="title-wrap">
                                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <div class="btn-wrap">
                                                    <a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <?php newsxo_post_meta(); ?>
                                        </article>
                                    </div>
                                    <!-- blog -->
                                </div>
                                <!-- // item -->
                            <?php
                            endwhile;
                            endif;
                            wp_reset_postdata(); ?>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div> <!-- // featured_cat_slider -->
                </div> <!-- // bs-posts-sec-inner -->
            </div>

            <?php
            //print_pre($all_posts);

            // close the widget container
            echo $args['after_widget']. '<!-- End Post Carousel Widget -->';
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;

            $categories = newsxo_get_terms();
            
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry

                echo parent::newsxo_generate_text_input('newsxo-posts-slider-title', __('Title', 'newsxo'), 'Posts Carousel');

                echo parent::newsxo_generate_select_options('newsxo-select-category', __('Select category', 'newsxo'), $categories);

            }
        }
    }
endif;