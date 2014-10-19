<?php

namespace Zoop\Product\DataModel;


use Zoop\Product\DataModel\CustomAttributeSetInterface;
use Zoop\Product\DataModel\AttributeSetInterface;
use Zoop\Store\DataModel\FilterStoreInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class CustomAttributeSet extends AbstractAttributeSet implements
    AttributeSetInterface,
    CustomAttributeSetInterface,
    FilterStoreInterface
{
    use StoresTrait;
}
