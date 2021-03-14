<?php
/**
 * Enum Type - ConfirmationTypeEnum
 *
 * @package WPGraphQLGravityForms\Types\Enum,
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Enum;

/**
 * Class - ConfirmationTypeEnum
 */
class ConfirmationTypeEnum extends AbstractEnum {
	const ENUM_NAME = 'ConfirmationTypeEnum';

	// Individual elements.
	const MESSAGE  = 'message';
	const PAGE     = 'page';
	const REDIRECT = 'redirect';

	/**
	 * Sets the Enum type description.
	 *
	 * @return string Enum type description.
	 */
	public function set_type_description() : string {
		return __( 'Type of form confirmation to be used.', 'wp-graphql-gravity-forms' );
	}

	/**
	 * Sets the Enum type values.
	 *
	 * @return array
	 */
	public function set_values() : array {
		return [
			'MESSAGE'  => [
				'description' => __( 'Use a confirmation "message".', 'wp-graphql-gravity-forms' ),
				'value'       => self::MESSAGE,
			],
			'PAGE'     => [
				'description' => __( 'Use a redirect to a different WordPress "page".', 'wp-graphql-gravity-forms' ),
				'value'       => self::PAGE,
			],
			'REDIRECT' => [
				'description' => __( 'Use a "redirect" to a given URL.', 'wp-graphql-gravity-forms' ),
				'value'       => self::REDIRECT,
			],
		];
	}
}