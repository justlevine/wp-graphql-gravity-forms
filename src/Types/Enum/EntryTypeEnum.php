<?php
/**
 * Enum Type - EntryTypeEnum
 *
 * @package WPGraphQLGravityForms\Types\Enum,
 * @since   0.4.0
 */

namespace WPGraphQLGravityForms\Types\Enum;

use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Enum;

/**
 * Class - EntryTypeEnum
 */
class EntryTypeEnum implements Hookable, Enum {
	const TYPE = 'EntryTypeEnum';

	// Individual elements.
	const NEW      = 'NEW';
	const EXISTING = 'EXISTING';

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() {
		add_action( 'graphql_register_types', [ $this, 'register' ] );
	}

	/**
	 * Registers Enum type.
	 */
	public function register() {
		register_graphql_enum_type(
			self::TYPE,
			[
				'description' => __( 'Type of entry to be created. Default is NEW.', 'wp-graphql-gravity-forms' ),
				'values'      => [
					self::NEW      => [
						'description' => __( 'New entry (default).', 'wp-graphql-gravity-forms' ),
						'value'       => self::NEW,
					],
					self::EXISTING => [
						'description' => __( 'Existing entry', 'wp-graphql-gravity-forms' ),
						'value'       => self::EXISTING,
					],
				],
			]
		);
	}
}
