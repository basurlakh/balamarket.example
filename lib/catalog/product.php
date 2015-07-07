<?php
/**
 * Created by PhpStorm.
 * User: zhelonkinanton@gmail.com
 * Date: 07.07.2015
 * Time: 22:56
 */

namespace Balamarket\Example\Catalog;

use Balamarket\Orm\Entity\IblockElement;

class ProductTable extends IblockElement
{
    public static function getIblockCode()
    {
        return "clothes";
    }
}