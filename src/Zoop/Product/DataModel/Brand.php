<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Store\DataModel\Store;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Brand extends AbstractBrand
{
    /**
     * Array. Stores that this product is part of.
     * The Zones annotation means this field is used by the Zones filter so
     * only products from the active store are available.
     *
     * @ODM\Collection
     * @Shard\Zones
     * @Shard\Validator\Required
     */
    protected $stores;

    public function __construct()
    {
        $this->stores = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     *
     * @param ArrayCollection $stores
     */
    public function setStores(ArrayCollection $stores)
    {
        $this->stores = $stores;
    }

    /**
     * @param Store $store
     */
    public function addStore(Store $store)
    {
        $this->stores->add($store->getId());
    }
}
