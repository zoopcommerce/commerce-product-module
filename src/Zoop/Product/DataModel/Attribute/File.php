<?php

namespace Zoop\Product\DataModel\Attribute;

use Zoop\Common\DataModel\File as CommonFile;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class File extends AbstractAttribute
{
    /**
     *
     * @ODM\ReferenceOne(targetDocument="Zoop\Common\DataModel\File")
     */
    protected $file;

    /**
     *
     * @return CommonFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     *
     * @param CommonFile $file
     */
    public function setFile(CommonFile $file)
    {
        $this->file = $file;
    }
}
