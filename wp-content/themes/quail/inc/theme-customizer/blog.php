<?php
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Quail
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

   // blog area
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog Setting', 'quail'),
            'priority' => 19,
        )
    );

    // blog layout
    $wp_customize->add_setting('quail_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 'layout', array(
        'label' => __('Post Layout', 'quail'),
        'section' => 'blog_options',
        'settings' => 'quail_blog_options[info]',
        'priority' => 10
        ) )
    ); 

    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'list',
            'sanitize_callback' => 'quail_sanitize_blog',
        )
    );

    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Choose a layout', 'quail'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(               
                'list'          => __( 'List', 'quail' )              
            ),
        )
    ); 
   

    
    // content / excerpt
    $wp_customize->add_setting('quail_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 'content', array(
        'label' => __('Post content/excerpt', 'quail'),
        'section' => 'blog_options',
        'settings' => 'quail_blog_options[info]',
        'priority' => 13
        ) )
    );

    $wp_customize->add_setting(
      'full_content_home',
      array(
        'sanitize_callback' => 'quail_sanitize_checkbox',
        'default' => 0,     
      )   
    );

    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Display full content on home page', 'quail'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );

    $wp_customize->add_setting(
      'full_content_archives',
      array(
        'sanitize_callback' => 'quail_sanitize_checkbox',
        'default' => 0,     
      )   
    );

    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type'      => 'checkbox',
            'label'     => __('Display full content on all archives.', 'quail'),
            'section'   => 'blog_options',
            'priority'  => 15,
        )
    ); 

    // excerpt length
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )       
    );

    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Post excerpt length', 'quail'),
        'description' => __('Default: 20 words', 'quail'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );


    // post meta
    $wp_customize->add_setting('quail_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 'meta', array(
        'label' => __('Post meta', 'quail'),
        'section' => 'blog_options',
        'settings' => 'quail_blog_options[info]',
        'priority' => 17
        ) )
    ); 

    // hide meta on index / archive
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'sanitize_callback' => 'quail_sanitize_checkbox',
        'default' => 0,     
      )   
    );

    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Don\'t show  meta on index/archive', 'quail'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );

    // hide meta on single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
        'sanitize_callback' => 'quail_sanitize_checkbox',
        'default' => 0,     
      )   
    );

    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Don\'t show  meta on single', 'quail'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );

    

    


/**
 * sanitization 
 */
    // blog layout
    function quail_sanitize_blog( $input ) {
        $valid = array(
            'list'       => __( 'List', 'quail' ),
       );

        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {

            return '';
        }
    }