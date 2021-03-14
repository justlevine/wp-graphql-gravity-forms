<?php
/**
 * GraphQL Object Type - AddressField
 *
 * @see https://docs.gravityforms.com/gf_field_date/
 *
 * @package WPGraphQLGravityForms\Types\Field
 * @since   0.0.1
 * @since   0.2.0 Add missing properties.
 */

namespace WPGraphQLGravityForms\Types\Field;

use WPGraphQLGravityForms\Types\Enum\CalendarIconTypeEnum;
use WPGraphQLGravityForms\Types\Enum\DateFieldFormatEnum;
use WPGraphQLGravityForms\Types\Enum\DateTypeEnum;
use WPGraphQLGravityForms\Types\Field\FieldProperty;
use WPGraphQLGravityForms\Types\GraphQLInterface\FieldInterface;

/**
 * Class - DateField
 */
class DateField extends AbstractField {
	/**
	 * Type registered in WPGraphQL.
	 */
	const TYPE = 'DateField';

	/**
	 * Type registered in Gravity Forms.
	 */
	const GF_TYPE = 'date';

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
				'description' => __( 'Gravity Forms Date field.', 'wp-graphql-gravity-forms' ),
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
					FieldProperty\InputsProperty::get(),
					FieldProperty\IsRequiredProperty::get(),
					FieldProperty\LabelProperty::get(),
					FieldProperty\NoDuplicatesProperty::get(),
					FieldProperty\PlaceholderProperty::get(),
					FieldProperty\SizeProperty::get(),
					FieldProperty\SubLabelPlacementProperty::get(),
					FieldProperty\VisibilityProperty::get(),
					[
						'calendarIconType' => [
							'type'        => CalendarIconTypeEnum::ENUM_NAME,
							'description' => __( 'Determines how the date field displays it’s calendar icon.', 'wp-graphql-gravity-forms' ),
						],
						'calendarIconUrl'  => [
							'type'        => 'String',
							'description' => __( 'Contains the URL to the custom calendar icon. Only applicable when calendarIconType is set to custom.', 'wp-graphql-gravity-forms' ),
						],
						'dateFormat'       => [
							'type'        => DateFieldFormatEnum::ENUM_NAME,
							'description' => __( 'Determines how the date is displayed.', 'wp-graphql-gravity-forms' ),
						],
						'dateType'         => [
							'type'        => DateTypeEnum::ENUM_NAME,
							'description' => __( 'The type of date field to display.', 'wp-graphql-gravity-forms' ),
						],
					]
				),
			]
		);
	}
}
