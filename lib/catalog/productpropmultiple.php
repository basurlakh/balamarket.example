<?php
/**
 * Created by PhpStorm.
 * User: zhelonkinanton@gmail.com
 * Date: 07.07.2015
 * Time: 22:59
 */

namespace Balamarket\Example\Catalog;


use Balamarket\Orm\Entity\IblockPropMultiple;

class ProductPropMultipleTable extends IblockPropMultiple
{
    public static function getIblockId()
    {
        return ProductTable::getIblockId();
    }
}
