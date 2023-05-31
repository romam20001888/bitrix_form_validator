
\Bitrix\Main\EventManager::getInstance()->addEventHandlerCompatible('form', 'onFormValidatorBuildList',
    array('AcroWeb\FormValidatorStringEmpty', 'getDescription')
);
\Bitrix\Main\Loader::registerAutoLoadClasses(null,array(
   'AcroWeb\FormValidatorStringEmpty' => '/local/php_interface/user_class/form_validator.php',
));
