<?php 
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
    
    // footer area
    $wp_customize->add_section(
        'quail_footer',
        array(
            'title'         => __('Footer Setting', 'quail'),
            'priority'      => 18,
        )
    );

    // footer widget ares
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '4',
            'sanitize_callback' => 'quail_sanitize_footer_widget',
        )
    );

    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'quail'),
            'section'     => 'quail_footer',
            'description' => __('No. of widget area on footer. You can add widgets on each column from Widgets section.', 'quail'),
            'choices' => array(
                '1'     => __('One Column', 'quail'),
                '2'     => __('Two Column', 'quail'),
                '3'     => __('Three Column', 'quail'),
                '4'     => __('Four Column', 'quail'),
            ),
        )
    );

    // footer copyright text
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => __('Copyright Quail. All rights reserved.','quail'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'footer_copyright',
        array(
            'type'        => 'text',
            'label'       => __('Footer copyright', 'quail'),
            'section'     => 'quail_footer',
            'description' => __('Enter copyright text', 'quail'),
        )
    );


/**
 * Sanitazation 
 */

    // footer widget areas
    function quail_sanitize_footer_widget( $input ) {
        $valid = array(
            '1'     => __('One Column', 'quail'),
            '2'     => __('Two Column', 'quail'),
            '3'     => __('Three Column', 'quail'),
            '4'     => __('Four Column', 'quail')
        );
        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {

            return '';
        }
    }