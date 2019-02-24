<?php
/**
 * Widget for skillbar section
 * @package    	Quail
 * @link        https://bellathemes.com/
 * since 	    1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! class_exists( 'Quail_Skillbar' ) ) :

	/**
	 * skillbar section
	 * @since 1.0.0
	 */
	class Quail_Skillbar extends WP_Widget{

		function __construct(){

			parent::__construct(
				'quail-skillbar', 
				esc_html__( 'Quail Skillbar', 'quail' ), 
				array( 'description' => esc_html__( 'Displays skillbar with title, subtitle', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
				);
		}



		function form( $instance ) {

			$skillbar 	= ! empty( $instance[ 'skillbar' ] ) ? $instance[ 'skillbar' ] : array();
			?>
			
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_label_1' ) ); ?>"><?php esc_html_e( 'Label 1:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_label_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[0][label]' ) ); ?>" type="text" value="<?php echo isset($skillbar[0]['label'])? esc_attr($skillbar[0]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_color_1' ) ); ?>"><?php esc_html_e( 'Bar Color:', 'quail' ); ?></label> 
					<input class="widefat color-field" id="<?php echo esc_attr( $this->get_field_id( 'bar_color_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[0][color]' ) ); ?>" type="text" value="<?php echo isset($skillbar[0]['color'])?esc_attr($skillbar[0]['color']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_number_1' ) ); ?>"><?php esc_html_e( 'Skill(%):', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_number_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[0][number]' ) ); ?>" type="number" value="<?php echo isset($skillbar[0]['number'])?esc_attr($skillbar[0]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_label_2' ) ); ?>"><?php esc_html_e( 'Label 2:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_label_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[1][label]' ) ); ?>" type="text" value="<?php echo isset($skillbar[1]['label'])?esc_attr($skillbar[1]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_color_2' ) ); ?>"><?php esc_html_e( 'Bar Color:', 'quail' ); ?></label> 
					<input class="widefat color-field" id="<?php echo esc_attr( $this->get_field_id( 'bar_color_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[1][color]' ) ); ?>" type="text" value="<?php echo isset($skillbar[1]['color'])?esc_attr($skillbar[1]['color']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_number_2' ) ); ?>"><?php esc_html_e( 'Skill(%):', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_number_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[1][number]' ) ); ?>" type="number" value="<?php echo isset($skillbar[1]['number'])?esc_attr($skillbar[1]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_label_3' ) ); ?>"><?php esc_html_e( 'Label 3:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_label_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[2][label]' ) ); ?>" type="text" value="<?php echo isset($skillbar[2]['label'])?esc_attr($skillbar[2]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_color_3' ) ); ?>"><?php esc_html_e( 'Color:', 'quail' ); ?></label> 
					<input class="widefat color-field" id="<?php echo esc_attr( $this->get_field_id( 'bar_color_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[2][color]' ) ); ?>" type="text" value="<?php echo isset($skillbar[2]['color'])?esc_attr($skillbar[2]['color']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_number_3' ) ); ?>"><?php esc_html_e( 'Skill(%):', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_number_3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[2][number]' ) ); ?>" type="number" min="1" max="100" value="<?php echo isset($skillbar[2]['number'])?esc_attr($skillbar[2]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_label_4' ) ); ?>"><?php esc_html_e( 'Label 4:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_label_4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[3][label]' ) ); ?>" type="text" value="<?php echo isset($skillbar[3]['label'])?esc_attr($skillbar[3]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_color_4' ) ); ?>"><?php esc_html_e( 'Bar Color:', 'quail' ); ?></label> 
					<input class="widefat color-field" id="<?php echo esc_attr( $this->get_field_id( 'bar_color_4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[3][color]' ) ); ?>" type="text" value="<?php echo isset($skillbar[3]['color'])?esc_attr($skillbar[3]['color']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_number_4' ) ); ?>"><?php esc_html_e( 'Skill(%):', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_number_4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[3][number]' ) ); ?>" type="number" value="<?php echo isset($skillbar[3]['number'])?esc_attr($skillbar[3]['number']):'';?>">
				</p>
			</div>
			<div class="qw-input-group">
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_label_5' ) ); ?>"><?php esc_html_e( 'Label 5:', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_label_5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[4][label]' ) ); ?>" type="text" value="<?php echo isset($skillbar[4]['label'])?esc_attr($skillbar[4]['label']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_color_5' ) ); ?>"><?php esc_html_e( 'Bar Color:', 'quail' ); ?></label> 
					<input class="widefat color-field" id="<?php echo esc_attr( $this->get_field_id( 'bar_color_5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[4][color]' ) ); ?>" type="text" value="<?php echo isset($skillbar[4]['color'])?esc_attr($skillbar[4]['color']):'';?>">
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'bar_number_5' ) ); ?>"><?php esc_html_e( 'Skill(%):', 'quail' ); ?></label> 
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bar_number_5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skillbar[4][number]' ) ); ?>" type="number" value="<?php echo isset($skillbar[4]['number'])?esc_attr($skillbar[4]['number']):'';?>">
				</p>
			</div>
		<?php
		}




		function update( $new_instance, $old_instance ) {

			$instance 		   		= $old_instance;
			$instance['skillbar'] 	= ( isset( $new_instance['skillbar'] ) ) ? $this->sanitize_array( $new_instance['skillbar'] ) : array();
			return $instance;
		}




		function widget( $widget_args, $instance ) {

			$before_title = isset( $args['before_title'] ) ? $args['before_title'] : '<h2>';
	        $after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '</h2>';

			$skillbar 	= ( isset( $instance['skillbar'] ) ) ? $instance['skillbar'] : array();

			if( isset($widget_args['before_widget'])){

				echo $widget_args['before_widget'];
			}
			?>

			<div class="quail-component quail-skillbar">

					<?php 
					if( is_array( $skillbar ) ):
						foreach( $skillbar as $skill):
							if( !$skill['label'] ):continue;endif;
						?>
							<div class="skillbar clearfix " data-percent="<?php echo esc_attr($skill['number']); ?>%">
								<div class="skillbar-title"><span><?php echo esc_html($skill['label']);?></span></div>
								<div class="skillbar-bar" style="background: <?php echo esc_attr($skill['color']);?>"></div>
								<div class="skill-bar-percent"><?php echo esc_html($skill['number']) ;?>%</div>
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

				if( isset( $array[$i]['color'] ) )
					$array[$i]['color'] = sanitize_hex_color( $array[$i]['color'] );

				if( isset( $array[$i]['number'] ) )
					$array[$i]['number'] = sanitize_text_field( $array[$i]['number'] );

			endfor;
		}
		
		return $array ;

	}
	}
endif;


if( ! function_exists( 'quail_widget_skillbar' ) ) :

	/**
	* Register and load widget.
	*/
	function quail_widget_skillbar() {

		register_widget( 'Quail_Skillbar' );

	}

endif;
add_action( 'widgets_init', 'quail_widget_skillbar' );