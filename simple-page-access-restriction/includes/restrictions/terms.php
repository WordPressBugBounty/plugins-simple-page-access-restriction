<?php

namespace PS_Simple_Page_Access_Restriction\Restrictions;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check whether the term is restricted.
 *
 * @param int $term_id The term ID.
 * @return boolean Whether the term is restricted.
 */
function is_term_restricted( $term_id ) {
	// Set the is.
	$is = false;

	// Get the term.
	$term = get_term( $term_id );

	// Check the term.
	if ( ! $term instanceof \WP_Term ) {
		// Return the is.
		return $is;
	}

	// Check the taxonomy.
	if ( empty( $term->taxonomy ) ) {
		// Return the is.
		return $is;
	}

	// Get the taxonomy.
	$taxonomy = $term->taxonomy;

	// Get the settings.
	$settings = ps_simple_par_get_settings();

	// Check the settings.
	if ( empty( $settings ) ) {
		// Return the is.
		return $is;
	}

	// Check the taxonomies.
	if ( empty( $settings['taxonomies'] ) ) {
		// Return the is.
		return $is;
	}

	// Get the taxonomies.
	$taxonomies = $settings['taxonomies'];

	// Check the taxonomy.
	if ( in_array( $taxonomy, $taxonomies, true ) ) {
		// Set the is.
		$is = true;
	}

	// Return the is.
	return $is;
}

/**
 * Check whether the current term is restricted.
 *
 * @return boolean Whether the current term is restricted.
 */
function is_current_term_restricted() {
	// Set the is.
	$is = false;

	// Get the request type.
	$type = get_request_type();

	// Check the request type.
	if ( 'taxonomy_archive' !== $type ) {
		// Return the is.
		return $is;
	}

	// Get the term ID.
	$term_id = get_queried_object_id();

	// Check whether it is restricted.
	$is = is_term_restricted( $term_id );

	// Return the is.
	return $is;
}

/**
 * Check whether the term should be redirected.
 *
 * @param int $term_id The term ID.
 * @return boolean Whether the term should be redirected.
 */
function should_redirect_term( $term_id ) {
	// Set the should.
	$should = false;

	// Get the settings.
	$settings = ps_simple_par_get_settings();

	// Check the settings.
	if ( empty( $settings ) ) {
		// Return the should.
		return $should;
	}

	// Check the taxonomies.
	if ( empty( $settings['taxonomies'] ) ) {
		// Return the should.
		return $should;
	}

	// Get the taxonomies.
	$taxonomies = $settings['taxonomies'];

	// Check the request.
	if ( is_tax( $taxonomies ) ) {
		// Set the should.
		$should = true;
	}

	// Check the taxonomies.
	if ( in_array( 'category', $taxonomies, true ) && is_category() ) {
		// Set the should.
		$should = true;
	}

	// Check the taxonomies.
	if ( in_array( 'post_tag', $taxonomies, true ) && is_tag() ) {
		// Set the should.
		$should = true;
	}

	// Return the should.
	return $should;
}

/**
 * Check whether the current term should be redirected.
 *
 * @return boolean Whether the current term should be redirected.
 */
function should_redirect_current_term() {
	// Set the should.
	$should = false;

	// Get the request type.
	$request_type = get_request_type();

	// Check the request type.
	if ( 'taxonomy_archive' !== $request_type ) {
		// Return the should.
		return $should;
	}

	// Get the term ID.
	$term_id = get_queried_object_id();

	// Check whether it should redirect.
	$should = should_redirect_term( $term_id );

	// Return the should.
	return $should;
}
