<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the post is restricted.
 *
 * @param int $post_id The post ID.
 * @return boolean Whether the post is restricted.
 */
function is_post_restricted( $post_id ) {
	// Set the is.
	$is = false;

	// Get the meta value.
	$meta_value = get_post_meta( $post_id, 'page_access_restricted', true );

	// Check the meta value.
	if ( 1 === intval( $meta_value ) ) {
		// Set the is.
		$is = true;
	}

	// Return the is.
	return $is;
}

/**
 * Check whether the current post is restricted.
 *
 * @return boolean Whether the current post is restricted.
 */
function is_current_post_restricted() {
	// Set the is.
	$is = false;

	// Get the request type.
	$type = get_request_type();

	// Check the request type.
	if ( 'singular' !== $type ) {
		// Return the is.
		return $is;
	}

	// Get the post ID.
	$post_id = get_queried_object_id();

	// Check whether it is restricted.
	$is = is_post_restricted( $post_id );

	// Return the is.
	return $is;
}

/**
 * Check whether the post should be redirected.
 *
 * @param int $post_id The post ID.
 * @return boolean Whether the post should be redirected.
 */
function should_redirect_post( $post_id ) {
	// Set the should.
	$should = false;

	// Check whether the post is restricted.
	if ( is_post_restricted( $post_id ) ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the current post should be redirected.
 *
 * @return boolean Whether the current post should be redirected.
 */
function should_redirect_current_post() {
	// Set the should.
	$should = false;

	// Get the request type.
	$request_type = get_request_type();

	// Check the request type.
	if ( 'singular' !== $request_type ) {
		// Return the should.
		return $should;
	}

	// Get the post ID.
	$post_id = get_queried_object_id();

	// Check whether it should redirect.
	$should = should_redirect_post( $post_id );

	// Return the should.
	return $should;
}
