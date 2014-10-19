<?php

namespace Zoop\Product\DataModel\Attribute;

use Zoop\Product\DataModel\Attribute\NumberAttributeInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Number extends AbstractAttribute implements NumberAttributeInterface
{
    /**
     *
     * @ODM\Float
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
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }
}
