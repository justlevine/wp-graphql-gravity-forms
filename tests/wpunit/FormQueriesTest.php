<?php
use GraphQLRelay\Relay;
use WPGraphQLGravityForms\Tests\Factories;
use WPGraphQLGravityForms\Types\Enum;

class FormQueriesTest extends \Codeception\TestCase\WPTestCase {

	/**
	 * @var \WpunitTesterActions
	 */
	protected $tester;
	protected $factory;
	protected $typeRegistry;
	protected $helpers;
	private $fields = [];
	private $form;


	public function setUp(): void {
		// Before...
		parent::setUp();
		$this->factory = new Factories\Factory();

		$this->typeRegistry = WPGraphQL::get_type_registry();
		// Text field.
		$this->fields[] = $this->factory->field->create(
			[
				'type'                 => 'text',
				'id'                   => 1,
				'label'                => 'Single Line Text',
				'adminLabel'           => '',
				'isRequired'           => false,
				'size'                 => 'medium',
				'errorMessage'         => '',
				'visibility'           => 'visible',
				'inputs'               => null,
				'formId'               => 2,
				'description'          => 'I am a single line text field.',
				'allowsPrepopulate'    => false,
				'inputMask'            => false,
				'inputMaskValue'       => '',
				'inputMaskIsCustom'    => false,
				'maxLength'            => '',
				'inputType'            => '',
				'labelPlacement'       => '',
				'descriptionPlacement' => '',
				'subLabelPlacement'    => '',
				'placeholder'          => '',
				'cssClass'             => '',
				'inputName'            => '',
				'noDuplicates'         => false,
				'defaultValue'         => '',
				'choices'              => '',
				'productField'         => '',
				'enablePasswordInput'  => '',
				'multipleFiles'        => false,
				'maxFiles'             => '',
				'calculationFormula'   => '',
				'calculationRounding'  => '',
				'enableCalculation'    => '',
				'disableQuantity'      => false,
				'displayAllCategories' => false,
				'useRichTextEditor'    => false,
				'checkboxLabel'        => '',
				'pageNumber'           => 1,
				'fields'               => '',
				'displayOnly'          => '',
			]
		);
		// TextAreaField.
		$this->fields[] = $this->factory->field->create(
			[
				'type'                 => 'textarea',
				'id'                   => 2,
				'label'                => 'Text Area',
				'adminLabel'           => '',
				'isRequired'           => false,
				'size'                 => 'medium',
				'errorMessage'         => '',
				'visibility'           => 'visible',
				'inputs'               => null,
				'formId'               => 2,
				'description'          => 'I am a text area field.',
				'allowsPrepopulate'    => false,
				'inputMask'            => false,
				'inputMaskValue'       => '',
				'inputMaskIsCustom'    => false,
				'maxLength'            => 28,
				'inputType'            => '',
				'labelPlacement'       => '',
				'descriptionPlacement' => '',
				'subLabelPlacement'    => '',
				'placeholder'          => '',
				'cssClass'             => '',
				'inputName'            => '',
				'noDuplicates'         => false,
				'defaultValue'         => '',
				'choices'              => '',
				'conditionalLogic'     => '',
				'productField'         => '',
				'form_id'              => '',
				'useRichTextEditor'    => false,
				'multipleFiles'        => false,
				'maxFiles'             => '',
				'calculationFormula'   => '',
				'calculationRounding'  => '',
				'enableCalculation'    => '',
				'disableQuantity'      => false,
				'displayAllCategories' => false,
				'pageNumber'           => 1,
				'fields'               => '',
				'displayOnly'          => '',
			]
		);
		// Form.
		$this->form = $this->factory->form->create_many(
			2,
			[
				'button'                     => [
					'conditionalLogic' => [
						'actionType' => 'show',
						'logicType'  => 'any',
						'rules'      => [
							[
								'fieldId'  => 1,
								'operator' => 'is',
								'value'    => 'value1',
							],
							[
								'fieldId'  => 1,
								'operator' => 'is',
								'value'    => 'value2',
							],
						],
					],
					'imageUrl'         => 'https://example.com',
					'text'             => 'Submit',
					'type'             => 'text',
				],
				'confirmations'              => [
					'5cfec9464e7d7' => [
						'id'          => '5cfec9464e7d7',
						'isDefault'   => true,
						'message'     => 'Thanks for contacting us! We will get in touch with you shortly.',
						'name'        => 'Default Confirmation',
						'pageId'      => 1,
						'queryString' => 'text={Single Line Text:1}&textarea={Text Area:2}',
						'type'        => 'message',
						'url'         => 'https://example.com/',
					],
				],
				'cssClass'                   => 'css-class-1 css-class-2',
				'date_created'               => '2019-06-10 21:19:02', // This is disregarded by GFAPI::add_form().
				'descriptionPlacement'       => 'below',
				'enableAnimation'            => false,
				'enableHoneypot'             => false,
				'fields'                     => $this->fields,
				'firstPageCssClass'          => 'first-page-css-class',
				'is_active'                  => true,
				'is_trash'                   => false,
				'labelPlacement'             => 'top_label',
				'lastPageButton'             => [
					'imageUrl' => 'https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png',
					'text'     => 'Previous',
					'type'     => 'text',
				],
				'limitEntries'               => true,
				'limitEntriesCount'          => 100,
				'limitEntriesMessage'        => 'Only 100 entries are permitted.',
				'limitEntriesPeriod'         => 'year',
				'nextFieldId'                => 3,
				'notifications'              => [
					'5cfec9464e529' => [
						'bcc'               => 'bcc-email@example.com',
						'conditionalLogic'  => [
							'actionType' => 'show',
							'logicType'  => 'any',
							'rules'      => [
								[
									'fieldId'  => 1,
									'operator' => 'is',
									'value'    => 'value1',
								],
								[
									'fieldId'  => 1,
									'operator' => 'is',
									'value'    => 'value2',
								],
							],
						],
						'disableAutoformat' => false,
						'enableAttachments' => false,
						'event'             => 'form_submission',
						'from'              => 'from-email@example.com',
						'fromName'          => 'WordPress',
						'id'                => '5cfec9464e529',
						'isActive'          => true,
						'message'           => '{all_fields}',
						'name'              => 'Admin Notification',
						'replyTo'           => 'replyto-email@example.com',
						'routing'           => [
							[
								'fieldId'  => 1,
								'operator' => 'is',
								'value'    => 'value1',
								'email'    => 'email1@example.com',
							],
							[
								'fieldId'  => 1,
								'operator' => 'is',
								'value'    => 'value2',
								'email'    => 'email2@example.com',
							],
						],
						'service'           => 'wordpress',
						'subject'           => 'New submission from {form_title}',
						'to'                => '{admin_email}',
						'toType'            => 'email',
					],
				],
				'pagination'                 => [
					'backgroundColor'                     => '#c6df9c',
					'color'                               => '#197b30',
					'display_progressbar_on_confirmation' => true,
					'pages'                               => [ 'page-1-name', 'page-2-name' ],
					'progressbar_completion_text'         => 'Completed!',
					'style'                               => 'custom',
					'type'                                => 'percentage',
				],
				'postAuthor'                 => 1,
				'postCategory'               => 1,
				'postContentTemplate'        => 'Post content template',
				'postContentTemplateEnabled' => false,
				'postFormat'                 => '0',
				'postStatus'                 => 'publish',
				'postTitleTemplate'          => 'Post title template',
				'postTitleTemplateEnabled'   => false,
				'requireLogin'               => true,
				'requireLoginMessage'        => 'You must be logged in to submit this form.',
				'save'                       => [
					'button'  => [
						'text' => 'Save and Continue Later',
					],
					'enabled' => true,
				],
				'scheduleEnd'                => '01/01/2030',
				'scheduleEndAmpm'            => 'pm',
				'scheduleEndHour'            => 10,
				'scheduleEndMinute'          => 45,
				'scheduleForm'               => true,
				'scheduleMessage'            => 'Schedule message.',
				'schedulePendingMessage'     => 'Schedule pending message.',
				'scheduleStart'              => '01/01/2020',
				'scheduleStartAmpm'          => 'am',
				'scheduleStartHour'          => 9,
				'scheduleStartMinute'        => 30,
				'subLabelPlacement'          => 'below',
				'useCurrentUserAsAuthor'     => true,
			]
		);
	}

