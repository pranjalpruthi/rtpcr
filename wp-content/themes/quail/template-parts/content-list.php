<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quail
 */


?>
<div  id="post-<?php the_ID(); ?>" <?php post_class('post-wrap'); ?>>
    <div class="article-wrap flex-box">
        
            <?php if( quail_feat_image() ):?>
                <div class="article-img-wrap">
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('quail-img-525-350'); ?></a>
                </div>
            <?php endif; ?>
                    
        <div class="post-summary <?php if( ! quail_feat_image()) echo 'full-width';?>">
            <?php if( ! esc_attr( get_theme_mod( 'hide_meta_index' ) )  && ( 'post' == get_post_type() ) ):?>
                                              
                
            <?php endif;?>
            <h4 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
            <?php quail_post_excerpt(); ?>
            <a href="<?php the_permalink();?>" class="custom-btn light-grey-btn detail-link"><?php esc_html_e('Details' , 'quail' );?></a>

            <ul class="content-list-meta">
            <li class="post-author"><?php quail_author();?> </li>
            <li class="post-posted"><?php quail_posted_on(); ?></li>
        </ul>
        </div>

        
    </div>
</div>          

