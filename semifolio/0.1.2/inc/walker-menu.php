<?php
class Semifolio_Menu_Walker extends Walker_Nav_Menu{
	
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul>\n";
	}
 
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', (array) apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( ! empty( $args->has_children ) && $args->has_children )
				$class_names .= ' has-sub';
 
			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
 
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			if ( ! empty( $args->before ) )
				$item_output = $args->before;
			else
				$item_output = '';
 
			$item_output .= '<a'. $attributes .'>';

			$item_output .= (!empty($args->link_before) ? $args->link_before : '') . apply_filters( 'the_title', $item->title, $item->ID ) . (!empty($args->link_after) ? $args->link_after : '');

			if ( !empty($args->has_children) && $args->has_children )
	$item_output .= '</a>';

			$item_output .= (!empty($args->after) ? $args->after : '');

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
 
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];
 
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
 
	public static function fallback( $args ) {
		$fb_output = null;

		extract( $args );
 
		$home_class = '';
		if ( is_front_page() && !is_paged() )
			$home_class = ' class="current_page_item active"';
		$fb_output .= '<li' . $home_class . '>' . $link_before . '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . $before . '<span class="fa fa-home"></span> ' . __( 'Home', 'semifolio' ) . $after . '</a>' . $link_after . '</li>';

		if ( current_user_can( 'manage_options' ) )
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Add a menu', 'semifolio' ) . '</a></li>';

		$fb_output = sprintf( $items_wrap, $menu_id, $menu_class, $fb_output );

		if ( ! empty( $container ) )
			$fb_output = '<' . $container . ' class="' . $container_class . '" id="' . $container_id . '">' . $fb_output . '</' . $container . '>';
		if ( $echo )
			echo $fb_output;
		else
			return $fb_output;
	}
}
