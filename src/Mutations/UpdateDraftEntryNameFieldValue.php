<?php
/**
 * Mutation - updateDraftEntryNameFieldValue
 *
 * Registers mutation to update a Gravity Forms draft entry name field value.
 *
 * @package WPGraphQLGravityForms\Mutation
 * @since 0.0.1
 */

namespace WPGraphQLGravityForms\Mutations;

use WPGraphQLGravityForms\Types\Input\NameInput;

/**
 * Class - UpdateDraftEntryNameFieldValue
 */
class UpdateDraftEntryNameFieldValue extends DraftEntryUpdater {
	/**
	 * Mutation name.
	 */
	const NAME = 'updateDraftEntryNameFieldValue';

	/**
	 * Defines the input field value configuration.
	 *
	 * @return array
	 */
	protected function get_value_input_field() : array {
		return [
			'type'        => NameInput::TYPE,
			'description' => __( 'The form field value.', 'wp-graphql-gravity-forms' ),
		];
	}

	/**
	 * Sanitizes the field values.
	 *
	 * @param array $value The field values.
	 *
	 * @return array
	 */
	protected function prepare_field_value( array $value ) : array {
		return [
			$this->field['inputs'][0]['id'] => array_key_exists( 'prefix', $value ) ? sanitize_text_field( $value['prefix'] ) : null,
			$this->field['inputs'][1]['id'] => array_key_exists( 'first', $value ) ? sanitize_text_field( $value['first'] ) : null,
			$this->field['inputs'][2]['id'] => array_key_exists( 'middle', $value ) ? sanitize_text_field( $value['middle'] ) : null,
			$this->field['inputs'][3]['id'] => array_key_exists( 'last', $value ) ? sanitize_text_field( $value['last'] ) : null,
			$this->field['inputs'][4]['id'] => array_key_exists( 'suffix', $value ) ? sanitize_text_field( $value['suffix'] ) : null,
		];
	}
}
