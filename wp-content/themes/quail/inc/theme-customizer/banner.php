<?php 
/**
 * Customizer options
 * @package     Quail
 * @link        https://bellathemes.com/
 * since        1.0.0
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
  
  /**
   * Banner type settings 
   */   

    // banner area
        $wp_customize->add_panel( 'quail_banner_panel', array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __('Banner Setting', 'quail'),
        ) );

    // banner type
    $wp_customize->add_section(
        'quail_banner_panel',
        array(
            'title'         => __('Banner type', 'quail'),
            'priority'      => 10,
            'panel'         => 'quail_banner_panel', 
        )
    );

    // front page banner type
    $wp_customize->add_setting(
        'front_banner_type',
        array(
            'default'           => 'slider-banner',
            'sanitize_callback' => 'quail_sanitize_banner_type',
        )
    );

    $wp_customize->add_control(
        'front_banner_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page banner', 'quail'),
            'section'     => 'quail_banner_panel',
            'choices' => array(
                'slider-banner'    => __('Full screen slider', 'quail'),
                'image-banner'     => __('Image banner', 'quail'),
                'no-banner'   => __('No banner', 'quail')
            ),
        )
    );

    // inner page banner type
    $wp_customize->add_setting(
        'site_banner_type',
        array(
            'default'           => 'image-banner',
            'sanitize_callback' => 'quail_sanitize_banner_type',
        )
    );

    $wp_customize->add_control(
        'site_banner_type',
        array(
            'type'        => 'radio',
            'label'       => __('Inner page banner', 'quail'),
            'section'     => 'quail_banner_panel',
            'choices' => array(
                'slider-banner'    => __('Full screen slider', 'quail'),
                'image-banner'     => __('Image banner', 'quail'),
                'no-banner'   => __('No banner', 'quail')
            ),
        )
    );    


