<?php

namespace Zoop\Product\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class PriceAdjustment
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
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @return float
     */
    public function getAdjustment()
    {
        return $this->adjustment;
    }

    /**
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     *
     * @param float $adjustment
     */
    public function setAdjustment($adjustment)
    {
        $this->adjustment = (float) $adjustment;
    }
}
