<?php
/**
 * Created by acroweb
 * User: Roman Rogankov
 * Date: 31.05.2023
 */
 
namespace AcroWeb;
 
use \Bitrix\Main\EventManager;
 
class FormValidatorStringEmpty
{
    public static function getDescription()
    {
        return array(
            'NAME' => 'iframe_text', // идентификатор
            'DESCRIPTION' => 'Проверка на iframe', // наименование
            'TYPES' => array('text',"textarea"), // типы полей
            'SETTINGS' => array(__CLASS__, 'getSettings'), // метод, возвращающий массив настроек
            'CONVERT_TO_DB' => array(__CLASS__, 'toDB'), // метод, конвертирующий массив настроек в строку
            'CONVERT_FROM_DB' => array(__CLASS__, 'fromDB'), // метод, конвертирующий строку настроек в массив
            'HANDLER' => array(__CLASS__, 'doValidate') // валидатор
        );
    }
 
    public static function getSettings()
    {
        return array();
    }
 
    public static function toDB($arParams)
    {
        return serialize($arParams);
    }
 
    public static function fromDB($strParams)
    { 
        return unserialize($strParams);
    }
 
    public static function doValidate($arParams, $arQuestion, $arAnswers, $arValues)
    {
        global $APPLICATION;
 
        foreach ($arValues as $value) 
        {
            preg_match('|<iframe[^>]+>(.*)</iframe>|U', $value, $iframe);
            
            if (!empty($iframe)) 
            {
                $APPLICATION->ThrowException('Запрешённый тег Iframe.');
                return false;
            }
 
        }

        return true;
    }
}