<?php
/**
 * Widget for cta button
 * @package     Quail
 * @link        https://bellathemes.com/
 * since 	   1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! class_exists( 'Quail_Button' ) ):

	/**
	 * cta button
	 * @since 1.0.0
	 */
	class Quail_Button extends WP_Widget{

		function __construct(){

			parent::__construct(
				'quail-cta', 
				esc_html__( 'Quail CTA Button', 'quail' ), 
				array( 'description' => esc_html__( 'Accepts Label and url for CTA button', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
				);
		}




		function form( $instance ) {

			$cta_label = ! empty( $instance[ 'cta_label' ] ) ? esc_attr( $instance[ 'cta_label' ] ) : '';
			$cta_url   = ! empty( $instance[ 'cta_url' ] ) ? esc_url($instance[ 'cta_url' ] ) : '';

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cta_label' ) ); ?>"><?php esc_html_e( 'CTA Label:', 'quail' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_label' ) ); ?>" type="text" value="<?php echo esc_attr( $cta_label ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cta_url' ) ); ?>"><?php esc_html_e( 'CTA URL:', 'quail' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_url' ) ); ?>" type="text" value="<?php echo esc_url( $cta_url ); ?>">
			</p>
			<?php
		}




		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			$instance['cta_label'] = ( isset( $new_instance['cta_label'] ) ) ? sanitize_text_field( $new_instance['cta_label'] ) : '';
			$instance['cta_url']   = ( isset( $new_instance['cta_url'] ) ) ? esc_url_raw( $new_instance['cta_url'] ) : '';
			return $instance;

		}




		function widget( $widget_args, $instance ) {

			$cta_label  = ( isset( $instance['cta_label'] ) )? $instance['cta_label'] : '';
			$cta_url 	= ( isset( $instance['cta_url'] ) ) ?  $instance['cta_url'] : '';

			if( isset($widget_args['before_widget'])){

				echo $widget_args['before_widget'];
			}

			?>

			<div class="quail-component quail-cta">

				<?php if( $cta_label): ?>

					<a href="<?php echo esc_url($cta_url); ?>" class="def-btn"><?php echo esc_html($cta_label);?></a>
					
				<?php endif; ?>

			</div>

			<?php
			if( isset($widget_args['after_widget'])){

				echo $widget_args['after_widget'];
			}
		}
	}

endif;


if( ! function_exists( 'quail_widget_cta' ) ):

	/**
	 * Register and load widget.
	 */
	function quail_widget_cta() {
		
		register_widget( 'Quail_Button' );

	}
endif;
add_action( 'widgets_init', 'quail_widget_cta' );