<?php
/**
 * Widget for team
 * @package    	Quail
 * @link        https://bellathemes.com/
 * since 	    1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! class_exists( 'Quail_Team' ) ): 

	/**
	 * Team section
	 * Retrievs from team custom post type 
	 * @since 1.0.0
	 */
	class Quail_Team extends WP_Widget{
		
		function __construct(){

			parent::__construct(
				'quail-team', 
				esc_html__( 'Quail Team', 'quail' ), 
				array( 'description' => esc_html__( 'Displays team carousel', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
				);
		}


		function form( $instance ) {

			$no 		= ! empty( $instance[ 'no' ] ) ? $instance[ 'no' ] : '';

			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'no' ) ); ?>"><?php esc_html_e( 'No of Team ( Enter -1 to display all ):', 'quail' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no' ) ); ?>" type="number" value="<?php echo esc_attr( $no ); ?>">
			</p>

			


		



		<?php
		}


		function update( $new_instance, $old_instance ){

			$instance 				= $old_instance;
			$instance['no'] 		= ( isset( $new_instance['no'] ) ) ? sanitize_text_field( $new_instance['no'] ) : '';
			return $instance;
		}


		function widget( $widget_args, $instance ) {

			
			$no 		= ( isset( $instance['no'] ) ) ? $instance['no'] : '-1';
			
			if( isset($widget_args['before_widget'])){

				echo $widget_args['before_widget'];
			}
			?>

				<div class="quail-component quail-team">
					<div class="teamCarousel owl-carousel owl-theme">

						<?php 
						$args  = array( 'post_type' => 'team' , 'posts_per_page' => $no );
						$loop = new WP_Query( $args );
						while( $loop->have_posts()):$loop->the_post();
						?> 
							<div class="item">
								<div class="person-img">
								<?php the_post_thumbnail('quail-img-585-500');?>
								</div>
								<div class="name">
									<?php the_title();?>
								</div>
								<div class="position"><?php echo get_post_meta( get_the_ID(), 'bellakit-team-designation', true ) ;?></div>
							</div>
					<?php endwhile; ?>

				</div>
			</div>

		

		<?php
		if( isset($widget_args['after_widget'])){

			echo $widget_args['after_widget'];
		}
		wp_reset_postdata();
	}
}
endif;


if( ! function_exists( 'quail_widget_team' ) ):

	/**
	* Register and load widget.
	*/
	function quail_widget_team() {

		register_widget( 'Quail_Team' );

	}

endif;
add_action( 'widgets_init', 'quail_widget_team' );