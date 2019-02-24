<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Quail
 */
$sidebar_bg = esc_attr( get_theme_mod('sidebar_background') );
?>

<div class="cols is-sidebar secondary <?php echo quail_get_sidebar_id(); if( $sidebar_bg ){ echo 'hassidebar_bg';}?>">
<?php 
dynamic_sidebar( 'sidebar-1' ); ?>
</div>