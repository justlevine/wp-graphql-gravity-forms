<?php
/**
 * Gravity Forms field.
 *
 * @see https://docs.gravityforms.com/field-object/
 * @see https://docs.gravityforms.com/gf_field/
 *
 * @package WPGraphQLGravityForms\Types\Field
 * @since   0.0.1
 * @since   0.2.0 Remove adminLabel, adminOnly, allowsPrepopulate, label, and visibility from global properties.
 */

namespace WPGraphQLGravityForms\Types\Field;

use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Type;
use WPGraphQLGravityForms\Types\GraphQLInterface\FieldInterface;
/**
 * Class - Field
 */
abstract class Field implements Hookable, Type {
	/**
	 * Get the global properties that apply to all GF field types.
	 *
	 * @return array
	 */
	protected function get_global_properties() : array {
		return FieldInterface::get_properties();
	}

	/**
	 * Get the custom properties.
	 *
	 * @return array
	 */
	protected function get_custom_properties() : array {
		/**
		 * Add GraphQL fields for custom field properties.
		 *
		 * @param array Additional GraphQL field definitions.
		 * @param array The type of Gravity Forms field.
		 */
		return apply_filters( 'wp_graphql_gf_custom_properties', [], static::GF_TYPE );
	}
}
