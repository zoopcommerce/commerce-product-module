<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\SingleProductInterface;
use Zoop\Product\DataModel\Option\OptionInterface;
use Zoop\Product\DataModel\EmbeddedBrandInterface;
use Zoop\Product\DataModel\SkuDefinitionInterface;
use Zoop\Product\DataModel\Attribute\AttributeInterface;
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
class SingleProduct extends AbstractProduct implements
    SingleProductInterface
{
    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Product\DataModel\EmbeddedBrand")
     */
    protected $brand;

    /**
     * @ODM\EmbedMany(
     *     strategy = "set",
     *     discriminatorField = "type",
     *     discriminatorMap = {
     *         "Dropdown"       = "Zoop\Product\DataModel\Option\Dropdown",
     *         "FileUpload"     = "Zoop\Product\DataModel\Option\FileUpload",
     *         "Radio"          = "Zoop\Product\DataModel\Option\Radio",
     *         "Text"           = "Zoop\Product\DataModel\Option\Text",
     *         "Hidden"         = "Zoop\Product\DataModel\Option\Hidden"
     *     }
     * )
     */
    protected $options;

    /**
     * @ODM\EmbedMany(
     *     strategy = "set",
     *     discriminatorField = "type",
     *     discriminatorMap = {
     *         "File"   = "Zoop\Product\DataModel\Attribute\File",
     *         "Number" = "Zoop\Product\DataModel\Attribute\Number",
     *         "Text"   = "Zoop\Product\DataModel\Attribute\Text"
     *     }
     * )
     */
    protected $attributes;

    /**
     *
     * @ODM\Boolean
     */
    protected $isNotForIndividualSale = false;

    /**
     * @ODM\EmbedMany(
     *     strategy = "set",
     *     discriminatorField = "type",
     *     discriminatorMap = {
     *         "Physical"  = "Zoop\Product\DataModel\PhysicalSkuDefinition",
     *         "Digital"   = "Zoop\Product\DataModel\DigitalSkuDefinition"
     *     }
     * )
     */
    protected $skuDefinitions;

    /**
     * {@inheritDoc}
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * {@inheritDoc}
     */
    public function setBrand(EmbeddedBrandInterface $brand)
    {
        $this->brand = $brand;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        if (!isset($this->options)) {
            $this->options = new ArrayCollection;
        }
        return $this->options;
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions($options)
    {
        if (is_array($this->options)) {
            $this->options = new ArrayCollection($options);
        } else {
            $this->options = $options;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addOption(OptionInterface $option)
    {
        $this->getOptions()->add($option);
    }

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
        $this->attributes = $attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function addAttribute(AttributeInterface $attribute)
    {
        $this->getAttributes()->add($attribute);
    }

    /**
     * {@inheritDoc}
     */
    public function isNotForIndividualSale()
    {
        return $this->isNotForIndividualSale;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsNotForIndividualSale($isNotForIndividualSale)
    {
        $this->isNotForIndividualSale = (boolean) $isNotForIndividualSale;
    }

    /**
     * {@inheritDoc}
     */
    public function getSkuDefinitions()
    {
        if (!isset($this->skuDefinitions)) {
            $this->skuDefinitions = new ArrayCollection;
        }
        return $this->skuDefinitions;
    }

    /**
     * {@inheritDoc}
     */
    public function setSkuDefinitions($skuDefinitions)
    {
        if (is_array($this->skuDefinitions)) {
            $this->skuDefinitions = new ArrayCollection($skuDefinitions);
        } else {
            $this->skuDefinitions = $skuDefinitions;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addSkuDefinition(SkuDefinitionInterface $skuDefinition)
    {
        $this->getSkuDefinitions()->add($skuDefinition);
    }
}
