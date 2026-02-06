<?php add_action('admin_enqueue_scripts','newsxo_author_widget_scripts');

function newsxo_author_widget_scripts() {    

    wp_enqueue_media();

    wp_enqueue_script('news_author_widget_script', get_template_directory_uri() . '/assets/js/widget-image.js', false, '1.0', true);

}
class Newsxo_author_info extends WP_Widget {  

    public function __construct() {
        parent::__construct(
            'post-author',
            __( 'AR: Author Info', 'newsxo' )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        echo '<!-- Start Author Widget -->' . $before_widget;

        $newsxo_btnone_target = !empty($instance['open_btnone_new_window']) ? '_blank' : '_self';
        $title = apply_filters( 'widget_title', $instance['title'] );

        ?>
        <div class="bs-author-widget">
            <?php newsxo_widget_title($title);
            if( !empty($instance['image_uri']) || !empty($instance['name']) || !empty($instance['desg']) || !empty($instance['facebook']) || !empty($instance['twt']) || !empty($instance['insta']) || !empty($instance['youtube']) || !empty($instance['lnk']) || !empty($instance['pntr']) || !empty($instance['tiktok']) ) { ?>
            <div class="bs-author"> 
                <?php  if( !empty($instance['image_uri']) || !empty($instance['name']) || !empty($instance['desg']) ) { ?>
                <div class="d-flex align-center inner">
                    <?php if (!empty($instance['image_uri'])) { ?> 
                        <div class="bs-author-img">
                            <img class="rounded-circle" src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo esc_attr($instance['name']); ?>" />
                        </div>
                    <?php } ?>
                    <div class="bs-author-info">
                        <?php if (!empty($instance['name'])) {
                            echo '<h4 class="name">'. esc_html($instance['name']).'</h4>';
                        } if (!empty($instance['desg'])) {
                            echo '<span class="designation">'. esc_html($instance['desg']).'</span>';
                        } ?>
                    </div>
                </div>
                <?php } if (!empty($instance['desg'])) {
                    echo '<p class="description">' .esc_html($instance['desc']).'</p>';
                } if( !empty($instance['facebook']) || !empty($instance['twt']) || !empty($instance['insta']) || !empty($instance['youtube']) || !empty($instance['lnk']) || !empty($instance['pntr']) || !empty($instance['tiktok']) ) { ?>
                    <strong>Follow me: </strong>        
                    <ul class="bs-social">
                        <?php
                        $social_links = [
                            'facebook' => 'fab fa-facebook',
                            'twt'      => 'fab fa-x-twitter',
                            'insta'    => 'fab fa-instagram',
                            'youtube'  => 'fab fa-youtube',
                        ];
                        foreach ($social_links as $key => $icon) {
                            if (!empty($instance[$key])) {
                                ?>
                                <li>
                                    <a class="<?php echo esc_attr($key); ?>" href="<?php echo esc_url($instance[$key]); ?>" target="<?php echo esc_attr($newsxo_btnone_target); ?>">
                                        <i class="<?php echo esc_attr($icon); ?>"></i>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                <?php } ?>         
            </div>
            <?php } 
        echo '</div>';
        echo $after_widget . '<!-- End Author Widget -->';
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $fields = ['title', 'name', 'desc', 'desg', 'image_uri', 'open_btnone_new_window'];
        $social_platforms = ['facebook', 'twt', 'insta', 'youtube'];

        foreach ($fields as $field) {
            $instance[$field] = strip_tags($new_instance[$field]);
        }

        foreach ($social_platforms as $platform) {
            $instance[$platform] = stripslashes(wp_filter_post_kses($new_instance[$platform]));
        }

        return $instance;
    }

    public function form($instance) {
        $defaults = [
            'title' => 'Author Details',
            'name' => '',
            'desc' => '',
            'desg' => '',
            'image_uri' => '',
            'open_btnone_new_window' => '',
            'facebook' => '',
            'twt' => '',
            'insta' => '',
            'youtube' => '',
        ];
        $instance = wp_parse_args((array) $instance, $defaults);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'newsxo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Author Image', 'newsxo'); ?></label><br/>
            <?php if (!empty($instance['image_uri'])) { ?>
                <img class="custom_media_image_team" src="<?php echo esc_url($instance['image_uri']); ?>" style="max-width:100px;display:block;margin-bottom:5px;" alt="<?php _e('Uploaded image', 'newsxo'); ?>" />
            <?php } ?>
            <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo esc_attr($instance['image_uri']); ?>" />
            <input type="button" class="button button-primary custom_media_button_team" id="image_upload_button" value="<?php _e('Upload Image', 'newsxo'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name', 'newsxo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo esc_attr($instance['name']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('desg'); ?>"><?php _e('Designation', 'newsxo'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('desg'); ?>" name="<?php echo $this->get_field_name('desg'); ?>" type="text" value="<?php echo esc_attr($instance['desg']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description', 'newsxo'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo esc_textarea($instance['desc']); ?></textarea>
        </p>
        <table>
            <?php
            $social_platforms = [
                'facebook' => __('Facebook Link', 'newsxo'),
                'twt'      => __('Twitter Link', 'newsxo'),
                'insta'    => __('Instagram Link', 'newsxo'),
                'youtube'  => __('YouTube Link', 'newsxo'),
            ];

            foreach ($social_platforms as $key => $label) {
                ?>
                <tr>
                    <td>
                        <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $label; ?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" value="<?php echo esc_attr($instance[$key]); ?>" />
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('open_btnone_new_window'); ?>" name="<?php echo $this->get_field_name('open_btnone_new_window'); ?>" <?php checked($instance['open_btnone_new_window'], 'on'); ?> />
            <label for="<?php echo $this->get_field_id('open_btnone_new_window'); ?>"><?php _e('Open links in new window', 'newsxo'); ?></label>
        </p>
        <?php
    }
}
