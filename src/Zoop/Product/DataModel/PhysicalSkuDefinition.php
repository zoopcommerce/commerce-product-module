<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\PhysicalSkuDefinitionInterface;
use Zoop\Product\DataModel\SkuDefinitionInterface;
use Zoop\Product\DataModel\ShippingRateInterface;
use Zoop\Product\DataModel\DimensionsInterface;
use Zoop\Product\DataModel\EmbeddedSupplierInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class PhysicalSkuDefinition extends AbstractSkuDefinition implements
    PhysicalSkuDefinitionInterface,
    SkuDefinitionInterface
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

    /**
     * {@inheritDoc}
     */
    public function getShippingRates()
    {
        if (!isset($this->shippingRates)) {
            $this->shippingRates = new ArrayCollection;
        }
        return $this->shippingRates;
    }

    /**
     * {@inheritDoc}
     */
    public function setShippingRates($shippingRates)
    {
        if (is_array($this->shippingRates)) {
            $this->shippingRates = new ArrayCollection($shippingRates);
        } else {
            $this->shippingRates = $shippingRates;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addShippingRate(ShippingRateInterface $shippingRate)
    {
        $this->getShippingRates()->add($shippingRate);
    }

    /**
     * {@inheritDoc}
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * {@inheritDoc}
     */
    public function setDimensions(DimensionsInterface $dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     * {@inheritDoc}
     */
    public function getSuppliers()
    {
        if (!isset($this->suppliers)) {
            $this->suppliers = new ArrayCollection;
        }
        return $this->suppliers;
    }

    /**
     * {@inheritDoc}
     */
    public function setSuppliers($suppliers)
    {
        if (is_array($this->$suppliers)) {
            $this->suppliers = new ArrayCollection($suppliers);
        } else {
            $this->suppliers = $suppliers;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addSupplier(EmbeddedSupplierInterface $supplier)
    {
        $this->getSuppliers()->add($supplier);
    }

    /**
     * {@inheritDoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * {@inheritDoc}
     */
    public function setQuantity($quantity)
    {
        $this->quantity = (integer) $quantity;
    }
}
