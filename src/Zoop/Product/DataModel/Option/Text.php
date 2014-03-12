<?php

namespace Zoop\Product\DataModel\Option;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class Text extends AbstractOption
{
    /**
     *
     * @ODM\Boolean
     */
    protected $isSkuSelector = false;
}
