<?php

namespace Zoop\Product\DataModel\Option;

use Zoop\Product\DataModel\Option\OptionInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
abstract class AbstractOption implements OptionInterface
{
    /**
     * @ODM\Id(strategy="NONE")
     */
    protected $id;

    /**
     *
     * @ODM\String
     */
    protected $name;

    /**
     *
     * @ODM\Boolean
     */
    protected $isRequired;

    /**
     *
     * @ODM\Boolean
     */
    protected $isSkuSelector;

    /**
     *
     * @ODM\String
     */
    protected $helpMessage;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function getHelpMessage()
    {
        return $this->helpMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function setHelpMessage($helpMessage)
    {
        $this->helpMessage = $helpMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function isSkuSelector()
    {
        return $this->isSkuSelector;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsSkuSelector($isSkuSelector)
    {
        $this->isSkuSelector = (boolean) $isSkuSelector;
    }

    /**
     * {@inheritDoc}
     */
    public function isRequired()
    {
        return $this->isRequired;
    }

    /**
     * {@inheritDoc}
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = (boolean) $isRequired;
    }
}