/**
 *Slider settings 
 */

 // slider area
    $wp_customize->add_section(
        'quail_slider',
        array(
            'title'         => __('Banner slides', 'quail'),
            'description'   => __('You can add up to 3 slides. For more slides or to use shortcode from third party slider plugin please upgrade to pro.', 'quail'),
            'priority'      => 11,
            'panel'         => 'quail_banner_panel',
        )
    );
    

    /**
     * slider Images 
     */

  // slide 1
    $wp_customize->add_setting('quail_slider_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 's1', array(
        'label' => __('First slide', 'quail'),
        'section' => 'quail_slider',
        'settings' => 'quail_slider_options[info]',
        'priority' => 10
        ) )
    ); 

    $wp_customize->add_setting(
        'slider_image_1',
        array(
            'default' => get_template_directory_uri().'/assets/images/slider1.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_1',
            array(
               'label'          => __( 'Slider image 1', 'quail' ),
               'type'           => 'image',
               'section'        => 'quail_slider',
               'settings'       => 'slider_image_1',
               'priority'       => 11,
            )
        )
    );

   
    $wp_customize->add_setting(
        'slider_title_1',
        array(
            'default' => __('Lorem ipsum dolor','quail'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_title_1',
        array(
            'label' => __( 'First slide title', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 12
        )
    );
    
    $wp_customize->add_setting(
        'slider_subtitle_1',
        array(
            'default' => __('Nulla tempor et est in suscipit. Vivamus ut augue euismod urna dapibus ','quail'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_subtitle_1',
        array(
            'label' => __( 'First slide subtitle', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 13
        )
    );  

    $wp_customize->add_setting(
        'slider_cta_1_label',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_cta_1_label',
        array(
            'label' => __( 'First slide CTA label', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 13
        )
    ); 

    $wp_customize->add_setting(
        'slider_cta_1_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'slider_cta_1_url',
        array(
            'label' => __( 'First slide CTA url', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 13
        )
    ); 

   
    // slide 2
    $wp_customize->add_setting('quail_slider_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 's2', array(
        'label' => __('Second slide', 'quail'),
        'section' => 'quail_slider',
        'settings' => 'quail_slider_options[info]',
        'priority' => 14
        ) )
    );  

    $wp_customize->add_setting(
        'slider_image_2',
        array(
            'default' => get_template_directory_uri().'/assets/images/slider2.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_2',
            array(
               'label'          => __( 'Slider image 2', 'quail' ),
               'type'           => 'image',
               'section'        => 'quail_slider',
               'settings'       => 'slider_image_2',
               'priority'       => 15,
            )
        )
    );
   
    $wp_customize->add_setting(
        'slider_title_2',
        array(
            'default' => __('Lorem ipsum dolor sit amet','quail'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_title_2',
        array(
            'label' => __( 'Second slide title', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 16
        )
    );
    
    $wp_customize->add_setting(
        'slider_subtitle_2',
        array(
            'default' => __('Sed pretium risus id lorem eleifend vehicula Nulla nec','quail'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_subtitle_2',
        array(
            'label' => __( 'Second slide subtitle', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 17
        )
    );   

   
    $wp_customize->add_setting(
        'slider_cta_2_label',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_cta_2_label',
        array(
            'label' => __( 'Second slide CTA Label', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 17
        )
    ); 

    $wp_customize->add_setting(
        'slider_cta_2_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'slider_cta_2_url',
        array(
            'label' => __( 'Second slide CTA URL', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 17
        )
    ); 

   // slide 3
    $wp_customize->add_setting('quail_slider_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',            
        )
    );

    $wp_customize->add_control( new quail_Info( $wp_customize, 's3', array(
        'label' => __('Third slide', 'quail'),
        'section' => 'quail_slider',
        'settings' => 'quail_slider_options[info]',
        'priority' => 18
        ) )
    ); 

    $wp_customize->add_setting(
        'slider_image_3',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_image_3',
            array(
               'label'          => __( 'Slider image 3', 'quail' ),
               'type'           => 'image',
               'section'        => 'quail_slider',
               'settings'       => 'slider_image_3',
               'priority'       => 19,
            )
        )
    );

    $wp_customize->add_setting(
        'slider_title_3',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_title_3',
        array(
            'label' => __( 'Third slide title', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 20
        )
    );
    
    $wp_customize->add_setting(
        'slider_subtitle_3',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_subtitle_3',
        array(
            'label' => __( 'Third slide subtitle', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 21
        )
    );            

    $wp_customize->add_setting(
        'slider_cta_3_label',
        array(
            'default' => __('Click here','quail'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'slider_cta_3_label',
        array(
            'label' => __( 'Third slide CTA label', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 22
        )
    ); 

    $wp_customize->add_setting(
        'slider_cta_3_url',
        array(
            'default' => __('#about','quail'),
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'slider_cta_3_url',
        array(
            'label' => __( 'Third slide CTA URL', 'quail' ),
            'section' => 'quail_slider',
            'type' => 'text',
            'priority' => 23
        )
    ); 



/**
 * Header Setting 
 */

    // inner page image banner height
    $wp_customize->add_setting(
        'header_height',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '350',
        )       
    );

    $wp_customize->add_control( 'header_height', array(
        'type'        => 'number',
        'priority'    => 11,
        'section'     => 'header_image',
        'label'       => __('Banner image height', 'quail'),
        'input_attrs' => array(
            'min'   => 250,
            'max'   => 600,
            'step'  => 5,
        ),
    ) );

    // banner overlay
    $wp_customize->add_setting(
        'hide_overlay',
        array(
            'sanitize_callback' => 'quail_sanitize_checkbox',
        )       
    );

    $wp_customize->add_control(
        'hide_overlay',
        array(
            'type'      => 'checkbox',
            'label'     => __('Disable banner overlay', 'quail'),
            'section'   => 'header_image',
            'priority'  => 12,
        )
    );   




/**
 *sanitization 
 */
    // banner type
    function quail_sanitize_banner_type( $input ) {

        $valid = array(
                    'slider-banner'    => __('Full screen slider', 'quail'),
                    'image-banner'     => __('Image banner', 'quail'),
                    'no-banner'   => __('No banner', 'quail')
        );
     
        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {

            return '';
        }
    }



    // checkboxes
    function quail_sanitize_checkbox( $input ) {
        if ( $input == 1 ) {

            return 1;

        } else {

            return '';
        }
    }



    // menu type
    /*function quail_sanitize_menu_type( $input ) {

        $valid = array(
                    'sticky-header'    => __('Sticky', 'quail'),
                    'image-banner'     => __('Image banner', 'quail'),
                    'absolute-header'  => __('Absolute', 'quail'),
                    'fixed-header'     => __('Fixed', 'quail'),
        );
        if ( array_key_exists( $input, $valid ) ) {

            return $input;

        } else {

            return '';
        }
    } */