	public function tearDown(): void {
		// Your tear down methods here.

		// Then...
		parent::tearDown();
	}

	// Tests
	public function testGravityFormsFormQuery() {
		$form_id   = $this->form[0];
		$global_id = Relay::toGlobalId( 'GravityFormsForm', $form_id );
		$form      = GFAPI::get_form( $form_id );

		$query = $this->get_form_query();

		$actual = graphql(
			[
				'query'     => $query,
				'variables' => [
					'id'     => $form_id,
					'idType' => 'DATABASE_ID',
				],
			]
		);

		$expected = [
			'gravityFormsForm' => [
				'button'                     => [
					'conditionalLogic' => [
						'actionType' => $this->get_enum_for_value( Enum\ConditionalLogicActionTypeEnum::ENUM_NAME, $form['button']['conditionalLogic']['actionType'] ),
						'logicType'  => $this->get_enum_for_value( Enum\ConditionalLogicLogicTypeEnum::ENUM_NAME, $form['button']['conditionalLogic']['logicType'] ),
						'rules'      => [
							[
								'fieldId'  => $form['button']['conditionalLogic']['rules'][0]['fieldId'],
								'operator' => $this->get_enum_for_value( Enum\RuleOperatorEnum::ENUM_NAME, $form['button']['conditionalLogic']['rules'][0]['operator'] ),
								'value'    => $form['button']['conditionalLogic']['rules'][0]['value'],
							],
							[
								'fieldId'  => $form['button']['conditionalLogic']['rules'][1]['fieldId'],
								'operator' => $this->get_enum_for_value( Enum\RuleOperatorEnum::ENUM_NAME, $form['button']['conditionalLogic']['rules'][1]['operator'] ),
								'value'    => $form['button']['conditionalLogic']['rules'][1]['value'],
							],
						],
					],
					'imageUrl'         => $form['button']['imageUrl'],
					'text'             => $form['button']['text'],
					'type'             => $this->get_enum_for_value( Enum\ButtonTypeEnum::ENUM_NAME, $form['button']['type'] ),
				],
				'confirmations'              => [
					[
						'id'          => $form['confirmations']['5cfec9464e7d7']['id'],
						'isDefault'   => $form['confirmations']['5cfec9464e7d7']['isDefault'],
						'message'     => $form['confirmations']['5cfec9464e7d7']['message'],
						'name'        => $form['confirmations']['5cfec9464e7d7']['name'],
						'pageId'      => $form['confirmations']['5cfec9464e7d7']['pageId'],
						'queryString' => $form['confirmations']['5cfec9464e7d7']['queryString'],
						'type'        => $this->get_enum_for_value( Enum\ConfirmationTypeEnum::ENUM_NAME, $form['confirmations']['5cfec9464e7d7']['type'] ),
						'url'         => $form['confirmations']['5cfec9464e7d7']['url'],
					],
				],
				'cssClass'                   => $form['cssClass'],
				'dateCreated'                => $form['date_created'],
				'description'                => $form['description'],
				'descriptionPlacement'       => $this->get_enum_for_value( Enum\FormDescriptionPlacementEnum::ENUM_NAME, $form['descriptionPlacement'] ),
				'enableAnimation'            => $form['enableAnimation'],
				'enableHoneypot'             => $form['enableHoneypot'],
				'fields'                     => [
					'nodes' => [
						[ 'type' => $form['fields'][0]['type'] ],
						[ 'type' => $form['fields'][1]['type'] ],
					],
				],
				'firstPageCssClass'          => $form['firstPageCssClass'],
				'formId'                     => $form['id'],
				'id'                         => $global_id,
				'isActive'                   => (bool) $form['is_active'],
				'isTrash'                    => (bool) $form['is_trash'],
				'labelPlacement'             => $this->get_enum_for_value( Enum\FormLabelPlacementEnum::ENUM_NAME, $form['labelPlacement'] ),
				'lastPageButton'             => [
					'imageUrl' => $form['lastPageButton']['imageUrl'],
					'text'     => $form['lastPageButton']['text'],
					'type'     => $this->get_enum_for_value( Enum\ButtonTypeEnum::ENUM_NAME, $form['lastPageButton']['type'] ),
				],
				'limitEntries'               => $form['limitEntries'],
				'limitEntriesCount'          => $form['limitEntriesCount'],
				'limitEntriesMessage'        => $form['limitEntriesMessage'],
				'limitEntriesPeriod'         => $this->get_enum_for_value( Enum\FormLimitEntriesPeriodEnum::ENUM_NAME, $form['limitEntriesPeriod'] ),
				'nextFieldId'                => $form['nextFieldId'],
				'notifications'              => [
					[
						'bcc'               => $form['notifications']['5cfec9464e529']['bcc'],
						'conditionalLogic'  => [
							'actionType' => $this->get_enum_for_value( Enum\ConditionalLogicActionTypeEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['conditionalLogic']['actionType'] ),
							'logicType'  => $this->get_enum_for_value( Enum\ConditionalLogicLogicTypeEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['conditionalLogic']['logicType'] ),

							'rules'      => [
								[
									'fieldId'  => $form['notifications']['5cfec9464e529']['conditionalLogic']['rules'][0]['fieldId'],
									'operator' => $this->get_enum_for_value( Enum\RuleOperatorEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['conditionalLogic']['rules'][0]['operator'] ),
									'value'    => $form['notifications']['5cfec9464e529']['conditionalLogic']['rules'][0]['value'],
								],
								[
									'fieldId'  => $form['notifications']['5cfec9464e529']['conditionalLogic']['rules'][1]['fieldId'],
									'operator' => $this->get_enum_for_value( Enum\RuleOperatorEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['conditionalLogic']['rules'][1]['operator'] ),
									'value'    => $form['notifications']['5cfec9464e529']['conditionalLogic']['rules'][1]['value'],
								],
							],
						],
						'disableAutoformat' => $form['notifications']['5cfec9464e529']['disableAutoformat'],
						'enableAttachments' => $form['notifications']['5cfec9464e529']['enableAttachments'],
						'event'             => $form['notifications']['5cfec9464e529']['event'],
						'from'              => $form['notifications']['5cfec9464e529']['from'],
						'fromName'          => $form['notifications']['5cfec9464e529']['fromName'],
						'id'                => $form['notifications']['5cfec9464e529']['id'],
						'isActive'          => $form['notifications']['5cfec9464e529']['isActive'],
						'message'           => $form['notifications']['5cfec9464e529']['message'],
						'name'              => $form['notifications']['5cfec9464e529']['name'],
						'replyTo'           => $form['notifications']['5cfec9464e529']['replyTo'],
						'routing'           => [
							[
								'fieldId'  => $form['notifications']['5cfec9464e529']['routing'][0]['fieldId'],
								'operator' => $this->get_enum_for_value( Enum\RuleOperatorEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['routing'][0]['operator'] ),
								'value'    => $form['notifications']['5cfec9464e529']['routing'][0]['value'],
								'email'    => $form['notifications']['5cfec9464e529']['routing'][0]['email'],
							],
							[
								'fieldId'  => $form['notifications']['5cfec9464e529']['routing'][1]['fieldId'],
								'operator' => $this->get_enum_for_value( Enum\RuleOperatorEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['routing'][1]['operator'] ),
								'value'    => $form['notifications']['5cfec9464e529']['routing'][1]['value'],
								'email'    => $form['notifications']['5cfec9464e529']['routing'][1]['email'],
							],
						],
						'service'           => $form['notifications']['5cfec9464e529']['service'],
						'subject'           => $form['notifications']['5cfec9464e529']['subject'],
						'to'                => $form['notifications']['5cfec9464e529']['to'],
						'toType'            => $this->get_enum_for_value( Enum\NotificationToTypeEnum::ENUM_NAME, $form['notifications']['5cfec9464e529']['toType'] ),
					],
				],
				'pagination'                 => [
					'backgroundColor'                  => $form['pagination']['backgroundColor'],
					'color'                            => $form['pagination']['color'],
					'displayProgressbarOnConfirmation' => $form['pagination']['display_progressbar_on_confirmation'],
					'pages'                            => $form['pagination']['pages'],
					'progressbarCompletionText'        => $form['pagination']['progressbar_completion_text'],
					'style'                            => $this->get_enum_for_value( Enum\PageProgressStyleEnum::ENUM_NAME, $form['pagination']['style'] ),
					'type'                             => $this->get_enum_for_value( Enum\PageProgressTypeEnum::ENUM_NAME, $form['pagination']['type'] ),
				],
				'postAuthor'                 => $form['postAuthor'],
				'postCategory'               => $form['postCategory'],
				'postContentTemplate'        => $form['postContentTemplate'],
				'postContentTemplateEnabled' => $form['postContentTemplateEnabled'],
				'postFormat'                 => $form['postFormat'],
				'postStatus'                 => $form['postStatus'],
				'postTitleTemplate'          => $form['postTitleTemplate'],
				'postTitleTemplateEnabled'   => $form['postTitleTemplateEnabled'],
				'requireLogin'               => $form['requireLogin'],
				'requireLoginMessage'        => $form['requireLoginMessage'],
				'save'                       => [
					'buttonText' => $form['save']['button']['text'],
					'enabled'    => $form['save']['enabled'],
				],
				'scheduleEnd'                => $form['scheduleEnd'],
				'scheduleEndAmpm'            => $form['scheduleEndAmpm'],
				'scheduleEndHour'            => $form['scheduleEndHour'],
				'scheduleEndMinute'          => $form['scheduleEndMinute'],
				'scheduleForm'               => $form['scheduleForm'],
				'scheduleMessage'            => $form['scheduleMessage'],
				'schedulePendingMessage'     => $form['schedulePendingMessage'],
				'scheduleStart'              => $form['scheduleStart'],
				'scheduleStartAmpm'          => $form['scheduleStartAmpm'],
				'scheduleStartHour'          => $form['scheduleStartHour'],
				'scheduleStartMinute'        => $form['scheduleStartMinute'],
				'subLabelPlacement'          => $this->get_enum_for_value( Enum\FormSubLabelPlacementEnum::ENUM_NAME, $form['subLabelPlacement'] ),
				'title'                      => $form['title'],
				'useCurrentUserAsAuthor'     => $form['useCurrentUserAsAuthor'],
			],
		];

		// Test with Database ID.
		$this->assertEquals( $expected, $actual['data'] );

		// Test with global ID
		$actual = graphql(
			[
				'query'     => $query,
				'variables' => [
					'id'     => $global_id,
					'idType' => 'ID',
				],
			]
		);

		$this->assertEquals( $expected, $actual['data'] );
	}

