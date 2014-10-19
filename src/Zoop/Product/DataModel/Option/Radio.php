<?php

namespace Zoop\Product\DataModel\Option;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Product\DataModel\Option\RadioOptionInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class Radio extends AbstractOption implements RadioOptionInterface
{
    /**
     *
     * @ODM\Collection
     */
    protected $values;

    /**
     * {@inheritDoc}
     */
    public function getValues()
    {
        if (!isset($this->values)) {
            $this->values = new ArrayCollection;
        }
        return $this->values;
    }

    /**
     * {@inheritDoc}
     */
    public function setValues(ArrayCollection $values)
    {
        if (is_array($this->values)) {
            $this->values = new ArrayCollection($values);
        } else {
            $this->values = $values;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addValue($value)
    {
        $this->getValues()->add($value);
    }
}
