<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the singular is restricted.
 *
 * @return boolean Whether the singular is restricted.
 */
function is_singular_restricted() {
	// Set the is.
	$is = false;

	// Return the is.
	return $is;
}

/**
 * Check whether the singular should be redirected.
 *
 * @return boolean Whether the singular should be redirected.
 */
function should_redirect_singular() {
	// Set the should.
	$should = false;

	// Check whether it is restricted.
	if ( is_singular_restricted() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}
