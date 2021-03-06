<?php

/**
 * Returns the nav type for the given page's header.
 * The value returned will represent an equivalent template part's name.
 *
 * @author Jo Dickson
 * @since 0.4.0
 * @return string The nav type name
 */
if ( !function_exists( 'ucfwp_get_nav_type' ) ) {
	function ucfwp_get_nav_type() {
		$nav_type = '';

		// Fall back to the ucf.edu primary navigation if a
		// header menu is not set.
		if ( ! has_nav_menu( 'header-menu' ) ) {
			$nav_type = 'mainsite';
		}

		return apply_filters( 'ucfwp_get_nav_type', $nav_type );
	}
}


/**
 * Returns HTML markup for the primary site navigation.
 *
 * @author Jo Dickson
 * @since 0.0.0
 * @param bool $image Whether or not a media background is present in the page header.
 * @return string Nav HTML
 **/
if ( !function_exists( 'ucfwp_get_nav_markup' ) ) {
	function ucfwp_get_nav_markup( $image=true ) {
		$retval = '';
		$template_part_name = ucfwp_get_nav_type();

		set_query_var( 'ucfwp_image_behind_nav', $image );

		ob_start();
		get_template_part( ucfwp_get_template_part_slug( 'nav' ), $template_part_name );
		$retval = trim( ob_get_clean() );

		return apply_filters( 'ucfwp_get_nav_markup', $retval );
	}
}


/**
 * Returns subnavigation markup for the current object.
 *
 * @author Jo Dickson
 * @since 0.0.0
 * @return string HTML for the page header
 **/
if ( !function_exists( 'ucfwp_get_subnav_markup' ) ) {
	function ucfwp_get_subnav_markup() {
		$obj               = ucfwp_get_queried_object();
		$include_subnav    = get_field( 'page_header_include_subnav', $obj );
		$subnav_population = get_field( 'page_header_subnav_link_population', $obj );

		if ( class_exists( 'Section_Menus_Common' ) && $include_subnav ) {
			$menu_sc_markup = '[section-menu]';

			if ( $subnav_population === 'custom' && have_rows( 'page_header_subnav_links' ) ) {
				while ( have_rows( 'page_header_subnav_links' ) ) : the_row();

					$content        = get_sub_field( 'link_text' );
					$atts           = array();

					if ( $content ) {
						$atts['href']       = esc_attr( get_sub_field( 'href' ) );
						$atts['new_window'] = esc_attr( get_sub_field( 'new_window' ) );
						$atts['rel']        = esc_attr( get_sub_field( 'rel' ) );
						$atts['li_class']   = esc_attr( get_sub_field( 'li_class' ) );
						$atts['a_class']    = esc_attr( get_sub_field( 'a_class' ) );
						$atts['layout']     = esc_attr( get_sub_field( 'layout' ) );

						$atts = array_filter( $atts );
						if ( ! empty( $atts ) && isset( $atts['href'] ) ) {
							$item_sc_markup = '[section-menu-item';

							foreach ( $atts as $attr => $val ) {
								$item_sc_markup .= " {$attr}=\"{$val}\"";
							}

							$item_sc_markup .= ']' . $content . '[/section-menu-item]';
							$menu_sc_markup .= $item_sc_markup;
						}
					}

				endwhile;

				$menu_sc_markup .= '[/section-menu]';
			}

			return do_shortcode( $menu_sc_markup );
		}
	}
}


/**
 * Nav walker class compatible with BS4-alpha/Athena Framework
 * 
 * CECS THEME MODIFIED - added sub-menu functionality to create multiple menu levels
 */
