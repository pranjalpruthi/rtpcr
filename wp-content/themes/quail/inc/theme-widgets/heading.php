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

if( ! class_exists( 'Quail_Heading' ) ):

/**
* heading
* @since 1.0.0
*/
class Quail_Heading extends WP_Widget
{
	function __construct(){

		parent::__construct(
				'quail-heading', 
				esc_html__( 'Quail Heading', 'quail' ), 
				array( 'description' => esc_html__( 'HTML heading (h1,h2,h3,h4,h5,h6) with styling', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
			);
	}


	function form( $instance ) {

		$heading 		= ! empty( $instance[ 'heading' ] ) ? $instance[ 'heading' ] : '';
		$heading_text   = ! empty( $instance[ 'heading_text' ] ) ? ($instance[ 'heading_text' ]) : '';
	
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>"><?php esc_html_e( 'Heading:', 'quail' ); ?></label> 
			<select name="<?php echo esc_attr( $this->get_field_name( 'heading' ) ); ?>" class="widefat" >
				<option  value="h1" <?php echo $heading == 'h1'?'selected':''; ?>>H1</option>
				<option  value="h2" <?php echo $heading == 'h2'?'selected':''; ?>>H2</option>
				<option  value="h3" <?php echo $heading == 'h3'?'selected':''; ?>>H3</option>
				<option  value="h4" <?php echo $heading == 'h4'?'selected':''; ?>>H4</option>
				<option  value="h5" <?php echo $heading == 'h5'?'selected':''; ?>>H5</option>
				<option  value="h6" <?php echo $heading == 'h6'?'selected':''; ?>>H6</option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading_text' ) ); ?>"><?php esc_html_e( 'Heading Text:', 'quail' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading_text' ) ); ?>" type="text" value="<?php echo esc_attr( $heading_text ); ?>">
		</p>

		
		<?php
	}


	function update( $new_instance, $old_instance ) {

		$instance 				  = $old_instance;
		$instance['heading'] 	  = ( isset( $new_instance['heading'] ) ) ? sanitize_text_field( $new_instance['heading'] ) : '';
		$instance['heading_text'] = ( isset( $new_instance['heading_text'] ) ) ? sanitize_text_field( $new_instance['heading_text'] ) : '';
		return $instance;

	}


	function widget( $widget_args, $instance ) {

		$heading 		= ( isset( $instance['heading'] ) ) ? $instance['heading'] : 'h1';
		$heading_text 	= ( isset( $instance['heading_text'] ) ) ? $instance['heading_text'] : __( 'Empty Heading' , 'quail' );
		
		if( isset($widget_args['before_widget'])){

			echo $widget_args['before_widget'];
		}

		?>
		<div class="quail-component quail-heading">

			<?php 


			echo '<'.$heading.'>'.esc_html($heading_text).'</'.$heading.'>';
			

			?>  

		</div>

		<?php

		if( isset($widget_args['after_widget'])){

			echo $widget_args['after_widget'];
		}
	}
}
endif;


if( ! function_exists( 'quail_widget_heading' ) ):

	/**
	* Register and load widget.
	*/
	function quail_widget_heading() {

		register_widget( 'Quail_Heading' );

	}

endif;
add_action( 'widgets_init', 'quail_widget_heading' );