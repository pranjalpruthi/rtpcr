<?php
/**
 * Widget for services
 *
 * @package     Quail
 * @link        https://bellathemes.com/
 * since 	    1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! class_exists( 'Quail_Services' ) ):

	/**
	 * Services section
	 * Retrievs from services custom post type 
	 * @since 1.0.0
	 */
	class Quail_Services extends WP_Widget{

		function __construct(){

			parent::__construct(
				'quail-services', 
				esc_html__( 'Quail Services', 'quail' ), 
				array( 'description' => esc_html__( 'Displays services', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
				);
		}




		function form( $instance ) {

			$no 		= ! empty( $instance[ 'no' ] ) ? $instance[ 'no' ] : '';

			?>
			

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'no' ) ); ?>"><?php esc_html_e( 'No of services ( Enter -1 to display all ):', 'quail' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no' ) ); ?>" type="number" value="<?php echo esc_attr( $no ); ?>">
			</p>

		
			<?php
		}




		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			$instance['no'] 		= ( isset( $new_instance['no'] ) ) ? sanitize_text_field( $new_instance['no'] ) : '';
			return $instance;

		}




		function widget( $widget_args, $instance ) {


			$no 		= ( isset( $instance['no'] ) ) ? $instance['no'] : '-1';
			
			if( isset($widget_args['before_widget'])){
				
				echo $widget_args['before_widget'];
			}
			?>
			

				<div class="quail-component quail-services">
					<?php 
					$args = array( 'post_type' => 'services' , 'posts_per_page' => $no );
					$loop = new WP_Query( $args );
					while( $loop->have_posts()): $loop->the_post();
					?>
						<div class="service-item">
							
								<div class="icon-holder">
									<i class="<?php echo get_post_meta( get_the_ID() , 'bellakit-service-icon' , true );?>"></i>
								</div> 
							
							<h4><?php the_title();?></h4>
							<?php 
							the_content();
							?>
							
						</div>
				<?php endwhile; ?>
			</div>
		

		<?php
		if( isset($widget_args['after_widget'])){

			echo $widget_args['after_widget'];
		}
		wp_reset_postdata();
	}
  }
endif;


if( ! function_exists( 'quail_widget_services' ) ) :

	/**
	 * Register and load widget.
	 */
	function quail_widget_services() {

	register_widget( 'Quail_Services' );

	}
	
endif;
add_action( 'widgets_init', 'quail_widget_services' );