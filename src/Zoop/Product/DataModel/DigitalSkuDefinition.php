<?php

namespace Zoop\Product\DataModel;

use Zoop\Common\DataModel\File;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class DigitalSkuDefinition extends AbstractSkuDefinition
{
    /**
     *
     * @ODM\ReferenceOne(targetDocument="Zoop\Common\DataModel\File")
     * @Shard\Serializer\Eager
     */
    protected $file;

    /**
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     *
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }
}
