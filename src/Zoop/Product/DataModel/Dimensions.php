<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\DimensionsInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Dimensions implements DimensionsInterface
{
    /**
     *
     * @ODM\Float
     */
    protected $weight;

    /**
     *
     * @ODM\Float
     */
    protected $width;

    /**
     *
     * @ODM\Float
     */
    protected $height;

    /**
     *
     * @ODM\Float
     */
    protected $depth;

    /**
     * {@inheritDoc}
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * {@inheritDoc}
     */
    public function setWeight($weight)
    {
        $this->weight = (float) $weight;
    }

    /**
     * {@inheritDoc}
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * {@inheritDoc}
     */
    public function setWidth($width)
    {
        $this->width = (float) $width;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * {@inheritDoc}
     */
    public function setHeight($height)
    {
        $this->height = (float) $height;
    }

    /**
     * {@inheritDoc}
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * {@inheritDoc}
     */
    public function setDepth($depth)
    {
        $this->depth = (float) $depth;
    }
}
