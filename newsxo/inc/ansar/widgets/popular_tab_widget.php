<?php

class Popular_Tab_Widget extends Newsxo_Widget_Base {
	/**
	 * Widget constructor.
	 */
	function __construct() {
		$this->text_fields = array('newsxo-tabbed-popular-posts-title', 'newsxo-tabbed-latest-posts-title', 'newsxo-tabbed-categorised-posts-title', 'newsxo-excerpt-length', 'newsxo-posts-number');

		$this->select_fields = array('newsxo-show-excerpt', 'newsxo-enable-categorised-tab', 'newsxo-select-category');

		$widget_options = array(
			'classname'   => 'popular_tab_Widget',
			'description' => __( 'Popular Tab', 'newsxo' ),
		);
		parent::__construct( 'popular_tab_Widget', __( 'AR: Popular Tab', 'newsxo' ), $widget_options );
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
		$tab_id = 'tabbed-' . $this->number; 

		/** This filter is documented in wp-includes/default-widgets.php */

		$show_excerpt = 'false';
		$excerpt_length = '20';
		$number_of_posts =  '4';


		$popular_title = isset($instance['newsxo-tabbed-popular-posts-title']) ? $instance['newsxo-tabbed-popular-posts-title'] : __('Popular', 'newsxo');
		$latest_title = isset($instance['newsxo-tabbed-latest-posts-title']) ? $instance['newsxo-tabbed-latest-posts-title'] : __('Latest', 'newsxo');


		$enable_categorised_tab = isset($instance['newsxo-enable-categorised-tab']) ? $instance['newsxo-enable-categorised-tab'] : 'true';
		$categorised_title = isset($instance['newsxo-tabbed-categorised-posts-title']) ? $instance['newsxo-tabbed-categorised-posts-title'] : __('Trending', 'newsxo');
		$category = isset($instance['newsxo-select-category']) ? $instance['newsxo-select-category'] : '0';


		// open the widget container
		echo $args['before_widget'];
		?>
		<!-- Popular Tab widget start-->

		<div class="tab-wrapper tabbed-post-widget wd-back">	
			<div class="tabs">
				<div bs-tab="<?php echo esc_attr($tab_id); ?>-home" class="tab-button active"><i class="fa-solid fa-newspaper"></i> <?php echo $categorised_title; ?></div> 
				<div bs-tab="<?php echo esc_attr($tab_id); ?>-popular" class="tab-button"><i class="fa-solid fa-fire"></i> <?php echo $popular_title; ?></div>
				<div bs-tab="<?php echo esc_attr($tab_id); ?>-latest" class="tab-button"><i class="fa-solid fa-bolt-lightning"></i> <?php echo $latest_title; ?></div>
			</div>
			<!-- Start Tabs -->	
			<div class="tab-contents">
				<div id="<?php echo esc_attr($tab_id); ?>-home" class="tab-content active d-grid">
					<?php newsxo_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts);	?>
				</div>
				<div id="<?php echo esc_attr($tab_id); ?>-popular" class="tab-content d-grid">
					<?php newsxo_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts); ?>
				</div>
				<?php if ($enable_categorised_tab == 'true'){ ?>
				<div id="<?php echo esc_attr($tab_id); ?>-latest" class="tab-content d-grid">
					<?php newsxo_render_posts('categorised', $show_excerpt, $excerpt_length, $number_of_posts, $category);	?>
				</div>
				<?php } ?>
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
	public function form($instance)	{
		$this->form_instance = $instance;
		$enable_categorised_tab = array(
			'true' => __('Yes', 'newsxo'),
			'false' => __('No', 'newsxo')

		);

		// generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
		?><h4><?php _e('Latest Posts', 'newsxo'); ?></h4><?php
		echo parent::newsxo_generate_text_input('newsxo-tabbed-latest-posts-title', __('Title', 'newsxo'), __('Latest', 'newsxo'));

		?><h4><?php _e('Popular Posts', 'newsxo'); ?></h4><?php
		echo parent::newsxo_generate_text_input('newsxo-tabbed-popular-posts-title', __('Title', 'newsxo'), __('Popular', 'newsxo'));

		$categories = newsxo_get_terms();
		if (isset($categories) && !empty($categories)) {
			?><h4><?php _e('Categorised Posts', 'newsxo'); ?></h4>
			<?php
			echo parent::newsxo_generate_select_options('newsxo-enable-categorised-tab', __('Enable Categorised Tab', 'newsxo'), $enable_categorised_tab);
			echo parent::newsxo_generate_text_input('newsxo-tabbed-categorised-posts-title', __('Title', 'newsxo'), __('Trending', 'newsxo'));
			echo parent::newsxo_generate_select_options('newsxo-select-category', __('Select category', 'newsxo'), $categories);
		}
	}
}