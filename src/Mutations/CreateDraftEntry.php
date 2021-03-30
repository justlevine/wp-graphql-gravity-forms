<?php
/**
 * Mutation - createGravityFormsDraftEntry
 *
 * Registers mutation to create a Gravity Forms draft entry.
 *
 * @package WPGraphQLGravityForms\Mutation
 * @since 0.0.1
 */

namespace WPGraphQLGravityForms\Mutations;

use GFFormsModel;
use GFCommon;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;
use WPGraphQLGravityForms\Utils\GFUtils;
use WPGraphQLGravityForms\Utils\Utils;

/**
 * Class - CreateDraftEntry
 */
class CreateDraftEntry extends AbstractMutation {
	/**
	 * Mutation Name
	 *
	 * @var string
	 */
	public static $name = 'createGravityFormsDraftEntry';

	/**
	 * Defines the input field configuration.
	 *
	 * @return array
	 */
	public function get_input_fields() : array {
		return [
			'formId'      => [
				'type'        => [ 'non_null' => 'Int' ],
				'description' => __( 'The form ID.', 'wp-graphql-gravity-forms' ),
			],
			'fromEntryId' => [
				'type'        => 'Integer',
				'description' => __( 'Optional. If set, a new draft entry will be created from the existing Entry. ', 'wp-graphql-gravity-forms' ),
			],
			'pageNumber'  => [
				'type'        => 'Integer',
				'description' => __( 'Optional. The page number where the user left off. Default is 1.', 'wp-graphql-gravity-forms' ),
			],
			'ip'          => [
				'type'        => 'String',
				'description' => __( 'Optional. The IP address of the user who submitted the draft entry. Default is an empty string.', 'wp-graphql-gravity-forms' ),
			],
			// @TODO: Files.
		];
	}

	/**
	 * Defines the output field configuration.
	 *
	 * @return array
	 */
	public function get_output_fields() : array {
		return [
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
			if ( empty( $input ) || ! is_array( $input ) || ! isset( $input['formId'] ) ) {
				throw new UserError( __( 'Mutation not processed. The input data was missing or invalid.', 'wp-graphql-gravity-forms' ) );
			}

			$form_id = absint( $input['formId'] );
			$form    = GFUtils::get_form( $form_id );

			$source_url   = esc_url_raw( Utils::truncate( $_SERVER['HTTP_REFERER'] ?? '', 250 ) );
			$resume_token = $this->save_draft_submission( $input, $form, $source_url );

			if ( ! $resume_token ) {
				throw new UserError( __( 'An error occurred while trying to create the draft entry.', 'wp-graphql-gravity-forms' ) );
			}

			return [
				'resumeToken' => $resume_token,
				'resumeUrl'   => GFUtils::get_resume_url( $source_url, $resume_token, $form ),
			];
		};
	}

	/**
	 * Mimics Gravity Forms' GFFormsModel::save_draft_submission() method.
	 *
	 * @param array  $input      Request input.
	 * @param array  $form       Form object.
	 * @param string $source_url Source URL.
	 *
	 * @return string The resume token, or empty string on failure.
	 */
	private function save_draft_submission( array $input, array $form, string $source_url ) : string {
		$ip = isset( $input['ip'] ) && ! empty( $form['personalData']['preventIP'] ) ? sanitize_text_field( $input['ip'] ) : '';

		// Get existing entry if `fromEntryId` is set, otherwise create new draft entry.
		$entry = isset( $input['fromEntryId'] ) ? GFUtils::get_entry( $input['fromEntryId'] ) : $this->get_draft_entry_data( $form, $ip, $source_url );

		$field_values   = '';
		$page_number    = isset( $input['pageNumber'] ) ? absint( $input['pageNumber'] ) : 1;
		$files          = []; // TODO: Get from Request.
		$form_unique_id = GFUtils::get_form_unique_id( $form['id'] );

		$resume_token = GFFormsModel::save_draft_submission(
			$form,
			$entry,
			$field_values,
			$page_number,
			$files,
			$form_unique_id,
			$ip,
			$source_url,
			''
		);

		return $resume_token ? (string) $resume_token : '';
	}

	/**
	 * Mimics Gravity Forms' GFFormsModel::create_lead() method.
	 *
	 * @param array  $form       Form object.
	 * @param string $ip         IP address.
	 * @param string $source_url Source URL.
	 *
	 * @return array Draft entry data.
	 */
	private function get_draft_entry_data( array $form, string $ip, string $source_url ) : array {
		return [
			'id'           => null,
			'post_id'      => null,
			'date_created' => null,
			'date_updated' => null,
			'form_id'      => $form['id'],
			'ip'           => $ip,
			'source_url'   => $source_url,
			'user_agent'   => sanitize_text_field( Utils::truncate( $_SERVER['HTTP_USER_AGENT'] ?? '', 250 ) ),
			'created_by'   => get_current_user_id() ?: 'NULL',
			'currency'     => gf_apply_filters( [ 'gform_currency_pre_save_entry', $form['id'] ], GFCommon::get_currency(), $form ),
		];
	}
}
