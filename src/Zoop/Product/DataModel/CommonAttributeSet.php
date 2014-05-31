<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\Attribute\AbstractAttribute;
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
class CommonAttributeSet extends AbstractAttributeSet
{
    /**
     * @ODM\EmbedMany(
     *     targetDocument="Zoop\Product\DataModel\Attribute\AbstractAttribute",
     *     discriminatorField="type",
     *     discriminatorMap={
     *         "dropdown" = "Zoop\Product\DataModel\Option\Dropdown",
     *         "file"     = "Zoop\Product\DataModel\Option\File",
     *         "radio"    = "Zoop\Product\DataModel\Option\Radio",
     *         "text"     = "Zoop\Product\DataModel\Option\Text"
     *     }
     * )
     */
    protected $attributes;

    /**
     * Array. Stores that this product is part of.
     * The Zones annotation means this field is used by the Zones filter so
     * only products from the active store are available.
     *
     * @ODM\Collection
     * @Shard\Zones
     * @Shard\Validator\Required
     */
    protected $store;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->stores = new ArrayCollection();
    }

    /**
     *
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
     *
     * @param Store $store
     */
    public function addStore(Store $store)
    {
        $this->getStores()->add($store->getId());
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     *
     * @param ArrayCollection $attributes
     */
    public function setAttributes(ArrayCollection $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     *
     * @param AbstractAttribute $attribute
     */
    public function addAttribute(AbstractAttribute $attribute)
    {
        $this->getAttributes()->add($attribute);
    }
}
