<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\ShippingRateInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class ShippingRate implements ShippingRateInterface
{
    /**
     *
     * @ODM\String
     * @Shard\Serializer\Eager
     */
    protected $country;

    /**
     *
     * @ODM\Float
     */
    protected $singleRate;

    /**
     *
     * @ODM\Float
     */
    protected $additionalRate;

    /**
     * {@inheritDoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritDoc}
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * {@inheritDoc}
     */
    public function getSingleRate()
    {
        return $this->singleRate;
    }

    /**
     * {@inheritDoc}
     */
    public function setSingleRate($singleRate)
    {
        $this->singleRate = (float) $singleRate;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdditionalRate()
    {
        return $this->additionalRate;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdditionalRate($additionalRate)
    {
        $this->additionalRate = (float) $additionalRate;
    }
}
