<?php

namespace Zoop\Product\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
abstract class AbstractAttributeSet
{
    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }
}
