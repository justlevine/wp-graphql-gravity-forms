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

use GFAPI;
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
}
