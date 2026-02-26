<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the request type.
 *
 * @return string The request type.
 */
function get_request_type() {
	// Set the type.
	$type = '';

	// Check the request.
	if ( is_singular() ) {
		// Set the type.
		$type = 'singular';

		// Check the request.
	} elseif ( is_tax() || is_category() || is_tag() ) {
		// Set the type.
		$type = 'taxonomy_archive';

		// Check the request.
	} elseif ( is_post_type_archive() ) {
		// Set the type.
		$type = 'type_archive';

		// Check the request.
	} elseif ( is_author() ) {
		// Set the type.
		$type = 'author_archive';

		// Check the request.
	} elseif ( is_date() ) {
		// Set the type.
		$type = 'date_archive';

		// Check the request.
	} elseif ( is_search() ) {
		// Set the type.
		$type = 'search';

		// Check the request.
	} elseif ( is_home() ) {
		// Set the type.
		$type = 'home';

		// Check the request.
	} elseif ( is_404() ) {
		// Set the type.
		$type = '404';
	}

	// Return the type.
	return $type;
}

/**
 * Get the archive post type.
 *
 * @return string The archive post type.
 */
function get_archive_post_type() {
	// Set the post type.
	$post_type = '';

	// Get the queried object.
	$queried_object = get_queried_object();

	// Check the queried object.
	if ( ! $queried_object instanceof \WP_Post_Type ) {
		// Return the post type.
		return $post_type;
	}

	// Check the post type.
	if ( ! empty( $queried_object->name ) ) {
		// Set the post type.
		$post_type = $queried_object->name;
	}

	// Return the post type.
	return $post_type;
}

/**
 * Get the redirect URL.
 *
 * @return string The redirect URL.
 */
function get_redirect_url() {
	// Set the URL.
	$url = '';

	// Get the settings.
	$settings = ps_simple_par_get_settings();

	// Check the settings.
	if ( empty( $settings ) ) {
		// Return the URL.
		return $url;
	}

	// Check the redirect type.
	if ( empty( $settings['redirect_type'] ) ) {
		// Return the URL.
		return $url;
	}

	// Check the redirect type is URL.
	if ( 'url' === $settings['redirect_type'] ) {
		// Check the redirect URL.
		if ( ! empty( $settings['redirect_url'] ) ) {
			// Set the URL.
			$url = $settings['redirect_url'];
		}

		// Check the redirect type is page.
	} elseif ( 'page' === $settings['redirect_type'] ) {
		// Check the login page.
		if ( ! empty( $settings['login_page'] ) && ! is_post_restricted( $settings['login_page'] ) ) {
			// Set the URL.
			$url = get_permalink( $settings['login_page'] );
		}
	}

	// Check the URL.
	if ( empty( $url ) ) {
		// Return the URL.
		return $url;
	}

	// Check the redirect parameter.
	if ( ! empty( $settings['redirect_parameter'] ) ) {
		// Remove unintentional characters.
		$settings['redirect_parameter'] = str_replace( '?', '', $settings['redirect_parameter'] );

		// Add the query arguments.
		$url = add_query_arg(
			$settings['redirect_parameter'],
			urlencode( home_url() . $_SERVER['REQUEST_URI'] ),
			$url
		);
	}

	// Allow developers to use this.
	$url = apply_filters( 'ps_simple_par_redirect_url', $url );

	// Return the URL.
	return $url;
}

/**
 * Redirect the request.
 */
function redirect_request() {
	// Get the redirect URL.
	$url = get_redirect_url();

	// Check the URL.
	if ( empty( $url ) ) {
		// Fall back to home URL.
		$url = home_url( '/' );
	}

	// Check the headers.
	if ( ! headers_sent() ) {
		// Prevent caching.
		nocache_headers();
	}

	// Redirect.
	wp_redirect( $url );

	// Exit.
	exit;
}

/**
 * Send a 404 response.
 */
function send_404_response() {
	// Get the global query.
	global $wp_query;

	// Set the 404.
	$wp_query->set_404();

	// Set the status header.
	status_header( 404 );

	// Prevent caching.
	nocache_headers();

	// Load the 404 template.
	include( get_404_template() );

	// Exit.
	exit;
}

/**
 * Check whether the request is restricted.
 *
 * @return boolean Whether the request is restricted.
 */
function is_request_restricted() {
	// Set the is.
	$is = false;

	// Check if the current user is allowed.
	if ( is_current_user_allowed() ) {
		// Return the is.
		return $is;
	}

	// Get the request type.
	$request_type = get_request_type();

	// Check the request type.
	if ( 'singular' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_singular() ) {
			// Set the is.
			$is = true;

			// Check whether it should redirect.
		} elseif ( should_redirect_current_post() ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( 'taxonomy_archive' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_taxonomy_archive() ) {
			// Set the is.
			$is = true;

			// Check whether it should redirect.
		} elseif ( should_redirect_current_term() ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( 'type_archive' === $request_type ) {
		// Get the post type.
		$post_type = get_archive_post_type();

		// Check whether it should redirect.
		if ( should_redirect_type_archive( $post_type ) ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( 'author_archive' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_author_archive() ) {
			// Set the is.
			$is = true;

			// Check whether it should redirect.
		} elseif ( should_redirect_current_author() ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( 'date_archive' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_date_archive() ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( 'search' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_search() ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( 'home' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_home() ) {
			// Set the is.
			$is = true;
		}

		// Check the request type.
	} elseif ( '404' === $request_type ) {
		// Check whether it should redirect.
		if ( should_redirect_404() ) {
			// Set the is.
			$is = true;
		}
	}

	// Return the is.
	return $is;
}

/**
 * Check whether the request should be redirected.
 *
 * Returns true only when the request is restricted and a redirect URL is
 * configured. When no URL is configured, handle_request() serves a 404 instead.
 *
 * @return boolean Whether the request should be redirected.
 */
function should_redirect_request() {
	// Set the should.
	$should = false;

	// Check whether the request is restricted.
	if ( ! is_request_restricted() ) {
		// Return the should.
		return $should;
	}

	// Get the redirect URL.
	$url = get_redirect_url();

	// Check the redirect URL.
	if ( empty( $url ) ) {
		// Return the should.
		return $should;
	}

	// Set the should.
	$should = true;

	// Return the should.
	return $should;
}

/**
 * Handle the request.
 *
 * If the request is restricted:
 * - Redirect if the URL is found;
 * - Send a 404 response otherwise.
 */
function handle_request() {
	// Check whether the request is restricted.
	if ( is_request_restricted() ) {
		// Check whether it should redirect.
		if ( should_redirect_request() ) {
			// Redirect the request.
			redirect_request();

			// Otherwise.
		} else {
			// Serve a 404.
			send_404_response();
		}
	}
}
