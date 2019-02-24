<?php

function quail_components_widget_init() { 

register_sidebar( array(
        'name'          => esc_html__( 'Default Sidebar', 'quail' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'quail' ),
        'before_widget' => '<div id="%1$s" class="thumb-posts flex-box %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );


}
add_action( 'widgets_init', 'quail_components_widget_init' );