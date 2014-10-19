<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Collection\DataModel\CollectionInterface;
use Zoop\Common\DataModel\UrlInterface;
use Zoop\Common\DataModel\CustomHtmlInterface;
use Zoop\Product\DataModel\ImageSetInterface;
use Zoop\Product\DataModel\PriceInterface;
use Zoop\Product\DataModel\ProductInterface;
use Zoop\Store\DataModel\StoresTrait;
use Zoop\Store\DataModel\StoresTraitInterface;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;
use Zoop\Shard\Stamp\DataModel\CreatedByTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedOnTrait;
use Zoop\Shard\Stamp\DataModel\UpdatedByTrait;
use Zoop\Shard\SoftDelete\DataModel\SoftDeleteableTrait;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document(collection="Product")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="type")
 * @ODM\DiscriminatorMap({
 *     "SingleProduct"  = "SingleProduct",
 *     "Bundle"         = "Bundle"
 * })
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="read"),
 *     @Shard\Permission\Basic(roles="zoop::admin", allow={"create", "update::*", "delete"}),
 *     @Shard\Permission\Basic(roles="partner::admin", allow={"create", "update::*", "delete"}),
 *     @Shard\Permission\Basic(roles="company::admin", allow={"create", "update::*", "delete"}),
 *     @Shard\Permission\Basic(roles="store::admin", allow={"update::*"}),
 *     @Shard\Permission\Transition(roles={"zoop::admin", "partner::admin", "company::admin", "store::admin"})
 * })
 */
abstract class AbstractProduct implements
    ProductInterface,
    StoresTraitInterface
{
    use CreatedOnTrait;
    use CreatedByTrait;
    use UpdatedOnTrait;
    use UpdatedByTrait;
    use SoftDeleteableTrait;
    use StoresTrait;

    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     *
     * @ODM\String
     * @ODM\UniqueIndex(order="asc")
     * @Shard\Validator\Chain({
     *     @Shard\Validator\Required,
     *     @Shard\Validator\Slug
     * })
     */
    protected $slug;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\CustomHtml")
     */
    protected $customHtml;

    /**
     *
     * @ODM\String
     */
    protected $description;

    /**
     * @ODM\Boolean
     */
    protected $hidden = false;

    /**
     *
     * @ODM\String
     * @Shard\Validator\Required
     */
    protected $name;

    /**
     *
     * @ODM\String
     */
    protected $metaDescription;

    /**
     * @ODM\ReferenceMany(
     *      targetDocument="Zoop\Collection\DataModel\AbstractCollection",
     *      simple="true",
     *      inversedBy="products"
     *  )
     */
    protected $collections;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Url")
     * @Shard\Validator\Required
     */
    protected $url;

    /**
     *
     * @ODM\EmbedMany(targetDocument="Zoop\Product\DataModel\ImageSet")
     */
    protected $imageSets;

    /**
     * There is another, dynamically applied state 'all-allocated' which means that
     * all available inventory has been allocated to carts, but may not have payment confirmed.
     *
     * @ODM\String
     * @Shard\State({
     *     "inactive",
     *     "active",
     *     "sold-out",
     *     "pre-order",
     *     "coming-soon",
     *     "hidden",
     *     "on-sale"
     * })
     */
    protected $state = 'active';

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Product\DataModel\Price")
     * @Shard\Validator\Required
     */
    protected $price;
    protected $canPurchase;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomHtml()
    {
        return $this->customHtml;
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomHtml(CustomHtmlInterface $customHtml)
    {
        $this->customHtml = $customHtml;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /**
     * {@inheritDoc}
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * {@inheritDoc}
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollections()
    {
        if (!isset($this->collections)) {
            $this->collections = new ArrayCollection;
        }
        return $this->collections;
    }

    /**
     * {@inheritDoc}
     */
    public function setCollections($collections)
    {
        if (is_array($this->collections)) {
            $this->collections = new ArrayCollection($collections);
        } else {
            $this->collections = $collections;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addCollection(CollectionInterface $collection)
    {
        $this->getCollections()->add($collection);
    }

    /**
     * {@inheritDoc}
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * {@inheritDoc}
     */
    public function setHidden($hidden)
    {
        $this->hidden = (boolean) $hidden;
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * {@inheritDoc}
     */
    public function setUrl(UrlInterface $url)
    {
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function getImageSets()
    {
        if (!isset($this->imageSets)) {
            $this->imageSets = new ArrayCollection;
        }
        return $this->imageSets;
    }

    /**
     * {@inheritDoc}
     */
    public function setImageSets($imageSets)
    {
        if (is_array($this->imageSets)) {
            $this->imageSets = new ArrayCollection($imageSets);
        } else {
            $this->imageSets = $imageSets;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addImageSet(ImageSetInterface $imageSet)
    {
        $this->getImageSets()->add($imageSet);
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritDoc}
     */
    public function setState($state)
    {
        $this->state = (string) $state;
    }

    /**
     * {@inheritDoc}
     */
    public function canPurchase()
    {
        return $this->canPurchase;
    }

    /**
     * {@inheritDoc}
     */
    public function setCanPurchase($canPurchase)
    {
        $this->canPurchase = (bool) $canPurchase;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice(PriceInterface $price)
    {
        $this->price = $price;
    }
}
