<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Category\DataModel\Category;
use Zoop\Common\File\DataModel\Image;
use Zoop\Common\DataModel\Url;
use Zoop\Product\DataModel\ImageSet;
use Zoop\Store\DataModel\Store;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\State(roles="*", allow="*")
 * })
 */
interface ProductInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     */
    public function setSlug($slug);

    /**
     * @return int
     */
    public function getLegacyId();

    /**
     * @param int $legacyId
     */
    public function setLegacyId($legacyId);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return ArrayCollection
     */
    public function getStores();

    /**
     *
     * @param ArrayCollection $stores
     */
    public function setStores(ArrayCollection $stores);

    /**
     *
     * @param Store $store
     */
    public function addStore(Store $store);

    /**
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     *
     * @param type $metaDescription
     */
    public function setMetaDescription($metaDescription);

    /**
     *
     * @return ArrayCollection
     */
    public function getCategories();

    /**
     *
     * @param ArrayCollection $categories
     */
    public function setCategories(ArrayCollection $categories);

    /**
     *
     * @param Category $category
     */
    public function addCategory(Category $category);

    /**
     *
     * @return ArrayCollection
     */
    public function getLegacyCategories();

    /**
     *
     * @param ArrayCollection $legacyCategories
     */
    public function setLegacyCategories(ArrayCollection $legacyCategories);

    /**
     *
     * @param string $category
     */
    public function addLegacyCategory($category);

    /**
     *
     * @return boolean
     */
    public function getHidden();

    /**
     *
     * @param boolean $hidden
     */
    public function setHidden($hidden);

    /**
     *
     * @return Url
     */
    public function getUrl();

    /**
     *
     * @param Url $url
     */
    public function setUrl(Url $url);

    /**
     *
     * @return ArrayCollection
     */
    public function getImageSets();

    /**
     *
     * @param ArrayCollection $imageSets
     */
    public function setImageSets(ArrayCollection $imageSets);

    /**
     * @param Image $image
     */
    public function addImageSet(ImageSet $image);

    /**
     *
     * @return string
     */
    public function getState();

    /**
     *
     * @param string $state
     */
    public function setState($state);

    /**
     *
     * @return boolean
     */
    public function getCanPurchase();

    /**
     *
     * @param boolean $canPurchase
     */
    public function setCanPurchase($canPurchase);

    /**
     *
     * @return Price
     */
    public function getPrice();

    /**
     *
     * @param Price $price
     */
    public function setPrice(Price $price);
}
