<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\BundleInterface;
use Zoop\Product\DataModel\BundledProductInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Bundle extends AbstractProduct implements BundleInterface
{
    /**
     * @ODM\EmbedMany(targetDocument="\Zoop\Product\DataModel\BundledProduct")
     */
    protected $bundledProducts;

    /**
     * {@inheritDoc}
     */
    public function getBundledProducts()
    {
        if (!isset($this->bundledProducts)) {
            $this->bundledProducts = new ArrayCollection;
        }
        return $this->bundledProducts;
    }

    /**
     * {@inheritDoc}
     */
    public function setBundledProducts($bundledProducts)
    {
        if (is_array($this->bundledProducts)) {
            $this->bundledProducts = new ArrayCollection($bundledProducts);
        } else {
            $this->bundledProducts = $bundledProducts;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addBundledProduct(BundledProductInterface $product)
    {
        $this->getBundledProducts()->add($product);
    }
}
