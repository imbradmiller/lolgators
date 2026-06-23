<?php
/**
 * Secure Custom Fields — local field groups for the Gators post types.
 *
 * Defined in code (not the DB) so they live with the theme and are easy to
 * version and edit. Field "name" values become the post-meta keys that the
 * block templates read via the Block Bindings API (see functions.php).
 *
 * @package lol-gators
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'acf/init',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		// --- Players ---------------------------------------------------------
		acf_add_local_field_group(
			array(
				'key'      => 'group_gators_player',
				'title'    => 'Player Details',
				'fields'   => array(
					array(
						'key'     => 'field_gators_jersey_number',
						'label'   => 'Jersey Number',
						'name'    => 'jersey_number',
						'type'    => 'number',
						'wrapper' => array( 'width' => '33' ),
					),
					array(
						'key'         => 'field_gators_position',
						'label'       => 'Position',
						'name'        => 'position',
						'type'        => 'text',
						'placeholder' => 'Running Back',
						'wrapper'     => array( 'width' => '33' ),
					),
					array(
						'key'         => 'field_gators_grade',
						'label'       => 'Grade / Age Group',
						'name'        => 'grade',
						'type'        => 'text',
						'placeholder' => '5th Grade',
						'wrapper'     => array( 'width' => '34' ),
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'player',
						),
					),
				),
				'position' => 'acf_after_title',
				'active'   => true,
			)
		);

		// --- Coaching Staff --------------------------------------------------
		acf_add_local_field_group(
			array(
				'key'      => 'group_gators_staff',
				'title'    => 'Coaching Staff Details',
				'fields'   => array(
					array(
						'key'         => 'field_gators_role',
						'label'       => 'Role / Title',
						'name'        => 'role',
						'type'        => 'text',
						'placeholder' => 'Head Coach',
						'wrapper'     => array( 'width' => '50' ),
					),
					array(
						'key'     => 'field_gators_email',
						'label'   => 'Email',
						'name'    => 'email',
						'type'    => 'email',
						'wrapper' => array( 'width' => '50' ),
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'staff',
						),
					),
				),
				'position' => 'acf_after_title',
				'active'   => true,
			)
		);

		// --- Sponsors --------------------------------------------------------
		acf_add_local_field_group(
			array(
				'key'      => 'group_gators_sponsor',
				'title'    => 'Sponsor Details',
				'fields'   => array(
					array(
						'key'     => 'field_gators_website',
						'label'   => 'Website URL',
						'name'    => 'website',
						'type'    => 'url',
						'wrapper' => array( 'width' => '50' ),
					),
					array(
						'key'           => 'field_gators_level',
						'label'         => 'Sponsorship Level',
						'name'          => 'sponsorship_level',
						'type'          => 'select',
						'choices'       => array(
							'Platinum' => 'Platinum',
							'Gold'     => 'Gold',
							'Silver'   => 'Silver',
							'Bronze'   => 'Bronze',
						),
						'default_value' => 'Bronze',
						'return_format' => 'value',
						'ui'            => 1,
						'allow_null'    => 0,
						'wrapper'       => array( 'width' => '50' ),
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'sponsor',
						),
					),
				),
				'position' => 'acf_after_title',
				'active'   => true,
			)
		);
	}
);
