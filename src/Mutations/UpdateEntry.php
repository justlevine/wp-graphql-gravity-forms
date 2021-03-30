<?php
/**
 * Mutation - UpdateGravityFormsEntry
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
use WPGraphQLGravityForms\Types\Entry\Entry;
use WPGraphQLGravityForms\Types\FieldError\FieldError;
use WPGraphQLGravityForms\Types\Input\FieldValuesInput;
use WPGraphQLGravityForms\Types\Enum\EntryStatusEnum;
use WPGraphQLGravityForms\Utils\GFUtils;

/**
 * Class - UpdateEntry
 */
class UpdateEntry extends AbstractMutation {
	/**
	 * Mutation name.
	 */
	const NAME = '';
	/**
	 * Mutation Name
	 *
	 * @var string
	 */
	public static $name = 'updateGravityFormsEntry';

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
	 * The Gravity Forms Entry object.
	 *
	 * @var array
	 */
	private $entry;

	/**
	 * The Gravity Forms Form object.
	 *
	 * @var array
	 */
	private $form;

	/**
	 * Gravity Forms field validation errors.
	 *
	 * @var array
	 */
	private $errors = [];

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
			'entryId'     => [
				'type'        => 'String',
				'description' => __( 'The Gravity Forms entry id. Empty if submitting a new entry, the resume token if submitting a draft entry, or the existing entry id if updating a previously submitted entry.', 'wp-graphql-gravity-forms' ),
			],
			'fieldValues' => [
				'type'        => [ 'list_of' => FieldValuesInput::TYPE ],
				'description' => __( 'The field ids and their values.', 'wp-graphql-gravity-forms' ),
			],
			'isStarred'   => [
				'type'        => 'Boolean',
				'description' => __( 'Indicates if the entry has been starred (i.e marked with a star).', 'wp-graphql-gravity-forms' ),
			],
			'isRead'      => [
				'type'        => 'Boolean',
				'description' => __( 'Indicates if the entry has been read. 1 for entries that are read and 0 for entries that have not been read.', 'wp-graphql-gravity-forms' ),
			],
			'ip'          => [
				'type'        => 'String',
				'description' => __( 'Client IP of user who submitted the form.', 'wp-graphql-gravity-forms' ),
			],
			'createdBy'   => [
				'type'        => 'Integer',
				'description' => __( 'ID of the user that submitted of the form if a logged in user submitted the form.', 'wp-graphql-gravity-forms' ),
			],
			'status'      => [
				'type'        => EntryStatusEnum::TYPE,
				'description' => __( 'The current status of the entry.', 'wp-graphql-gravity-forms' ),
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
					if ( ! $payload['entryId'] && ! $payload['resumeToken'] ) {
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

			$this->entry = GFUtils::get_entry( (int) $input['entryId'] );
			$this->form  = GFUtils::get_form( $this->entry['form_id'] );

			$entry_data = $this->prepare_entry_data( $input );

			if ( ! empty( $this->errors ) ) {
				return [ 'errors' => $this->errors ];
			}

			$updated_entry_id = GFUtils::update_entry( $entry_data );

			return [
				'entryId' => $updated_entry_id,
			];
		};
	}

	/**
	 * Prepares entry object for update.
	 *
	 * @param array $input .
	 * @return array
	 */
	private function prepare_entry_data( array $input ) : array {
			$is_starred = $input['isStarred'] ?? null;
			$is_read    = $input['isRead'] ?? null;
			$ip         = isset( $input['ip'] ) && ! empty( $form['personalData']['preventIP'] ) ? sanitize_text_field( $input['ip'] ) : null;
			$created_by = isset( $input['createdBy'] ) ? absint( $input['createdBy'] ) : null;
			$status     = $input['status'] ?? null;

			$entry_properties = array_filter(
				[
					'is_starred' => $is_starred,
					'is_read'    => $is_read,
					'ip'         => $ip,
					'created_by' => $created_by,
					'status'     => $status,
				],
				fn( $property ) => (bool) strlen( $property )
			);
			$field_values     = $this->prepare_field_values( $input['fieldValues'] );

			return array_replace(
				$this->entry,
				$entry_properties,
				$field_values,
			);
	}


	/**
	 * Validates the Gravity Forms field value.
	 *
	 * @param GF_Field $field .
	 * @param mixed    $value .
	 *
	 * @return mixed
	 */
	private function validate_field_value( GF_Field $field, $value ) {
		$field->validate( $value, $this->form );
		if ( $field->failed_validation ) {
			$this->errors[] = [
				'id'      => $field->id,
				'message' => $field->validation_message,
			];
		}
		return $value;
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
					$formatted_values += $this->validate_field_value( $field, $this->prepare_address_field_value( $field, $value ) );
					break;
				case 'chainedselect':
				case 'checkbox':
					$formatted_values += $this->validate_field_value( $field, $this->prepare_complex_field_value( $field, $value ) );
					break;
				case 'consent':
					$formatted_values += $this->validate_field_value( $field, $this->prepare_consent_field_value( $field, $value ) );
					break;
				case 'email':
					$formatted_values[ $values['id'] ] = $this->validate_field_value( $field, $this->prepare_email_field_value( $value ) );
					break;
				case 'list':
					$formatted_values[ $values['id'] ] = $this->validate_field_value( $field, $this->prepare_list_field_value( $field, $value ) );
					break;
				case 'multiselect':
				case 'post_category':
				case 'post_custom':
				case 'post_tags':
					$formatted_values[ $values['id'] ] = $this->validate_field_value( $field, $this->prepare_string_array_value( $value ) );
					break;
				case 'name':
					$formatted_values += $this->validate_field_value( $field, $this->prepare_name_field_value( $field, $value ) );
					break;
				case 'website':
					$formatted_values[ $values['id'] ] = $this->validate_field_value( $field, $this->prepare_website_field_value( $value ) );
					break;
				case 'fileupload':
				case 'post_image':
					$formatted_values [ $values['id'] ] = $this->validate_field_value( $field, $this->prepare_fileupload_field_value( $field, $value ) );
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
					$formatted_values[ $values['id'] ] = $this->validate_field_value( $field, $this->prepare_string_value( $value ) );
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
		if ( ! isset( $input['entryId'] ) ) {
			throw new UserError( __( 'Mutation not processed. Entry ID not provided.', 'wp-graphql-gravity-forms' ) );
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
