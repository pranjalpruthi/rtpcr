<?php
/**
 * Widget for counter section
 * @package    	Quail
 * @link        https://bellathemes.com/
 * since 	    1.0.0
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
if( ! class_exists( 'Quail_Counter' ) ):
	/**
	* Counter section
	* @since 1.0.0
	*/

	class Quail_Counter extends WP_Widget{

		function __construct(){
			parent::__construct(
				'quail-counter', 
				esc_html__( 'Quail Counter', 'quail' ), 
				array( 'description' => esc_html__( 'Displays counter with title, icon and number', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
				);
		}




		function form( $instance ) {

			$counter 	= ! empty( $instance[ 'counter' ] ) ? $instance[ 'counter' ] : array();
			?>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_label_1' ) ); ?>"><?php esc_html_e( 'Label:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_label_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[0][label]' ) ); ?>" type="text" value="<?php echo isset($counter[0]['label'])?esc_attr($counter[0]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_icon_1' ) ); ?>"><?php  esc_html_e( 'FontAwesome Icon: e.g. fa fa-ambulance', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_icon_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[0][icon]' ) ); ?>" type="text" value="<?php echo isset($counter[0]['icon'])?esc_attr($counter[0]['icon']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_number_1' ) ); ?>"><?php esc_html_e( 'Number:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_number_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[0][number]' ) ); ?>" type="number" value="<?php echo isset($counter[0]['number'])? esc_attr($counter[0]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_label_2' ) ); ?>"><?php esc_html_e( 'Label:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_label_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[1][label]' ) ); ?>" type="text" value="<?php echo isset($counter[1]['label'])?esc_attr($counter[1]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_icon_2' ) ); ?>"><?php  esc_html_e( 'FontAwesome Icon: e.g. fa fa-ambulance', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_icon_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[1][icon]' ) ); ?>" type="text" value="<?php echo isset($counter[1]['icon'])?esc_attr($counter[1]['icon']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_number_2' ) ); ?>"><?php esc_html_e( 'Number:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_number_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[1][number]' ) ); ?>" type="number" value="<?php echo isset($counter[1]['number'])?esc_attr($counter[1]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_label_3' ) ); ?>"><?php esc_html_e( 'Label:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_label_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[2][label]' ) ); ?>" type="text" value="<?php echo isset($counter[2]['label'])?esc_attr($counter[2]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_icon_3' ) ); ?>"><?php  esc_html_e( 'FontAwesome Icon: e.g. fa fa-ambulance', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_icon_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[2][icon]' ) ); ?>" type="text" value="<?php echo isset($counter[2]['icon'])?esc_attr($counter[2]['icon']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_number_3' ) ); ?>"><?php esc_html_e( 'Number:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_number_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[2][number]' ) ); ?>" type="number" value="<?php echo isset($counter[2]['number'])?esc_attr($counter[2]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_label_4' ) ); ?>"><?php esc_html_e( 'Label:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_label_4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[3][label]' ) ); ?>" type="text" value="<?php echo isset($counter[3]['label'])?esc_attr($counter[3]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_icon_4' ) ); ?>"><?php  esc_html_e( 'FontAwesome Icon: e.g. fa fa-ambulance', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_icon_4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[3][icon]' ) ); ?>" type="text" value="<?php echo isset($counter[3]['icon'])?esc_attr($counter[3]['icon']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'counter_number_4' ) ); ?>"><?php esc_html_e( 'Number:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'counter_number_4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'counter[3][number]' ) ); ?>" type="number" value="<?php echo isset($counter[3]['number'])?esc_attr($counter[3]['number']):'';?>">
				</p>
			</div>
			<?php
		}




		function update( $new_instance, $old_instance ) { 

			$instance 				= $old_instance;
			$instance['counter'] 	= ( isset( $new_instance['counter'] ) ) ? $this->sanitize_array( $new_instance['counter'] ) : '';
			
			return $instance;
		}




		function widget( $widget_args, $instance ) {

			$before_title = isset( $args['before_title'] ) ? $args['before_title'] : '<h2>';
	        $after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '</h2>';
			$counter 	=  ( isset( $instance['counter'] ) ) ? $instance['counter'] : '';

			if( isset($widget_args['before_widget'])){
				echo $widget_args['before_widget'];
			}
			?>
				<div class="quail-component quail-counter four-col">
					<?php 
					if( is_array( $counter ) ):
						foreach( $counter as $count):
							if( empty( $count['label'] ) ): continue; endif;
						?>
						<div class="mc-item">
							<div class="mc-item-inner">
								<div class="mc-item-icon">
									<i class="<?php echo esc_attr($count['icon']); ?>"></i>
								</div>
								<div class="mc-item-meta">
									<span class="mc-item-count highlight"><?php echo esc_html($count['number']); ?></span>
									<div class="mc-item-lbl"><?php echo esc_html($count['label']); ?></div>
								</div>
							</div>
						</div>
						<?php 
						endforeach;
						endif;
						?>
					</div>
			
				<?php
				if( isset($widget_args['after_widget'])){
					echo $widget_args['after_widget'];
				}
			}
		




	private function sanitize_array( $array ){

		if( is_array( $array ) ){
			for( $i = 0; $i < count( $array ); $i++ ):
				if( isset( $array[$i]['label'] ) )
					$array[$i]['label'] = sanitize_text_field( $array[$i]['label'] );
				if( isset( $array[$i]['icon'] ) )
					$array[$i]['icon'] = sanitize_text_field( $array[$i]['icon'] );
				if( isset( $array[$i]['number'] ) )
					$array[$i]['number'] = sanitize_text_field( $array[$i]['number'] );
			endfor;
		}
		
		return $array ;
	}

	}

endif;


if( ! function_exists( 'quail_widget_counter' ) ) :
	
	/**
	 * Register and load widget.
	 */
	function quail_widget_counter() {
		
		register_widget( 'Quail_Counter' );
	}
endif;
add_action( 'widgets_init', 'quail_widget_counter' );