<?php

use WPGraphQLGravityForms\Test\Factories\Entry;
use WPGraphQLGravityForms\Test\Factories\Field;
use WPGraphQLGravityForms\Test\Factories\Form;

class WPGraphQLSettingsTest extends \Codeception\TestCase\WPTestCase {

	/**
	 * @var \WpunitTesterActions
	 */
	protected $tester;

	public function setUp(): void {
		// Before...
		parent::setUp();

		$this->factory()->form  = new Form();
		$this->factory()->field = new Field();
		$this->factory()->entry = new Entry();
	}

	public function tearDown(): void {
		// Your tear down methods here.

		// Then...
		parent::tearDown();
	}

	private function create_form() {
	}

	private function formsQuery() {
		//phpcs:disable
		$query = 'query FormQuery {
			gravityFormsForms {
				nodes {
					fields {
						nodes {
							... on TextField {
								id
							}
						}
					}
				}
			}
			gravityFormsEntries {
				nodes {
					fields {
						nodes {
							... on TextField {
								id
							}
						}
					}
				}
			}
		}';
		//phpcs:enable

		return graphql( [ 'query' => $query ] );
	}

	// Tests.
	public function testSetMaxQueryAmount() {
		$fields  = $this->factory()->field->create_many( 5, [ 'type' => 'text' ] );
		$form_id = $this->factory()->form->create( [ 'fields' => $fields ] );

		$results = $this->formsQuery();
		codecept_debug( $results );

		$this->assertCount( 600, $results['data']['gravityFormsForms']['nodes'][0]['fields'] );
	}
}
