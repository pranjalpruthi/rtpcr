<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Quail
 */

get_header(); 
$sidebar = quail_default_sidebar_pos();
$row = quail_grid_class( $sidebar );

?>
<?php get_template_part( 'template-parts/banner' );?>

<section id="postSingle" class="standard-view pd-t-100 pd-b-100">
    <div class="<?php echo quail_site_container();?> quail-page-content">
        <div class="<?php echo esc_attr($row);?>">
          
          <?php if( $sidebar == 'left' ):  get_sidebar();  endif; ?>     

            <div class="cols" >

                <div class="post-details">


                    <?php
                    while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'single' );
                    
                    if( 'post' == get_post_type() ){
                        
                      if( ! esc_attr( get_theme_mod( 'hide_meta_single' ) ) && ( 'post' == get_post_type() ) ):
                       
                       echo '<ul class="content-list-meta">';
                       echo '<li class="post-author">'; quail_author();          
                       echo '<li class="post-posted">'; quail_posted_on(); 
                       echo '</ul>';
                
                       endif;
                    
                   }

                    the_post_navigation( array( 'screen_reader_text' => '','prev_text'=> __('Previous' , 'quail') , 'next_text'=>__('Next' , 'quail' )) );

                  
                    
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

endwhile; // End of the loop.
?>




</div>

</div> 
  <?php if( $sidebar == 'right' ):  get_sidebar();  endif; ?>     
</div>
</div>
</section>

<?php

get_footer();
