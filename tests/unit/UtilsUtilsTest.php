<?php

use WPGraphQLGravityForms\Utils\Utils;

class UtilsUtilsTest extends \Codeception\Test\Unit {


		/**
		 * Tests that deprecationReason is added to the property definition.
		 *
		 * @throws Exception
		 */
	public function testDeprecateProperty() {
		$property = [
			'propertyName' => [
				'type'        => 'String',
				'description' => 'Some description',
			],
		];

		$deprecationReason = 'This is a test deprecation';

		$deprecatedProperty = Utils::deprecate_property( $property, $deprecationReason );

		$this->assertEquals( $deprecationReason, $deprecatedProperty['propertyName']['deprecationReason'] );
	}
}
