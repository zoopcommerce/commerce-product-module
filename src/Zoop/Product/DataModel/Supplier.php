<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\PhysicalSkyDefinition;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Supplier extends AbstractSupplier
{
    /**
     * @ODM\ReferenceMany(targetDocument="PhysicalSkyDefinition", mappedBy="suppliers")
     * @Shard\Serializer\Eager
     */
    protected $skuDefinitions;

    public function __construct()
    {
        $this->skuDefinitions = new ArrayCollection();
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getSkuDefinitions()
    {
        return $this->skuDefinitions;
    }

    /**
     *
     * @param ArrayCollection $skuDefinitions
     */
    public function setSkuDefinitions(ArrayCollection $skuDefinitions)
    {
        $this->skuDefinitions = $skuDefinitions;
    }

    public function addSkuDefinition(PhysicalSkyDefinition $skuDefinition)
    {
        $this->getSkuDefinitions()->add($skuDefinition);
    }
}