	public function testGravityFormsFormsQuery() {
		$query = '
			query {
				gravityFormsForms {
					nodes {
						formId
					}
				}
			}
		';

		$actual = graphql( [ 'query' => $query ] );
		$this->assertEquals( 2, count( $actual['data']['gravityFormsForms']['nodes'] ) );
	}

	public function testEmptyGravityFormsFormQuery() {
		$form_id   = $this->factory->form->create( [ 'fields' => [] ] );
		$global_id = Relay::toGlobalId( 'GravityFormsForm', $form_id );
		$form      = GFAPI::get_form( $form_id );
		codecept_debug( $form );
		$confirmation_key = key( $form['confirmations'] );
		$query            = $this->get_form_query();

		$actual = graphql(
			[
				'query'     => $query,
				'variables' => [
					'id'     => $form_id,
					'idType' => 'DATABASE_ID',
				],
			]
		);

		$expected =
			[
				'gravityFormsForm' => [
					'button'                     => null,
					'confirmations'              => [
						[
							'id'          => $form['confirmations'][ $confirmation_key ]['id'],
							'isDefault'   => $form['confirmations'][ $confirmation_key ]['isDefault'],
							'message'     => $form['confirmations'][ $confirmation_key ]['message'],
							'name'        => $form['confirmations'][ $confirmation_key ]['name'],
							'pageId'      => $form['confirmations'][ $confirmation_key ]['pageId'],
							'queryString' => $form['confirmations'][ $confirmation_key ]['queryString'],
							'type'        => $this->get_enum_for_value( Enum\ConfirmationTypeEnum::ENUM_NAME, $form['confirmations'][ $confirmation_key ]['type'] ),
							'url'         => $form['confirmations'][ $confirmation_key ]['url'],
						],
					],
					'cssClass'                   => null,
					'dateCreated'                => $form['date_created'],
					'description'                => $form['description'],
					'descriptionPlacement'       => null,
					'enableAnimation'            => null,
					'enableHoneypot'             => null,
					'fields'                     => [
						'nodes' => [],
					],
					'firstPageCssClass'          => null,
					'formId'                     => $form['id'],
					'id'                         => $global_id,
					'isActive'                   => (bool) $form['is_active'],
					'isTrash'                    => (bool) $form['is_trash'],
					'labelPlacement'             => null,
					'lastPageButton'             => null,
					'limitEntries'               => null,
					'limitEntriesCount'          => null,
					'limitEntriesMessage'        => null,
					'limitEntriesPeriod'         => null,
					'nextFieldId'                => $form['nextFieldId'],
					'notifications'              => [],
					'pagination'                 => null,
					'postAuthor'                 => null,
					'postCategory'               => null,
					'postContentTemplate'        => null,
					'postContentTemplateEnabled' => null,
					'postFormat'                 => null,
					'postStatus'                 => null,
					'postTitleTemplate'          => null,
					'postTitleTemplateEnabled'   => null,
					'requireLogin'               => null,
					'requireLoginMessage'        => null,
					'save'                       => null,
					'scheduleEnd'                => null,
					'scheduleEndAmpm'            => null,
					'scheduleEndHour'            => null,
					'scheduleEndMinute'          => null,
					'scheduleForm'               => null,
					'scheduleMessage'            => null,
					'schedulePendingMessage'     => null,
					'scheduleStart'              => null,
					'scheduleStartAmpm'          => null,
					'scheduleStartHour'          => null,
					'scheduleStartMinute'        => null,
					'subLabelPlacement'          => null,
					'title'                      => $form['title'],
					'useCurrentUserAsAuthor'     => null,
				],
			];

		$this->assertEquals( $expected, $actual['data'] );
	}


