<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the user is allowed to access restricted content.
 *
 * @param int $user_id The user ID.
 * @return boolean Whether the user is allowed.
 */
function is_user_allowed( $user_id ) {
	// Set the is.
	$is = false;

	// Check the user ID.
	if ( empty( $user_id ) ) {
		// Return the is.
		return $is;
	}

	// @todo check user roles in the future.

	// Set the is.
	$is = true;

	// Return the is.
	return $is;
}

/**
 * Check whether the current user is allowed to access restricted content.
 *
 * @return boolean Whether the current user is allowed.
 */
function is_current_user_allowed() {
	// Get the current user ID.
	$user_id = get_current_user_id();

	// Check whether the user is allowed.
	$is = is_user_allowed( $user_id );

	// Return the is.
	return $is;
}
