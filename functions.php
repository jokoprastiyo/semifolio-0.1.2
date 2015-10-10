<?php
/**
 * Semifolio functions and definitions
 *
 * @package Semifolio
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'semifolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function semifolio_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cartel, use a find and replace
	 * to change 'semifolio' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'semifolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
              // The title tag, only works on WordPress 4.1 or later
              add_theme_support( 'title-tag' );
  
	// Add stylesheet for the WYSIWYG editor
	add_editor_style();
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'semifolio' ),
		'top-menu' => __( 'Top Menu', 'semifolio' )
	) );

	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Custom backgrounds support
	$defaults_bg = array(
		'default-color'            => 'ffffff',
		'default-image'             => '',
		'wp-head-callback'       => 'semifolio_custom_background_cb',
		'admin_head_callback'     => '',
		'admin_preview_callback' => ''
	);
	add_theme_support ( 'custom-background', apply_filters( 'semifolio_custom_background_args', $defaults_bg ) );
  
	// Custom header support
	$defaults_hd = array(
		'default-text-color'            => '',
		'default-image'           => '',
		'upload'                    => true,
		'wp-head-callback'       => 'semifolio_header_style',
		'admin_head_callback'     => 'semifolio_admin_header_style',
		'admin_preview_callback' => 'semifolio_admin_header_img'
	);
	add_theme_support ( 'custom-header', apply_filters( 'semifolio_custom_header_args', $defaults_hd ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // semifolio_setup
add_action( 'after_setup_theme', 'semifolio_setup' );
/* Function custom background callback*/
  
function semifolio_custom_background_cb() {
	// Get the background image.
	$image_bg = get_background_image();
	// If there's an image, just call the normal WordPress callback. We won't do anything here.
	if ( !empty( $image_bg ) ) {
		_custom_background_cb();
		return;
	// Get the background color.
	$color_bg = get_background_color();
	// If no background color, return.
		if ( empty( $color_bg ) )
		return;
	// Use 'background' instead of 'background-color'.
	$style_bg = "background: {color};";
?>
<style type="text/css">body { <?php echo trim( $style_bg ); ?> }</style>
	<?php }
}

/* Fuction custom header callback */
  
if ( ! function_exists( 'semifolio_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see semifolio_custom_header_setup().
 */
function semifolio_header_style() {
	$header_text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-branding {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
<?php
}
endif; // semifolio_header_style
if ( ! function_exists( 'semifolio_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see semifolio_custom_header_setup().
 */
function semifolio_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg {
			padding: 20px;
			background: #fff;
			font-size: 1.375em;
			text-align: center;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
			margin: 0 0 10px;
			font-family: "Source Sans Pro", sans-serif;
			font-size: 3.6em;
			line-height: 1.1;
			font-weight: 900;
			text-transform: uppercase;
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#desc {
			color: #b1b2b3 !important;
			font-family: "PT Serif", serif;
			font-size: 0.73em;
			line-height: 1.5;
			font-weight: normal;
			font-style: italic;
		}
		#headimg img {
			display: block;
			margin: 0 auto 20px auto;
		}
		#headimg img   h1 {
			margin-top: -5px;
		}
	</style>
<?php
}
endif; // semifolio_admin_header_style
if ( ! function_exists( 'semifolio_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see semifolio_custom_header_setup().
 */
function semifolio_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"><?php bloginfo( 'description' ); ?></div>
	</div>
<?php
}
endif;
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function semifolio_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'semifolio' ),
		'id'            => 'main-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget', 'semifolio' ),
		'id'            => 'footer-widget',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget col-md-4 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => __( 'Top Widget', 'semifolio' ),
		'id'            => 'top-widget',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	
	}
add_action( 'widgets_init', 'semifolio_widgets_init' );
 
/**
 * Enqueue Style and Script.
 */
function semifolio_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	/* translators: If there are characters in your language that are not supported by Lobster, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lobster font: on or off', 'semifolio' ) ) {
		$fonts[] = 'Lobster:400';
	}
	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'semifolio' ) ) {
		$fonts[] = 'Roboto:300,400,700,900';
	}
 
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		), '//fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
 
function semifolio_scripts(){
		wp_enqueue_style( 'semifolio_bootstrap_css', get_template_directory_uri() . '/inc/bootstrap/bootstrap.css');
		wp_enqueue_style( 'semifolio_fontawesome_css', get_template_directory_uri() . '/inc/css/font-awesome.css');
	wp_enqueue_style( 'semifolio-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('semifolio_google_fonts', semifolio_fonts_url(), array(), null);
	wp_enqueue_style( 'semifolio_top_menu', get_template_directory_uri() . '/top-menu.css' );

	wp_enqueue_script( 'semifolio_dropdown_js', get_template_directory_uri() . '/inc/js/dropdown.js', array('jquery') );
	wp_enqueue_script( 'semifolio_bootstrap-min_js', get_template_directory_uri() . '/inc/bootstrap/bootstrap.min.js', array(), '20150615', true );
	wp_enqueue_script('semifolio_touchdown', get_template_directory_uri() . '/inc/js/touchdown.js', array('jquery'));
	wp_enqueue_script('semifolio_scriptsmin', get_template_directory_uri() . '/inc/js/scripts.min.js', array('jquery'));
	wp_enqueue_script( 'semifolio_skip_link', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'semifolio_scripts' );

/* Excerpt config */
 
function semifolio_excerptlength_default($length) {
	return 40;
}
 
function semifolio_excerptlength_themes($length) {
	return 60;
}
 
function semifolio_excerptmore($more)
{
	return '... <div class="readmore"><a rel="bookmark" href="' . get_permalink( get_the_ID() ) . '">Continue reading &rarr;</a></div>';
}
	add_filter('excerpt_length', 'semifolio_excerptlength_default');
	add_filter('excerpt_length', 'semifolio_excerptlength_themes');
	add_filter('excerpt_more', 'semifolio_excerptmore');
    
/* Favicon */
 
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
 
if ( ! function_exists( 'semifolio_favicon_icon' ) ) :
  
function semifolio_favicon_icon() {

	$favicon_icon = get_option( 'semifolio_upload_favicon_icon' );
	if ( get_option( 'semifolio_display_favicon_icon' ) == 1 ) :
	if ( ! get_option( 'semifolio_upload_favicon_icon' ) ) {

		$favicon_icon = get_template_directory_uri() . '/images/favicon.ico';
	}
?>
		<link rel="shortcut icon" href="<?php echo $favicon_icon; ?>" type="image/x-icon" />
	<?php
	endif;
}
endif;
	// Load in header blog page
	add_action('wp_head', 'semifolio_favicon_icon');
	// Load in the header admin
	add_action('admin_head', 'semifolio_favicon_icon');
 
}
 
/* Customizer */

require get_template_directory() . '/inc/customizer.php';

/* Custom template tags for this theme. */

require get_template_directory() . '/inc/template-tags.php';

/* Custom functions  */

require get_template_directory() . '/inc/extras.php';
 
/* Walker menu */
 
require get_template_directory() . '/inc/walker-menu.php';
 
/* Popular post */
 
require get_template_directory() . '/inc/popular-post.php';
 
/* Portfolio */
 
require get_template_directory() . '/inc/portfolio.php';
