<?php
/**
 * GraphQL Object Type - Gravity Forms form notification routing
 *
 * @see https://docs.gravityforms.com/notifications-object/#routing-rule-properties
 *
 * @package WPGraphQLGravityForms\Types\Form
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Form;

use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Type;

/**
 * Class - FormNotificationRouting
 */
class FormNotificationRouting implements Hookable, Type {
	const TYPE = 'FormNotificationRouting';

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
				'description' => __( 'Properties for all the email notifications which exist for a form.', 'wp-graphql-gravity-forms' ),
				'fields'      => [
					'fieldId'  => [
						'type'        => 'String',
						'description' => __( 'Target field ID. The field that will have it’s value compared with the value property to determine if this rule is a match.', 'wp-graphql-gravity-forms' ),
					],
					// @TODO: convert to an enum.
					'operator' => [
						'type'        => 'String',
						'description' => __( 'Operator to be used when evaluating this rule. Possible values: is, isnot, >, <, contains, starts_with, or ends_with.', 'wp-graphql-gravity-forms' ),
					],
					'value'    => [
						'type'        => 'String',
						'description' => __( 'The value to compare with the field specified by fieldId.', 'wp-graphql-gravity-forms' ),
					],
					'email'    => [
						'type'        => 'String',
						'description' => __( 'The email or merge tag to be used as the email To address if this rule is a match.', 'wp-graphql-gravity-forms' ),
					],
				],
			]
		);
	}
}
