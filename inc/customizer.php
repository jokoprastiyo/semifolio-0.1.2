<?php
/**
 * Semifolio Theme Customizer
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function semifolio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
 
/**
* Remove setting & control
*/
	$wp_customize->remove_setting( 'display_header_text' );
	$wp_customize->remove_control( 'display_header_text' );
              $wp_customize->remove_section( 'color' );
              $wp_customize->remove_setting( 'header_textcolor' );
              $wp_customize->remove_control( 'header_textcolor' );
   
    /**
    * Textarea customize control class.
    */
if ( class_exists( 'WP_Customize_Control' ) ) :
    class Semifolio_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
        public function render_content() {
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label ); ?></span>
                <textarea rows= "5" style="width:100%;"<?php $this->link(); ?>><?php echo esc_textarea($this->value() ); ?></textarea>
        </label>
        <?php
        }
    }
endif;
 
    /**
    * Text attribute customize control class.
    */
if ( class_exists( 'WP_Customize_Control' ) ) :
    class Semifolio_Customize_Info_Control extends WP_Customize_Control {
        public $type = 'info';
        public function render_content() {
?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label ); ?></span>
            <span <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></span>
        </label>
    <?php
    }
}
endif;
 

/*----------------------------------------------------------------------------------------*/
/* Blog Options. 
/*----------------------------------------------------------------------------------------*/
    $wp_customize->add_section('semifolio_blog_options', array(
        'title'    => __('Blog Options', 'semifolio'),
        'description' => '',
        'priority' => 1,
    ));
 
    // Display Popular Post
    $wp_customize->add_setting('semifolio_display_popular_post_setting', array(
        'default'        => 0,
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_checkbox',
    ));
    $wp_customize->add_control('popular_post', array(
        'label'      => __('Do You want to display popular post?', 'semifolio'),
        'section'    => 'semifolio_blog_options',
        'settings'   => 'semifolio_display_popular_post_setting',
        'type'       => 'checkbox',
        'priority'   => 1,
    ));
 
    // Display Slideshow
    $wp_customize->add_setting('semifolio_display_portfolio_setting', array(
        'default' => 0,
        'capability' => 'edit_theme_options',
        'type'          => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'semifolio_sanitize_checkbox',
    ));
    $wp_customize->add_control('portfolio_post', array(
        'settings' => 'semifolio_display_portfolio_setting',
        'label'    => __('Do You want to display portfolio post?', 'semifolio'),
        'section'  => 'semifolio_blog_options',
        'type'     => 'checkbox',
        'priority'   => 2,
    ));
 
    // Post Type Portfolio
    $wp_customize->add_setting('semifolio_posttype_portfolio',array(
        'default' => 'page',
        'capability'     => 'edit_theme_options',
        'type'          => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ) );
    $wp_customize ->add_control(new Semifolio_Customize_Textarea_Control($wp_customize, 'posttype_portfolio', array(
        'label' => __('Input post type just for custom post portfolio, separated by commas if use more than one of post type. This support post type from plugin installed. Example: ( default blog: "post", "page" )', 'semifolio'),
        'section' => 'semifolio_blog_options',
        'settings' => 'semifolio_posttype_portfolio',
        'type' => 'textarea',
        'priority'   => 3,
    ) ) );
 
