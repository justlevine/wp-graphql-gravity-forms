<?php
/**
 * Mutation - submitGravityFormsDraftEntry
 *
 * Registers mutation to submit a Gravity Forms draft entry so that it becomes a permanent entry.
 *
 * @package WPGraphQLGravityForms\Mutation
 * @since 0.0.1
 * @since 0.3.0 Support post creation.
 */

namespace WPGraphQLGravityForms\Mutations;

use GFAPI;
use GFCommon;
use GF_Field;
use GFFormDisplay;
use GFFormsModel;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQLGravityForms\Types\Entry\Entry;
use WPGraphQLGravityForms\DataManipulators\EntryDataManipulator;
use WPGraphQLGravityForms\Utils\GFUtils;

/**
 * Class - SubmitDraftEntry
 */
class SubmitDraftEntry extends AbstractMutation {
	/**
	 * Mutation Name
	 *
	 * @var string
	 */
	public static $name = 'submitGravityFormsDraftEntry';

	/**
	 * EntryDataManipulator instance.
	 *
	 * @var EntryDataManipulator
	 */
	private $entry_data_manipulator;

	/**
	 * Gravity Forms form object.
	 *
	 * @var array
	 */
	private $form;

	/**
	 * Constructor
	 *
	 * @param EntryDataManipulator $entry_data_manipulator .
	 */
	public function __construct( EntryDataManipulator $entry_data_manipulator ) {
		$this->entry_data_manipulator = $entry_data_manipulator;
	}

	/**
	 * Register hooks to WordPress.
	 */
	public function register_hooks() : void {
		parent::register_hooks();
		add_action( 'graphql_before_resolve_field', [ $this, 'ensure_required_fields_are_set' ], 10, 7 );
	}

