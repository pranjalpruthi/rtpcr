<?php
/**
 * Widget for heading 
 *
 * @package    	 Quail
 * @link         https://bellathemes.com/
 * since 	     1.0
 * Author:       Quail
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! class_exists( 'Quail_Paragraph' ) ):

/**
* heading
* @since 1.0.0
*/
class Quail_Paragraph extends WP_Widget
{
	function __construct(){

		parent::__construct(
				'quail-paragraph', 
				esc_html__( 'Quail Paragraph', 'quail' ), 
				array( 'description' => esc_html__( 'Single Paragraph', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
			);
	}




	function form( $instance ) {

		
		$paragraph_text   = ! empty( $instance[ 'paragraph_text' ] ) ? ($instance[ 'paragraph_text' ]) : '';
	
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'paragraph_text' ) ); ?>"><?php esc_html_e( 'Heading Text:', 'quail' ); ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'paragraph_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'paragraph_text' ) ); ?>"><?php echo esc_attr( $paragraph_text ); ?></textarea>
		</p>

		
		<?php
	}




	function update( $new_instance, $old_instance ) {

		$instance 				  = $old_instance;
		$instance['paragraph_text'] = ( isset( $new_instance['paragraph_text'] ) ) ? sanitize_text_field( $new_instance['paragraph_text'] ) : '';
		return $instance;

	}




	function widget( $widget_args, $instance ) {

		$heading 		= ( isset( $instance['heading'] ) ) ? $instance['heading'] : 'h1';
		$paragraph_text 	= ( isset( $instance['paragraph_text'] ) ) ? $instance['paragraph_text'] : __( 'Empty Heading' , 'quail' );
		
		if( isset($widget_args['before_widget'])){

			echo $widget_args['before_widget'];
		}

		?>
		<div class="quail-component quail-paragraph">

			<?php 


			echo '<p>'.esc_html($paragraph_text).'</p>';
			

			?>  

		</div>

		<?php

		if( isset($widget_args['after_widget'])){

			echo $widget_args['after_widget'];
		}
	}
}
endif;


if( ! function_exists( 'quail_widget_paragraph' ) ):

	/**
	* Register and load widget.
	*/
	function quail_widget_paragraph() {

		register_widget( 'Quail_Paragraph' );

	}

endif;
add_action( 'widgets_init', 'quail_widget_paragraph' );