<?php
/**
 * Template part banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quail
 */


 $front_banner = quail_front_banner_type();
 
 $site_banner = quail_site_banner_type(); 

 if( ( is_front_page() || is_home() )  ){ 

    if( $front_banner == 'slider-banner' ){

      quail_banner_slider();

    }else if( $front_banner == 'video-banner' ){

      quail_banner_video();

    }else if(  $front_banner == 'image-banner' ){

      quail_banner_image();
    }
  
 }else{

    if( $site_banner == 'slider-banner' ){ 

      quail_banner_slider();
    }
    else if( $site_banner == 'video-banner' ){

      quail_banner_video();
    }
    else if(  $site_banner == 'image-banner' ){

      quail_banner_image();
    }
    
 
 }