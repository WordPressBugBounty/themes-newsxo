<?php
if (!class_exists('Newsxo_Posts_List')) :
    /**
     * Adds Newsxo_Posts_List widget.
     */
    class Newsxo_Posts_List extends Newsxo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsxo-categorised-posts-title','newsxo-posts-number');
            $this->select_fields = array('newsxo-select-category');
            $this->checkboxes = array('newsxo-count-per-row');

            $widget_ops = array(
                'classname' => 'small-post-list-widget',
                'description' => __('Displays posts from selected category in a list.', 'newsxo'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsxo_posts_list', __('AR: Posts List', 'newsxo'), $widget_ops);
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
            $title = apply_filters('widget_title', $instance['newsxo-categorised-posts-title'], $instance, $this->id_base);
            $category = isset($instance['newsxo-select-category']) ? $instance['newsxo-select-category'] : '0';
            $number_of_posts = isset($instance['newsxo-posts-number']) ? $instance['newsxo-posts-number'] : 4;
            $per_row = isset($instance['newsxo-count-per-row']) ? $instance['newsxo-count-per-row'] : '1';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="small-post-list-widget">
                <?php newsxo_widget_title($title); ?>
                <div class="small-post-list-inner d-grid column<?php echo esc_attr($per_row);?>"> 
                
                <?php $all_posts = newsxo_get_posts($number_of_posts, $category);
                    $count = 1;
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                        global $post;
                        $url = newsxo_get_freatured_image_url($post->ID, 'thumbnail'); ?>
                            <!-- small-list-post -->
                            <div class="small-post mb-0">
                                <?php if($url) { ?>   
                                <div class="img-small-post back-img hlgr" style="background-image: url('<?php echo esc_url($url); ?>');">
                                <a href="<?php the_permalink(); ?>" class="link-div"></a>
                                </div><?php } ?>
                                <!-- // img-small-post -->
                                <div class="small-post-content">
                                <?php newsxo_post_categories(); ?>
                                <!-- small-post-content -->
                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <!-- // title_small_post -->
                                <div class="bs-blog-meta">
                                    <span class="bs-blog-date"><?php echo get_the_date( 'M j , Y' ); ?></span>
                                </div>
                                </div>
                            <!-- // small-post-content -->
                            </div>
                            <?php
                            $count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>                            
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
        public function form($instance)
        {
            $this->form_instance = $instance;
            $options = array(
                'true' => __('Yes', 'newsxo'),
                'false' => __('No', 'newsxo')

            );

            $newsxo_count_per_row_option = array(
                '1'    => __('1 Post','newsxo'),
                '2'    => __('2 Posts','newsxo'),
            );
            $number_of_posts = isset($instance['newsxo-posts-number']) ? $instance['newsxo-posts-number'] : 4;

            $categories = newsxo_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                
                echo parent::newsxo_generate_text_input('newsxo-categorised-posts-title', __('Title', 'newsxo'), __('Posts List', 'newsxo'));

                echo parent::newsxo_generate_select_options('newsxo-select-category', __('Select category', 'newsxo'), $categories);

                echo parent::newsxo_generate_text_input('newsxo-posts-number', __('Number of Posts to Show', 'newsxo'), $number_of_posts);
                
                echo parent::newsxo_generate_checkbox_options('newsxo-count-per-row', __('Post Count Per Row', 'newsxo'), $newsxo_count_per_row_option, $note ='', $default="1");

            }
        }
    }
endif;