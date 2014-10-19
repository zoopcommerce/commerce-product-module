<?php

namespace Zoop\Product\DataModel\Option;

use Zoop\Product\DataModel\Option\FileUploadOptionInterface;
use Zoop\Common\File\DataModel\FileInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class FileUpload extends AbstractOption implements FileUploadOptionInterface
{
    /**
     *
     * @ODM\Boolean
     */
    protected $isSkuSelector = false;

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
