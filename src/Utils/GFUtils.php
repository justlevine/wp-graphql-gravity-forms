<?php
/**
 * GF Utils
 *
 * Wrappers for common Gravity Forms functions.
 *
 * @package WPGraphQLGravityForms\Utils
 * @since 0.4.0
 */

namespace WPGraphQLGravityForms\Utils;

use GF_Field;
use GFAPI;
use GFFormsModel;
use GraphQL\Error\UserError;

/**
 * Class - GFUtils
 */
class GFUtils {
	/**
	 * Gets the Gravity Form form object for the given form ID.
	 * Uses GFAPI::get_form().
	 *
	 * @see https://docs.gravityforms.com/api-functions/#get-form
	 *
	 * @param integer $form_id .
	 * @param bool    $is_active Whether to only return the form if it is active.
	 * @return array
	 *
	 * @throws UserError .
	 */
	public static function get_form( int $form_id, bool $is_active = true ) : array {
		$form = GFAPI::get_form( $form_id );

		if ( ! $form ) {
			throw new UserError(
				// translators: Gravity Forms form id.
				sprintf( __( 'Unable to retrieve the form for the given ID %n', 'wp-graphql-gravity-forms' ), $form_id ),
			);
		}

		if ( $is_active && ( ! $form['is_active'] || $form['is_trash'] ) ) {
			throw new UserError(
				// translators: Gravity Forms form id.
				sprintf( __( 'The form for the given ID %n is inactive or trashed.', 'wp-graphql-gravity-forms' ), $form_id ),
			);
		}

		return $form;
	}

	/**
	 * Gets the Gravity Form entry object for the given form ID.
	 * Uses GFAPI::get_entry().
	 *
	 * @see https://docs.gravityforms.com/api-functions/#get-entry
	 *
	 * @param integer $entry_id .
	 * @return array
	 *
	 * @throws UserError .
	 */
	public static function get_entry( int $entry_id ) : array {
		$entry = GFAPI::get_entry( $entry_id );

		if ( is_wp_error( $entry ) ) {
			throw new UserError(
				// translators: Gravity Forms form id.
				sprintf( __( 'The entry the given ID %n was not found. Error: ', 'wp-graphql-gravity-forms' ), $entry_id ) . $entry->get_error_message()
			);
		}

		return $entry;
	}


	/**
	 * Mimics Gravity Forms' GFFormsModel::get_form_unique_id() method.
	 *
	 * @param int $form_id Form ID.
	 *
	 * @return string Unique ID.
	 */
	public static function get_form_unique_id( int $form_id ) : string {
		if ( ! isset( GFFormsModel::$unique_ids[ $form_id ] ) ) {
			GFFormsModel::$unique_ids[ $form_id ] = uniqid();
		}

		return GFFormsModel::$unique_ids[ $form_id ];
	}

	/**
	 * Get the draft resume URL.
	 *
	 * @param string     $source_url   Source URL.
	 * @param string     $resume_token Resume token.
	 * @param array|null $form         Form object.
	 *
	 * @return string Resume URL, or empty string if no source URL was provided.
	 */
	public static function get_resume_url( string $source_url, string $resume_token, $form = [] ) : string {
		if ( ! $source_url ) {
			return '';
		}

		/**
		 * Filters the 'Save and Continue' URL to be used with a partial entry submission.
		 *
		 * @param string $resume_url   The URL to be used to resume the partial entry.
		 * @param array  $form         The Form Object.
		 * @param string $resume_token The token that is used within the URL.
		 * @param string $unused       Unused parameter. Included for consistency with the native
		 *                             Gravity Forms gform_save_and_continue_resume_url hook.
		 */
		return esc_url(
			apply_filters(
				'gform_save_and_continue_resume_url',
				add_query_arg( [ 'gf_token' => $resume_token ], $source_url ),
				$form,
				$resume_token,
				''
			)
		);
	}

	/**
	 * Returns Gravity Forms Field object for given field id.
	 *
	 * @param array $form     The form.
	 * @param int   $field_id Field ID.
	 *
	 * @return GF_Field
	 *
	 * @throws UserError .
	 */
	public static function get_field_by_id( array $form, int $field_id ) : GF_Field {
		$matching_fields = array_values(
			array_filter(
				$form['fields'],
				function( GF_Field $field ) use ( $field_id ) : bool {
					return $field['id'] === $field_id;
				}
			)
		);

		if ( ! $matching_fields ) {
			throw new UserError(
				// translators: Gravity Forms form id and field id.
				sprintf( __( 'The Form (ID %n) does not not contain a field with the field ID %n.', 'wp-graphql-gravity-forms' ), $form['id'], $field_id )
			);
		}

		return $matching_fields[0];
	}
}
