<?php

namespace Zoop\Product\DataModel\Option;

use Zoop\Product\DataModel\Option\TextOptionInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Text extends AbstractOption implements TextOptionInterface
{
    /**
     *
     * @ODM\Boolean
     */
    protected $isSkuSelector = false;
}
