<?php
/**
 * Mutation - submitGravityFormsForm
 *
 * Registers mutation to submit a Gravity Forms draft entry so that it becomes a permanent entry.
 *
 * @package WPGraphQLGravityForms\Mutation
 * @since 0.0.1
 * @since 0.3.0 Support post creation.
 */

namespace WPGraphQLGravityForms\Mutations;

use GFAPI;
use GF_Field;
use GFFormsModel;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQLGravityForms\DataManipulators\EntryDataManipulator;
use WPGraphQLGravityForms\DataManipulators\DraftEntryDataManipulator;
use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Interfaces\Mutation;
use WPGraphQLGravityForms\Types\Entry\Entry;
use WPGraphQLGravityForms\Types\FieldError\FieldError;
use WPGraphQLGravityForms\Types\Input\FieldValuesInput;
use WPGraphQLGravityForms\Utils\GFUtils;
use WPGraphQLGravityForms\Utils\Utils;

/**
 * Class - SubmitForm
 */
class SubmitForm extends AbstractMutation {
	/**
	 * Mutation Name
	 *
	 * @var string
	 */
	public static $name = 'submitGravityFormsForm';

	/**
	 * EntryDataManipulator instance.
	 *
	 * @var EntryDataManipulator
	 */
	private $entry_data_manipulator;
	/**
	 * DraftEntryDataManipulator instance.
	 *
	 * @var DraftEntryDataManipulator
	 */
	private $draft_entry_data_manipulator;

	/**
	 * The Gravity Forms form object.
	 *
	 * @var array
	 */
	private $form;

	/**
	 * Whether the form should be saved as a draft entry.
	 *
	 * @var boolean
	 */
	private $save_as_draft;

	/**
	 * Constructor
	 *
	 * @param array $instances .
	 */
	public function __construct( array $instances ) {
		$this->entry_data_manipulator       = $instances['entry_data_manipulator'];
		$this->draft_entry_data_manipulator = $instances['draft_entry_data_manipulator'];
	}

	/**
	 * Defines the input field configuration.
	 *
	 * @return array
	 */
	public function get_input_fields() : array {
		return [
			'createdBy'   => [
				'type'        => 'Integer',
				'description' => __( 'Optional. ID of the user that submitted of the form if a logged in user submitted the form.', 'wp-graphql-gravity-forms' ),
			],
			'fieldValues' => [
				'type'        => [ 'list_of' => FieldValuesInput::TYPE ],
				'description' => __( 'The field ids and their values.', 'wp-graphql-gravity-forms' ),
			],
			'formId'      => [
				'type'        => [ 'non_null' => 'Integer' ],
				'description' => __( 'The form ID.', 'wp-graphql-gravity-forms' ),
			],
			'ip'          => [
				'type'        => 'String',
				'description' => __( 'Optional. The IP address of the user who submitted the draft entry. Default is an empty string.', 'wp-graphql-gravity-forms' ),
			],
			'saveAsDraft' => [
				'type'        => 'Boolean',
				'description' => __( 'Optional. Set to `true` if submitting a draft entry.', 'wp-graphql-gravity-forms' ),
			],
			'sourcePage'  => [
				'type'        => 'Integer',
				'description' => __( 'Optional. Default is 1. Useful for multi-page forms to indicate which page of the form was just submitted.', 'wp-graphql-gravity-forms' ),
			],
			'targetPage'  => [
				'type'        => 'Integer',
				'description' => __( 'Optional. Default is 0. Useful for multi-page forms to indicate which page is to be loaded if the current page passes validation.', 'wp-graphql-gravity-forms' ),
			],
		];
	}

