<?php

namespace Zoop\Product\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="read"),
 *     @Shard\Permission\Basic(roles="store-manager", allow="*")
 * })
 */
class Price
{
    /**
     *
     * @ODM\Float
     */
    protected $full;

    /**
     *
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
     *
     * @return float
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     *
     * @param float $full
     */
    public function setFull($full)
    {
        $this->full = (float) $full;
    }

    /**
     *
     * @return float
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     *
     * @param float $sale
     */
    public function setSale($sale)
    {
        $this->sale = (float) $sale;
    }

    /**
     *
     * @return float
     */
    public function getWholesale()
    {
        return $this->wholesale;
    }

    /**
     *
     * @param float $wholesale
     */
    public function setWholesale($wholesale)
    {
        $this->wholesale = $wholesale;
    }

    /**
     *
     * @return boolean
     */
    public function getSaleActive()
    {
        return $this->saleActive;
    }

    /**
     *
     * @param boolean $saleActive
     */
    public function setSaleActive($saleActive)
    {
        $this->saleActive = (boolean) $saleActive;
    }
}
