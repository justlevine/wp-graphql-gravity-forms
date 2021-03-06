<?php
/**
 * GraphQL Object Type - PostContentField
 *
 * @see https://docs.gravityforms.com/post-body/
 *
 * @package WPGraphQLGravityForms\Types\Field
 * @since   0.0.1
 * @since   0.2.0 Add missing properties.
 */

namespace WPGraphQLGravityForms\Types\Field;

use WPGraphQLGravityForms\Types\Field\FieldProperty;

/**
 * Class - PostContentField
 */
class PostContentField extends Field {
	/**
	 * Type registered in WPGraphQL.
	 */
	const TYPE = 'PostContentField';

	/**
	 * Type registered in Gravity Forms.
	 */
	const GF_TYPE = 'post_content';

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
				'description' => __( 'Gravity Forms Post Content field.', 'wp-graphql-gravity-forms' ),
				'fields'      => array_merge(
					$this->get_global_properties(),
					$this->get_custom_properties(),
					FieldProperty\AdminLabelProperty::get(),
					FieldProperty\AdminOnlyProperty::get(),
					FieldProperty\DefaultValueProperty::get(),
					FieldProperty\DescriptionPlacementProperty::get(),
					FieldProperty\DescriptionProperty::get(),
					FieldProperty\ErrorMessageProperty::get(),
					FieldProperty\InputNameProperty::get(),
					FieldProperty\IsRequiredProperty::get(),
					FieldProperty\LabelProperty::get(),
					FieldProperty\MaxLengthProperty::get(),
					FieldProperty\PlaceholderProperty::get(),
					FieldProperty\SizeProperty::get(),
					FieldProperty\VisibilityProperty::get(),
				),
			]
		);
	}
}
