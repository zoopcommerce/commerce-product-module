<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\PriceInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Price implements PriceInterface
{
    /**
     * @ODM\Float
     */
    protected $full;

    /**
     * @ODM\Float
     */
    protected $sale;

    /**
     * @ODM\Float
     */
    protected $wholesale;

    /**
     * Dynamic field based on the sale/promotion price
     * @var boolean
     */
    protected $saleActive;

    /**
     * {@inheritDoc}
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * {@inheritDoc}
     */
    public function setFull($full)
    {
        $this->full = (float) $full;
    }

    /**
     * {@inheritDoc}
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * {@inheritDoc}
     */
    public function setSale($sale)
    {
        $this->sale = (float) $sale;
    }

    /**
     * {@inheritDoc}
     */
    public function getWholesale()
    {
        return $this->wholesale;
    }

    /**
     * {@inheritDoc}
     */
    public function setWholesale($wholesale)
    {
        $this->wholesale = $wholesale;
    }

    /**
     * {@inheritDoc}
     */
    public function isSaleActive()
    {
        return ($this->sale > 0);
    }
}