	/**
	 * Defines the output field configuration.
	 *
	 * @return array
	 */
	public function get_output_fields() : array {
		return [
			'entryId'     => [
				'type'        => 'Integer',
				'description' => __( 'The ID of the entry that was created. Null if the entry was only partially submitted or submitted as a draft.', 'wp-graphql-gravity-forms' ),
			],
			'entry'       => [
				'type'        => Entry::TYPE,
				'description' => __( 'The entry that was created.', 'wp-graphql-gravity-forms' ),
				'resolve'     => function( array $payload ) {
					if ( ! empty( $payload['errors'] ) || ( ! $payload['entryId'] && ! $payload['resumeToken'] ) ) {
						return null;
					}

					if ( $payload['entryId'] ) {
						$entry = GFUtils::get_entry( $payload['entryId'] );

						return $this->entry_data_manipulator->manipulate( $entry );
					}

					if ( $payload['resumeToken'] ) {
						$submission = GFUtils::get_draft_submission( $payload['resumeToken'] );

						return $this->draft_entry_data_manipulator->manipulate( $submission['partial_entry'], $payload['resumeToken'] );
					}
				},
			],
			'errors'      => [
				'type'        => [ 'list_of' => FieldError::TYPE ],
				'description' => __( 'Field errors.', 'wp-graphql-gravity-forms' ),
			],
			'resumeToken' => [
				'type'        => 'String',
				'description' => __( 'Draft resume token.', 'wp-graphql-gravity-forms' ),
			],
			'resumeUrl'   => [
				'type'        => 'String',
				'description' => __( 'Draft resume URL. If the "Referer" header is not included in the request, this will be an empty string.', 'wp-graphql-gravity-forms' ),
			],
		];
	}

	/**
	 * Defines the data modification closure.
	 *
	 * @return callable
	 */
	public function mutate_and_get_payload() : callable {
		return function( $input, AppContext $context, ResolveInfo $info ) : array {
			// Check for required fields.
			$this->validate_required_inputs( $input );

			// Set default values.
			$target_page         = $input['targetPage'] ?? 0;
			$source_page         = $input['sourcePage'] ?? 1;
			$this->save_as_draft = $input['saveAsDraft'] ?? false;
			$ip                  = isset( $input['ip'] ) && ! empty( $form['personalData']['preventIP'] ) ? sanitize_text_field( $input['ip'] ) : null;
			$created_by          = isset( $input['createdBy'] ) ? absint( $input['createdBy'] ) : null;
			$source_url          = esc_url_raw( Utils::truncate( $_SERVER['HTTP_REFERER'] ?? '', 250 ) );

			$this->form = GFUtils::get_form( $input['formId'] );

			$field_values = $this->get_field_values( $input['fieldValues'] );

			$submission = GFAPI::submit_form(
				$input['formId'],
				$this->get_input_values( $this->save_as_draft, $field_values ),
				$field_values,
				$target_page,
				$source_page,
			);

			if ( is_wp_error( $submission ) ) {
				throw new UserError( __( 'There was an error while processing the form. Error: ', 'wp-graphql-gravity-forms' ) . $submission->get_error_message() );
			}

			if ( $submission['is_valid'] ) {
				$this->update_entry_properties( $submission, $ip, $created_by, $source_url );
			}

			return [
				'entryId'     => ! empty( $submission['entry_id'] ) ? absint( $submission['entry_id'] ) : null,
				'resumeToken' => $submission['resume_token'] ?? null,
				'resumeUrl'   => isset( $submission['resume_token'] ) ? GFUtils::get_resume_url( $source_url, $submission['resume_token'], $this->form ) : null,
				'errors'      => isset( $submission['validation_messages'] ) ? $this->get_submission_errors( $submission['validation_messages'] ) : null,
			];
		};
	}

	/**
	 * Generates array of field errors from the submission.
	 *
	 * @param array $messages The Gravity Forms submission validation messages.
	 * @return array
	 */
	private function get_submission_errors( array $messages ) : array {
		return array_map(
			function( $id, $message ) {
				return [
					'id'      => $id,
					'message' => $message,
				];
			},
			array_keys( $messages ),
			$messages
		);
	}

	/**
	 * Gets the field values, properly formatted for Gravity Forms.
	 *
	 * @param array $field_values .
	 * @return array
	 */
	private function get_field_values( array $field_values ) : array {
		$field_values = $this->prepare_field_values( $field_values );

		if ( ! $this->save_as_draft ) {
			$empty_fields = $this->generate_empty_fields();
			$field_values = $field_values + $empty_fields;
		}

		return $this->format_field_keys( $field_values );
	}

