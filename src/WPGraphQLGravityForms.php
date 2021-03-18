<?php
/**
 * Initializes a singleton instance of WPGraphQLGravityForms.
 *
 * @package WPGraphQLGravityForms
 * @since 0.0.1
 * @since 0.2.0 Remove MultiSelectChoiceProperty and add RadioChoiceProperty, AddressInputProperty, ChainedSelectInputProperty, and NameInputProperty.
 * @since 0.3.0 Adds ConsentField, ConsentFieldValue, HiddenFieldValue, PostCategoryFieldValue, PostContentFieldValue, PostCustomFieldValue, PostTagsFieldValue, PostTitleFieldValue, ChainedSelectInput, UpdateDraftEntryChainedSelectFieldValue, UpdateDraftEntryConsentFieldValue, UpdateDraftEntryHiddenFieldValue, UpdateDraftEntryPostCategoryFieldValue, UpdateDraftEntryPostContentFieldValue, UpdateDraftEntryPostCustomFieldValue, UpdateDraftEntryPostExcerptFieldValue, UpdateDraftEntryPostTitleFieldValue, and UpdateDraftEntryPostTagsFieldValue.
 */

namespace WPGraphQLGravityForms;

use WPGraphQLGravityForms\Interfaces\Hookable;
use WPGraphQLGravityForms\Types\Button\Button;
use WPGraphQLGravityForms\Types\Button\LastPageButton;
use WPGraphQLGravityForms\Types\ConditionalLogic;
use WPGraphQLGravityForms\Types\Enum;
use WPGraphQLGravityForms\Types\Form;
use WPGraphQLGravityForms\Types\Field;
use WPGraphQLGravityForms\Types\Field\FieldProperty;
use WPGraphQLGravityForms\Types\Field\FieldValue;
use WPGraphQLGravityForms\Types\FieldError\FieldError;
use WPGraphQLGravityForms\Types\Union;
use WPGraphQLGravityForms\Types\Entry;
use WPGraphQLGravityForms\Types\Input;
use WPGraphQLGravityForms\Types\GraphQLInterface;
use WPGraphQLGravityForms\Utils\Utils;

/**
 * Main plugin class.
 */
final class WPGraphQLGravityForms {

	/**
	 * Class instances.
	 *
	 * @var array $instances
	 */
	private $instances = [];

	/**
	 * Main method for running the plugin.
	 */
	public function run() : void {
		$this->create_instances();
		$this->register_hooks();
	}

