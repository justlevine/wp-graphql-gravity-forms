<?php
/**
 * Enum Type - TimeFieldFormatEnum
 *
 * @package WPGraphQLGravityForms\Types\Enum,
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Enum;

/**
 * Class - TimeFieldFormatEnum
 */
class TimeFieldFormatEnum extends AbstractEnum {
	const ENUM_NAME = 'TimeFieldFormatEnum';

	// Individual elements.
	const H12 = '12';
	const H24 = '24';

	/**
	 * Sets the Enum type description.
	 *
	 * @return string Enum type description.
	 */
	public function set_type_description() : string {
		return __( 'How the time is displayed.', 'wp-graphql-gravity-forms' );
	}

	/**
	 * Sets the Enum type values.
	 *
	 * @return array
	 */
	public function set_values() : array {
		return [
			'H12' => [
				'description' => __( '12-hour time format.', 'wp-graphql-gravity-forms' ),
				'value'       => self::H12,
			],
			'H24' => [
				'description' => __( '24-hour time format', 'wp-graphql-gravity-forms' ),
				'value'       => self::H24,
			],
		];
	}
}
