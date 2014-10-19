<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\PriceAdjustmentInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class PriceAdjustment implements PriceAdjustmentInterface
{
    /**
     * @ODM\String
     * @Shard\State({
     *     "fixed",
     *     "percentage"
     * })
     */
    protected $type;

    /**
     *
     * @ODM\Float
     */
    protected $adjustment;

    /**
     * {@inheritDoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdjustment()
    {
        return $this->adjustment;
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdjustment($adjustment)
    {
        $this->adjustment = (float) $adjustment;
    }
}