	/**
	 * Updates entry properties that cannot be set with GFAPI::submit_form().
	 *
	 * @param array   $submission The Gravity Forms submission result array.
	 * @param string  $ip .
	 * @param integer $created_by .
	 * @param string  $source_url .
	 * @throws UserError .
	 */
	private function update_entry_properties( array $submission, string $ip = null, int $created_by = null, string $source_url ) : void {
		if ( ! $submission['entry_id'] || empty( $submission['resume_token'] ) ) {
			return;
		}

		if ( $submission['resume_token'] ) {
			$draft_entry = GFUtils::get_draft_entry( $submission['resume_token'] );

			$ip         = $ip ?? $draft_entry['partial_entry']['ip'];
			$created_by = $created_by ?? $draft_entry['partial_entry']['created_by'];
			$is_updated = GFFormsModel::update_draft_submission( $submission['resume_token'], $this->form, $draft_entry['partial_entry']['date_created'], $ip, $source_url, $draft_entry['submission'] );
			if ( empty( $is_updated ) ) {
				throw new UserError( __( 'Unable to update the draft entry properties.', 'wp-graphql-gravity-forms' ) );
			}
			return;
		}

		if ( null !== $ip ) {
			$is_updated = GFAPI::update_entry_property( $submission['entry_id'], 'ip', $ip );
			if ( ! $is_updated ) {
				throw new UserError( __( 'Unable to update the entry IP address', 'wp-graphql-gravity-forms' ) );
			}
		}

		if ( null !== $created_by ) {
			$is_updated = GFAPI::update_entry_property( $submission['entry_id'], 'created_by', $created_by );
			if ( ! $is_updated ) {
				throw new UserError( __( 'Unable to update the entry createdBy id.', 'wp-graphql-gravity-forms' ) );
			}
		}

		$is_updated = GFAPI::update_entry_property( $submission['entry_id'], 'source_url', $source_url );
		if ( ! $is_updated ) {
			throw new UserError( __( 'Unable to update the entry source url', 'wp-graphql-gravity-forms' ) );
		}
	}

	/**
	 * Renames the $field_value input keys into a format Gravity Forms can understand.
	 *
	 * @param array $field_values .
	 * @return array
	 */
	private function format_field_keys( array $field_values ) : array {
		$formatted = [];

		foreach ( $field_values as $key => $value ) {
			$formatted[ 'input_' . str_replace( '.', '_', $key ) ] = $value;
		}
		return $formatted;
	}

	/**
	 * Creates the $input_values array required by GFAPI::submit_form().
	 *
	 * @param boolean $is_draft .
	 * @param array   $field_values The field values. Required so submit_form() can generate the $_POST object.
	 * @return array
	 */
	private function get_input_values( bool $is_draft, array $field_values ) : array {
		return [
			'gform_save' => $is_draft,
		] + $field_values;
	}

	/**
	 * Sets empty field values for all fields associated with the form.
	 * This is necessary to validate fields not provided in the mutation.
	 *
	 * @return array
	 */
	private function generate_empty_fields() : array {
		$empty_fields = [];

		foreach ( $this->form['fields'] as $field ) {
			if ( ! empty( $field->inputs ) ) {
				foreach ( $field->inputs as $input ) {
					$empty_fields[ $input['id'] ] = null;
				}
			} else {
				$empty_fields[ $field->id ] = null;
			}
		}
		return $empty_fields;
	}

	/**
	 * Converts the provided field values into a format that Gravity Forms can understand.
	 *
	 * @param array $field_values .
	 * @return array
	 */
	private function prepare_field_values( array $field_values ) : array {
		$formatted_values = [];

		foreach ( $field_values as $values ) {
			$field = GFUtils::get_field_by_id( $this->form, $values['id'] );

			$this->validate_field_value_type( $field, $values );

			$value = $values['addressValues'] ?? $values['chainedSelectValues'] ?? $values['checkboxValues'] ?? $values['listValues'] ?? $values['nameValues'] ?? $values['value'];

			switch ( $field->type ) {
				case 'address':
					$formatted_values += $this->prepare_address_field_value( $field, $value );
					break;
				case 'chainedselect':
				case 'checkbox':
					$formatted_values += $this->prepare_complex_field_value( $field, $value );
					break;
				case 'consent':
					$formatted_values += $this->prepare_consent_field_value( $field, $value );
					break;
				case 'email':
					$formatted_values[ $values['id'] ] = $this->prepare_email_field_value( $value );
					break;
				case 'list':
					$formatted_values[ $values['id'] ] = $this->prepare_list_field_value( $field, $value );
					break;
				case 'multiselect':
				case 'post_category':
				case 'post_custom':
				case 'post_tags':
					$formatted_values[ $values['id'] ] = $this->prepare_string_array_value( $value );
					break;
				case 'name':
					$formatted_values += $this->prepare_name_field_value( $field, $value );
					break;
				case 'website':
					$formatted_values[ $values['id'] ] = $this->prepare_website_field_value( $value );
					break;
				case 'fileupload':
				case 'post_image':
					$formatted_values [ $values['id'] ] = $this->prepare_fileupload_field_value( $field, $value );
					break;
				case 'date':
				case 'hidden':
				case 'number':
				case 'phone':
				case 'post_content':
				case 'post_excerpt':
				case 'post_title':
				case 'radio':
				case 'select':
				case 'textarea':
				case 'text':
				case 'time':
				default:
					$formatted_values[ $values['id'] ] = $this->prepare_string_value( $value );
					break;
			}
		}

		return $formatted_values;
	}

