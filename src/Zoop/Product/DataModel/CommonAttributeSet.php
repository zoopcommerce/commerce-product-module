<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\Attribute\AttributeInterface;
use Zoop\Product\DataModel\CommonAttributeSetInterface;
use Zoop\Product\DataModel\AttributeSetInterface;
use Zoop\Store\DataModel\FilterStoreInterface;
use Zoop\Store\DataModel\StoresTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class CommonAttributeSet extends AbstractAttributeSet implements
    AttributeSetInterface,
    CommonAttributeSetInterface,
    FilterStoreInterface
{
    use StoresTrait;

    /**
     * @ODM\EmbedMany(
     *     targetDocument="Zoop\Product\DataModel\Attribute\AbstractAttribute",
     *     discriminatorField="type",
     *     discriminatorMap={
     *         "Dropdown" = "Zoop\Product\DataModel\Option\Dropdown",
     *         "File"     = "Zoop\Product\DataModel\Option\File",
     *         "Radio"    = "Zoop\Product\DataModel\Option\Radio",
     *         "Text"     = "Zoop\Product\DataModel\Option\Text"
     *     }
     * )
     */
    protected $attributes;

    /**
     * {@inheritDoc}
     */
    public function getAttributes()
    {
        if (!isset($this->attributes)) {
            $this->attributes = new ArrayCollection;
        }
        return $this->attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function setAttributes($attributes)
    {
        if (is_array($this->attributes)) {
            $this->attributes = new ArrayCollection($attributes);
        } else {
            $this->attributes = $attributes;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addAttribute(AttributeInterface $attribute)
    {
        $this->getAttributes()->add($attribute);
    }
}
