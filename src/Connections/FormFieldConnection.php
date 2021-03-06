<?php
/**
 * Connection - FormField
 *
 * Registers connections from GravityFormsForm.
 *
 * @package WPGraphQLGravityForms\Connections
 * @since 0.0.1
 */

namespace WPGraphQLGravityForms\Connections;

use GFAPI;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQLRelay\Relay;
use WPGraphQL\AppContext;
use WPGraphQLGravityForms\DataManipulators\EntryDataManipulator;
use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Connection;
use WPGraphQLGravityForms\Types\Form\Form;
use WPGraphQLGravityForms\Types\Entry\Entry;
use WPGraphQLGravityForms\Types\Field\Field;
use WPGraphQLGravityForms\Types\Union\ObjectFieldUnion;
use WPGraphQLGravityForms\DataManipulators\FieldsDataManipulator;

/**
 * Class - FormFieldConnection
 */
class FormFieldConnection implements Hookable, Connection {
	/**
	 * The from field name.
	 */
	const FROM_FIELD = 'fields';

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() {
			add_action( 'init', [ $this, 'register_connection' ] );
	}

	/**
	 * Register connection from GravityFormsForm type to other types.
	 */
	public function register_connection() {
		register_graphql_connection(
			[
				'fromType'      => Form::TYPE,
				'toType'        => ObjectFieldUnion::TYPE,
				'fromFieldName' => self::FROM_FIELD,
				'resolve'       => function( array $root, array $args, AppContext $context, ResolveInfo $info ) : array {
					$fields              = ( new FieldsDataManipulator() )->manipulate( $root['fields'] );
					$connection          = Relay::connectionFromArray( $fields, $args );
					$nodes               = array_map( fn( $edge ) => $edge['node'] ?? null, $connection['edges'] );
					$connection['nodes'] = $nodes ?: null;

					return $connection;
				},
			]
		);

		register_graphql_connection(
			[
				'fromType'      => Form::TYPE,
				'toType'        => Entry::TYPE,
				'fromFieldName' => 'entries',
				'resolve'       => function( array $root, array $args, AppContext $context, ResolveInfo $info ) : array {
					$form_entries           = GFAPI::get_entries( $root['formId'] );
					$entry_data_manipulator = new EntryDataManipulator();
					$entries                = array_map( fn( array $entry ) => $entry_data_manipulator->manipulate( $entry ), $form_entries );
					$connection             = Relay::connectionFromArray( $entries, $args );

					return $connection;
				},
			]
		);
	}
}
