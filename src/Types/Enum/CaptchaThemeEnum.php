<?php
/**
 * Enum Type - CaptchaThemeEnum
 *
 * @package WPGraphQLGravityForms\Types\Enum,
 * @since   0.0.1
 */

namespace WPGraphQLGravityForms\Types\Enum;

/**
 * Class - CaptchaThemeEnum
 */
class CaptchaThemeEnum extends AbstractEnum {
	const ENUM_NAME = 'CaptchaThemeEnum';

	// Individual elements.
	const RED        = 'red';
	const WHITE      = 'white';
	const BLACKGLASS = 'blackglass';
	const CLEAN      = 'clean';

	/**
	 * Sets the Enum type description.
	 *
	 * @return string Enum type description.
	 */
	public function set_type_description() : string {
		return __( 'The theme to be used for the reCAPTCHA field.', 'wp-graphql-gravity-forms' );
	}

	/**
	 * Sets the Enum type values.
	 *
	 * @return array
	 */
	public function set_values() : array {
		return [
			'RED'        => [
				'description' => __( 'Red reCAPTCHA theme.', 'wp-graphql-gravity-forms' ),
				'value'       => self::RED,
			],
			'WHITE'      => [
				'description' => __( 'White reCAPTCHA theme.', 'wp-graphql-gravity-forms' ),
				'value'       => self::WHITE,
			],
			'BLACKGLASS' => [
				'description' => __( 'Black glass reCAPTCHA theme.', 'wp-graphql-gravity-forms' ),
				'value'       => self::BLACKGLASS,
			],
			'CLEAN'      => [
				'description' => __( 'Clean reCAPTCHA theme.', 'wp-graphql-gravity-forms' ),
				'value'       => self::CLEAN,
			],
		];
	}
}