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
		$this->instances['button'] = new Button();

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

		// Field Properties.
		$this->instances['address_input_property']         = new FieldProperty\AddressInputProperty();
		$this->instances['chained_select_choice_property'] = new FieldProperty\ChainedSelectChoiceProperty();
		$this->instances['chained_select_input_property']  = new FieldProperty\ChainedSelectInputProperty();
		$this->instances['checkbox_input_property']        = new FieldProperty\CheckboxInputProperty();
		$this->instances['choice_property']                = new FieldProperty\ChoiceProperty();
		$this->instances['input_property']                 = new FieldProperty\InputProperty();
		$this->instances['list_choice_property']           = new FieldProperty\ListChoiceProperty();
		$this->instances['name_input_property']            = new FieldProperty\NameInputProperty();
		$this->instances['password_input_property']        = new FieldProperty\PasswordInputProperty();
		$this->instances['radio_choice_property']          = new FieldProperty\RadioChoiceProperty();

		// Interfaces.
		$this->instances['field_interface'] = new GraphQLInterface\FieldInterface();

		// Fields.
		$enabled_field_types = self::get_enabled_field_types();
		foreach ( $enabled_field_types as $gf_type => $type ) {
			$field_class_name                       = 'WPGraphQLGravityForms\\Types\\Field\\' . $type;
			$this->instances[ $gf_type . '_field' ] = new $field_class_name();
		}

		// Field Values.
		$this->instances['address_field_value']        = new FieldValue\AddressFieldValue();
		$this->instances['chained_select_field_value'] = new FieldValue\ChainedSelectFieldValue();
		$this->instances['checkbox_input_value']       = new FieldValue\CheckboxInputValue();
		$this->instances['checkbox_field_values']      = new FieldValue\CheckboxFieldValue();
		$this->instances['consent_field_values']       = new FieldValue\ConsentFieldValue();
		$this->instances['date_field_values']          = new FieldValue\DateFieldValue();
		$this->instances['email_field_value']          = new FieldValue\EmailFieldValue();
		$this->instances['hidden_field_value']         = new FieldValue\HiddenFieldValue();
		$this->instances['file_upload_field_value']    = new FieldValue\FileUploadFieldValue();
		$this->instances['list_input_value']           = new FieldValue\ListInputValue();
		$this->instances['list_field_values']          = new FieldValue\ListFieldValue();
		$this->instances['multi_select_field_value']   = new FieldValue\MultiSelectFieldValue();
		$this->instances['name_field_value']           = new FieldValue\NameFieldValue();
		$this->instances['number_field_value']         = new FieldValue\NumberFieldValue();
		$this->instances['phone_field_values']         = new FieldValue\PhoneFieldValue();
		$this->instances['post_category_field_value']  = new FieldValue\PostCategoryFieldValue();
		$this->instances['post_content_field_value']   = new FieldValue\PostContentFieldValue();
		$this->instances['post_custom_field_value']    = new FieldValue\PostCustomFieldValue();
		$this->instances['post_excerpt_field_value']   = new FieldValue\PostExcerptFieldValue();
		$this->instances['post_tags_field_value']      = new FieldValue\PostTagsFieldValue();
		$this->instances['post_title_field_value']     = new FieldValue\PostTitleFieldValue();
		$this->instances['radio_field_values']         = new FieldValue\RadioFieldValue();
		$this->instances['select_field_value']         = new FieldValue\SelectFieldValue();
		$this->instances['signature_field_value']      = new FieldValue\SignatureFieldValue();
		$this->instances['text_area_field_value']      = new FieldValue\TextAreaFieldValue();
		$this->instances['text_field_value']           = new FieldValue\TextFieldValue();
		$this->instances['time_field_value']           = new FieldValue\TimeFieldValue();
		$this->instances['website_field_value']        = new FieldValue\WebsiteFieldValue();

		// Entries.
		$this->instances['entry']      = new Entry\Entry( $this->instances['entry_data_manipulator'], $this->instances['draft_entry_data_manipulator'] );
		$this->instances['entry_form'] = new Entry\EntryForm( $this->instances['form_data_manipulator'] );
		$this->instances['entry_user'] = new Entry\EntryUser();

		// Input.
		$this->instances['address_input']              = new Input\AddressInput();
		$this->instances['chained_select_input']       = new Input\ChainedSelectInput();
		$this->instances['checkbox_input']             = new Input\CheckboxInput();
		$this->instances['list_input']                 = new Input\ListInput();
		$this->instances['name_input']                 = new Input\NameInput();
		$this->instances['entries_date_fiters_input']  = new Input\EntriesDateFiltersInput();
		$this->instances['entries_field_fiters_input'] = new Input\EntriesFieldFiltersInput();
		$this->instances['entries_sorting_input']      = new Input\EntriesSortingInput();

		// Unions.
		$this->instances['object_field_value_union'] = new Union\ObjectFieldValueUnion( $this->instances );

		// Connections.
		$this->instances['entry_field_connection']        = new Connections\EntryFieldConnection( $this->instances );
		$this->instances['form_field_connection']         = new Connections\FormFieldConnection();
		$this->instances['root_query_entries_connection'] = new Connections\RootQueryEntriesConnection();
		$this->instances['root_query_forms_connection']   = new Connections\RootQueryFormsConnection();

		// Enums.
		$this->instances['address_type_enum']                   = new Enum\AddressTypeEnum();
		$this->instances['button_type_enum']                    = new Enum\ButtonTypeEnum();
		$this->instances['calendar_icon_type_enum']             = new Enum\CalendarIconTypeEnum();
		$this->instances['captcha_theme_enum']                  = new Enum\CaptchaThemeEnum();
		$this->instances['captcha_type_enum']                   = new Enum\CaptchaTypeEnum();
		$this->instances['chained_selects_alignmnet_enum']      = new Enum\ChainedSelectsAlignmentEnum();
		$this->instances['conditional_logic_action_type_enum']  = new Enum\ConditionalLogicActionTypeEnum();
		$this->instances['conditional_logic_logic_type_enum']   = new Enum\ConditionalLogicLogicTypeEnum();
		$this->instances['confirmation_type_enum']              = new Enum\ConfirmationTypeEnum();
		$this->instances['date_field_format_enum']              = new Enum\DateFieldFormatEnum();
		$this->instances['date_type_enum']                      = new Enum\DateTypeEnum();
		$this->instances['description_placement_property_enum'] = new Enum\DescriptionPlacementPropertyEnum();
		$this->instances['entry_status_enum']                   = new Enum\EntryStatusEnum();
		$this->instances['field_filters_mode_enum']             = new Enum\FieldFiltersModeEnum();
		$this->instances['field_filters_operator_input_enum']   = new Enum\FieldFiltersOperatorInputEnum();
		$this->instances['form_description_placement_enum']     = new Enum\FormDescriptionPlacementEnum();
		$this->instances['form_label_placement_enum']           = new Enum\FormLabelPlacementEnum();
		$this->instances['form_limit_entries_period_enum']      = new Enum\FormLimitEntriesPeriodEnum();
		$this->instances['form_status_enum']                    = new Enum\FormStatusEnum();
		$this->instances['form_sub_label_placement_enum']       = new Enum\FormSubLabelPlacementEnum();
		$this->instances['id_type_enum']                        = new Enum\IdTypeEnum();
		$this->instances['label_placement_property_enum']       = new Enum\LabelPlacementPropertyEnum();
		$this->instances['min_password_strength_enum']          = new Enum\MinPasswordStrengthEnum();
		$this->instances['notification_to_type_enum']           = new Enum\NotificationToTypeEnum();
		$this->instances['number_field_format_enum']            = new Enum\NumberFieldFormatEnum();
		$this->instances['page_progress_style_enum']            = new Enum\PageProgressStyleEnum();
		$this->instances['page_progress_type_enum']             = new Enum\PageProgressTypeEnum();
		$this->instances['phone_field_format_enum']             = new Enum\PhoneFieldFormatEnum();
		$this->instances['rule_operator_enum']                  = new Enum\RuleOperatorEnum();
		$this->instances['signature_border_style_enum']         = new Enum\SignatureBorderStyleEnum();
		$this->instances['signature_border_width_enum']         = new Enum\SignatureBorderWidthEnum();
		$this->instances['size_property_enum']                  = new Enum\SizePropertyEnum();
		$this->instances['sorting_input_enum']                  = new Enum\SortingInputEnum();
		$this->instances['time_field_format_enum']              = new Enum\TimeFieldFormatEnum();
		$this->instances['visibility_property_enum']            = new Enum\VisibilityPropertyEnum();

		// Field errors.
		$this->instances['field_error'] = new FieldError();

		// Mutations.
		$this->instances['delete_entry']                                  = new Mutations\DeleteEntry();
		$this->instances['create_draft_entry']                            = new Mutations\CreateDraftEntry();
		$this->instances['delete_draft_entry']                            = new Mutations\DeleteDraftEntry();
		$this->instances['submit_draft_entry']                            = new Mutations\SubmitDraftEntry( $this->instances['entry_data_manipulator'] );
		$this->instances['update_draft_entry_address_field_value']        = new Mutations\UpdateDraftEntryAddressFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_chained_select_field_value'] = new Mutations\UpdateDraftEntryChainedSelectFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_checkbox_field_value']       = new Mutations\UpdateDraftEntryCheckboxFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_consent_field_value']        = new Mutations\UpdateDraftEntryConsentFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_date_field_value']           = new Mutations\UpdateDraftEntryDateFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_email_field_value']          = new Mutations\UpdateDraftEntryEmailFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_hidden_field_value']         = new Mutations\UpdateDraftEntryHiddenFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_list_field_value']           = new Mutations\UpdateDraftEntryListFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_multi_select_field_value']   = new Mutations\UpdateDraftEntryMultiSelectFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_name_field_value']           = new Mutations\UpdateDraftEntryNameFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_number_field_value']         = new Mutations\UpdateDraftEntryNumberFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_phone_field_value']          = new Mutations\UpdateDraftEntryPhoneFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_post_category_field_value']  = new Mutations\UpdateDraftEntryPostCategoryFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_post_content_field_value']   = new Mutations\UpdateDraftEntryPostContentFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_post_custom_field_value']    = new Mutations\UpdateDraftEntryPostCustomFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_post_excerpt_field_value']   = new Mutations\UpdateDraftEntryPostExcerptFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_post_tags_field_value']      = new Mutations\UpdateDraftEntryPostTagsFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_post_title_field_value']     = new Mutations\UpdateDraftEntryPostTitleFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_radio_field_value']          = new Mutations\UpdateDraftEntryRadioFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_select_field_value']         = new Mutations\UpdateDraftEntrySelectFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_signature_field_value']      = new Mutations\UpdateDraftEntrySignatureFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_text_area_field_value']      = new Mutations\UpdateDraftEntryTextAreaFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_text_field_value']           = new Mutations\UpdateDraftEntryTextFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_time_field_value']           = new Mutations\UpdateDraftEntryTimeFieldValue( $this->instances['draft_entry_data_manipulator'] );
		$this->instances['update_draft_entry_website_field_value']        = new Mutations\UpdateDraftEntryWebsiteFieldValue( $this->instances['draft_entry_data_manipulator'] );
	}


	/**
	 * Returns Gravity Forms Field types to be exposed to the GraphQL schema.
	 *
	 * @return array field types.
	 */
	public static function get_enabled_field_types() : array {
		$fields = [
			Field\AddressField::GF_TYPE       => Field\AddressField::TYPE,
			Field\CaptchaField::GF_TYPE       => Field\CaptchaField::TYPE,
			Field\ChainedSelectField::GF_TYPE => Field\ChainedSelectField::TYPE,
			Field\CheckboxField::GF_TYPE      => Field\CheckboxField::TYPE,
			Field\ConsentField::GF_TYPE       => Field\ConsentField::TYPE,
			Field\DateField::GF_TYPE          => Field\DateField::TYPE,
			Field\EmailField::GF_TYPE         => Field\EmailField::TYPE,
			Field\FileUploadField::GF_TYPE    => Field\FileUploadField::TYPE,
			Field\HiddenField::GF_TYPE        => Field\HiddenField::TYPE,
			Field\HtmlField::GF_TYPE          => Field\HtmlField::TYPE,
			Field\ListField::GF_TYPE          => Field\ListField::TYPE,
			Field\MultiSelectField::GF_TYPE   => Field\MultiSelectField::TYPE,
			Field\NameField::GF_TYPE          => Field\NameField::TYPE,
			Field\NumberField::GF_TYPE        => Field\NumberField::TYPE,
			Field\PageField::GF_TYPE          => Field\PageField::TYPE,
			Field\PasswordField::GF_TYPE      => Field\PasswordField::TYPE,
			Field\PhoneField::GF_TYPE         => Field\PhoneField::TYPE,
			Field\PostCategoryField::GF_TYPE  => Field\PostCategoryField::TYPE,
			Field\PostContentField::GF_TYPE   => Field\PostContentField::TYPE,
			Field\PostCustomField::GF_TYPE    => Field\PostCustomField::TYPE,
			Field\PostExcerptField::GF_TYPE   => Field\PostExcerptField::TYPE,
			Field\PostImageField::GF_TYPE     => Field\PostImageField::TYPE,
			Field\PostTagsField::GF_TYPE      => Field\PostTagsField::TYPE,
			Field\PostTitleField::GF_TYPE     => Field\PostTitleField::TYPE,
			Field\RadioField::GF_TYPE         => Field\RadioField::TYPE,
			Field\SectionField::GF_TYPE       => Field\SectionField::TYPE,
			Field\SelectField::GF_TYPE        => Field\SelectField::TYPE,
			Field\SignatureField::GF_TYPE     => Field\SignatureField::TYPE,
			Field\TextAreaField::GF_TYPE      => Field\TextAreaField::TYPE,
			Field\TextField::GF_TYPE          => Field\TextField::TYPE,
			Field\TimeField::GF_TYPE          => Field\TimeField::TYPE,
			Field\WebsiteField::GF_TYPE       => Field\WebsiteField::TYPE,
		];

		/**
		 * Filter to add custom Gravity Forms field types to the GraphQL schema.
		 *
		 * @param array The field types.
		 */
		return apply_filters( 'wp_graphql_gf_field_types', $fields );
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
