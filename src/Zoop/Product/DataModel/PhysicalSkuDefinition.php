<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\ShippingRate;
use Zoop\Product\DataModel\Dimensions;
use Zoop\Product\DataModel\EmbeddedSupplier;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class PhysicalSkuDefinition extends AbstractSkuDefinition
{
    /**
     *
     * @ODM\EmbedMany(targetDocument="Zoop\Product\DataModel\ShippingRate")
     */
    protected $shippingRates;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Product\DataModel\Dimensions")
     */
    protected $dimensions;

    /**
     * @ODM\EmbedMany(targetDocument="Zoop\Product\DataModel\EmbeddedSupplier")
     */
    protected $suppliers;

    /**
     *
     * @ODM\Int
     */
    protected $quantity = 0;

    public function __construct()
    {
        parent::__construct();
        $this->suppliers = new ArrayCollection();
        $this->shippingRates = new ArrayCollection();
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getShippingRates()
    {
        return $this->shippingRates;
    }

    /**
     *
     * @param ArrayCollection $shippingRates
     */
    public function setShippingRates(ArrayCollection $shippingRates)
    {
        $this->shippingRates = $shippingRates;
    }

    /**
     *
     * @param ShippingRate $shippingRate
     */
    public function addShippingRate(ShippingRate $shippingRate)
    {
        $this->getShippingRates()->add($shippingRate);
    }

    /**
     *
     * @return Dimensions
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     *
     * @param Dimensions $dimensions
     */
    public function setDimensions(Dimensions $dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }

    /**
     *
     * @param ArrayCollection $suppliers
     */
    public function setSuppliers(ArrayCollection $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    /**
     *
     * @param EmbeddedSupplier $supplier
     */
    public function addSupplier(EmbeddedSupplier $supplier)
    {
        $this->getSuppliers()->add($supplier);
    }

    /**
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = (integer) $quantity;
    }
}