	/**
	 * Defines the input field configuration.
	 *
	 * @return array
	 */
	public function get_input_fields() : array {
		return [
			'forceCreate'          => [
				'type'        => 'Boolean',
				'description' => __( 'Optional. If `true`, a new entry will be created even if the draft entry was created from an existing one. Defaults to `false`.', 'wp-graphql-gravity-forms' ),
			],
			'resumeToken'          => [
				'type'        => 'String',
				'description' => __( 'Draft resume token.', 'wp-graphql-gravity-forms' ),
			],
			'triggerNotifications' => [
				'type'        => 'Boolean',
				'description' => __( 'Whether GravityForms notifications should be sent. Defaults to `true`.', 'wp-graphql-gravity-forms' ),
			],
			'triggerPostCreation'  => [
				'type'        => 'Boolean',
				'description' => __( 'Optional. Whether a new post should be created.', 'wp-graphql-gravity-forms' ),
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
			'entryId' => [
				'type'        => 'Integer',
				'description' => __( 'The ID of the entry that was created.', 'wp-graphql-gravity-forms' ),
			],
			'entry'   => [
				'type'        => Entry::TYPE,
				'description' => __( 'The entry that was created.', 'wp-graphql-gravity-forms' ),
				'resolve'     => function( array $payload ) : array {
					$entry = GFUtils::get_entry( $payload['entryId'] );

					return $this->entry_data_manipulator->manipulate( $entry );
				},
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
			if ( empty( $input ) || ! is_array( $input ) || ! isset( $input['resumeToken'] ) ) {
				throw new UserError( __( 'Mutation not processed. The input data was missing or invalid.', 'wp-graphql-gravity-forms' ) );
			}

			$resume_token = sanitize_text_field( $input['resumeToken'] );
			$draft_entry  = GFUtils::get_draft_entry( $resume_token );
			$form_id      = $draft_entry['form_id'];

			$this->form = GFUtils::get_form( $form_id );

			// Sets last page.
			$this->set_form_page_to_last();

			// Force creates new entry if `$input['createNewEntry']` is true.
			$submission = $this->get_draft_submission( $draft_entry );
			$entry_id   = $input['createNewEntry'] ?? false ? $this->create_entry( $submission['partial_entry'] ) : $this->maybe_update_entry( $submission['partial_entry'] );

			/**
			 * Create a new post if Post Creation fields are in use.
			 *
			 * @TODO: Check how GF handles post creation when entries are updated.
			 */
			if ( ! isset( $input['triggerPostCreation'] ) || $input['triggerPostCreation'] ) {
				$this->create_post( $entry_id );
			}

			// Send notifications.
			if ( ! isset( $input['triggerNotifications'] ) || $input['triggerNotifications'] ) {
				$this->send_notifications( $entry_id );
			}

			GFFormsModel::delete_draft_submission( $resume_token );
			GFFormsModel::purge_expired_draft_submissions();

			return [ 'entryId' => $entry_id ];
		};
	}

	/**
	 * Updates existing Gravity Forms entry if it exists. Otherwise, creates new entry.
	 *
	 * @param array $partial_entry .
	 * @return integer
	 */
	private function maybe_update_entry( array $partial_entry ) : int {
		if ( $partial_entry['id'] ) {
			return $this->update_entry( $partial_entry );
		}
		return $this->create_entry( $partial_entry );
	}

	/**
	 * Creates Gravity Forms entry from draft entry.
	 *
	 * @param array $partial_entry .
	 * @return integer
	 * @throws UserError .
	 */
	private function create_entry( array $partial_entry ) : int {
		$entry_id = GFAPI::add_entry( $partial_entry );

		if ( is_wp_error( $entry_id ) ) {
			throw new UserError( __( 'An error occurred while trying to submit the draft entry.', 'wp-graphql-gravity-forms' ) . ' ' . $entry_id->get_error_message() );
		}

		return $entry_id;
	}

	/**
	 * Updates the existing Gravity Forms entry from the current draft entry.
	 *
	 * @param array $partial_entry .
	 * @return integer
	 * @throws UserError .
	 */
	private function update_entry( array $partial_entry ) : int {
		$is_entry_updated = GFAPI::update_entry( $partial_entry );

		if ( is_wp_error( ( $is_entry_updated ) ) ) {
			throw new UserError( __( 'An error occured while trying to update the entry.', 'wp-graphql-gravity-forms' ) . ' ' . $is_entry_updated->get_error_message() );
		}

		return $partial_entry['id'];
	}

	/**
	 * Create WordPress post if the form has any post fields.
	 *
	 * @param integer $entry_id .
	 * @throws UserError .
	 */
	private function create_post( int $entry_id ) : void {
		$entry = GFUtils::get_entry( $entry_id );

		GFCommon::create_post( $this->form, $entry );
	}

	/**
	 * Triggers Gravity Forms Notificiations associated with the entry.
	 *
	 * @param integer $entry_id .
	 * @throws UserError .
	 */
	private function send_notifications( int $entry_id ) : void {
		$entry = GFUtils::get_entry( $entry_id );

		GFAPI::send_notifications( $this->form, $entry );
	}

	/**
	 * Gets draft submission data.
	 *
	 * @TODO: use GFUtils::get_draft_submission().
	 *
	 * @param array $draft_entry .
	 * @return array
	 * @throws UserError .
	 */
	private function get_draft_submission( array $draft_entry ) : array {
		$submission = json_decode( $draft_entry['submission'], true );

		if ( ! $submission ) {
			throw new UserError( __( 'The submission data for this draft entry could not be read.', 'wp-graphql-gravity-forms' ) );
		}

		return $submission;
	}

	/**
	 * Fire an action BEFORE the field resolves
	 *
	 * @param mixed       $source         Source passed down the Resolve Tree.
	 * @param array       $args           Args for the field.
	 * @param AppContext  $context        AppContext passed down the ResolveTree.
	 * @param ResolveInfo $info           ResolveInfo passed down the ResolveTree.
	 * @param mixed       $field_resolver Field resolver.
	 * @param string      $type_name      Name of the type the fields belong to.
	 * @param string      $field_key      Name of the field.
	 *
	 * @throws UserError .
	 */
	public function ensure_required_fields_are_set( $source, array $args, AppContext $context, ResolveInfo $info, $field_resolver, string $type_name, string $field_key ) : void {
		// Make sure this is the submitGravityFormsDraftEntry field on the RootMutation.
		if ( 'RootMutation' !== $type_name || self::$name !== $field_key ) {
			return;
		}
		$draft_entry      = GFUtils::get_draft_entry( $args['input']['resumeToken'] );
		$submission       = $this->get_draft_submission( $draft_entry );
		$submitted_values = $submission['submitted_values'];
		$form             = GFUtils::get_form( $submission['partial_entry']['form_id'] );
		$fields           = $form['fields'];

		foreach ( $fields as $field ) {
			if ( 'captcha' === $field['type'] ) {
				$field_id          = absint( $field['id'] );
				$field_to_validate = GFUtils::get_field_by_id( $form, $field_id );
				$field_value       = $submitted_values[ $field_id ];

				$field_to_validate->validate( $field_value, $form );

				if ( $field->isRequired && empty( $submitted_values[ $field_id ] ) ) {
					$field->failed_validation = true;
				}

				if ( $field_to_validate->failed_validation ) {
					throw new UserError( __( 'Mutation not processed. The input data was missing or invalid.', 'wp-graphql-gravity-forms' ) );
				}
			}
		}
	}

	/**
	 * Sets form page to last page so post creation can work.
	 */
	private function set_form_page_to_last() : void {
		require_once GFCommon::get_base_path() . '/form_display.php';

		GFFormDisplay::set_current_page( $this->form['id'], GFFormDisplay::get_max_page_number( $this->form ) );
	}
}