	/**
	 * Create instances.
	 */
	private function create_instances() : void {
		// Settings.
		$this->instances['wpgraphql_settings'] = new Settings\WPGraphQLSettings();

		// Data manipulators.
		$this->instances['fields_data_manipulator']      = new DataManipulators\FieldsDataManipulator();
		$this->instances['form_data_manipulator']        = new DataManipulators\FormDataManipulator( $this->instances['fields_data_manipulator'] );
		$this->instances['entry_data_manipulator']       = new DataManipulators\EntryDataManipulator();
		$this->instances['draft_entry_data_manipulator'] = new DataManipulators\DraftEntryDataManipulator( $this->instances['entry_data_manipulator'] );

		// Data loaders.
		$this->instances['loader_registrar'] = new Data\Loader\LoadersRegistrar();

		// Buttons.
		$this->instances['button']           = new Button();
		$this->instances['last_page_button'] = new LastPageButton();

		// Conditional Logic.
		$this->instances['conditional_logic']      = new ConditionalLogic\ConditionalLogic();
		$this->instances['conditional_logic_rule'] = new ConditionalLogic\ConditionalLogicRule();

		// Forms.
		$this->instances['save_and_continue']         = new Form\SaveAndContinue();
		$this->instances['form_notification_routing'] = new Form\FormNotificationRouting();
		$this->instances['form_notification']         = new Form\FormNotification();
		$this->instances['form_confirmation']         = new Form\FormConfirmation();
		$this->instances['form_pagination']           = new Form\FormPagination();
		$this->instances['form']                      = new Form\Form( $this->instances['form_data_manipulator'] );

		// Interfaces.
		$this->instances['field_interface'] = new GraphQLInterface\FieldInterface();

		// Field Properties.
		foreach ( self::get_enabled_field_property_types() as $type ) {
			$field_class_name = 'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\' . $type;

			$this->instances[ Utils::to_snake_case( $type ) ] = new $field_class_name();
		}

		// Fields.
		foreach ( self::get_enabled_field_types() as $type ) {
			$field_class_name = 'WPGraphQLGravityForms\\Types\\Field\\' . $type;

			$this->instances[ Utils::to_snake_case( $type ) ] = new $field_class_name();
		}

		// Field Values.
		foreach ( self::get_enabled_field_value_types() as $type ) {
			$field_class_name = 'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\' . $type;

			$this->instances[ Utils::to_snake_case( $type ) ] = new $field_class_name();
		}

		// Entries.
		$this->instances['entry']      = new Entry\Entry( $this->instances['entry_data_manipulator'], $this->instances['draft_entry_data_manipulator'] );
		$this->instances['entry_form'] = new Entry\EntryForm( $this->instances['form_data_manipulator'] );
		$this->instances['entry_user'] = new Entry\EntryUser();

		// Inputs.
		foreach ( self::get_enabled_input_types() as $type ) {
			$field_class_name = 'WPGraphQLGravityForms\\Types\\Input\\' . $type;

			$this->instances[ Utils::to_snake_case( $type ) ] = new $field_class_name();
		}

		// Unions.
		$this->instances['object_field_value_union'] = new Union\ObjectFieldValueUnion( $this->instances );

		// Connections.
		$this->instances['entry_field_connection']        = new Connections\EntryFieldConnection( $this->instances );
		$this->instances['form_field_connection']         = new Connections\FormFieldConnection();
		$this->instances['root_query_entries_connection'] = new Connections\RootQueryEntriesConnection();
		$this->instances['root_query_forms_connection']   = new Connections\RootQueryFormsConnection();

		// Enums.
		foreach ( self::get_enabled_enum_types() as $type ) {
			$field_class_name = 'WPGraphQLGravityForms\\Types\\Enum\\' . $type;

			$this->instances[ Utils::to_snake_case( $type ) ] = new $field_class_name();
		}

		// Field errors.
		$this->instances['field_error'] = new FieldError();

		// Mutations.
		$this->instances['delete_entry']       = new Mutations\DeleteEntry();
		$this->instances['create_draft_entry'] = new Mutations\CreateDraftEntry();
		$this->instances['delete_draft_entry'] = new Mutations\DeleteDraftEntry();
		$this->instances['submit_draft_entry'] = new Mutations\SubmitDraftEntry( $this->instances['entry_data_manipulator'] );

		foreach ( self::get_field_value_mutation_names() as $type ) {
			$field_class_name = 'WPGraphQLGravityForms\\Mutations\\' . $type;

			$this->instances[ Utils::to_snake_case( $type ) ] = new $field_class_name( $this->instances['draft_entry_data_manipulator'] );
		}
	}


