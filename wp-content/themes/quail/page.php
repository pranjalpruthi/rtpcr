<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quail
 */

get_header();

$sidebar = quail_default_sidebar_pos();
$row = quail_grid_class( $sidebar );

?>
 <?php get_template_part('template-parts/banner');?>


 <section class="quail-hl-para inner-page">
  
   
    
      <div class="<?php echo quail_site_container();?> quail-page-content">
      <div class="<?php echo esc_attr($row);?>">
         <?php if( $sidebar == 'left' ):  get_sidebar();  endif; ?>   
      <div class="cols">
        <?php
        while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
?>

</div>
<?php if( $sidebar == 'right' ):  get_sidebar();  endif; ?>  
</div>

</div>
 

</section>
  

<?php

get_footer();
