<?php

namespace Zoop\Product\DataModel;

use Zoop\Common\File\DataModel\Image;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class ImageSet
{
    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $raw;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $extraLarge;

    /**
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $large;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $medium;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $small;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $thumbnail;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $adminFeatureSmall;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $adminThumbnailSmall;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $adminFeatureLarge;

    /**
     *
     * @ODM\EmbedOne(targetDocument="Zoop\Common\File\DataModel\Image")
     */
    protected $adminThumbnailLarge;

    /**
     *
     * @return Image
     */
    public function getRaw()
    {
        return $this->raw;
    }

    public function setRaw(Image $raw)
    {
        $this->raw = $raw;
    }

    /**
     *
     * @return Image
     */
    public function getExtraLarge()
    {
        return $this->extraLarge;
    }

    public function setExtraLarge(Image $extraLarge)
    {
        $this->extraLarge = $extraLarge;
    }

    /**
     *
     * @return Image
     */
    public function getLarge()
    {
        return $this->large;
    }

    /**
     *
     * @param Image $large
     */
    public function setLarge(Image $large)
    {
        $this->large = $large;
    }

    /**
     *
     * @return Image
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     *
     * @param Image $medium
     */
    public function setMedium(Image $medium)
    {
        $this->medium = $medium;
    }

    /**
     *
     * @return Image
     */
    public function getSmall()
    {
        return $this->small;
    }

    /**
     *
     * @param Image $small
     */
    public function setSmall(Image $small)
    {
        $this->small = $small;
    }

    /**
     *
     * @return Image
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     *
     * @param Image $thumbnail
     */
    public function setThumbnail(Image $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     *
     * @return Image
     */
    public function getAdminFeatureSmall()
    {
        return $this->adminFeatureSmall;
    }

    /**
     *
     * @param Image $adminFeatureSmall
     */
    public function setAdminFeatureSmall(Image $adminFeatureSmall)
    {
        $this->adminFeatureSmall = $adminFeatureSmall;
    }

    /**
     *
     * @return Image
     */
    public function getAdminThumbnailSmall()
    {
        return $this->adminThumbnailSmall;
    }

    /**
     *
     * @param Image $adminThumbnailSmall
     */
    public function setAdminThumbnailSmall(Image $adminThumbnailSmall)
    {
        $this->adminThumbnailSmall = $adminThumbnailSmall;
    }

    /**
     *
     * @return Image
     */
    public function getAdminFeatureLarge()
    {
        return $this->adminFeatureLarge;
    }

    /**
     *
     * @param Image $adminFeatureLarge
     */
    public function setAdminFeatureLarge(Image $adminFeatureLarge)
    {
        $this->adminFeatureLarge = $adminFeatureLarge;
    }

    /**
     *
     * @return Image
     */
    public function getAdminThumbnailLarge()
    {
        return $this->adminThumbnailLarge;
    }

    /**
     *
     * @param Image $adminThumbnailLarge
     */
    public function setAdminThumbnailLarge(Image $adminThumbnailLarge)
    {
        $this->adminThumbnailLarge = $adminThumbnailLarge;
    }
}
