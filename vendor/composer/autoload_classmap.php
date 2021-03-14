<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'WPGraphQLGravityForms\\Connections\\EntryFieldConnection' => $baseDir . '/src/Connections/EntryFieldConnection.php',
    'WPGraphQLGravityForms\\Connections\\FormFieldConnection' => $baseDir . '/src/Connections/FormFieldConnection.php',
    'WPGraphQLGravityForms\\Connections\\RootQueryEntriesConnection' => $baseDir . '/src/Connections/RootQueryEntriesConnection.php',
    'WPGraphQLGravityForms\\Connections\\RootQueryEntriesConnectionResolver' => $baseDir . '/src/Connections/RootQueryEntriesConnectionResolver.php',
    'WPGraphQLGravityForms\\Connections\\RootQueryFormsConnection' => $baseDir . '/src/Connections/RootQueryFormsConnection.php',
    'WPGraphQLGravityForms\\Connections\\RootQueryFormsConnectionResolver' => $baseDir . '/src/Connections/RootQueryFormsConnectionResolver.php',
    'WPGraphQLGravityForms\\DataManipulators\\DraftEntryDataManipulator' => $baseDir . '/src/DataManipulators/DraftEntryDataManipulator.php',
    'WPGraphQLGravityForms\\DataManipulators\\EntryDataManipulator' => $baseDir . '/src/DataManipulators/EntryDataManipulator.php',
    'WPGraphQLGravityForms\\DataManipulators\\FieldsDataManipulator' => $baseDir . '/src/DataManipulators/FieldsDataManipulator.php',
    'WPGraphQLGravityForms\\DataManipulators\\FormDataManipulator' => $baseDir . '/src/DataManipulators/FormDataManipulator.php',
    'WPGraphQLGravityForms\\Data\\Loader\\EntriesLoader' => $baseDir . '/src/Data/Loader/EntriesLoader.php',
    'WPGraphQLGravityForms\\Data\\Loader\\LoadersRegistrar' => $baseDir . '/src/Data/Loader/LoadersRegistrar.php',
    'WPGraphQLGravityForms\\Interfaces\\Connection' => $baseDir . '/src/Interfaces/Connection.php',
    'WPGraphQLGravityForms\\Interfaces\\DataManipulator' => $baseDir . '/src/Interfaces/DataManipulator.php',
    'WPGraphQLGravityForms\\Interfaces\\Enum' => $baseDir . '/src/Interfaces/Enum.php',
    'WPGraphQLGravityForms\\Interfaces\\Field' => $baseDir . '/src/Interfaces/Field.php',
    'WPGraphQLGravityForms\\Interfaces\\FieldProperty' => $baseDir . '/src/Interfaces/FieldProperty.php',
    'WPGraphQLGravityForms\\Interfaces\\FieldValue' => $baseDir . '/src/Interfaces/FieldValue.php',
    'WPGraphQLGravityForms\\Interfaces\\Hookable' => $baseDir . '/src/Interfaces/Hookable.php',
    'WPGraphQLGravityForms\\Interfaces\\InputType' => $baseDir . '/src/Interfaces/InputType.php',
    'WPGraphQLGravityForms\\Interfaces\\Mutation' => $baseDir . '/src/Interfaces/Mutation.php',
    'WPGraphQLGravityForms\\Interfaces\\Type' => $baseDir . '/src/Interfaces/Type.php',
    'WPGraphQLGravityForms\\Mutations\\CreateDraftEntry' => $baseDir . '/src/Mutations/CreateDraftEntry.php',
    'WPGraphQLGravityForms\\Mutations\\CreateEntry' => $baseDir . '/src/Mutations/CreateEntry.php',
    'WPGraphQLGravityForms\\Mutations\\DeleteDraftEntry' => $baseDir . '/src/Mutations/DeleteDraftEntry.php',
    'WPGraphQLGravityForms\\Mutations\\DeleteEntry' => $baseDir . '/src/Mutations/DeleteEntry.php',
    'WPGraphQLGravityForms\\Mutations\\DraftEntryUpdater' => $baseDir . '/src/Mutations/DraftEntryUpdater.php',
    'WPGraphQLGravityForms\\Mutations\\SubmitDraftEntry' => $baseDir . '/src/Mutations/SubmitDraftEntry.php',
    'WPGraphQLGravityForms\\Mutations\\SubmitEntry' => $baseDir . '/src/Mutations/SubmitEntry.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryAddressFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryAddressFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryChainedSelectFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryChainedSelectFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryCheckboxFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryCheckboxFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryConsentFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryConsentFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryDateFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryDateFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryEmailFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryEmailFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryHiddenFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryHiddenFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryListFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryListFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryMultiSelectFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryMultiSelectFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryNameFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryNameFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryNumberFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryNumberFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPhoneFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPhoneFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostCategoryFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPostCategoryFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostContentFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPostContentFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostCustomFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPostCustomFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostExcerptFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPostExcerptFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostTagsFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPostTagsFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostTitleFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryPostTitleFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryRadioFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryRadioFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntrySelectFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntrySelectFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntrySignatureFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntrySignatureFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryTextAreaFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryTextAreaFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryTextFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryTextFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryTimeFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryTimeFieldValue.php',
    'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryWebsiteFieldValue' => $baseDir . '/src/Mutations/UpdateDraftEntryWebsiteFieldValue.php',
    'WPGraphQLGravityForms\\Settings\\WPGraphQLSettings' => $baseDir . '/src/Settings/WPGraphQLSettings.php',
    'WPGraphQLGravityForms\\Types\\Button\\Button' => $baseDir . '/src/Types/Button/Button.php',
    'WPGraphQLGravityForms\\Types\\ConditionalLogic\\ConditionalLogic' => $baseDir . '/src/Types/ConditionalLogic/ConditionalLogic.php',
    'WPGraphQLGravityForms\\Types\\ConditionalLogic\\ConditionalLogicRule' => $baseDir . '/src/Types/ConditionalLogic/ConditionalLogicRule.php',
    'WPGraphQLGravityForms\\Types\\Entry\\Entry' => $baseDir . '/src/Types/Entry/Entry.php',
    'WPGraphQLGravityForms\\Types\\Entry\\EntryForm' => $baseDir . '/src/Types/Entry/EntryForm.php',
    'WPGraphQLGravityForms\\Types\\Entry\\EntryUser' => $baseDir . '/src/Types/Entry/EntryUser.php',
    'WPGraphQLGravityForms\\Types\\Enum\\AbstractEnum' => $baseDir . '/src/Types/Enum/AbstractEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\AddressTypeEnum' => $baseDir . '/src/Types/Enum/AddressTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\ButtonTypeEnum' => $baseDir . '/src/Types/Enum/ButtonTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\CalendarIconTypeEnum' => $baseDir . '/src/Types/Enum/CalendarIconTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\CaptchaThemeEnum' => $baseDir . '/src/Types/Enum/CaptchaThemeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\CaptchaTypeEnum' => $baseDir . '/src/Types/Enum/CaptchaTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\ChainedSelectsAlignmentEnum' => $baseDir . '/src/Types/Enum/ChainedSelectsAlignmentEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\ConditionalLogicActionTypeEnum' => $baseDir . '/src/Types/Enum/ConditionalLogicActionTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\ConditionalLogicLogicTypeEnum' => $baseDir . '/src/Types/Enum/ConditionalLogicLogicTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\ConfirmationTypeEnum' => $baseDir . '/src/Types/Enum/ConfirmationTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\DateFieldFormatEnum' => $baseDir . '/src/Types/Enum/DateFieldFormatEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\DateTypeEnum' => $baseDir . '/src/Types/Enum/DateTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\DescriptionPlacementPropertyEnum' => $baseDir . '/src/Types/Enum/DescriptionPlacementPropertyEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\EntryStatusEnum' => $baseDir . '/src/Types/Enum/EntryStatusEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\EntryTypeEnum' => $baseDir . '/src/Types/Enum/EntryTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FieldFiltersModeEnum' => $baseDir . '/src/Types/Enum/FieldFiltersModeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FieldFiltersOperatorInputEnum' => $baseDir . '/src/Types/Enum/FieldFiltersOperatorInputEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FormDescriptionPlacementEnum' => $baseDir . '/src/Types/Enum/FormDescriptionPlacementEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FormLabelPlacementEnum' => $baseDir . '/src/Types/Enum/FormLabelPlacementEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FormLimitEntriesPeriodEnum' => $baseDir . '/src/Types/Enum/FormLimitEntriesPeriodEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FormStatusEnum' => $baseDir . '/src/Types/Enum/FormStatusEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\FormSubLabelPlacementEnum' => $baseDir . '/src/Types/Enum/FormSubLabelPlacementEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\LabelPlacementPropertyEnum' => $baseDir . '/src/Types/Enum/LabelPlacementPropertyEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\MinPasswordStrengthEnum' => $baseDir . '/src/Types/Enum/MinPasswordStrengthEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\NotificationToTypeEnum' => $baseDir . '/src/Types/Enum/NotificationToTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\NumberFieldFormatEnum' => $baseDir . '/src/Types/Enum/NumberFieldFormatEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\PageProgressStyleEnum' => $baseDir . '/src/Types/Enum/PageProgressStyleEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\PageProgressTypeEnum' => $baseDir . '/src/Types/Enum/PageProgressTypeEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\PhoneFieldFormatEnum' => $baseDir . '/src/Types/Enum/PhoneFieldFormatEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\RuleOperatorEnum' => $baseDir . '/src/Types/Enum/RuleOperatorEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\SignatureBorderStyleEnum' => $baseDir . '/src/Types/Enum/SignatureBorderStyleEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\SignatureBorderWidthEnum' => $baseDir . '/src/Types/Enum/SignatureBorderWidthEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\SizePropertyEnum' => $baseDir . '/src/Types/Enum/SizePropertyEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\SortingInputEnum' => $baseDir . '/src/Types/Enum/SortingInputEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\TimeFieldFormatEnum' => $baseDir . '/src/Types/Enum/TimeFieldFormatEnum.php',
    'WPGraphQLGravityForms\\Types\\Enum\\VisibilityPropertyEnum' => $baseDir . '/src/Types/Enum/VisibilityPropertyEnum.php',
    'WPGraphQLGravityForms\\Types\\FieldError\\FieldError' => $baseDir . '/src/Types/FieldError/FieldError.php',
    'WPGraphQLGravityForms\\Types\\Field\\AbstractField' => $baseDir . '/src/Types/Field/AbstractField.php',
    'WPGraphQLGravityForms\\Types\\Field\\AddressField' => $baseDir . '/src/Types/Field/AddressField.php',
    'WPGraphQLGravityForms\\Types\\Field\\CaptchaField' => $baseDir . '/src/Types/Field/CaptchaField.php',
    'WPGraphQLGravityForms\\Types\\Field\\ChainedSelectField' => $baseDir . '/src/Types/Field/ChainedSelectField.php',
    'WPGraphQLGravityForms\\Types\\Field\\CheckboxField' => $baseDir . '/src/Types/Field/CheckboxField.php',
    'WPGraphQLGravityForms\\Types\\Field\\ConsentField' => $baseDir . '/src/Types/Field/ConsentField.php',
    'WPGraphQLGravityForms\\Types\\Field\\DateField' => $baseDir . '/src/Types/Field/DateField.php',
    'WPGraphQLGravityForms\\Types\\Field\\EmailField' => $baseDir . '/src/Types/Field/EmailField.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AddressInputProperty' => $baseDir . '/src/Types/Field/FieldProperty/AddressInputProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AdminLabelProperty' => $baseDir . '/src/Types/Field/FieldProperty/AdminLabelProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AdminOnlyProperty' => $baseDir . '/src/Types/Field/FieldProperty/AdminOnlyProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AllowsPrepopulateProperty' => $baseDir . '/src/Types/Field/FieldProperty/AllowsPrepopulateProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChainedSelectChoiceProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChainedSelectChoiceProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChainedSelectInputProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChainedSelectInputProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\CheckboxInputProperty' => $baseDir . '/src/Types/Field/FieldProperty/CheckboxInputProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChoiceProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty\\ChoiceIsSelectedProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChoiceProperty/ChoiceIsSelectedProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty\\ChoiceTextProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChoiceProperty/ChoiceTextProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty\\ChoiceValueProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChoiceProperty/ChoiceValueProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoicesProperty' => $baseDir . '/src/Types/Field/FieldProperty/ChoicesProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DefaultValueProperty' => $baseDir . '/src/Types/Field/FieldProperty/DefaultValueProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DescriptionPlacementProperty' => $baseDir . '/src/Types/Field/FieldProperty/DescriptionPlacementProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DescriptionProperty' => $baseDir . '/src/Types/Field/FieldProperty/DescriptionProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DisplayOnlyProperty' => $baseDir . '/src/Types/Field/FieldProperty/DisplayOnlyProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnableChoiceValueProperty' => $baseDir . '/src/Types/Field/FieldProperty/EnableChoiceValueProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnableEnhancedUiProperty' => $baseDir . '/src/Types/Field/FieldProperty/EnableEnhancedUiProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnablePriceProperty' => $baseDir . '/src/Types/Field/FieldProperty/EnablePriceProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnableSelectAllProperty' => $baseDir . '/src/Types/Field/FieldProperty/EnableSelectAllProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ErrorMessageProperty' => $baseDir . '/src/Types/Field/FieldProperty/ErrorMessageProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputNameProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputNameProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputCustomLabelProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputCustomLabelProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputDefaultValueProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputDefaultValueProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputIdProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputIdProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputIsHiddenProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputIsHiddenProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputKeyProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputKeyProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputLabelProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputLabelProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputNameProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputNameProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputPlaceholderProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputProperty/InputPlaceholderProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputTypeProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputTypeProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputsProperty' => $baseDir . '/src/Types/Field/FieldProperty/InputsProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\IsRequiredProperty' => $baseDir . '/src/Types/Field/FieldProperty/IsRequiredProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\LabelPlacementProperty' => $baseDir . '/src/Types/Field/FieldProperty/LabelPlacementProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\LabelProperty' => $baseDir . '/src/Types/Field/FieldProperty/LabelProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ListChoiceProperty' => $baseDir . '/src/Types/Field/FieldProperty/ListChoiceProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\MaxLengthProperty' => $baseDir . '/src/Types/Field/FieldProperty/MaxLengthProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\NameInputProperty' => $baseDir . '/src/Types/Field/FieldProperty/NameInputProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\NoDuplicatesProperty' => $baseDir . '/src/Types/Field/FieldProperty/NoDuplicatesProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\PageNumberProperty' => $baseDir . '/src/Types/Field/FieldProperty/PageNumberProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\PasswordInputProperty' => $baseDir . '/src/Types/Field/FieldProperty/PasswordInputProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\PlaceholderProperty' => $baseDir . '/src/Types/Field/FieldProperty/PlaceholderProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ProductFieldProperty' => $baseDir . '/src/Types/Field/FieldProperty/ProductFieldProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\RadioChoiceProperty' => $baseDir . '/src/Types/Field/FieldProperty/RadioChoiceProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\SizeProperty' => $baseDir . '/src/Types/Field/FieldProperty/SizeProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\SubLabelPlacementProperty' => $baseDir . '/src/Types/Field/FieldProperty/SubLabelPlacementProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\VisibilityProperty' => $baseDir . '/src/Types/Field/FieldProperty/VisibilityProperty.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\AddressFieldValue' => $baseDir . '/src/Types/Field/FieldValue/AddressFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ChainedSelectFieldValue' => $baseDir . '/src/Types/Field/FieldValue/ChainedSelectFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\CheckboxFieldValue' => $baseDir . '/src/Types/Field/FieldValue/CheckboxFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\CheckboxInputValue' => $baseDir . '/src/Types/Field/FieldValue/CheckboxInputValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ConsentFieldValue' => $baseDir . '/src/Types/Field/FieldValue/ConsentFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\DateFieldValue' => $baseDir . '/src/Types/Field/FieldValue/DateFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\EmailFieldValue' => $baseDir . '/src/Types/Field/FieldValue/EmailFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\FileUploadFieldValue' => $baseDir . '/src/Types/Field/FieldValue/FileUploadFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\HiddenFieldValue' => $baseDir . '/src/Types/Field/FieldValue/HiddenFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ListFieldValue' => $baseDir . '/src/Types/Field/FieldValue/ListFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ListInputValue' => $baseDir . '/src/Types/Field/FieldValue/ListInputValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\MultiSelectFieldValue' => $baseDir . '/src/Types/Field/FieldValue/MultiSelectFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\NameFieldValue' => $baseDir . '/src/Types/Field/FieldValue/NameFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\NumberFieldValue' => $baseDir . '/src/Types/Field/FieldValue/NumberFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PhoneFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PhoneFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostCategoryFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PostCategoryFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostContentFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PostContentFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostCustomFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PostCustomFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostExcerptFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PostExcerptFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostTagsFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PostTagsFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostTitleFieldValue' => $baseDir . '/src/Types/Field/FieldValue/PostTitleFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\RadioFieldValue' => $baseDir . '/src/Types/Field/FieldValue/RadioFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\SelectFieldValue' => $baseDir . '/src/Types/Field/FieldValue/SelectFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\SignatureFieldValue' => $baseDir . '/src/Types/Field/FieldValue/SignatureFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\TextAreaFieldValue' => $baseDir . '/src/Types/Field/FieldValue/TextAreaFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\TextFieldValue' => $baseDir . '/src/Types/Field/FieldValue/TextFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\TimeFieldValue' => $baseDir . '/src/Types/Field/FieldValue/TimeFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\WebsiteFieldValue' => $baseDir . '/src/Types/Field/FieldValue/WebsiteFieldValue.php',
    'WPGraphQLGravityForms\\Types\\Field\\FileUploadField' => $baseDir . '/src/Types/Field/FileUploadField.php',
    'WPGraphQLGravityForms\\Types\\Field\\HiddenField' => $baseDir . '/src/Types/Field/HiddenField.php',
    'WPGraphQLGravityForms\\Types\\Field\\HtmlField' => $baseDir . '/src/Types/Field/HtmlField.php',
    'WPGraphQLGravityForms\\Types\\Field\\ListField' => $baseDir . '/src/Types/Field/ListField.php',
    'WPGraphQLGravityForms\\Types\\Field\\MultiSelectField' => $baseDir . '/src/Types/Field/MultiSelectField.php',
    'WPGraphQLGravityForms\\Types\\Field\\NameField' => $baseDir . '/src/Types/Field/NameField.php',
    'WPGraphQLGravityForms\\Types\\Field\\NumberField' => $baseDir . '/src/Types/Field/NumberField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PageField' => $baseDir . '/src/Types/Field/PageField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PasswordField' => $baseDir . '/src/Types/Field/PasswordField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PhoneField' => $baseDir . '/src/Types/Field/PhoneField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostCategoryField' => $baseDir . '/src/Types/Field/PostCategoryField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostContentField' => $baseDir . '/src/Types/Field/PostContentField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostCustomField' => $baseDir . '/src/Types/Field/PostCustomField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostExcerptField' => $baseDir . '/src/Types/Field/PostExcerptField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostImageField' => $baseDir . '/src/Types/Field/PostImageField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostTagsField' => $baseDir . '/src/Types/Field/PostTagsField.php',
    'WPGraphQLGravityForms\\Types\\Field\\PostTitleField' => $baseDir . '/src/Types/Field/PostTitleField.php',
    'WPGraphQLGravityForms\\Types\\Field\\RadioField' => $baseDir . '/src/Types/Field/RadioField.php',
    'WPGraphQLGravityForms\\Types\\Field\\SectionField' => $baseDir . '/src/Types/Field/SectionField.php',
    'WPGraphQLGravityForms\\Types\\Field\\SelectField' => $baseDir . '/src/Types/Field/SelectField.php',
    'WPGraphQLGravityForms\\Types\\Field\\SignatureField' => $baseDir . '/src/Types/Field/SignatureField.php',
    'WPGraphQLGravityForms\\Types\\Field\\TextAreaField' => $baseDir . '/src/Types/Field/TextAreaField.php',
    'WPGraphQLGravityForms\\Types\\Field\\TextField' => $baseDir . '/src/Types/Field/TextField.php',
    'WPGraphQLGravityForms\\Types\\Field\\TimeField' => $baseDir . '/src/Types/Field/TimeField.php',
    'WPGraphQLGravityForms\\Types\\Field\\WebsiteField' => $baseDir . '/src/Types/Field/WebsiteField.php',
    'WPGraphQLGravityForms\\Types\\Form\\Form' => $baseDir . '/src/Types/Form/Form.php',
    'WPGraphQLGravityForms\\Types\\Form\\FormConfirmation' => $baseDir . '/src/Types/Form/FormConfirmation.php',
    'WPGraphQLGravityForms\\Types\\Form\\FormNotification' => $baseDir . '/src/Types/Form/FormNotification.php',
    'WPGraphQLGravityForms\\Types\\Form\\FormNotificationRouting' => $baseDir . '/src/Types/Form/FormNotificationRouting.php',
    'WPGraphQLGravityForms\\Types\\Form\\FormPagination' => $baseDir . '/src/Types/Form/FormPagination.php',
    'WPGraphQLGravityForms\\Types\\Form\\SaveAndContinue' => $baseDir . '/src/Types/Form/SaveAndContinue.php',
    'WPGraphQLGravityForms\\Types\\GraphQLInterface\\FieldInterface' => $baseDir . '/src/Types/GraphQLInterface/FieldInterface.php',
    'WPGraphQLGravityForms\\Types\\Input\\AddressInput' => $baseDir . '/src/Types/Input/AddressInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\ChainedSelectInput' => $baseDir . '/src/Types/Input/ChainedSelectInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\CheckboxInput' => $baseDir . '/src/Types/Input/CheckboxInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\EntriesDateFiltersInput' => $baseDir . '/src/Types/Input/EntriesDateFiltersInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\EntriesFieldFiltersInput' => $baseDir . '/src/Types/Input/EntriesFieldFiltersInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\EntriesSortingInput' => $baseDir . '/src/Types/Input/EntriesSortingInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\ListInput' => $baseDir . '/src/Types/Input/ListInput.php',
    'WPGraphQLGravityForms\\Types\\Input\\NameInput' => $baseDir . '/src/Types/Input/NameInput.php',
    'WPGraphQLGravityForms\\Types\\Union\\ObjectFieldValueUnion' => $baseDir . '/src/Types/Union/ObjectFieldValueUnion.php',
    'WPGraphQLGravityForms\\Utils\\Utils' => $baseDir . '/src/Utils/Utils.php',
    'WPGraphQLGravityForms\\WPGraphQLGravityForms' => $baseDir . '/src/WPGraphQLGravityForms.php',
);
