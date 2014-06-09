<?php

namespace Zoop\Product\DataModel\Option;

use Doctrine\Common\Collections\ArrayCollection;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Dropdown extends AbstractOption
{
    /**
     * @ODM\Collection
     */
    protected $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    /**
     *
     * @return ArrayCollection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     *
     * @param ArrayCollection $values
     */
    public function setValues(ArrayCollection $values)
    {
        $this->values = $values;
    }

    /**
     *
     * @param string $value
     */
    public function addValue($value)
    {
        $this->getValues()->add($value);
    }
}
