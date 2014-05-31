<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Category\DataModel\Category;
use Zoop\Common\File\DataModel\Image;
use Zoop\Common\DataModel\Url;
use Zoop\Common\DataModel\CustomHtml;
use Zoop\Product\DataModel\ImageSet;
use Zoop\Store\DataModel\Store;
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
 * @Shard\Serializer\Discriminator
 * @Shard\AccessControl({
 *     @Shard\Permission\State(roles="*", allow="*")
 * })
 */
abstract class AbstractProduct
{
    use CreatedOnTrait;
    use CreatedByTrait;
    use UpdatedOnTrait;
    use UpdatedByTrait;
    use SoftDeleteableTrait;

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
     * @ODM\Int
     * @ODM\UniqueIndex(order="asc")
     */
    protected $legacyId;

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
     * @ODM\ReferenceMany(targetDocument="Zoop\Category\DataModel\Category", simple="true", inversedBy="products")
     */
    protected $categories;

    /**
     * @ODM\Collection
     * @ODM\Index
     */
    protected $legacyCategories;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\DataModel\Url")
     * @Shard\Validator\Required
     */
    protected $url;

    /**
     *
     * @ODM\EmbedMany(targetDocument="ImageSet")
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
     *
     * @ODM\EmbedOne(targetDocument="Price")
     * @Shard\Validator\Required
     */
    protected $price;
    protected $canPurchase;

    public function __construct()
    {
        $this->stores = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->imageSets = new ArrayCollection();
        $this->legacyCategories = new ArrayCollection();
    }

    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCustomHtml()
    {
        return $this->customHtml;
    }

    public function setCustomHtml(CustomHtml $customHtml)
    {
        $this->customHtml = $customHtml;
    }

    /**
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     *
     * @return integer
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    public function setLegacyId($legacyId)
    {
        $this->legacyId = (int) $legacyId;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /**
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     *
     * @param type $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     *
     * @param ArrayCollection $categories
     */
    public function setCategories(ArrayCollection $categories)
    {
        $this->categories = $categories;
    }

    /**
     *
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->getCategories()->add($category);
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getLegacyCategories()
    {
        return $this->legacyCategories;
    }

    /**
     *
     * @param ArrayCollection $legacyCategories
     */
    public function setLegacyCategories(ArrayCollection $legacyCategories)
    {
        $this->legacyCategories = $legacyCategories;
    }

    /**
     *
     * @param string $category
     */
    public function addLegacyCategory($category)
    {
        $this->getLegacyCategories()->add($category);
    }

    /**
     *
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     *
     * @param boolean $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = (boolean) $hidden;
    }

    /**
     *
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @param Url $url
     */
    public function setUrl(Url $url)
    {
        $this->url = $url;
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getImageSets()
    {
        return $this->imageSets;
    }

    /**
     *
     * @param ArrayCollection $imageSets
     */
    public function setImageSets(ArrayCollection $imageSets)
    {
        $this->imageSets = $imageSets;
    }

    /**
     * @param Image $image
     */
    public function addImageSet(Image $image)
    {
        $this->getImageSets()->add($image);
    }

    /**
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     *
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = (string) $state;
    }

    /**
     *
     * @return boolean
     */
    public function getCanPurchase()
    {
        return $this->canPurchase;
    }

    /**
     *
     * @param boolean $canPurchase
     */
    public function setCanPurchase($canPurchase)
    {
        $this->canPurchase = (bool) $canPurchase;
    }

    /**
     *
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     *
     * @param Price $price
     */
    public function setPrice(Price $price)
    {
        $this->price = $price;
    }
}
