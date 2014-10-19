<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\DigitalSkuDefinitionInterface;
use Zoop\Product\DataModel\SkuDefinitionInterface;
use Zoop\Common\File\DataModel\FileInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class DigitalSkuDefinition extends AbstractSkuDefinition implements
    DigitalSkuDefinitionInterface,
    SkuDefinitionInterface
{
    /**
     * @ODM\ReferenceOne(targetDocument="\Zoop\Common\File\DataModel\File")
     * @Shard\Serializer\Eager
     */
    protected $file;

    /**
     * {@inheritDoc}
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * {@inheritDoc}
     */
    public function setFile(FileInterface $file)
    {
        $this->file = $file;
    }
}
