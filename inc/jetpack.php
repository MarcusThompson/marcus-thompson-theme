<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package MarcusThompson
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function marcus_thompson_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'marcus_thompson_jetpack_setup' );
