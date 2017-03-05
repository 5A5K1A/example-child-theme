<?php
add_action( 'widgets_init', function(){
	register_widget( 'Od_Shortcode_Widget' );
});

/**
 * Adds Od_Shortcode_Widget widget.
 */
class Od_Shortcode_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Od_Shortcode_Widget', // Base ID
			__('Shortcode', 'od'), // Name
			array( 'description' => __( 'Voeg een shortcode toe.', 'od' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

     	echo $args['before_widget'];
		if ( !empty($instance['title']) ) {
			echo $args['before_title'].apply_filters( 'widget_title', $instance['title'] ).$args['after_title'];
		}
		echo do_shortcode( $instance['shortcode'], false );
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title     = ( isset($instance['title']) ) ? $instance['title'] : __('New title', 'od');
		$shortcode = ( isset($instance['shortcode']) ) ? $instance['shortcode'] : __('New shortcode', 'od');
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'od'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Shortcode:', 'od'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" type="text" value="<?php echo esc_attr( $shortcode ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title']     = ( !empty($new_instance['title']) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['shortcode'] = ( !empty($new_instance['shortcode']) ) ? strip_tags( $new_instance['shortcode'] ) : '';

		return $instance;
	}
}