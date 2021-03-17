<?php
/**
 * Enum Type - IdTypeEnum
 *
 * @package WPGraphQLGravityForms\Types\Enum,
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Enum;

/**
 * Class - IdTypeEnum
 */
class IdTypeEnum extends AbstractEnum {
	const ENUM_NAME = 'IdTypeEnum';

	// Individual elements.
	const ID          = 'global_id';
	const DATABASE_ID = 'database_id';

	/**
	 * Sets the Enum type description.
	 *
	 * @return string Enum type description.
	 */
	public function set_type_description() : string {
		return __( 'Type of button to be displayed. Default is TEXT.', 'wp-graphql-gravity-forms' );
	}

	/**
	 * Sets the Enum type values.
	 *
	 * @return array
	 */
	public function set_values() : array {
		return [
			'ID'          => [
				'description' => __( 'Unique global ID for the object.', 'wp-graphql-gravity-forms' ),
				'value'       => self::ID,
			],
			'DATABASE_ID' => [
				'description' => __( 'The database ID assigned by Gravity Forms', 'wp-graphql-gravity-forms' ),
				'value'       => self::DATABASE_ID,
			],
		];
	}
}