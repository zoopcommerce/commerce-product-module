<?php

namespace Zoop\Product\DataModel\Attribute;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 */
class Text extends AbstractAttribute
{
    /**
     *
     * @ODM\String
     */
    protected $value;


    /**
     *
     * @ODM\String
     */
    protected $unit;

    /**
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
