<?php
/**
 * Enum Type - EntryTypeEnum
 *
 * @package WPGraphQLGravityForms\Types\Enum,
 * @since   0.4.0
 */

namespace WPGraphQLGravityForms\Types\Enum;

/**
 * Class - EntryTypeEnum
 */
class EntryTypeEnum extends AbstractEnum {
	const ENUM_NAME = 'EntryTypeEnum';

	// Individual elements.
	const NEW      = 'NEW';
	const EXISTING = 'EXISTING';

	/**
	 * Sets the Enum type description.
	 *
	 * @return string Enum type description.
	 */
	public function set_type_description() : string {
		return __( 'Type of entry to be created. Default is NEW.', 'wp-graphql-gravity-forms' );
	}

	/**
	 * Sets the Enum type values.
	 *
	 * @return array
	 */
	public function set_values() : array {
		return [
			self::NEW      => [
				'description' => __( 'New entry (default).', 'wp-graphql-gravity-forms' ),
				'value'       => self::NEW,
			],
			self::EXISTING => [
				'description' => __( 'Existing entry', 'wp-graphql-gravity-forms' ),
				'value'       => self::EXISTING,
			],
		];
	}
}