/*----------------------------------------------------------------------------------------*/
/* Layout Options Section 
/*----------------------------------------------------------------------------------------*/
  $wp_customize->add_section('semifolio_layout_options', array(
        'title'    => __('Layout Options', 'semifolio'),
        'description' => '',
        'priority' => 2,
    ));
 
    // Display Favicon
    $wp_customize->add_setting('semifolio_display_favicon_icon', array(
        'default' => 0,
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'semifolio_sanitize_checkbox',
    ));
    $wp_customize->add_control('display_favicon_icon', array(
        'settings' => 'semifolio_display_favicon_icon',
        'label'    => __('Do you want to display favicon?', 'semifolio'),
        'section'  => 'semifolio_layout_options',
        'type'     => 'checkbox',
        'priority'   => 1,
    ));
 
    // Upload Favicon Icon
    $wp_customize->add_setting('semifolio_upload_favicon_icon', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_favicon_icon', array(
        'label'    => __('Upload Favicon:', 'semifolio'),
        'section'  => 'semifolio_layout_options',
        'settings' => 'semifolio_upload_favicon_icon',
        'priority'   => 2,
    )));
 
    // Upload Header Ads Image
    $wp_customize->add_setting('semifolio_upload_header_ads', array(

        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_header_ads', array(

        'label'    => __('Upload Header Ads Image:', 'semifolio'),
        'section'  => 'semifolio_layout_options',
        'settings' => 'semifolio_upload_header_ads',
        'priority'   => 3,
    )));
    // Header Ads URL
    $wp_customize->add_setting('semifolio_header_ads_url',array(

        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ) );
    $wp_customize ->add_control(new Semifolio_Customize_Textarea_Control($wp_customize, 'header_ads_url', array(

        'label' => __('Input Full URL Header Ads', 'semifolio'),
        'section' => 'semifolio_layout_options',
        'settings' => 'semifolio_header_ads_url',
        'type' => 'textarea',
        'priority'   => 4,
    ) ) );
 
    // Display Footer Widget
    $wp_customize->add_setting('semifolio_display_footer_widget', array(
        'default'     => 0,
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'     => 'semifolio_sanitize_checkbox',
    ));
    $wp_customize->add_control('display_footer_widget', array(
        'settings' => 'semifolio_display_footer_widget',
        'label'    => __('Do You want to display Footer Widget?', 'semifolio'),
        'section'  => 'semifolio_layout_options',
        'type'     => 'checkbox',
        'priority'   => 5,
    ));
 
    // Footer Tagline
    $wp_customize->add_setting('semifolio_footer_tagline', array(
        'default'           => '' . __('Change the tagline about your site, which will display on the bottom section of the footer. This section supports html tags if desired. The text is wrapped in a paragraph element for formatting. <a href="' . esc_url( __('http://generasite.tk/', 'semifolio') ) . '">Upgrade Now!</a>', 'semifolio') . '',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ));
    $wp_customize->add_control( new Semifolio_Customize_Info_Control($wp_customize, 'footer_tagline', array(
        'label'    => __('Footer Bottom Tagline', 'semifolio'),
        'section'  => 'semifolio_layout_options',
        'settings' => 'semifolio_footer_tagline',
        'type' => 'info',
        'priority'   => 6,
    )));
 
/*----------------------------------------------------------------------------------------*/
/* Images Resize Section 
/*----------------------------------------------------------------------------------------*/
$wp_customize->add_section('semifolio_images_resize_section', array(
        'title'    => __('Images Resize', 'semifolio'),
        'description' => 'Semifolio PRO Support Only!',
        'priority' => 3,
    ));
 
    // PRO Options
    $wp_customize->add_setting('semifolio_images_resize', array(
        'default'           => '' . __('Allows you to change the size of images in posts on every page of your blog. <a href="' . esc_url( __('http://generasite.tk/', 'semifolio') ) . '">Upgrade Now!</a>', 'semifolio') . '',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ));
    $wp_customize->add_control( new Semifolio_Customize_Info_Control($wp_customize, 'images_resize', array(
        'label'    => __('Semifolio PRO Options!', 'semifolio'),
        'section'  => 'semifolio_images_resize_section',
        'settings' => 'semifolio_images_resize',
        'type' => 'info',
    )));
 
