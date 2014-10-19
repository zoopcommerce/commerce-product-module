<?php

namespace Zoop\Product\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\SkuDefinitionInterface;
use Zoop\Product\DataModel\SupplierInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Supplier extends AbstractSupplier implements SupplierInterface
{
    /**
     * @ODM\ReferenceMany(targetDocument="PhysicalSkyDefinition", mappedBy="suppliers")
     * @Shard\Serializer\Eager
     */
    protected $skuDefinitions;

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
