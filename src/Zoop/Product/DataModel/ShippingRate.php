<?php

namespace Zoop\Product\DataModel;

use Zoop\Common\DataModel\Country;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class ShippingRate
{
    /**
     *
     * @ODM\ReferenceOne(targetDocument="Zoop\Common\DataModel\Country", simple="true")
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
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    /**
     *
     * @return float
     */
    public function getSingleRate()
    {
        return $this->singleRate;
    }

    /**
     *
     * @param float $singleRate
     */
    public function setSingleRate($singleRate)
    {
        $this->singleRate = (float) $singleRate;
    }

    /**
     *
     * @return float
     */
    public function getAdditionalRate()
    {
        return $this->additionalRate;
    }

    /**
     *
     * @param float $additionalRate
     */
    public function setAdditionalRate($additionalRate)
    {
        $this->additionalRate = (float) $additionalRate;
    }
}