	/**
	 * Returns Gravity Forms Field types to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_enabled_field_types() : array {
		$types = [
			Field\AddressField::TYPE,
			Field\CaptchaField::TYPE,
			Field\ChainedSelectField::TYPE,
			Field\CheckboxField::TYPE,
			Field\ConsentField::TYPE,
			Field\DateField::TYPE,
			Field\EmailField::TYPE,
			Field\FileUploadField::TYPE,
			Field\HiddenField::TYPE,
			Field\HtmlField::TYPE,
			Field\ListField::TYPE,
			Field\MultiSelectField::TYPE,
			Field\NameField::TYPE,
			Field\NumberField::TYPE,
			Field\PageField::TYPE,
			Field\PasswordField::TYPE,
			Field\PhoneField::TYPE,
			Field\PostCategoryField::TYPE,
			Field\PostContentField::TYPE,
			Field\PostCustomField::TYPE,
			Field\PostExcerptField::TYPE,
			Field\PostImageField::TYPE,
			Field\PostTagsField::TYPE,
			Field\PostTitleField::TYPE,
			Field\RadioField::TYPE,
			Field\SectionField::TYPE,
			Field\SelectField::TYPE,
			Field\SignatureField::TYPE,
			Field\TextAreaField::TYPE,
			Field\TextField::TYPE,
			Field\TimeField::TYPE,
			Field\WebsiteField::TYPE,
		];

		/**
		 * Filter to add custom Gravity Forms field types to the GraphQL schema.
		 *
		 * @param array The field types.
		 */
		return apply_filters( 'wp_graphql_gf_field_types', $types );
	}

	/**
	 * Returns Gravity Forms Field Value types to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_enabled_field_value_types() : array {
		$types = [
			FieldValue\AddressFieldValue::TYPE,
			FieldValue\ChainedSelectFieldValue::TYPE,
			FieldValue\CheckboxInputValue::TYPE,
			FieldValue\CheckboxFieldValue::TYPE,
			FieldValue\ConsentFieldValue::TYPE,
			FieldValue\DateFieldValue::TYPE,
			FieldValue\EmailFieldValue::TYPE,
			FieldValue\HiddenFieldValue::TYPE,
			FieldValue\FileUploadFieldValue::TYPE,
			FieldValue\ListInputValue::TYPE,
			FieldValue\ListFieldValue::TYPE,
			FieldValue\MultiSelectFieldValue::TYPE,
			FieldValue\NameFieldValue::TYPE,
			FieldValue\NumberFieldValue::TYPE,
			FieldValue\PhoneFieldValue::TYPE,
			FieldValue\PostCategoryFieldValue::TYPE,
			FieldValue\PostContentFieldValue::TYPE,
			FieldValue\PostCustomFieldValue::TYPE,
			FieldValue\PostExcerptFieldValue::TYPE,
			FieldValue\PostTagsFieldValue::TYPE,
			FieldValue\PostTitleFieldValue::TYPE,
			FieldValue\RadioFieldValue::TYPE,
			FieldValue\SelectFieldValue::TYPE,
			FieldValue\SignatureFieldValue::TYPE,
			FieldValue\TextAreaFieldValue::TYPE,
			FieldValue\TextFieldValue::TYPE,
			FieldValue\TimeFieldValue::TYPE,
			FieldValue\WebsiteFieldValue::TYPE,
		];

		/**
		 * Filter to add custom Gravity Forms field value types to the GraphQL schema.
		 *
		 * @param array The field value types.
		 */
		return apply_filters( 'wp_graphql_gf_field_value_types', $types );
	}

	/**
	 * Returns Gravity Forms Field Properties types to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_enabled_field_property_types() : array {
		$types = [
			FieldProperty\AddressInputProperty::TYPE,
			FieldProperty\ChainedSelectChoiceProperty::TYPE,
			FieldProperty\ChainedSelectInputProperty::TYPE,
			FieldProperty\CheckboxInputProperty::TYPE,
			FieldProperty\ChoiceProperty::TYPE,
			FieldProperty\InputProperty::TYPE,
			FieldProperty\ListChoiceProperty::TYPE,
			FieldProperty\NameInputProperty::TYPE,
			FieldProperty\PasswordInputProperty::TYPE,
			FieldProperty\RadioChoiceProperty::TYPE,
		];

		/**
		 * Filter to add custom Gravity Forms field property types to the GraphQL schema.
		 *
		 * @param array The field value types.
		 */
		return apply_filters( 'wp_graphql_gf_field_property_types', $types );
	}

	/**
	 * Returns Gravity Forms input types to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_enabled_input_types() : array {
		$types = [
			Input\AddressInput::TYPE,
			Input\ChainedSelectInput::TYPE,
			Input\CheckboxInput::TYPE,
			Input\ListInput::TYPE,
			Input\NameInput::TYPE,
			Input\EntriesDateFiltersInput::TYPE,
			Input\EntriesFieldFiltersInput::TYPE,
			Input\EntriesSortingInput::TYPE,
		];

		/**
		 * Filter to add custom Gravity Forms input types to the GraphQL schema.
		 *
		 * @param array The field value types.
		 */
		return apply_filters( 'wp_graphql_gf_input_types', $types );
	}

	/**
	 * Returns Gravity Forms Enum types to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_enabled_enum_types() : array {
		$types = [
			Enum\AddressTypeEnum::TYPE,
			Enum\ButtonTypeEnum::TYPE,
			Enum\CalendarIconTypeEnum::TYPE,
			Enum\CaptchaThemeEnum::TYPE,
			Enum\CaptchaTypeEnum::TYPE,
			Enum\ChainedSelectsAlignmentEnum::TYPE,
			Enum\ConditionalLogicActionTypeEnum::TYPE,
			Enum\ConditionalLogicLogicTypeEnum::TYPE,
			Enum\ConfirmationTypeEnum::TYPE,
			Enum\DateFieldFormatEnum::TYPE,
			Enum\DateTypeEnum::TYPE,
			Enum\DescriptionPlacementPropertyEnum::TYPE,
			Enum\EntryStatusEnum::TYPE,
			Enum\FieldFiltersModeEnum::TYPE,
			Enum\FieldFiltersOperatorInputEnum::TYPE,
			Enum\FormDescriptionPlacementEnum::TYPE,
			Enum\FormLabelPlacementEnum::TYPE,
			Enum\FormLimitEntriesPeriodEnum::TYPE,
			Enum\FormStatusEnum::TYPE,
			Enum\FormSubLabelPlacementEnum::TYPE,
			Enum\IdTypeEnum::TYPE,
			Enum\LabelPlacementPropertyEnum::TYPE,
			Enum\MinPasswordStrengthEnum::TYPE,
			Enum\NotificationToTypeEnum::TYPE,
			Enum\NumberFieldFormatEnum::TYPE,
			Enum\PageProgressStyleEnum::TYPE,
			Enum\PageProgressTypeEnum::TYPE,
			Enum\PhoneFieldFormatEnum::TYPE,
			Enum\RuleOperatorEnum::TYPE,
			Enum\SignatureBorderStyleEnum::TYPE,
			Enum\SignatureBorderWidthEnum::TYPE,
			Enum\SizePropertyEnum::TYPE,
			Enum\SortingInputEnum::TYPE,
			Enum\TimeFieldFormatEnum::TYPE,
			Enum\VisibilityPropertyEnum::TYPE,
		];

		/**
		 * Filter to add custom Gravity Forms enum types to the GraphQL schema.
		 *
		 * @param array The field value types.
		 */
		return apply_filters( 'wp_graphql_gf_enum_types', $types );
	}

	/**
	 * Returns Gravity Forms draft entry updater field value mutation names to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_field_value_mutation_names() : array {
		$types = [
			Mutations\UpdateDraftEntryAddressFieldValue::NAME,
			Mutations\UpdateDraftEntryChainedSelectFieldValue::NAME,
			Mutations\UpdateDraftEntryCheckboxFieldValue::NAME,
			Mutations\UpdateDraftEntryConsentFieldValue::NAME,
			Mutations\UpdateDraftEntryDateFieldValue::NAME,
			Mutations\UpdateDraftEntryEmailFieldValue::NAME,
			Mutations\UpdateDraftEntryHiddenFieldValue::NAME,
			Mutations\UpdateDraftEntryListFieldValue::NAME,
			Mutations\UpdateDraftEntryMultiSelectFieldValue::NAME,
			Mutations\UpdateDraftEntryNameFieldValue::NAME,
			Mutations\UpdateDraftEntryNumberFieldValue::NAME,
			Mutations\UpdateDraftEntryPhoneFieldValue::NAME,
			Mutations\UpdateDraftEntryPostCategoryFieldValue::NAME,
			Mutations\UpdateDraftEntryPostContentFieldValue::NAME,
			Mutations\UpdateDraftEntryPostCustomFieldValue::NAME,
			Mutations\UpdateDraftEntryPostExcerptFieldValue::NAME,
			Mutations\UpdateDraftEntryPostTagsFieldValue::NAME,
			Mutations\UpdateDraftEntryPostTitleFieldValue::NAME,
			Mutations\UpdateDraftEntryRadioFieldValue::NAME,
			Mutations\UpdateDraftEntrySelectFieldValue::NAME,
			Mutations\UpdateDraftEntrySignatureFieldValue::NAME,
			Mutations\UpdateDraftEntryTextAreaFieldValue::NAME,
			Mutations\UpdateDraftEntryTextFieldValue::NAME,
			Mutations\UpdateDraftEntryTimeFieldValue::NAME,
			Mutations\UpdateDraftEntryWebsiteFieldValue::NAME,
		];

		/**
		 * Filter to add custom Gravity Forms draft entry updater mutation names to the GraphQL schema.
		 *
		 * @param array The field value types.
		 */
		return apply_filters( 'wp_graphql_gf_field_value_mutation_names', $types );
	}

	/**
	 * Register all hooks to WordPress.
	 */
	private function register_hooks() : void {
		foreach ( $this->get_hookable_instances() as $instance ) {
			$instance->register_hooks();
		}
	}

	/**
	 * Get array of all hookable instances.
	 *
	 * @return array
	 */
	private function get_hookable_instances() : array {
		return array_filter(
			$this->instances,
			fn ( $instance) => $instance instanceof Hookable
		);
	}
}
