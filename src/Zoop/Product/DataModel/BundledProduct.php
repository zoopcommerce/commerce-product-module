<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\BundledProductInterface;
use Zoop\Product\DataModel\PriceAdjustmentInterface;
use Zoop\Product\DataModel\SingleProductInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class BundledProduct implements BundledProductInterface
{
    /**
     * @ODM\ReferenceMany(targetDocument="\Zoop\Product\DataModel\SingleProduct", simple="true")
     * @Shard\Serializer\Eager
     */
    protected $products;

    /**
     * @ODM\Boolean
     */
    protected $isRequired;

    /**
     * @ODM\EmbedOne(targetDocument="\Zoop\Product\DataModel\PriceAdjustment")
     */
    protected $priceAdjustment;

    /**
     * {@inheritDoc}
     */
    public function getProducts()
    {
        if (!isset($this->products)) {
            $this->products = new ArrayCollection;
        }
        return $this->products;
    }

    /**
     * {@inheritDoc}
     */
    public function setProducts($products)
    {
        if (is_array($this->products)) {
            $this->products = new ArrayCollection($products);
        } else {
            $this->products = $products;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addProduct(SingleProductInterface $product)
    {
        $this->getProducts()->add($product);
    }

    /**
     * {@inheritDoc}
     */
    public function isRequired()
    {
        return $this->isRequired;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = (boolean) $isRequired;
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
