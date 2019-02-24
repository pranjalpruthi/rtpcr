<?php
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

   // font area 
    $wp_customize->add_section(
        'quail_fonts',
        array(
            'title' => __('Fonts Setting', 'quail'),
            'priority' => 19,
            'description' => __('Please take reference of google fonts: <a target="_blank" href="https://fonts.google.com/">google.com/fonts</a>', 'quail'),
        )
    );

    // default font name
    $wp_customize->add_setting('quail_font_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Theme font', 'quail'),
        'section' => 'quail_fonts',
        'settings' => 'quail_font_options[info]',
        'priority' => 10
        ) )
    ); 

    $wp_customize->add_setting(
        'body_font_url',
        array(
            'default' => 'https://fonts.googleapis.com/css?family=Poppins:400,600,900',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'body_font_url',
        array(
            'label' => __( 'Google font url & sets', 'quail' ),
            'description' => __( 'e.g. https://fonts.googleapis.com/css?family=Poppins:400,600,900', 'quail'),
            'section' => 'quail_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );

    // font family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => "'Poppins', sans-serif",
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Font family', 'quail' ),
            'section' => 'quail_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );

    // font sizes
    $wp_customize->add_setting('quail_font_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'quail'),
        'section' => 'quail_fonts',
        'settings' => 'quail_font_options[info]',
        'priority' => 16
        ) )
    );

    // site title font size
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );

    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'quail_fonts',
        'label'       => __('Site title', 'quail'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) ); 

    // site description font size
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );

    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'quail_fonts',
        'label'       => __('Site description', 'quail'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );  

    // main menu font size
    $wp_customize->add_setting(
        'menu_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );

    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'quail_fonts',
        'label'       => __('Menu items', 'quail'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) ); 

    

    // body text default font size
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16',
        )       
    );

    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'quail_fonts',
        'label'       => __('Paragraph font size', 'quail'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );
