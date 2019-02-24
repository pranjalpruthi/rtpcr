<?php
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
       
    // header area
    $wp_customize->add_panel( 'quail_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header Setting', 'quail'),
    ) );

    // header type
    $wp_customize->add_section(
        'quail_header_type',
        array(
            'title'         => __('Header type', 'quail'),
            'priority'      => 10,
            'panel'         => 'quail_header_panel', 
        )
    );
    
   // menu style
    $wp_customize->add_section(
        'quail_menu_type',
        array(
            'title'         => __('Header style', 'quail'),
            'priority'      => 99,
            'panel'         => 'quail_header_panel', 
        )
    );
    
    // sticky menu
    $wp_customize->add_setting(
        'menu_type',
        array(
            'default'           => 'sticky-header',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'quail_sanitize_header_type',
        )
    );

    $wp_customize->add_control(
        'menu_type',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Header Style', 'quail'),
            'section' => 'quail_menu_type',
            'choices' => array(
                'sticky-header'   => __('Sticky', 'quail'),
                'static-header'   => __('Static', 'quail')
                
            ),
        )
    );

    // menu display type
    $wp_customize->add_setting(
        'menu_display',
        array(
            'default'           => 'menu-inline',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'quail_sanitize_menu_display',
        )
    );

    $wp_customize->add_control(
        'menu_display',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Menu / Logo Alignment', 'quail'),
            'section'   => 'quail_menu_type',
            'choices'   => array(
                'menu-inline'     => __('Inline', 'quail'),
                'menu-center'   => __('Centered', 'quail'),
            ),
        )
    );


    /**
     * Sanitazation 
     */

    // menu type
    function quail_sanitize_header_type( $input ) {
        $valid = array(
                    'sticky-header'     => __('Sticky', 'quail'),
                    'static-header'     => __('Static', 'quail'),
                    
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }

    // menu display type
    function quail_sanitize_menu_display( $input ) {
        $valid = array(
            'menu-inline'     => __('Inline', 'quail'),
                    'menu-center'   => __('Centered', 'quail'),
        );
        if ( array_key_exists( $input, $valid ) ) {
            return $input;
        } else {
            return '';
        }
    }