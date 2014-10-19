<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\ImageSetInterface;
use Zoop\Common\File\DataModel\ImageInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class ImageSet implements ImageSetInterface
{
    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $raw;

    /**
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $extraLarge;

    /**
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $large;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $medium;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $small;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $thumbnail;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $adminFeatureSmall;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $adminThumbnailSmall;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $adminFeatureLarge;

    /**
     *
     * @ODM\EmbedOne(targetDocument="\Zoop\Common\File\DataModel\Image")
     */
    protected $adminThumbnailLarge;

    /**
     * {@inheritDoc}
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * {@inheritDoc}
     */
    public function setRaw(ImageInterface $raw)
    {
        $this->raw = $raw;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtraLarge()
    {
        return $this->extraLarge;
    }

    /**
     * {@inheritDoc}
     */
    public function setExtraLarge(ImageInterface $extraLarge)
    {
        $this->extraLarge = $extraLarge;
    }

    /**
     * {@inheritDoc}
     */
    public function getLarge()
    {
        return $this->large;
    }

    /**
     * {@inheritDoc}
     */
    public function setLarge(ImageInterface $large)
    {
        $this->large = $large;
    }

    /**
     * {@inheritDoc}
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * {@inheritDoc}
     */
    public function setMedium(ImageInterface $medium)
    {
        $this->medium = $medium;
    }

    /**
     * {@inheritDoc}
     */
    public function getSmall()
    {
        return $this->small;
    }

    /**
     * {@inheritDoc}
     */
    public function setSmall(ImageInterface $small)
    {
        $this->small = $small;
    }

    /**
     * {@inheritDoc}
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * {@inheritDoc}
     */
    public function setThumbnail(ImageInterface $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminFeatureSmall()
    {
        return $this->adminFeatureSmall;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminFeatureSmall(ImageInterface $adminFeatureSmall)
    {
        $this->adminFeatureSmall = $adminFeatureSmall;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminThumbnailSmall()
    {
        return $this->adminThumbnailSmall;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminThumbnailSmall(ImageInterface $adminThumbnailSmall)
    {
        $this->adminThumbnailSmall = $adminThumbnailSmall;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminFeatureLarge()
    {
        return $this->adminFeatureLarge;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminFeatureLarge(ImageInterface $adminFeatureLarge)
    {
        $this->adminFeatureLarge = $adminFeatureLarge;
    }

    /**
     * {@inheritDoc}
     */
    public function getAdminThumbnailLarge()
    {
        return $this->adminThumbnailLarge;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdminThumbnailLarge(ImageInterface $adminThumbnailLarge)
    {
        $this->adminThumbnailLarge = $adminThumbnailLarge;
    }
}
