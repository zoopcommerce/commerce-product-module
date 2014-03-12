<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\PriceAdjustment;
use Zoop\Product\DataModel\Option\AbstractOption;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
abstract class AbstractSkuDefinition
{
    /**
     * @ODM\Int
     * @ODM\Index(unique = true)
     */
    protected $legacyId;

    /**
     * @ODM\Hash
     */
    protected $optionMap;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Product\DataModel\PriceAdjustment")
     */
    protected $priceAdjustment;

    /**
     * @return array
     */
    public function getOptionMap()
    {
        return $this->optionMap;
    }

    /**
     *
     * @param array $optionMap
     */
    public function setOptionMap(array $optionMap = [])
    {
        $this->optionMap = $optionMap;
    }

    /**
     *
     * @param AbstractOption $optionMap
     */
    public function addOptionMap(AbstractOption $optionMap)
    {
        $this->optionMap[$optionMap->getName()] = $optionMap;
    }

    /**
     *
     * @return PriceAdjustment
     */
    public function getPriceAdjustment()
    {
        return $this->priceAdjustment;
    }

    /**
     *
     * @param PriceAdjustment $priceAdjustment
     */
    public function setPriceAdjustment(PriceAdjustment $priceAdjustment)
    {
        $this->priceAdjustment = $priceAdjustment;
    }

    /**
     *
     * @return integer
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     *
     * @param integer $legacyId
     */
    public function setLegacyId($legacyId)
    {
        $this->legacyId = (integer) $legacyId;
    }
}
