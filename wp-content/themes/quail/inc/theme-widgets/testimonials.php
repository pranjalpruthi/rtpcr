<?php
/**
 * Widget for testimonials
 * @package    	 Quail
 * @link         https://bellathemes.com/
 * since 	     1.0.0
 * Author:       Quail
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 */
if( ! class_exists( 'Quail_Testimonials' ) ):
	/**
	 * Testimonials section
	 * Retrievs from testimonials custom post type 
	 * @since 1.0.0
	 */

	class Quail_Testimonials extends WP_Widget{

		function __construct(){
			parent::__construct(
				'quail-testimonials', 
				esc_html__( 'Quail Testimonials', 'quail' ), 
				array( 'description' => esc_html__( 'Displays testimonials carousel', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
				);
		}




		function form( $instance ) {

			$no 		= ! empty( $instance[ 'no' ] ) ? $instance[ 'no' ] : '';
			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'no' ) ); ?>"><?php esc_html_e( 'No of Testimonials ( Enter -1 to display all ):', 'quail' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'no' ) ); ?>" type="number" value="<?php echo esc_attr( $no ); ?>">
			</p>
			<?php
		}




		function update( $new_instance, $old_instance ) {

			$instance 				= $old_instance;
			$instance['no'] 		= ( isset( $new_instance['no'] ) ) ? sanitize_text_field( $new_instance['no'] ) : '';
			return $instance;
		}




		function widget( $widget_args, $instance ) {

			$before_title = isset( $args['before_title'] ) ? $args['before_title'] : '<h2>';
	        $after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '</h2>';
			$no 		= ( isset( $instance['no'] ) ) ? $instance['no'] : '-1';

			if( isset($widget_args['before_widget'])){
				echo $widget_args['before_widget'];
			}
			?>
			
				
				
				<div class="quail-component quail-testimonial">
					<div class="testimonialCarousel owl-carousel owl-theme">
						<?php
						$args = array( 'post_type' => 'testimonials' , 'posts_per_page' => $no);
						$loop = new WP_Query( $args );
						while( $loop->have_posts()):$loop->the_post();
								$name =  get_post_meta( get_the_ID() , 'bellakit-client-name' , true ) ;
						?>  
								<div class="item">
									
									<div class="tst-item-inner">
										<?php the_content();?>
										<div class="tst-item-img_meta">
											<div class="tst-item-img">
												<?php 
												if( has_post_thumbnail() ){
													the_post_thumbnail( 'thumbnail' );
												}else{
													echo '<img src="'.esc_url(get_template_directory_uri().'/assets/images/user-default.jpg').'" height="100" width="100" alt="">';
												}
												?>
											</div>
											<div class="tst-item-meta">
												<span class="name"><?php echo $name?$name:the_title();?></span>
											</div>
										</div>
									</div>
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
if( ! function_exists( 'quail_widget_testimonials' ) ):
	/**
	 * Register and load widget.
	 */
	function quail_widget_testimonials() {
		register_widget( 'Quail_Testimonials' );
	}
	
endif;
add_action( 'widgets_init', 'quail_widget_testimonials' );