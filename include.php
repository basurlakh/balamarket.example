<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;

\CModule::AddAutoloadClasses("balamarket.example",array());
Loader::includeModule("balamarket.orm");

