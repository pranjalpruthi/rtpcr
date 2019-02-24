<?php
/**
 * Widget for recent post block
 * @package    	Quail
 * @link        https://bellathemes.com/
 * since 	    1.0.0
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
if( ! class_exists( 'Quail_Blog' ) ):
	/*
	 * Blog section
	 * Retrievs from post 
	 * @since 1.0.0
	 */
	class Quail_Blog extends WP_Widget{
			function __construct(){
				parent::__construct(
					'quail-blog', 
					esc_html__( 'Quail Blog', 'quail' ), 
					array( 'description' => esc_html__( 'Displays home page blog block', 'quail' ) , 'panels_groups' => array( 'themewidgets' ) )
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

				$before_title = isset( $args['before_title'] ) ? $args['before_title'] : '<h2>';
	            $after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '</h2>';
				$no 		= ( isset( $instance['no'] ) ) ? $instance['no'] : '3';

				if( isset($widget_args['before_widget'])){
					echo $widget_args['before_widget'];
				}
				?>
					<div class="quail-component quail-blog">
						<?php 
						$args = array('post_type' => 'post' , 'posts_per_page' => 3 );
						$loop = new WP_Query( $args );
						while( $loop->have_posts()):$loop->the_post();
						?>
								<div class="article-wrap">
									<?php if(has_post_thumbnail()):?>
										<div class="article-img-wrap">
											<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'quail-img-585-500' );?> </a>
										</div>
									<?php endif;?>
									
									
									<div class="blog-artical-content">
										<h3 class="blog-title">
											<a href="<?php the_permalink();?>" class="article-title-link">
										<?php the_title();?>
									</a>
								</h3>
								<div class="blog-para">
										<?php quail_post_excerpt();?>
										
									</div>
								<ul class="content-list-meta">
            						<li class="post-author"><?php quail_author();?> </li>
           							 <li class="post-posted"><?php quail_posted_on(); ?></li>
        						</ul>
									
									
								</div>
								</div>
								
					<?php endwhile;?>
				</div>
			
			<?php
			if( isset($widget_args['after_widget'])){
				
				echo $widget_args['after_widget'];
			}
			wp_reset_postdata();
		}
	}
endif;

if( ! function_exists( 'quail_widget_blog' ) ):
	/**
	 * Register and load widget.
	 */
	function quail_widget_blog() {
		
		register_widget( 'Quail_Blog' );
	}

endif;
add_action( 'widgets_init', 'quail_widget_blog' );