if ( !class_exists( 'bs4Navwalker' ) ) {

	/**
	 * Class Name: bs4Navwalker
	 * GitHub URI: https://github.com/dupkey/bs4navwalker
	 * Description: A custom WordPress nav walker class for Bootstrap 4 (v4.0.0-alpha.1) nav menus in a custom theme using the WordPress built in menu manager
	 * Version: 0.1
	 * Author: Dominic Businaro - @dominicbusinaro
	 * License: GPL-2.0+
	 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
	 */

	class bs4Navwalker extends Walker_Nav_Menu
	{
		/**
		* Starts the list before the elements are added.
		*
		* @see Walker::start_lvl()
		*
		* @since 3.0.0
		*
		* @param string $output Passed by reference. Used to append additional content.
		* @param int    $depth  Depth of menu item. Used for padding.
		* @param array  $args   An array of arguments. @see wp_nav_menu()
		*/
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"dropdown-menu dropdown-menu-right\">";
		}

		/**
		* Ends the list of after the elements are added.
		*
		* @see Walker::end_lvl()
		*
		* @since 3.0.0
		*
		* @param string $output Passed by reference. Used to append additional content.
		* @param int    $depth  Depth of menu item. Used for padding.
		* @param array  $args   An array of arguments. @see wp_nav_menu()
		*/
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</div>\n";

			/**
			 * FOR SUB-MENU
			 * If the loop is at the end of a sub-menu, close without indent
			 * to avoid creating extra space beneath the link.
			 */
			if ($depth > 0) {
				$output .= "</div>";
			}
		}

		/**
		* Start the element output.
		*
		* @see Walker::start_el()
		*
		* @since 3.0.0
		*
		* @param string $output Passed by reference. Used to append additional content.
		* @param object $item   Menu item data object.
		* @param int    $depth  Depth of menu item. Used for padding.
		* @param array  $args   An array of arguments. @see wp_nav_menu()
		* @param int    $id     Current item ID.
		*/
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			/**
			* Filter the CSS class(es) applied to a menu item's list item element.
			*
			* @since 3.0.0
			* @since 4.1.0 The `$depth` parameter was added.
			*
			* @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			* @param object $item    The current menu item.
			* @param array  $args    An array of {@see wp_nav_menu()} arguments.
			* @param int    $depth   Depth of menu item. Used for padding.
			*/
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

			$class_names .= ' nav-item';

			if (in_array('menu-item-has-children', $classes)) {
				$class_names .= ' dropdown';
			}

			if (in_array('current-menu-item', $classes)) {
				$class_names .= ' active';
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			* Filter the ID applied to a menu item's list item element.
			*
			* @since 3.0.1
			* @since 4.1.0 The `$depth` parameter was added.
			*
			* @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			* @param object $item    The current menu item.
			* @param array  $args    An array of {@see wp_nav_menu()} arguments.
			* @param int    $depth   Depth of menu item. Used for padding.
			*/
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			if ($depth === 0) {
				$output .= $indent . '<li' . $id . $class_names .'>';
			}

			/**
			 * FOR SUB-MENU
			 * Creates a starting sub-menu tag for a loop where it is at the 
			 * second depth level. $indent is removed to avoid creatin empty
			 * space above the link.
			 */
			if ($depth > 0 && in_array('menu-item-has-children', $classes)) {
				$output .= '<div' . $id . 'class="dropdown-item dropdown-submenu">';
			}

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			if ($depth === 0) {
				$atts['class'] = 'nav-link';
			}

			if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
				$atts['class']       .= ' dropdown-toggle';
				$atts['data-toggle']  = 'dropdown';
			}

			if ($depth > 0) {
				$atts['class'] = 'dropdown-item';
			}

			if ($depth > 1) {
				$atts['class'] = 'dropdown-item sub-menu-item';
			}

			/**
			 * FOR SUB-MENU
			 * Adds the dropdown triggers when children and depth > 0 exist.
			 * Separate from existing IF above to allow adding different classes
			 * to sub-menu toggles if needed.
			 */
			if ($depth > 0 && in_array('menu-item-has-children', $classes)) {
				$atts['class']       .= ' dropdown-toggle';
				$atts['data-toggle']  = 'dropdown';
			}

			if (in_array('current-menu-item', $item->classes)) {
				$atts['class'] .= ' active';
			}

			/**
			* Filter the HTML attributes applied to a menu item's anchor element.
			*
			* @since 3.6.0
			* @since 4.1.0 The `$depth` parameter was added.
			*
			* @param array $atts {
			*     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			*
			*     @type string $title  Title attribute.
			*     @type string $target Target attribute.
			*     @type string $rel    The rel attribute.
			*     @type string $href   The href attribute.
			* }
			* @param object $item  The current menu item.
			* @param array  $args  An array of {@see wp_nav_menu()} arguments.
			* @param int    $depth Depth of menu item. Used for padding.
			*/
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			$item_output .= '<a'. $attributes .'>';
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			/**
			* Filter a menu item's starting output.
			*
			* The menu item's starting output only includes `$args->before`, the opening `<a>`,
			* the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			* no filter for modifying the opening and closing `<li>` for a menu item.
			*
			* @since 3.0.0
			*
			* @param string $item_output The menu item's starting HTML output.
			* @param object $item        Menu item data object.
			* @param int    $depth       Depth of menu item. Used for padding.
			* @param array  $args        An array of {@see wp_nav_menu()} arguments.
			*/
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		* Ends the element output, if needed.
		*
		* @see Walker::end_el()
		*
		* @since 3.0.0
		*
		* @param string $output Passed by reference. Used to append additional content.
		* @param object $item   Page data object. Not used.
		* @param int    $depth  Depth of page. Not Used.
		* @param array  $args   An array of arguments. @see wp_nav_menu()
		*/
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if (isset($args->has_children) && $depth === 0) {
				$output .= "</li>\n";
			}
		}
	}

}
