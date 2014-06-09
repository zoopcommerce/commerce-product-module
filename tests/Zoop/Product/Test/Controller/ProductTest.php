<?php

namespace Zoop\Product\Test\Controller;

use Zoop\Product\Test\AbstractTest;
use Zoop\Product\Test\Assets\TestData;

class ProductTest extends AbstractTest
{
    public function testCreateSingleProduct()
    {
        $product = TestData::createSingleProduct(self::getUnserializer());
        
        $this->getDocumentManager()->persist($product);
        $this->getDocumentManager()->flush($product);
    }
}
