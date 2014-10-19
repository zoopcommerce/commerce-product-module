<?php

namespace Zoop\Product\DataModel;

use Zoop\Store\DataModel\FilterStoreInterface;
use Zoop\Store\DataModel\StoresTrait;
use Zoop\Product\DataModel\BrandInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Brand extends AbstractBrand implements
    BrandInterface,
    FilterStoreInterface
{
    use StoresTrait;
}
