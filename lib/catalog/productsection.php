<?php
/**
 * Created by PhpStorm.
 * User: basurlakh@gmail.com
 * Date: 07.07.2015
 * Time: 23:00
 */

namespace Balamarket\Example\Catalog;


use Balamarket\Orm\Entity\IblockSection;

class ProductSectionTable extends IblockSection
{
    public static function getIblockId()
    {
        return ProductTable::getIblockId();
    }
}
