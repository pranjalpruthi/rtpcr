<?php
/**
 * Quail Theme Customizer
 *
 * @package Quail
 */

   

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function quail_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'refresh';

	
	$wp_customize->get_section( 'title_tagline' )->title = __('Site name, tagline and logo', 'quail');
	$wp_customize->get_section( 'header_image' )->title = __('Add media' , 'quail');
	$wp_customize->get_section( 'title_tagline' )->priority = '5';
	$wp_customize->get_section( 'title_tagline' )->panel = 'quail_header_panel';
	$wp_customize->get_section( 'header_image' )->panel = 'quail_banner_panel';
	$wp_customize->get_section( 'colors' )->title = __('General', 'quail');
    $wp_customize->get_section( 'colors' )->panel = 'quail_colors_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'quail_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'quail_customize_partial_blogdescription',
		) );
	}

	 class quail_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3>
            <?php echo esc_html( $this->label ); ?>
            </h3>
        <?php
        }
    } 
    require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/layout.php';
    require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/header.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/banner.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/footer.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/fonts.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/blog.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/sidebar.php';
	require_once trailingslashit( get_template_directory() ) . '/inc/theme-customizer/color.php';

	// Load Upgrade to Pro control.
	 require_once trailingslashit( get_template_directory() ) . '/inc/theme-upgrade/control.php';

	// Register custom section types.
	$wp_customize->register_section_type( 'quail_Customize_Section_Upsell' );
	// Register sections.
	$wp_customize->add_section(
		new quail_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Quail', 'quail' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'quail' ),
				'pro_url'  => 'https://bellathemes.com/downloads/quail-pro/',
				'priority'  => 1,
			)
		)
	);

}
add_action( 'customize_register', 'quail_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function quail_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function quail_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function quail_customize_preview_js() {
	wp_enqueue_script( 'quail-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'quail_customize_preview_js' );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.7
 */
function quail_customizer_control_scripts() {

  wp_enqueue_script( 'quail-customize-controls', get_template_directory_uri() . '/inc/theme-upgrade/customize-controls.js', array( 'customize-controls' ) );

  wp_enqueue_style( 'quail-customize-controls', get_template_directory_uri() . '/inc/theme-upgrade/customize-controls.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'quail_customizer_control_scripts', 0 );
