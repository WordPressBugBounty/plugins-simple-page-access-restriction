<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the type archive is restricted.
 *
 * @param string $post_type The post type.
 * @return boolean Whether the type archive is restricted.
 */
function is_type_archive_restricted( $post_type ) {
	// Set the is.
	$is = false;

	// Check the post type.
	if ( 'product' === $post_type ) {
		// Check the function.
		if ( function_exists( 'is_shop' ) && is_shop() ) {
			// Get the post ID.
			$post_id = get_option( 'woocommerce_shop_page_id' );

			// Check whether the post is restricted.
			if ( is_post_restricted( $post_id ) ) {
				// Set the is.
				$is = true;
			}
		}
	}

	// Return the is.
	return $is;
}

/**
 * Check whether the date archive is restricted.
 *
 * @return boolean Whether the date archive is restricted.
 */
function is_date_archive_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the taxonomy archive is restricted.
 *
 * @return boolean Whether the taxonomy archive is restricted.
 */
function is_taxonomy_archive_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the author archive is restricted.
 *
 * @return boolean Whether the author archive is restricted.
 */
function is_author_archive_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the type archive should be redirected.
 *
 * @param string $post_type The post type.
 * @return boolean Whether the type archive should be redirected.
 */
function should_redirect_type_archive( $post_type ) {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_type_archive_restricted( $post_type ) ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the date archive should be redirected.
 *
 * @return boolean Whether the date archive should be redirected.
 */
function should_redirect_date_archive() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_date_archive_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the taxonomy archive should be redirected.
 *
 * @return boolean Whether the taxonomy archive should be redirected.
 */
function should_redirect_taxonomy_archive() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_taxonomy_archive_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the author archive should be redirected.
 *
 * @return boolean Whether the author archive should be redirected.
 */
function should_redirect_author_archive() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_author_archive_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}
