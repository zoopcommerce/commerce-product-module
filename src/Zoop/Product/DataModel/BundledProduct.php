<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\PriceAdjustment;
use Zoop\Product\DataModel\SingleProduct;
use Doctrine\Common\Collections\ArrayCollection;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class BundledProduct
{
    /**
     * @ODM\ReferenceMany(targetDocument="Zoop\Product\DataModel\SingleProduct", simple="true")
     * @Shard\Serializer\Eager
     */
    protected $products;

    /**
     *
     * @ODM\Boolean
     */
    protected $required;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Product\DataModel\PriceAdjustment")
     */
    protected $priceAdjustment;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     *
     * @param ArrayCollection $products
     */
    public function setProducts(SingleProduct $product)
    {
        $this->getProducts()->add($product);
    }

    public function addProduct(ArrayCollection $products)
    {
        $this->products = $products;
    }
    /**
     *
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     *
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = (boolean) $required;
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
}
