<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc0769f616b013655fd745e5ced376c8f
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPGraphQLGravityForms\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPGraphQLGravityForms\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'WPGraphQLGravityForms\\Connections\\EntryFieldConnection' => __DIR__ . '/../..' . '/src/Connections/EntryFieldConnection.php',
        'WPGraphQLGravityForms\\Connections\\FormFieldConnection' => __DIR__ . '/../..' . '/src/Connections/FormFieldConnection.php',
        'WPGraphQLGravityForms\\Connections\\RootQueryEntriesConnection' => __DIR__ . '/../..' . '/src/Connections/RootQueryEntriesConnection.php',
        'WPGraphQLGravityForms\\Connections\\RootQueryEntriesConnectionResolver' => __DIR__ . '/../..' . '/src/Connections/RootQueryEntriesConnectionResolver.php',
        'WPGraphQLGravityForms\\Connections\\RootQueryFormsConnection' => __DIR__ . '/../..' . '/src/Connections/RootQueryFormsConnection.php',
        'WPGraphQLGravityForms\\Connections\\RootQueryFormsConnectionResolver' => __DIR__ . '/../..' . '/src/Connections/RootQueryFormsConnectionResolver.php',
        'WPGraphQLGravityForms\\DataManipulators\\DraftEntryDataManipulator' => __DIR__ . '/../..' . '/src/DataManipulators/DraftEntryDataManipulator.php',
        'WPGraphQLGravityForms\\DataManipulators\\EntryDataManipulator' => __DIR__ . '/../..' . '/src/DataManipulators/EntryDataManipulator.php',
        'WPGraphQLGravityForms\\DataManipulators\\FieldsDataManipulator' => __DIR__ . '/../..' . '/src/DataManipulators/FieldsDataManipulator.php',
        'WPGraphQLGravityForms\\DataManipulators\\FormDataManipulator' => __DIR__ . '/../..' . '/src/DataManipulators/FormDataManipulator.php',
        'WPGraphQLGravityForms\\Data\\Loader\\EntriesLoader' => __DIR__ . '/../..' . '/src/Data/Loader/EntriesLoader.php',
        'WPGraphQLGravityForms\\Data\\Loader\\LoadersRegistrar' => __DIR__ . '/../..' . '/src/Data/Loader/LoadersRegistrar.php',
        'WPGraphQLGravityForms\\Interfaces\\Connection' => __DIR__ . '/../..' . '/src/Interfaces/Connection.php',
        'WPGraphQLGravityForms\\Interfaces\\DataManipulator' => __DIR__ . '/../..' . '/src/Interfaces/DataManipulator.php',
        'WPGraphQLGravityForms\\Interfaces\\Enum' => __DIR__ . '/../..' . '/src/Interfaces/Enum.php',
        'WPGraphQLGravityForms\\Interfaces\\Field' => __DIR__ . '/../..' . '/src/Interfaces/Field.php',
        'WPGraphQLGravityForms\\Interfaces\\FieldProperty' => __DIR__ . '/../..' . '/src/Interfaces/FieldProperty.php',
        'WPGraphQLGravityForms\\Interfaces\\FieldValue' => __DIR__ . '/../..' . '/src/Interfaces/FieldValue.php',
        'WPGraphQLGravityForms\\Interfaces\\Hookable' => __DIR__ . '/../..' . '/src/Interfaces/Hookable.php',
        'WPGraphQLGravityForms\\Interfaces\\InputType' => __DIR__ . '/../..' . '/src/Interfaces/InputType.php',
        'WPGraphQLGravityForms\\Interfaces\\Mutation' => __DIR__ . '/../..' . '/src/Interfaces/Mutation.php',
        'WPGraphQLGravityForms\\Interfaces\\Type' => __DIR__ . '/../..' . '/src/Interfaces/Type.php',
        'WPGraphQLGravityForms\\Mutations\\CreateDraftEntry' => __DIR__ . '/../..' . '/src/Mutations/CreateDraftEntry.php',
        'WPGraphQLGravityForms\\Mutations\\DeleteDraftEntry' => __DIR__ . '/../..' . '/src/Mutations/DeleteDraftEntry.php',
        'WPGraphQLGravityForms\\Mutations\\DeleteEntry' => __DIR__ . '/../..' . '/src/Mutations/DeleteEntry.php',
        'WPGraphQLGravityForms\\Mutations\\DraftEntryUpdater' => __DIR__ . '/../..' . '/src/Mutations/DraftEntryUpdater.php',
        'WPGraphQLGravityForms\\Mutations\\SubmitDraftEntry' => __DIR__ . '/../..' . '/src/Mutations/SubmitDraftEntry.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryAddressFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryAddressFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryChainedSelectFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryChainedSelectFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryCheckboxFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryCheckboxFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryConsentFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryConsentFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryDateFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryDateFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryEmailFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryEmailFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryHiddenFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryHiddenFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryListFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryListFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryMultiSelectFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryMultiSelectFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryNameFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryNameFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryNumberFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryNumberFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPhoneFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPhoneFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostCategoryFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPostCategoryFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostContentFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPostContentFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostCustomFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPostCustomFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostExcerptFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPostExcerptFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostTagsFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPostTagsFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryPostTitleFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryPostTitleFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryRadioFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryRadioFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntrySelectFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntrySelectFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntrySignatureFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntrySignatureFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryTextAreaFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryTextAreaFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryTextFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryTextFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryTimeFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryTimeFieldValue.php',
        'WPGraphQLGravityForms\\Mutations\\UpdateDraftEntryWebsiteFieldValue' => __DIR__ . '/../..' . '/src/Mutations/UpdateDraftEntryWebsiteFieldValue.php',
        'WPGraphQLGravityForms\\Settings\\WPGraphQLSettings' => __DIR__ . '/../..' . '/src/Settings/WPGraphQLSettings.php',
        'WPGraphQLGravityForms\\Types\\Button\\Button' => __DIR__ . '/../..' . '/src/Types/Button/Button.php',
        'WPGraphQLGravityForms\\Types\\ConditionalLogic\\ConditionalLogic' => __DIR__ . '/../..' . '/src/Types/ConditionalLogic/ConditionalLogic.php',
        'WPGraphQLGravityForms\\Types\\ConditionalLogic\\ConditionalLogicRule' => __DIR__ . '/../..' . '/src/Types/ConditionalLogic/ConditionalLogicRule.php',
        'WPGraphQLGravityForms\\Types\\Entry\\Entry' => __DIR__ . '/../..' . '/src/Types/Entry/Entry.php',
        'WPGraphQLGravityForms\\Types\\Entry\\EntryForm' => __DIR__ . '/../..' . '/src/Types/Entry/EntryForm.php',
        'WPGraphQLGravityForms\\Types\\Entry\\EntryUser' => __DIR__ . '/../..' . '/src/Types/Entry/EntryUser.php',
        'WPGraphQLGravityForms\\Types\\Enum\\AbstractEnum' => __DIR__ . '/../..' . '/src/Types/Enum/AbstractEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\AddressTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/AddressTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\ButtonTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/ButtonTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\CalendarIconTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/CalendarIconTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\CaptchaThemeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/CaptchaThemeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\CaptchaTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/CaptchaTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\ChainedSelectsAlignmentEnum' => __DIR__ . '/../..' . '/src/Types/Enum/ChainedSelectsAlignmentEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\ConditionalLogicActionTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/ConditionalLogicActionTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\ConditionalLogicLogicTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/ConditionalLogicLogicTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\ConfirmationTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/ConfirmationTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\DateFieldFormatEnum' => __DIR__ . '/../..' . '/src/Types/Enum/DateFieldFormatEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\DateTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/DateTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\DescriptionPlacementPropertyEnum' => __DIR__ . '/../..' . '/src/Types/Enum/DescriptionPlacementPropertyEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\EntryStatusEnum' => __DIR__ . '/../..' . '/src/Types/Enum/EntryStatusEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FieldFiltersModeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FieldFiltersModeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FieldFiltersOperatorInputEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FieldFiltersOperatorInputEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FormDescriptionPlacementEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FormDescriptionPlacementEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FormLabelPlacementEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FormLabelPlacementEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FormLimitEntriesPeriodEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FormLimitEntriesPeriodEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FormStatusEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FormStatusEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\FormSubLabelPlacementEnum' => __DIR__ . '/../..' . '/src/Types/Enum/FormSubLabelPlacementEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\IdTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/IdTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\LabelPlacementPropertyEnum' => __DIR__ . '/../..' . '/src/Types/Enum/LabelPlacementPropertyEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\MinPasswordStrengthEnum' => __DIR__ . '/../..' . '/src/Types/Enum/MinPasswordStrengthEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\NotificationToTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/NotificationToTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\NumberFieldFormatEnum' => __DIR__ . '/../..' . '/src/Types/Enum/NumberFieldFormatEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\PageProgressStyleEnum' => __DIR__ . '/../..' . '/src/Types/Enum/PageProgressStyleEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\PageProgressTypeEnum' => __DIR__ . '/../..' . '/src/Types/Enum/PageProgressTypeEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\PhoneFieldFormatEnum' => __DIR__ . '/../..' . '/src/Types/Enum/PhoneFieldFormatEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\RuleOperatorEnum' => __DIR__ . '/../..' . '/src/Types/Enum/RuleOperatorEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\SignatureBorderStyleEnum' => __DIR__ . '/../..' . '/src/Types/Enum/SignatureBorderStyleEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\SignatureBorderWidthEnum' => __DIR__ . '/../..' . '/src/Types/Enum/SignatureBorderWidthEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\SizePropertyEnum' => __DIR__ . '/../..' . '/src/Types/Enum/SizePropertyEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\SortingInputEnum' => __DIR__ . '/../..' . '/src/Types/Enum/SortingInputEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\TimeFieldFormatEnum' => __DIR__ . '/../..' . '/src/Types/Enum/TimeFieldFormatEnum.php',
        'WPGraphQLGravityForms\\Types\\Enum\\VisibilityPropertyEnum' => __DIR__ . '/../..' . '/src/Types/Enum/VisibilityPropertyEnum.php',
        'WPGraphQLGravityForms\\Types\\FieldError\\FieldError' => __DIR__ . '/../..' . '/src/Types/FieldError/FieldError.php',
        'WPGraphQLGravityForms\\Types\\Field\\AddressField' => __DIR__ . '/../..' . '/src/Types/Field/AddressField.php',
        'WPGraphQLGravityForms\\Types\\Field\\CaptchaField' => __DIR__ . '/../..' . '/src/Types/Field/CaptchaField.php',
        'WPGraphQLGravityForms\\Types\\Field\\ChainedSelectField' => __DIR__ . '/../..' . '/src/Types/Field/ChainedSelectField.php',
        'WPGraphQLGravityForms\\Types\\Field\\CheckboxField' => __DIR__ . '/../..' . '/src/Types/Field/CheckboxField.php',
        'WPGraphQLGravityForms\\Types\\Field\\ConsentField' => __DIR__ . '/../..' . '/src/Types/Field/ConsentField.php',
        'WPGraphQLGravityForms\\Types\\Field\\DateField' => __DIR__ . '/../..' . '/src/Types/Field/DateField.php',
        'WPGraphQLGravityForms\\Types\\Field\\EmailField' => __DIR__ . '/../..' . '/src/Types/Field/EmailField.php',
        'WPGraphQLGravityForms\\Types\\Field\\Field' => __DIR__ . '/../..' . '/src/Types/Field/Field.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AddressInputProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/AddressInputProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AdminLabelProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/AdminLabelProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AdminOnlyProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/AdminOnlyProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\AllowsPrepopulateProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/AllowsPrepopulateProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChainedSelectChoiceProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChainedSelectChoiceProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChainedSelectInputProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChainedSelectInputProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\CheckboxInputProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/CheckboxInputProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChoiceProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty\\ChoiceIsSelectedProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChoiceProperty/ChoiceIsSelectedProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty\\ChoiceTextProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChoiceProperty/ChoiceTextProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoiceProperty\\ChoiceValueProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChoiceProperty/ChoiceValueProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ChoicesProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ChoicesProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DefaultValueProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/DefaultValueProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DescriptionPlacementProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/DescriptionPlacementProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DescriptionProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/DescriptionProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\DisplayOnlyProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/DisplayOnlyProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnableChoiceValueProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/EnableChoiceValueProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnableEnhancedUiProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/EnableEnhancedUiProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnablePriceProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/EnablePriceProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\EnableSelectAllProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/EnableSelectAllProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ErrorMessageProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ErrorMessageProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputNameProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputNameProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputCustomLabelProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputCustomLabelProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputDefaultValueProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputDefaultValueProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputIdProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputIdProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputIsHiddenProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputIsHiddenProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputKeyProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputKeyProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputLabelProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputLabelProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputNameProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputNameProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputProperty\\InputPlaceholderProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputProperty/InputPlaceholderProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputTypeProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputTypeProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\InputsProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/InputsProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\IsRequiredProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/IsRequiredProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\LabelPlacementProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/LabelPlacementProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\LabelProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/LabelProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ListChoiceProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ListChoiceProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\MaxLengthProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/MaxLengthProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\NameInputProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/NameInputProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\NoDuplicatesProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/NoDuplicatesProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\PageNumberProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/PageNumberProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\PasswordInputProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/PasswordInputProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\PlaceholderProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/PlaceholderProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\ProductFieldProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/ProductFieldProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\RadioChoiceProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/RadioChoiceProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\SizeProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/SizeProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\SubLabelPlacementProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/SubLabelPlacementProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldProperty\\VisibilityProperty' => __DIR__ . '/../..' . '/src/Types/Field/FieldProperty/VisibilityProperty.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\AddressFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/AddressFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ChainedSelectFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/ChainedSelectFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\CheckboxFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/CheckboxFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\CheckboxInputValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/CheckboxInputValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ConsentFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/ConsentFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\DateFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/DateFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\EmailFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/EmailFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\FileUploadFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/FileUploadFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\HiddenFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/HiddenFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ListFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/ListFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\ListInputValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/ListInputValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\MultiSelectFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/MultiSelectFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\NameFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/NameFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\NumberFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/NumberFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PhoneFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PhoneFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostCategoryFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PostCategoryFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostContentFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PostContentFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostCustomFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PostCustomFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostExcerptFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PostExcerptFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostTagsFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PostTagsFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\PostTitleFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/PostTitleFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\RadioFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/RadioFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\SelectFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/SelectFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\SignatureFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/SignatureFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\TextAreaFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/TextAreaFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\TextFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/TextFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\TimeFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/TimeFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FieldValue\\WebsiteFieldValue' => __DIR__ . '/../..' . '/src/Types/Field/FieldValue/WebsiteFieldValue.php',
        'WPGraphQLGravityForms\\Types\\Field\\FileUploadField' => __DIR__ . '/../..' . '/src/Types/Field/FileUploadField.php',
        'WPGraphQLGravityForms\\Types\\Field\\HiddenField' => __DIR__ . '/../..' . '/src/Types/Field/HiddenField.php',
        'WPGraphQLGravityForms\\Types\\Field\\HtmlField' => __DIR__ . '/../..' . '/src/Types/Field/HtmlField.php',
        'WPGraphQLGravityForms\\Types\\Field\\ListField' => __DIR__ . '/../..' . '/src/Types/Field/ListField.php',
        'WPGraphQLGravityForms\\Types\\Field\\MultiSelectField' => __DIR__ . '/../..' . '/src/Types/Field/MultiSelectField.php',
        'WPGraphQLGravityForms\\Types\\Field\\NameField' => __DIR__ . '/../..' . '/src/Types/Field/NameField.php',
        'WPGraphQLGravityForms\\Types\\Field\\NumberField' => __DIR__ . '/../..' . '/src/Types/Field/NumberField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PageField' => __DIR__ . '/../..' . '/src/Types/Field/PageField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PasswordField' => __DIR__ . '/../..' . '/src/Types/Field/PasswordField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PhoneField' => __DIR__ . '/../..' . '/src/Types/Field/PhoneField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostCategoryField' => __DIR__ . '/../..' . '/src/Types/Field/PostCategoryField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostContentField' => __DIR__ . '/../..' . '/src/Types/Field/PostContentField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostCustomField' => __DIR__ . '/../..' . '/src/Types/Field/PostCustomField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostExcerptField' => __DIR__ . '/../..' . '/src/Types/Field/PostExcerptField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostImageField' => __DIR__ . '/../..' . '/src/Types/Field/PostImageField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostTagsField' => __DIR__ . '/../..' . '/src/Types/Field/PostTagsField.php',
        'WPGraphQLGravityForms\\Types\\Field\\PostTitleField' => __DIR__ . '/../..' . '/src/Types/Field/PostTitleField.php',
        'WPGraphQLGravityForms\\Types\\Field\\RadioField' => __DIR__ . '/../..' . '/src/Types/Field/RadioField.php',
        'WPGraphQLGravityForms\\Types\\Field\\SectionField' => __DIR__ . '/../..' . '/src/Types/Field/SectionField.php',
        'WPGraphQLGravityForms\\Types\\Field\\SelectField' => __DIR__ . '/../..' . '/src/Types/Field/SelectField.php',
        'WPGraphQLGravityForms\\Types\\Field\\SignatureField' => __DIR__ . '/../..' . '/src/Types/Field/SignatureField.php',
        'WPGraphQLGravityForms\\Types\\Field\\TextAreaField' => __DIR__ . '/../..' . '/src/Types/Field/TextAreaField.php',
        'WPGraphQLGravityForms\\Types\\Field\\TextField' => __DIR__ . '/../..' . '/src/Types/Field/TextField.php',
        'WPGraphQLGravityForms\\Types\\Field\\TimeField' => __DIR__ . '/../..' . '/src/Types/Field/TimeField.php',
        'WPGraphQLGravityForms\\Types\\Field\\WebsiteField' => __DIR__ . '/../..' . '/src/Types/Field/WebsiteField.php',
        'WPGraphQLGravityForms\\Types\\Form\\Form' => __DIR__ . '/../..' . '/src/Types/Form/Form.php',
        'WPGraphQLGravityForms\\Types\\Form\\FormConfirmation' => __DIR__ . '/../..' . '/src/Types/Form/FormConfirmation.php',
        'WPGraphQLGravityForms\\Types\\Form\\FormNotification' => __DIR__ . '/../..' . '/src/Types/Form/FormNotification.php',
        'WPGraphQLGravityForms\\Types\\Form\\FormNotificationRouting' => __DIR__ . '/../..' . '/src/Types/Form/FormNotificationRouting.php',
        'WPGraphQLGravityForms\\Types\\Form\\FormPagination' => __DIR__ . '/../..' . '/src/Types/Form/FormPagination.php',
        'WPGraphQLGravityForms\\Types\\Form\\SaveAndContinue' => __DIR__ . '/../..' . '/src/Types/Form/SaveAndContinue.php',
        'WPGraphQLGravityForms\\Types\\GraphQLInterface\\FieldInterface' => __DIR__ . '/../..' . '/src/Types/GraphQLInterface/FieldInterface.php',
        'WPGraphQLGravityForms\\Types\\Input\\AddressInput' => __DIR__ . '/../..' . '/src/Types/Input/AddressInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\ChainedSelectInput' => __DIR__ . '/../..' . '/src/Types/Input/ChainedSelectInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\CheckboxInput' => __DIR__ . '/../..' . '/src/Types/Input/CheckboxInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\EntriesDateFiltersInput' => __DIR__ . '/../..' . '/src/Types/Input/EntriesDateFiltersInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\EntriesFieldFiltersInput' => __DIR__ . '/../..' . '/src/Types/Input/EntriesFieldFiltersInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\EntriesSortingInput' => __DIR__ . '/../..' . '/src/Types/Input/EntriesSortingInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\ListInput' => __DIR__ . '/../..' . '/src/Types/Input/ListInput.php',
        'WPGraphQLGravityForms\\Types\\Input\\NameInput' => __DIR__ . '/../..' . '/src/Types/Input/NameInput.php',
        'WPGraphQLGravityForms\\Types\\Union\\ObjectFieldValueUnion' => __DIR__ . '/../..' . '/src/Types/Union/ObjectFieldValueUnion.php',
        'WPGraphQLGravityForms\\Utils\\Utils' => __DIR__ . '/../..' . '/src/Utils/Utils.php',
        'WPGraphQLGravityForms\\WPGraphQLGravityForms' => __DIR__ . '/../..' . '/src/WPGraphQLGravityForms.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc0769f616b013655fd745e5ced376c8f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc0769f616b013655fd745e5ced376c8f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc0769f616b013655fd745e5ced376c8f::$classMap;

        }, null, ClassLoader::class);
    }
}
