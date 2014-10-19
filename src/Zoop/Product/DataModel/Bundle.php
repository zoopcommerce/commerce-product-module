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
 *     @Shard\Permission\Basic(roles="*", allow="read"),
 *     @Shard\Permission\Basic(roles="zoop::admin", allow={"create", "update::*", "delete"}),
 *     @Shard\Permission\Basic(roles="partner::admin", allow={"create", "update::*", "delete"}),
 *     @Shard\Permission\Basic(roles="company::admin", allow={"create", "update::*", "delete"}),
 *     @Shard\Permission\Basic(roles="store::admin", allow={"update::*"}),
 *     @Shard\Permission\Transition(roles={"zoop::admin", "partner::admin", "company::admin", "store::admin"})
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
