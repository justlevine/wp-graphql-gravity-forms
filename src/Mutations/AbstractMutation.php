<?php
/**
 * Abstract class for Mutations
 *
 * @package WPGraphQLGravityForms\Mutation
 * @since 0.0.1
 */

namespace WPGraphQLGravityForms\Mutations;

use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Mutation;

/**
 * Class - DraftEntryUpdator
 */
abstract class AbstractMutation implements Hookable, Mutation {

	/**
	 * Mutation Name
	 *
	 * @var string
	 */
	public static $name;

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() : void {
		add_action( 'graphql_register_types', [ $this, 'register_mutation' ] );
	}

	/**
	 * Registers mutation.
	 */
	public function register_mutation() : void {
		register_graphql_mutation(
			static::$name,
			[
				'inputFields'         => $this->get_input_fields(),
				'outputFields'        => $this->get_output_fields(),
				'mutateAndGetPayload' => $this->mutate_and_get_payload(),
			]
		);
	}
}
