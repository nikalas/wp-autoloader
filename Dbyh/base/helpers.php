<?php
/**
 * This file holds all general helper functions for the theme.
 */


// fallback if symfony/var-dumper is not installed
if ( ! function_exists( 'dump' ) ) {
	/**
	 * Prettify the default var_dump();
	 *
	 * @param mixed $item The value to be dumped.
	 * @since 2.0.0
	 * @author ***
	 */
	function dump( mixed $item ) {
		echo '<style>.dbyh-dump:before { content: "Resultat"; font-size: 20px; color: #94ffda; background: #134255; position: absolute; top: 0; left: 0; width: 100%; padding: 7px; font-weight: 700; } .dbyh-dump { position: relative; z-index: 9999; border: 2px solid #134255; max-width: 750px; width: 100%; border-left: 12px solid #134255; padding: 2.9rem 1rem 1rem 1rem; margin: 2rem auto; overflow-x: auto; line-height: 24px; font-size: 14px; background-image: linear-gradient( 180deg, #eee 50%, #fff 50%); background-size: 100% 48px; }</style>';
		echo '<pre class="dbyh-dump">';
		var_dump( $item ); //phpcs:ignore
		echo '</pre>';
	}
}


// fallback if symfony/var-dumper is not installed
if ( ! function_exists( 'dd' ) ) {
	/**
	 * Dump and die
	 *
	 * @param  mixed ...$args takes any number of arguments and passes them to dump().
	 * @return void
	 *
	 * @author Niklas Eliason <niklas.eliason@decisionbyheart.com>
	 * @since 4.3.1
	 */
	function dd( mixed ...$args ) {
		dump( $args );
		wp_die();
	}
}


/**
 * Custom function to search for value in multidimensional array
 *
 * @param mixed $needle The value to be found.
 * @param array $haystack The array to be searched.
 * @since 2.0.0
 * @author ***
 */
function search_multi_array( mixed $needle, array $haystack ) {
	return preg_match( '/"' . preg_quote( $needle, '/' ) . '"/i', wp_json_encode( $haystack ) );
}


/**
 * Replaces all dashes with underscores in the given array.
 *
 * Works recursively for nested arrays.
 * Useful for when ACF-fields have been wrongly created.
 *
 * @param array $arr An array.
 * @return array The modified array.
 *
 * @author Niklas Eliason <niklas.eliason@decisionbyheart.com>
 * @since 5.0.0
 */
function array_dashes_to_underscores( array $arr ) {
	$new_array = array();
	foreach ( $arr as $key => $value ) {
		$new_key = str_replace( '-', '_', $key );
		if ( is_array( $value ) ) {
			$new_array[ $new_key ] = array_dashes_to_underscores( $value );
		} else {
			$new_array[ $new_key ] = $value;
		}
	}
	return $new_array;
}
