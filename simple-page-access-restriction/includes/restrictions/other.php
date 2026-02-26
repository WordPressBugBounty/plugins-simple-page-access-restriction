<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the search is restricted.
 *
 * @return boolean Whether the search is restricted.
 */
function is_search_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the home is restricted.
 *
 * @return boolean Whether the home is restricted.
 */
function is_home_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the 404 is restricted.
 *
 * @return boolean Whether the 404 is restricted.
 */
function is_404_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the search should be redirected.
 *
 * @return boolean Whether the search should be redirected.
 */
function should_redirect_search() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_search_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the home should be redirected.
 *
 * @return boolean Whether the home should be redirected.
 */
function should_redirect_home() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_home_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the 404 should be redirected.
 *
 * @return boolean Whether the 404 should be redirected.
 */
function should_redirect_404() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_404_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}