/*----------------------------------------------------------------------------------------*/
/* Background Color Section 
/*----------------------------------------------------------------------------------------*/
$wp_customize->add_section('semifolio_background_color_section', array(
        'title'    => __('Background Color', 'semifolio'),
        'description' => 'Semifolio PRO Support Only!',
        'priority' => 4,
    ));
 
    // PRO Options
    $wp_customize->add_setting('semifolio_background_color', array(
        'default'           => '' . __('Allows you to change the background in each area on your blog page. <a href="' . esc_url( __('http://generasite.tk/', 'semifolio') ) . '">Upgrade Now!</a>', 'semifolio') . '',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ));
    $wp_customize->add_control( new Semifolio_Customize_Info_Control($wp_customize, 'background_color', array(
        'label'    => __('Semifolio PRO Options!', 'semifolio'),
        'section'  => 'semifolio_background_color_section',
        'settings' => 'semifolio_background_color',
        'type' => 'info',
    )));
 
/*----------------------------------------------------------------------------------------*/
/* Text & Links Color Section
/*----------------------------------------------------------------------------------------*/
$wp_customize->add_section('semifolio_text_color_section', array(
        'title'    => __('Texts & Links Color', 'semifolio'),
        'description' => 'Semifolio PRO Support Only!',
        'priority' => 5,
    ));
 
    // PRO Options
    $wp_customize->add_setting('semifolio_text_color', array(
        'default'           => '' . __('With this option, you can change the color of text and links in almost all parts of the area of the blog, or align with the background that you change. <a href="' . esc_url( __('http://generasite.tk/', 'semifolio') ) . '">Upgrade Now!</a>', 'semifolio') . '',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ));
    $wp_customize->add_control( new Semifolio_Customize_Info_Control($wp_customize, 'text_color', array(
        'label'    => __('Semifolio PRO Options!', 'semifolio'),
        'section'  => 'semifolio_text_color_section',
        'settings' => 'semifolio_text_color',
        'type' => 'info',
    )));
 
/*----------------------------------------------------------------------------------------*/
/* Tracking Code, Script & CSS Section
/*----------------------------------------------------------------------------------------*/
$wp_customize->add_section('semifolio_code_section', array(
        'title'    => __('Tracking Code, Script & CSS', 'semifolio'),
        'description' => 'Semifolio PRO Support Only!',
        'priority' => 6,
    ));
 
    // PRO Options
    $wp_customize->add_setting('semifolio_tracking_code', array(
        'default'           => '' . __('Add your site in Google Webmaster by attaching a tracking code, analitycs, and tagmanager. You can also add code your own scripts and css, that will added into header and footer. <a href="' . esc_url( __('http://generasite.tk/', 'semifolio') ) . '">Upgrade Now!</a>', 'semifolio') . '',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'semifolio_sanitize_text_attribute',
    ));
    $wp_customize->add_control( new Semifolio_Customize_Info_Control($wp_customize, 'tracking_code', array(
        'label'    => __('Semifolio PRO Options!', 'semifolio'),
        'section'  => 'semifolio_code_section',
        'settings' => 'semifolio_tracking_code',
        'type' => 'info',
    )));
}
add_action( 'customize_register', 'semifolio_customize_register' );
 
/**
 * Sanitize the checkbox.
 */
function semifolio_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
 
/**
 * Sanitize text attribute.
 */
function semifolio_sanitize_text_attribute( $input ) {
     return wp_kses_post( force_balance_tags( $input ) );
}
 
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function semifolio_customize_preview_js() {
	wp_enqueue_script( 'semifolio_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'semifolio_customize_preview_js' );
 
/**
 *  Registers script
 */
function semifolio_registers() {
    wp_register_script( 'semifolio_customizer_script', get_template_directory_uri() . '/inc/js/anaklado.js', array('jquery'), '2015', true  );
    wp_enqueue_script( 'semifolio_customizer_script' );
    wp_localize_script( 'semifolio_customizer_script', 'anaklado_buttons', array(
        'rate'      => __( 'Rate Semifolio 5 stars!', 'semifolio' ),
        'doc'       => __( 'Upgrade to Semifolio Pro!', 'semifolio' ),
        'pro'       => __( esc_html( __('<img src="' . __( get_template_directory_uri() . '/images/btn_donate.gif', 'semifolio' ) . '" alt="donate">', 'semifolio') ), 'semifolio' )
    ) );
}
add_action( 'customize_controls_enqueue_scripts', 'semifolio_registers' );