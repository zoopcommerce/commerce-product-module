<?php

namespace Zoop\Product\DataModel;

use Zoop\Product\DataModel\EmbeddedSupplierInterface;
//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="*")
 * })
 */
class EmbeddedSupplier extends AbstractSupplier implements EmbeddedSupplierInterface
{

}
