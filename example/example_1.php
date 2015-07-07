<?php
/**
 * Created by PhpStorm.
 * User: basurlakh@gmail.com
 * Date: 07.07.2015
 * Time: 23:02
 */

use Balamarket\Example\Catalog\ProductSectionTable;
use Balamarket\Example\Catalog\ProductTable;
use Bitrix\Main\DB\SqlExpression;
use Bitrix\Main\Loader;

Loader::includeModule("balamarket.example");

/**
 * Примеры выборок.
 * Данные примеры приводятся в контексте "Современный интернет-магазин (bitrix.eshop)"
 * над инфоблоком с символьным кодод "clothes" название "Одежда"
 *
 * Перед выборкой убедитесь что свойства инфоблока хранятся в отдельной таблице! Иначе будет ошибка
 * что таблица b_iblock_element_prop_s#ID# не найдена
 *
 * @link http://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&LESSON_ID=2723
 */

// Получим список товаров
$arProducts = ProductTable::getList(array(
    "select" => array(
        "ID",
        "NAME"
    ),
    "filter" => array(
        "=ACTIVE" => "Y"
    ),
    "limit" => 10
))->fetchAll();

echo"<pre>";print_r($arProducts);echo"</pre>";


// Получим товары и значения свойств
$arProducts = ProductTable::getList(array(
    "select" => array(
        "ID",
        "NAME",
        "ARTNUMBER" => "PROPERTY_SIMPLE.ARTNUMBER",
        "MANUFACTURER" => "PROPERTY_SIMPLE.MANUFACTURER", // Значение свойства "MANUFACTURER"
        "SECTION_NAME" => "SECTION.NAME" // Название раздела
    ),
    "filter" => array(
        "=ACTIVE" => "Y",
        "!=PROPERTY_SIMPLE.ARTNUMBER" => false // свойство "ARTNUMBER" должно быть не пустым
    ),
    "limit" => 10
))->fetchAll();

echo"<pre>";print_r($arProducts);echo"</pre>";

// Выборка множественных свойств
$arProducts = ProductTable::getList(array(
    "select" => array(
        "ID",
        "NAME",
        "ARTNUMBER" => "PROPERTY_SIMPLE.ARTNUMBER",
        "MATERIALS", // Значения множественного свойства "MATERIAL"
        "MANUFACTURER" => "PROPERTY_SIMPLE.MANUFACTURER", // Значение свойства "MANUFACTURER"
    ),
    "runtime" => array(
        "MATERIALS" => array(
            "data_type" => "string",
            "expression" => array(
                "GROUP_CONCAT(DISTINCT %s)",
                "PROPERTY_MULTIPLE_MATERIAL.VALUE"
            )
        )
    ),
    "filter" => array(
        "=ACTIVE" => "Y",
        "!=PROPERTY_SIMPLE.ARTNUMBER" => false // свойство "ARTNUMBER" должно быть не пустым
    ),
    "group" => array("ID"),
    "limit" => 10
))->fetchAll();

echo"<pre>";print_r($arProducts);echo"</pre>";

// Выборка раделов
$arProductSections = ProductSectionTable::getList(array(
    "select" => array(
        "NAME",
        "DESCRIPTION"
    ),
    "filter" => array(
        "=ACTIVE" => "Y",
        "=GLOBAL_ACTIVE" => "Y"
    ),
    "limit" => 10
))->fetchAll();

echo"<pre>";print_r($arProductSections);echo"</pre>";

// Выборка всех дочерних разделов в виде дерева раздела "Обувь"
$arProductSections = ProductSectionTable::getList(array(
    "select" => array(
        "SECTION_ID" => "CHILD_SECTION.ID",
        "SECTION_NAME" => "CHILD_SECTION.NAME",
        "SECTION_DESCRIPTION" => "CHILD_SECTION.DESCRIPTION",
    ),
    "runtime" => array(
        "CHILD_SECTION" => array(
            "data_type" => '\Balamarket\Example\Catalog\ProductSectionTable',
            "reference" => array(
                "<=this.LEFT_MARGIN" => "ref.LEFT_MARGIN",
                ">this.RIGHT_MARGIN" => "ref.RIGHT_MARGIN",
                "ref.IBLOCK_ID" => new SqlExpression('?i', ProductSectionTable::getIblockId()) // Фильтрация по id инфоблока
            )
        )
    ),
    "filter" => array(
        "=ACTIVE" => "Y",
        "=GLOBAL_ACTIVE" => "Y",
        "=CODE" => "shoes" // символьный код раздела "Обувь"
    ),
    "order" => array("CHILD_SECTION.LEFT_MARGIN" => "ASC")
))->fetchAll();

echo"<pre>";print_r($arProductSections);echo"</pre>";
