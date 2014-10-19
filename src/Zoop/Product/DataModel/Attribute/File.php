<?php

namespace Zoop\Product\DataModel\Attribute;

use Zoop\Common\File\DataModel\FileInterface;
use Zoop\Product\DataModel\Attribute\FileAttributeInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class File extends AbstractAttribute implements FileAttributeInterface
{
    /**
     *
     * @ODM\ReferenceOne(targetDocument="\Zoop\Common\File\DataModel\File")
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