	private function get_enum_for_value( string $enumName, string $value ) : string {
		return $this->typeRegistry->get_type( $enumName )->serialize( $value );
	}

	private function get_form_query() {
		return '
			query getForm( $id: ID!, $idType: IdTypeEnum ) {
				gravityFormsForm( id: $id, idType: $idType ) {
					button {
						conditionalLogic {
							actionType
							logicType
							rules {
								fieldId
								operator
								value
							}
						}
						imageUrl
						text
						type
					}
					confirmations {
						id
						isDefault
						message
						name
						pageId
						queryString
						type
						url
					}
					cssClass
					dateCreated
					description
					descriptionPlacement
					enableAnimation
					enableHoneypot
					fields {
						nodes {
							type
						}
					}
					firstPageCssClass
					formId
					id
					isActive
					isTrash
					labelPlacement
					lastPageButton {
						imageUrl
						text
						type
					}
					limitEntries
					limitEntriesCount
					limitEntriesMessage
					limitEntriesPeriod
					nextFieldId
					notifications {
						bcc
						conditionalLogic {
							actionType
							logicType
							rules {
								fieldId
								operator
								value
							}
						}
						disableAutoformat
						enableAttachments
						event
						from
						fromName
						id
						isActive
						message
						name
						replyTo
						routing {
							email
							fieldId
							operator
							value
						}
						service
						subject
						to
						toType
					}
					pagination {
						backgroundColor
						color
						displayProgressbarOnConfirmation
						pages
						progressbarCompletionText
						style
						type
					}
					postAuthor
					postCategory
					postContentTemplate
					postContentTemplateEnabled
					postFormat
					postStatus
					postTitleTemplate
					postTitleTemplateEnabled
					requireLogin
					requireLoginMessage
					save {
						buttonText
						enabled
					}
					scheduleEnd
					scheduleEndAmpm
					scheduleEndHour
					scheduleEndMinute
					scheduleForm
					scheduleMessage
					schedulePendingMessage
					scheduleStart
					scheduleStartAmpm
					scheduleStartHour
					scheduleStartMinute
					subLabelPlacement
					title
					useCurrentUserAsAuthor
				}
			}
		';
	}
}
