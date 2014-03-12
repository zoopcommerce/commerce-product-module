<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\AbstractProduct;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Bundle extends AbstractProduct
{
    /**
     * @ODM\EmbedMany(targetDocument="BundledProduct")
     */
    protected $bundledProducts;

    /**
     * @return ArrayCollection
     */
    public function getBundledProducts()
    {
        return $this->bundledProducts;
    }

    /**
     * @param ArrayCollection $bundledProducts
     */
    public function setBundledProducts(ArrayCollection $bundledProducts)
    {
        $this->bundledProducts = $bundledProducts;
    }

    /**
     * @param AbstractProduct $product
     */
    public function addBundledProduct(AbstractProduct $product)
    {
        $this->getBundledProducts()->add($product);
    }
}
