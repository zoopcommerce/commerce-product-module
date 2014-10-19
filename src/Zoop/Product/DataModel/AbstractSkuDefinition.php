<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\PriceAdjustmentInterface;
use Zoop\Product\DataModel\Option\OptionInterface;
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
     * @ODM\Id(strategy="NONE")
     */
    protected $id;

    /**
     * @ODM\Hash
     */
    protected $optionMap;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Product\DataModel\PriceAdjustment")
     */
    protected $priceAdjustment;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionMap()
    {
        return $this->optionMap;
    }

    /**
     * {@inheritDoc}
     */
    public function setOptionMap(array $optionMap = [])
    {
        $this->optionMap = $optionMap;
    }

    /**
     * {@inheritDoc}
     */
    public function addOptionMap(OptionInterface $optionMap)
    {
        $this->optionMap[$optionMap->getName()] = $optionMap;
    }

    /**
     * {@inheritDoc}
     */
    public function getPriceAdjustment()
    {
        return $this->priceAdjustment;
    }

    /**
     * {@inheritDoc}
     */
    public function setPriceAdjustment(PriceAdjustmentInterface $priceAdjustment)
    {
        $this->priceAdjustment = $priceAdjustment;
    }
}
