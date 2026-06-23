<?php
/**
 * Land O' Lakes Gators — child theme of Twenty Twenty-Five.
 *
 * @package lol-gators
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the child theme's custom stylesheet on the front end.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'lol-gators',
			get_stylesheet_directory_uri() . '/assets/css/gators.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
);

/**
 * Load the same custom styles inside the block editor for visual parity.
 */
add_action(
	'after_setup_theme',
	function () {
		add_editor_style( 'assets/css/gators.css' );
	}
);

/**
 * Give the team's custom post types public archives, so we get automatic
 * roster / coaching-staff / sponsors listing pages (archive-{type}.html).
 *
 * The post types are registered by Secure Custom Fields; this filter augments
 * their registration args without editing the SCF definitions.
 */
add_filter(
	'register_post_type_args',
	function ( $args, $post_type ) {
		if ( in_array( $post_type, array( 'player', 'staff', 'sponsor' ), true ) ) {
			$args['has_archive'] = true;
		}
		return $args;
	},
	10,
	2
);

/**
 * Register the SCF field keys as post meta so the Block Bindings API
 * (source: core/post-meta) can read them in the block templates.
 */
add_action(
	'init',
	function () {
		$string_meta = array(
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'string',
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		);

		register_post_meta( 'player', 'jersey_number', $string_meta );
		register_post_meta( 'player', 'position', $string_meta );
		register_post_meta( 'player', 'grade', $string_meta );

		register_post_meta( 'staff', 'role', $string_meta );
		register_post_meta( 'staff', 'email', $string_meta );

		register_post_meta( 'sponsor', 'website', $string_meta );
		register_post_meta( 'sponsor', 'sponsorship_level', $string_meta );
	}
);

/**
 * Register a pattern category for team-specific patterns.
 */
add_action(
	'init',
	function () {
		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'lol-gators',
				array( 'label' => __( 'Gators', 'lol-gators' ) )
			);
		}
	}
);

// Secure Custom Fields field groups for Players, Coaching Staff, and Sponsors.
require_once __DIR__ . '/inc/fields.php';
