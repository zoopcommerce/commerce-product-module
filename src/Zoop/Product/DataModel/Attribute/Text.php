<?php

namespace Zoop\Product\DataModel\Attribute;

use Zoop\Product\DataModel\Attribute\TextAttributeInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Text extends AbstractAttribute implements TextAttributeInterface
{
    /**
     *
     * @ODM\String
     */
    protected $value;


    /**
     *
     * @ODM\String
     */
    protected $unit;

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
