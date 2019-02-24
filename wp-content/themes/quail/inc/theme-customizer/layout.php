<?php 
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

    // page layout 
    $wp_customize->add_panel( 'quail_site_layout_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Layout Setting', 'quail'),
    ) );

    // layout type
    $wp_customize->add_section(
        'quail_layout_type',
        array(
            'title'         => __('Layout Setting', 'quail'),
            'priority'      => 10,
            'panel'         => 'quail_site_layout_panel', 
        )
    );

    $wp_customize->add_setting(
        'site_layout_type',
        array(
            'default'           => 'full-width-layout',
            'sanitize_callback' => 'quail_sanitize_site_layout',
        )
    );

    $wp_customize->add_control(
        'site_layout_type',
        array(
            'type'        => 'radio',
            'label'       => __('Layout', 'quail'),
            'section'     => 'quail_layout_type',
            'description' => __('Select page layout', 'quail'),
            'choices' => array(
                'full-width-layout'    => __('Full Width / Fluid', 'quail'),
                'box-layout'          => __('Boxed', 'quail'),
               
            ),
        )
    );


/**
 * sanitization
 */

    //site layout
    function quail_sanitize_site_layout( $input ) {
        $valid = array(
            'full-width-layout'    => __('Full Width', 'quail'),
                    'box-layout'     => __('Boxed', 'quail'),
                    'left-header-layout'     => __('Left Menu', 'quail'),
                    'right-header-layout'     => __('Right Menu', 'quail'),
        );
        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {
            
            return '';
        }
    }
