<?php
/**
 * GraphQL Object Type - PhoneField
 *
 * @see https://docs.gravityforms.com/gf_field_phone/
 *
 * @package WPGraphQLGravityForms\Types\Field
 * @since   0.0.1
 * @since   0.2.0 Add missing properties.
 */

namespace WPGraphQLGravityForms\Types\Field;

use WPGraphQLGravityForms\Types\Enum\PhoneFieldFormatEnum;
use WPGraphQLGravityForms\Types\Field\FieldProperty;
use WPGraphQLGravityForms\Types\GraphQLInterface\FieldInterface;

/**
 * Class - PhoneField
 */
class PhoneField extends Field {
	/**
	 * Type registered in WPGraphQL.
	 */
	const TYPE = 'PhoneField';

	/**
	 * Type registered in Gravity Forms.
	 */
	const GF_TYPE = 'phone';

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
				'description' => __( 'Gravity Forms Phone field.', 'wp-graphql-gravity-forms' ),
				'interfaces'  => [ FieldInterface::TYPE ],
				'fields'      => array_merge(
					$this->get_global_properties(),
					$this->get_custom_properties(),
					FieldProperty\AdminLabelProperty::get(),
					FieldProperty\AdminOnlyProperty::get(),
					FieldProperty\AllowsPrepopulateProperty::get(),
					FieldProperty\DefaultValueProperty::get(),
					FieldProperty\DescriptionPlacementProperty::get(),
					FieldProperty\DescriptionProperty::get(),
					FieldProperty\ErrorMessageProperty::get(),
					FieldProperty\InputNameProperty::get(),
					FieldProperty\IsRequiredProperty::get(),
					FieldProperty\LabelProperty::get(),
					FieldProperty\NoDuplicatesProperty::get(),
					FieldProperty\PlaceholderProperty::get(),
					FieldProperty\SizeProperty::get(),
					FieldProperty\VisibilityProperty::get(),
					[
						'phoneFormat' => [
							'type'        => PhoneFieldFormatEnum::ENUM_NAME,
							'description' => __( 'Determines the allowed format for phones. If the phone value does not conform with the specified format, the field will fail validation.', 'wp-graphql-gravity-forms' ),
						],
					]
				),
			]
		);
	}
}