	/**
	 * Formats and sanitizes the AddressField value.
	 *
	 * @param GF_Field $field .
	 * @param array    $value .
	 * @return array
	 */
	private function prepare_address_field_value( GF_Field $field, array $value ) : array {
			return [
				$field['inputs'][0]['id'] => array_key_exists( 'street', $value ) ? sanitize_text_field( $value['street'] ) : null,
				$field['inputs'][1]['id'] => array_key_exists( 'lineTwo', $value ) ? sanitize_text_field( $value['lineTwo'] ) : null,
				$field['inputs'][2]['id'] => array_key_exists( 'city', $value ) ? sanitize_text_field( $value['city'] ) : null,
				$field['inputs'][3]['id'] => array_key_exists( 'state', $value ) ? sanitize_text_field( $value['state'] ) : null,
				$field['inputs'][4]['id'] => array_key_exists( 'zip', $value ) ? sanitize_text_field( $value['zip'] ) : null,
				$field['inputs'][5]['id'] => array_key_exists( 'country', $value ) ? sanitize_text_field( $value['country'] ) : null,
			];
	}

	/**
	 * Formats and sanitizes complex field values that are comprised of several input fields.
	 *
	 * @param GF_Field $field .
	 * @param array    $value .
	 * @return array
	 */
	private function prepare_complex_field_value( GF_Field $field, array $value ) : array {
		$values_to_save = array_reduce(
			$field->inputs,
			function( array $values_to_save, array $input ) : array {
				$values_to_save[ $input['id'] ] = ''; // Initialize all inputs to an empty string.
				return $values_to_save;
			},
			[]
		);

		foreach ( $value as $single_value ) {
			$input_id    = sanitize_text_field( $single_value['inputId'] );
			$input_value = sanitize_text_field( $single_value['value'] );

			// Make sure the input ID passed in exists.
			if ( ! isset( $values_to_save[ $input_id ] ) ) {
				continue;
			}

			// Overwrite initial empty string with the value passed in.
			$values_to_save[ $input_id ] = $input_value;
		}

		return $values_to_save;
	}

	/**
	 * Formats and sanitizes the ConsentField value.
	 *
	 * @param GF_Field $field .
	 * @param array    $value .
	 * @return array
	 */
	private function prepare_consent_field_value( GF_Field $field, array $value ) : array {
		return [
			$field->inputs[0]['id'] => (bool) $value,
			$field->inputs[1]['id'] => isset( $field->checkboxLabel ) ? sanitize_text_field( $field->checkboxLabel ) : null,
			$field->inputs[2]['id'] => isset( $field->descriptiom ) ? sanitize_text_field( $field->description ) : null,
		];
	}

	/**
	 * Sanitizes the EmailField value.
	 *
	 * @param string $value .
	 * @return string
	 */
	private function prepare_email_field_value( string $value ) : string {
		return sanitize_email( $value );
	}

	/**
	 * Saves the FileUploadField value to $_FILES.
	 *
	 * @param GF_Field $field .
	 * @param string   $value .
	 * @return string
	 */
	private function prepare_fileupload_field_value( GF_Field $field, string $value ) : string {
		$_FILES[ 'input_' . $field->id ] = $value;
		return $value;
	}

	/**
	 * Formats and sanitizes ListField values.
	 *
	 * @param GF_Field $field .
	 * @param array    $value .
	 * @return array
	 */
	private function prepare_list_field_value( GF_Field $field, array $value ) : array {
		$values_to_save = [];
		foreach ( $value as $row ) {
			foreach ( $row as $row_values ) {
				foreach ( $row_values as $single_value ) {
					$values_to_save[] = sanitize_text_field( $single_value );
				}
			}
		}

		return $values_to_save; //phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
	}

