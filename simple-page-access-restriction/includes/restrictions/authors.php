<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the author is restricted.
 *
 * @param int $author_id The author ID.
 * @return boolean Whether the author is restricted.
 */
function is_author_restricted( $author_id ) {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the current author is restricted.
 *
 * @return boolean Whether the current author is restricted.
 */
function is_current_author_restricted() {
	// Set the is.
	$is = false;

	// Get the request type.
	$type = get_request_type();

	// Check the request type.
	if ( 'author_archive' !== $type ) {
		// Return the is.
		return $is;
	}

	// Get the author ID.
	$author_id = get_queried_object_id();

	// Check whether it is restricted.
	$is = is_author_restricted( $author_id );

	// Return the is.
	return $is;
}

/**
 * Check whether the author should be redirected.
 *
 * @param int $author_id The author ID.
 * @return boolean Whether the author should be redirected.
 */
function should_redirect_author( $author_id ) {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_author_restricted( $author_id ) ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the current author should be redirected.
 *
 * @return boolean Whether the current author should be redirected.
 */
function should_redirect_current_author() {
	// Set the should.
	$should = false;

	// Get the request type.
	$request_type = get_request_type();

	// Check the request type.
	if ( 'author_archive' !== $request_type ) {
		// Return the should.
		return $should;
	}

	// Get the author ID.
	$author_id = get_queried_object_id();

	// Check whether it should redirect.
	$should = should_redirect_author( $author_id );

	// Return the should.
	return $should;
}
