<?php

namespace WPGraphQLGravityForms\Test\Factories;

use GFAPI;
use WP_UnitTest_Generator_Sequence;

class Entry extends \WP_UnitTest_Factory_For_Thing {

	public function __construct( $factory = null ) {
		parent::__construct( $factory );
		$this->default_generation_definitions = [
			'id'               => new WP_UnitTest_Generator_Sequence( '%n' ),
			'post_id'          => 3,
			'date_created'     => '2019-06-26 01:53:42',
			'date_updated'     => '2019-06-26 01:53:42',
			'is_starred'       => false,
			'is_read'          => true,
			'ip'               => '172.17.0.1',
			'source_url'       => 'http://example.com/text-fields-form/',
			'user_agent'       => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36',
			'currency'         => 'USD',
			'payment_status'   => '',
			'payment_date'     => '',
			'payment_amount'   => '',
			'payment_method'   => '',
			'transaction_id'   => '',
			'is_fulfilled'     => '',
			'created_by'       => 1,
			'transaction_type' => '',
			'status'           => 'active',
		];
	}

	public function create_object( $args ) {
		$entry = [
			'id'               => $args['id'],
			'form_id'          => $args['form_id'],
			'post_id'          => $args['post_id'],
			'date_created'     => $args['date_created'],
			'date_updated'     => $args['date_updated'],
			'is_starred'       => $args['is_starred'],
			'is_read'          => $args['is_read'],
			'ip'               => $args['ip'],
			'source_url'       => $args['source_url'],
			'user_agent'       => $args['user_agent'],
			'currency'         => $args['currency'],
			'payment_status'   => $args['payment_status'],
			'payment_date'     => $args['payment_date'],
			'payment_amount'   => $args['payment_amount'],
			'payment_method'   => $args['payment_method'],
			'transaction_id'   => $args['transaction_id'],
			'is_fulfilled'     => $args['is_fulfilled'],
			'created_by'       => $args['created_by'],
			'transaction_type' => $args['transaction_type'],
			'status'           => $args['status'],
		];

		$entry_id = GFAPI::add_entry( $entry + $args['field_values'] );

		return $entry_id;
	}

	public function create_many( $count, $args = [], $generation_definitions = null ) {
		$entry_ids = [];
		for ( $n = 0; $n < $count; $n++ ) {
			$entry_args       = $args;
			$entry_args['id'] = $n + 1;

			$entry_ids[] = $this->create_object( $entry_args );
		}

		return $entry_ids;
	}

	public function update_object( $entry_id, $properties ) {
		$result = true;

		foreach ( $properties as $key => $value ) {
			$result = GFAPI::updateEntryProperty( $entry_id, $key, $value );

			if ( ! $result ) {
				break;
			}
		}
		return $result;
	}

	public function get_object_by_id( $form_id ) {
		return GFAPI::get_entry( $form_id );
	}
}
