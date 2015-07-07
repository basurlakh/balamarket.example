<?php
/**
 * Created by PhpStorm.
 * User: basurlakh@gmail.com
 * Date: 07.07.2015
 * Time: 22:58
 */

namespace Balamarket\Example\Catalog;


use Balamarket\Orm\Entity\IblockPropSimple;

class ProductPropSimpleTable extends IblockPropSimple
{
    public static function getIblockId()
    {
        return ProductTable::getIblockId();
    }
}
