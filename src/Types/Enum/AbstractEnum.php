<?php
/**
 * Abstract Enum Type
 *
 * @package WPGraphQLGravityForms\Types\Enum
 * @since 0.4.0
 */

namespace WPGraphQLGravityForms\Types\Enum;

use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Enum;
use WPGraphQLGravityForms\Utils\Utils;

/**
 * Abstract Class - Abstract Enum
 */
abstract class AbstractEnum implements Hookable, Enum {

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() : void {
		add_action( 'graphql_register_types', [ $this, 'register' ] );
	}

	/**
	 * Registers Enum type.
	 */
	public function register() : void {
		register_graphql_enum_type(
			static::ENUM_NAME,
			[
				'description' => $this->set_type_description(),
				'values'      => $this->prepare_values(),
			],
		);
	}

	/**
	 * Filters and sorts the values before register().
	 *
	 * @return array
	 */
	private function prepare_values() : array {

		/**
		 * Pass the values through a filter.
		 */

		$values = apply_filters( 'wp_graphql_' . Utils::to_snake_case( static::ENUM_NAME ) . '_values', $this->set_values() );

		/**
		 * Sort the values alpahbetically by key.
		 */
		ksort( $values );

		return $values;
	}

}
