<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Send the headers.
 */
function send_headers() {
	// Check whether the current post is restricted.
	if ( ! is_current_post_restricted() ) {
		// Return early.
		return;
	}

	// Check whether the current user is allowed.
	if ( is_current_user_allowed() ) {
		// Return early.
		return;
	}

	// Check whether the headers have been sent.
	if ( headers_sent() ) {
		// Return early.
		return;
	}

	// Send the noindex header.
	header( 'X-Robots-Tag: noindex, nofollow', true );
}
