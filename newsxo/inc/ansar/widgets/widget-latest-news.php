<?php
if (!class_exists('Newsxo_Latest_Post')) :
    /**
     * Adds Newsxo_Latest_Post widget.
     */
    class Newsxo_Latest_Post extends Newsxo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newsxo-categorised-posts-title','bg_color', 'text_color', 'bor_color', 'newsxo-posts-number');
            $this->select_fields = array('newsxo-select-category');

            $widget_ops = array(
                'classname' => 'latstpost-widget hori',
                'description' => __('Displays posts from selected category in single column.', 'newsxo'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('newsxo_latest_post', __('AR: Latest News Post', 'newsxo'), $widget_ops);
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
            $number_of_posts = isset($instance['newsxo-posts-number']) ? $instance['newsxo-posts-number'] : '5';
            $loop_off = 0;
            $blog_post_layout = (get_theme_mod('blog_post_layout','list-layout'));
            $layout = esc_attr(get_theme_mod('newsxo_archive_page_layout','align-content-right')) == 'full-width-content' ? '3': '2';
            // open the widget container
            echo $args['before_widget'];

            ?>

            <!-- bs-posts-sec bs-posts-modul-6 -->
            <div class="latest-post-widget<?php if ( ! empty( $title ) ) { echo ' wd-back'; } ?>">
            <?php newsxo_widget_title($title); ?>
                <?php
                $all_posts = newsxo_get_posts( -1 , $category);
                ?>
                <!-- bs-posts-sec-inner -->
                    <?php
                    if($blog_post_layout == 'list-layout'){
                        echo '<div id="list" class="d-grid">';
                        if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                            if($loop_off < $number_of_posts){
                                global $post; 
                                 get_template_part('template-parts/sections/content','data'); ?>
                                <?php } else {
                                    $visibility = ' hide-content';
                                       get_template_part('template-parts/sections/content','data', array('visibility' => $visibility) );
                                } $loop_off++; ?>
                        <?php endwhile; ?>
                    <?php endif;
                    echo'</div>';
                    } else {
                    ?><div id="grid" class="d-grid column<?php echo esc_attr($layout)?>"><?php
                        if ($all_posts->have_posts()) :
                            while ($all_posts->have_posts()) : $all_posts->the_post();
                            if($loop_off < $number_of_posts){
                                global $post; 
                                 get_template_part('template-parts/sections/content','dataGrid'); ?>
                                <?php } else {
                                    $visibility = 'hide-content';
                                       get_template_part('template-parts/sections/content','dataGrid', array('visibility' => $visibility) );
                                } $loop_off++; ?>
                        <?php endwhile; ?>
                    <?php endif;
                    ?></div><?php
                    }
                wp_reset_postdata(); ?>
                <!-- // bs-posts-sec-inner -->
            </div> <!-- // bs-posts-sec block_6 -->
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

            $categories = newsxo_get_terms();
            $number_of_posts = isset($instance['newsxo-posts-number']) ? $instance['newsxo-posts-number'] : '5';

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::newsxo_generate_text_input('newsxo-categorised-posts-title', 'Title', 'Latest News');

                echo parent::newsxo_generate_select_options('newsxo-select-category', __('Select Category', 'newsxo'), $categories);

                echo parent::newsxo_generate_text_input('newsxo-posts-number', __('Number of Post to Show', 'newsxo'), $number_of_posts);
            }

        }
    }
endif;