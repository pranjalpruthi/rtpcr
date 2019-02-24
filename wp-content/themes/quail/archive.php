<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quail
 */

get_header(); 

$sidebar = quail_default_sidebar_pos();

$row = quail_grid_class( $sidebar );

?>

<?php get_template_part( 'template-parts/banner' );?>

    <section id="quail-list" class="quail-blog-list article-main post-<?php echo quail_blog_layout()?>-view pd-t-100 pd-b-100">
    	<div class="<?php echo quail_site_container();?> quail-page-content">
 

    		<div class="<?php echo esc_attr($row);?>">  
            
              
              <?php if( $sidebar == 'left' ):  get_sidebar();  endif; ?>        
                
    			<div class="cols">

                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                ?> 
                
    				
    				 <?php 
    				 if ( have_posts() ) :
	    				 /* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-'.quail_blog_layout(), get_post_format() );

						endwhile;

                         do_action('quail_posts_navigation'); 
						
					else :

					get_template_part( 'template-parts/content', 'none' );

					endif; ?>
    				 
    			
    			</div>
                <?php if( $sidebar == 'right' ):  get_sidebar();  endif; ?>   
    		</div>
    	</div>
    </section>
<?php

get_footer();