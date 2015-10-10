<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Semifolio
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function semifolio_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'semifolio_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function semifolio_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'semifolio_body_classes' );
 
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */

    if( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
  
    // filter function for wp_title
function semifolio_filter_wp_title( $old_title, $sep, $sep_location ){

    // add padding to the sep
    $ssep = ' ' . $sep . ' ';
     
    // find the type of index page this is
    if( is_category() ) $insert = $ssep . __('Category','semifolio');
    elseif( is_tag() ) $insert = $ssep . __('Tag','semifolio');
    elseif( is_author() ) $insert = $ssep . __('Author','semifolio');
    elseif( is_year() || is_month() || is_day() ) $insert = $ssep . __('Archives','semifolio');
    elseif( is_home() ) $insert = $ssep . get_bloginfo('description');
    else $insert = NULL;
     
    // get the page number we're on (index)
    if( get_query_var( 'paged' ) )
    $num = $ssep . __('Page ','semifolio') . get_query_var( 'paged' );
     
    // get the page number we're on (multipage post)
    elseif( get_query_var( 'page' ) )
    $num = $ssep . __('Page ','semifolio') . get_query_var( 'page' );
     
    // else
    else $num = NULL;
     
    // concoct and return new title
    return get_bloginfo( 'name' ) . $insert . $old_title . $num;
}
add_filter( 'wp_title', 'semifolio_filter_wp_title', 10, 3 );
function semifolio_rss_title($title) {

    /* need to fix our add a | blog name to wp_title */
    $ft = str_replace(' | ','',$title);
    return str_replace(get_bloginfo('name'),'',$ft);
}
add_filter('get_wp_title_rss', 'semifolio_rss_title',10,1);
  
    // Adding Title for site older than WordPress 4.1
function semifolio_render_title() {

	?>
	<title><?php wp_title(); ?></title>
	<?php
	}
add_action( 'wp_head', 'semifolio_render_title' );
    endif;
 
/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function semifolio_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'semifolio_setup_author' );
