<?php
/**
 * GraphQL Object Type - NameFieldValue
 * Values for an individual Name field.
 *
 * @package WPGraphQLGravityForms\Types\Field\FieldValue
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Field\FieldValue;

use GF_Field;
use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Type;
use WPGraphQLGravityForms\Interfaces\FieldValue;
use WPGraphQLGravityForms\Types\Field\NameField;

/**
 * Class - NameFieldValue
 */
class NameFieldValue implements Hookable, Type, FieldValue {
	/**
	 * Type registered in WPGraphQL.
	 */
	const TYPE = NameField::TYPE . 'Value';

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() : void {
		add_action( 'graphql_register_types', [ $this, 'register_type' ] );
	}

	/**
	 * Register Object type to GraphQL schema.
	 */
	public function register_type() : void {
		register_graphql_object_type(
			self::TYPE,
			[
				'description' => __( 'Name field values.', 'wp-graphql-gravity-forms' ),
				'fields'      => [
					'prefix' => [
						'type'        => 'String',
						'description' => __( 'Prefix, such as Mr., Mrs. etc.', 'wp-graphql-gravity-forms' ),
					],
					'first'  => [
						'type'        => 'String',
						'description' => __( 'First name.', 'wp-graphql-gravity-forms' ),
					],
					'middle' => [
						'type'        => 'String',
						'description' => __( 'Middle name.', 'wp-graphql-gravity-forms' ),
					],
					'last'   => [
						'type'        => 'String',
						'description' => __( 'Last name.', 'wp-graphql-gravity-forms' ),
					],
					'suffix' => [
						'type'        => 'String',
						'description' => __( 'Suffix, such as Sr., Jr. etc.', 'wp-graphql-gravity-forms' ),
					],
				],
			]
		);
	}

	/**
	 * Get the field value.
	 *
	 * @param array    $entry Gravity Forms entry.
	 * @param GF_Field $field Gravity Forms field.
	 *
	 * @return array Entry field value.
	 */
	public static function get( array $entry, GF_Field $field ) : array {
			return [
				'prefix' => ! empty( $entry[ $field['inputs'][0]['id'] ] ) ? $entry[ $field['inputs'][0]['id'] ] : null,
				'first'  => ! empty( $entry[ $field['inputs'][1]['id'] ] ) ? $entry[ $field['inputs'][1]['id'] ] : null,
				'middle' => ! empty( $entry[ $field['inputs'][2]['id'] ] ) ? $entry[ $field['inputs'][2]['id'] ] : null,
				'last'   => ! empty( $entry[ $field['inputs'][3]['id'] ] ) ? $entry[ $field['inputs'][3]['id'] ] : null,
				'suffix' => ! empty( $entry[ $field['inputs'][4]['id'] ] ) ? $entry[ $field['inputs'][4]['id'] ] : null,
			];
	}
}