	/**
	 * Formats and sanitizes the NameField value.
	 *
	 * @param GF_Field $field .
	 * @param array    $value .
	 * @return array
	 */
	private function prepare_name_field_value( GF_Field $field, array $value ) : array {
		return [
			$field['inputs'][0]['id'] => array_key_exists( 'prefix', $value ) ? sanitize_text_field( $value['prefix'] ) : null,
			$field['inputs'][1]['id'] => array_key_exists( 'first', $value ) ? sanitize_text_field( $value['first'] ) : null,
			$field['inputs'][2]['id'] => array_key_exists( 'middle', $value ) ? sanitize_text_field( $value['middle'] ) : null,
			$field['inputs'][3]['id'] => array_key_exists( 'last', $value ) ? sanitize_text_field( $value['last'] ) : null,
			$field['inputs'][4]['id'] => array_key_exists( 'suffix', $value ) ? sanitize_text_field( $value['suffix'] ) : null,
		];
	}

	/**
	 * Sanitizes string field values.
	 *
	 * @param string $value .
	 * @return string
	 */
	private function prepare_string_value( string $value ) : string {
		return sanitize_text_field( $value );
	}

	/**
	 * Formats and sanitizes field string array field values.
	 *
	 * @param array $value .
	 * @return string
	 */
	private function prepare_string_array_value( array $value ) : string {
		return (string) wp_json_encode( array_map( 'sanitize_text_field', $value ) );
	}

	/**
	 * Sanitizes the WebsiteField value.
	 *
	 * @param string $value .
	 * @return string
	 */
	private function prepare_website_field_value( string $value ) : string {
		return esc_url_raw( $value );
	}

	/**
	 * Ensures required input fields are set.
	 *
	 * @param mixed $input .
	 * @throws UserError .
	 */
	private function validate_required_inputs( $input = null ) : void {
		if ( empty( $input ) || ! is_array( $input ) ) {
				throw new UserError( __( 'Mutation not processed. The input data was missing or invalid.', 'wp-graphql-gravity-forms' ) );
		}
		if ( ! isset( $input['formId'] ) ) {
			throw new UserError( __( 'Mutation not processed. Form ID not provided.', 'wp-graphql-gravity-forms' ) );
		}
		if ( empty( $input['fieldValues'] ) ) {
			throw new UserError( __( 'Mutation not processed. Field values not provided.', 'wp-graphql-gravity-forms' ) );
		}
	}

	/**
	 * Checks that the proper GraphQL input type is used to submit the field values.
	 *
	 * @param GF_Field $field .
	 * @param array    $values the `fieldValues` input array.
	 *
	 * @throws UserError .
	 */
	private function validate_field_value_type( GF_Field $field, array $values ) : void {
		switch ( $field->type ) {
			case 'address':
				if ( ! isset( $values['addressValues'] ) ) {
					// translators: Gravity Forms field id.
					throw new UserError( sprintf( __( 'Mutation not processed. Field %d requires the use of `addressValues`.', 'wp-graphql-gravity-forms' ), $field->id ) );
				}
				break;
			case 'chainedselect':
				if ( ! isset( $values['chainedSelectValues'] ) ) {
					// translators: Gravity Forms field id.
					throw new UserError( sprintf( __( 'Mutation not processed. Field %d requires the use of `chainedSelectValues`.', 'wp-graphql-gravity-forms' ), $field->id ) );
				}
				break;
			case 'checkbox':
				if ( ! isset( $values['checkboxValues'] ) ) {
					// translators: Gravity Forms field id.
					throw new UserError( sprintf( __( 'Mutation not processed. Field %d requires the use of `checkboxValues`.', 'wp-graphql-gravity-forms' ), $field->id ) );
				}
				break;
			case 'list':
				if ( ! isset( $values['listValues'] ) ) {
					// translators: Gravity Forms field id.
					throw new UserError( sprintf( __( 'Mutation not processed. Field %d requires the use of `listValues`.', 'wp-graphql-gravity-forms' ), $field->id ) );
				}
				break;
			case 'name':
				if ( ! isset( $values['nameValues'] ) ) {
					// translators: Gravity Forms field id.
					throw new UserError( sprintf( __( 'Mutation not processed. Field %d requires the use of `nameValues`.', 'wp-graphql-gravity-forms' ), $field->id ) );
				}
				break;
			default:
				if ( ! isset( $values['value'] ) ) {
					// translators: Gravity Forms field id.
					throw new UserError( sprintf( __( 'Mutation not processed. Field %d requires the use of `value`.', 'wp-graphql-gravity-forms' ), $field->id ) );
				}
				break;
		}
	}
}
