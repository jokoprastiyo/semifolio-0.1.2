<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Semifolio
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<link href="http://gmpg.org/xfn/11" rel="profile" />
		<meta name="viewport" content="width=device-width, initial-
 scale=1.0" />
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
 
	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'semifolio' ); ?></a>
 
<div class="container"><div class="row">
	<div class="col-md-4">
		<div id="top-widgets">
		<?php if ( ! dynamic_sidebar( 'top-widget' ) ) :
			dynamic_sidebar( 'top-widget' );
		endif; ?>
		</div>
	</div>
</div></div>
 
<?php wp_nav_menu( array(
	'theme_location' => 'top-menu',
	'container' => 'div',
	'container_class' => 'nav-menu',
	'menu_class' => 'menu',
	'fallback_cb' => 'Semifolio_Menu_Walker::fallback',
	'walker' => new Walker_Nav_Menu()
) ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="container"><div class="row">
			<div class="col-md-8">
				<div class="site-branding">
					
	<?php if ( get_header_image() ) { ?>
				<a rel="home" href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo get_header_image(); ?>" title="<?php echo esc_attr( bloginfo( 'name', 'display' ) ); ?>" alt="<?php echo esc_attr( bloginfo( 'name', 'display' ) ); ?>" /></a>
	<?php } else { ?>
				<h1 class="site-title logo"><a id="blogname" rel="home" href="<?php echo home_url();?>/" title="<?php echo esc_attr( bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description logo"><?php bloginfo( 'description' ); ?></h2>
	
	<?php } ?>
	
				</div>
			</div>
			<div class="col-md-4">
				<div class="container"><div class="row">
					<div class="col-md-12">
<?php
if ( get_option( 'semifolio_upload_header_ads' ) ) :
	$heading_link = get_option( 'semifolio_header_ads_url' );
	if ( ! get_option( 'semifolio_header_ads_url' ) ) :
	$heading_link = home_url();
	endif;
?>
		<a href="<?php echo $heading_link; ?>">
			<img src="<?php echo get_option( 'semifolio_upload_header_ads' ); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
		</a>
<?php
	else :
		get_search_form();
 
endif; ?>
					</div>
				</div></div>
			</div>
		</div></div>
	</header><!-- #masthead -->
 
<nav id="site-navigation" role="navigation">
	<?php wp_nav_menu( array(
		'theme-location' => 'primary',
		'container_class' => '',
		'menu_class' => 'menu',
	) ); ?>
</nav>

	<div id="content" class="site-content">