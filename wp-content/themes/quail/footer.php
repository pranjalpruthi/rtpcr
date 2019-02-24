<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quail
 */

?>
  
   </div>  

    <!--Footer component-->
    <section id="footer" class="quail-footer">
        
        <div class="<?php echo quail_site_container();?>">

                            
                <?php if ( is_active_sidebar( 'quail-footer-1' ) ) : ?>

                    <?php get_template_part( 'template-parts/footer' , 'sidebar' ); ?>

                <?php endif; ?>

        </div>

        <div class="copyright-bottom">
        <?php echo quail_copyright_text();?>  
        <span> | </span>     
        <?php  echo sprintf( esc_html__( 'Theme %s', 'quail' ), '<a target="_blank" rel="designer" href="https://bellathemes.com/">' . esc_html__( 'Quail', 'quail' ) . '</a>' ); ?>     
        </div>
    </section>
    <!--Ends-->
      
<?php wp_footer(); ?>

</body>
</html>



