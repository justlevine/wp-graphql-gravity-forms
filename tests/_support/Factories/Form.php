<?php

namespace WPGraphQLGravityForms\Test\Factories;

use GFAPI;
use WP_UnitTest_Generator_Sequence;

class Form extends \WP_UnitTest_Factory_For_Thing {

	public function __construct( $factory = null ) {
		parent::__construct( $factory );
		$this->default_generation_definitions = [
			'title'       => new WP_UnitTest_Generator_Sequence( 'Form title %s' ),
			'description' => new WP_UnitTest_Generator_Sequence( ' Form description %s' ),
		];
	}

	public function create_object( $args ) {
		$form = [
			'title'       => $args['title'],
			'description' => $args['description'],
			'fields'      => $args['fields'],
		];

		$form_id = GFAPI::add_form( $form );

		return $form_id;
	}

	public function create_many( $count, $args = [], $generation_definitions = null ) {
		$form_ids = [];
		for ( $n = 0; $n < $count; $n++ ) {
			$form_args  = $args;
			$form_ids[] = $this->create_object( $form_args );
		}

		return $form_ids;
	}

	public function update_object( $form_id, $form ) {
		return GFAPI::update_form( $form, $form_id );
	}

	public function get_object_by_id( $form_id ) {
		return GFAPI::get_form( $form_id );
	}
}
