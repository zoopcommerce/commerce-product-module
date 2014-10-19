<?php

namespace Zoop\Product\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\MappedSuperclass
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
abstract class AbstractBrand
{
    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     *
     * @ODM\String
     * @ODM\Index
     * @Shard\Validator\Chain({
     *     @Shard\Validator\Required,
     *     @Shard\Validator\Slug
     * })
     */
    protected $slug;

    /**
     *
     * @ODM\String
     */
    protected $name;

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
        $this->name = $name;
    }
}
