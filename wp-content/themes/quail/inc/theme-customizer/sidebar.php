<?php 
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */ 

// sidebar area
 $wp_customize->add_panel( 'quail_sidebar_panel', array(
        'priority'       => 11,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Sidebar Setting', 'quail'),
    ) );



    // post sidebar position
    $wp_customize->add_section(
        'quail_sidebar_panel',
        array(
            'title'         => __('Sidebar', 'quail'),
            'priority'      => 10,
            'panel'         => 'quail_sidebar_panel', 
        )
    );

    // post archive sidebar position
    $wp_customize->add_setting(
        'sidebar_pos',
        array(
            'default'           => 'right',
            'sanitize_callback' => 'quail_sanitize_sidebar',
        )
    );

    $wp_customize->add_control(
        'sidebar_pos',
        array(
            'type'        => 'radio',
            'label'       => __('Sidebar Position', 'quail'),
            'section'     => 'quail_sidebar_panel',
            'description' => '',
            'choices' => array(
                'none'    => __('No sidebar', 'quail'),
                'right'     => __('Right sidebar', 'quail'),
                'left'=> __('Left sidebar', 'quail')
            ),
        )
    );

    
    


    


    


    /**
    * Sanitazation 
    */

    // sidebar position
    function quail_sanitize_sidebar( $input ) {
        $valid = array(
                    'none'    => __('No sidebar', 'quail'),
                    'right'     => __('Right sidebar', 'quail'),
                    'left'=> __('Left sidebar', 'quail')
        );
     
        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {

            return '';
        }
    }

    // sidebar id
    function quail_sanitize_sidebar_id( $input ) {
        $valid = quail_sidebars();
     
        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {

            return '';
        }
    }

