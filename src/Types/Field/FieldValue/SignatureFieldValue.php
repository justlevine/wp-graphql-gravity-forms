<?php
/**
 * GraphQL Object Type - SignatureFieldValue
 * Values for an individual Signature field.
 *
 * @package WPGraphQLGravityForms\Types\Field\FieldValue
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Field\FieldValue;

use GF_Field;
use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Type;
use WPGraphQLGravityForms\Interfaces\FieldValue;
use WPGraphQLGravityForms\Types\Field\SignatureField;

/**
 * Class - SignatureFieldValue
 */
class SignatureFieldValue implements Hookable, Type, FieldValue {
	/**
	 * Type registered in WPGraphQL.
	 */
	const TYPE = SignatureField::TYPE . 'Value';

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() {
		add_action( 'graphql_register_types', [ $this, 'register_type' ] );
	}

	/**
	 * Register Object type to GraphQL schema.
	 */
	public function register_type() {
		register_graphql_object_type(
			self::TYPE,
			[
				'description' => __( 'Signature field value.', 'wp-graphql-gravity-forms' ),
				'fields'      => [
					'url' => [
						'type'        => 'String',
						'description' => __( 'The URL to the signature image.', 'wp-graphql-gravity-forms' ),
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
		if ( ! function_exists( 'gf_signature' ) || ! array_key_exists( $field['id'], $entry ) ) {
			return [ 'url' => null ];
		}

		return [
			'url' => gf_signature()->get_signature_url( $entry[ $field['id'] ] ),
		];
	}
}
