<?php

namespace Zoop\Product\DataModel\Option;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument 
 * @Shard\AccessControl({
 *      @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
abstract class AbstractOption
{
    /**
     * @ODM\Id(strategy="UUID")
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
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @return string
     */
    public function getHelpMessage()
    {
        return $this->helpMessage;
    }

    /**
     *
     * @param string $helpMessage
     */
    public function setHelpMessage($helpMessage)
    {
        $this->helpMessage = $helpMessage;
    }

    /**
     *
     * @return boolean
     */
    public function getIsSkuSelector()
    {
        return $this->isSkuSelector;
    }

    /**
     *
     * @param boolean $isSkuSelector
     */
    public function setIsSkuSelector($isSkuSelector)
    {
        $this->isSkuSelector = (boolean) $isSkuSelector;
    }

    /**
     *
     * @return boolean
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }

    /**
     *
     * @param boolean $isRequired
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = (boolean) $isRequired;
    }
}
