<?php

namespace WPGraphQLGravityForms\Tests\Factories;

use GFAPI;
use WP_UnitTest_Generator_Sequence;

class Form extends \WP_UnitTest_Factory_For_Thing {

	public function __construct( $factory = null ) {
		parent::__construct( $factory );
		$this->default_generation_definitions = [
			'title'       => new WP_UnitTest_Generator_Sequence( 'Form title %s' ),
			'description' => new WP_UnitTest_Generator_Sequence( 'Form description %s' ),
			'fields' => [],
		];
	}

	public function create_object( $args ) {
		return GFAPI::add_form( $args );
	}

	public function create_many( $count, $args = [], $generation_definitions = null ) {
		$form_ids = [];
		for ( $n = 0; $n < $count; $n++ ) {
			$form_args  = $args;
			$form_ids[] = $this->create( $form_args );
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
