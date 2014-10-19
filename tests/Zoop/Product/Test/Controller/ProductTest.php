<?php

namespace Zoop\Product\Test\Controller;

use Zoop\Product\Test\AbstractTest;
use Zoop\Product\Test\Assets\TestData;
use Zoop\Product\DataModel\SingleProduct;
use Zoop\Product\DataModel\Option\Dropdown;
use Zoop\Product\DataModel\Attribute\Text;
use Zoop\Product\DataModel\PhysicalSkuDefinition;
use Zoop\Product\DataModel\EmbeddedSupplier;

class ProductTest extends AbstractTest
{
    public function testCreateSingleProduct()
    {
        $product = TestData::createSingleProduct(self::getUnserializer());

        $this->getDocumentManager()->persist($product);
        $this->getDocumentManager()->flush($product);

        $this->assertTrue($product instanceof SingleProduct);
        $this->assertNotNull($product->getId());
        $this->assertEquals(1, $product->getLegacyId());
        $this->assertEquals('11-inch-macbook-air', $product->getSlug());
        $this->assertEquals('11-inch MacBook Air', $product->getName());
        $this->assertEquals(
            '<p>1.4GHz dual-core Intel Core i5 processor</p>'
            . '<p>Turbo Boost up to 2.7GHz</p><p>Intel HD Graphics 5000</p>'
            . '<p>4GB memory</p>'
            . '<p>128GB PCIe-based flash storage</p>',
            $product->getDescription()
        );
        $this->assertEquals(
            '11-inch MacBook Air: 1.4GHz dual-core Intel Core i5 processor,'
            . '4GB memory, 128GB PCIe-based flash storage',
            $product->getMetaDescription()
        );
        $this->assertEquals('Apple', $product->getBrand()->getName());
        $this->assertEquals('apple', $product->getBrand()->getSlug());
        $this->assertFalse($product->getHidden());
        $this->assertEquals('apple', $product->getStores()[0]);
        $this->assertEquals('product/11-inch-macbook-air', $product->getUrl()->getRelative());
        $this->assertEquals('active', $product->getState());
        $this->assertEquals(1099, $product->getPrice()->getFull());
        $this->assertEquals(1000, $product->getPrice()->getSale());
        $this->assertEquals(500, $product->getPrice()->getWholesale());
        $this->assertTrue($product->getPrice()->getSaleActive());
        $this->assertFalse($product->getNotForIndividualSale());
        $this->assertCount(0, $product->getCategories());
        $this->assertCount(2, $product->getLegacyCategories());

        // Options
        $this->assertCount(1, $product->getOptions());
        $option = $product->getOptions()[0];
        $this->assertTrue($option instanceof Dropdown);
        $this->assertEquals('Storage', $option->getName());
        $this->assertCount(2, $option->getValues());
        $this->assertEquals('128GB', $option->getValues()[0]);
        $this->assertEquals('256GB', $option->getValues()[1]);

        // Attributes
        $this->assertCount(1, $product->getAttributes());
        $attribute = $product->getAttributes()[0];
        $this->assertTrue($attribute instanceof Text);
        $this->assertEquals('Storage', $attribute->getLabel());
        $this->assertEquals('128GB, 256GB', $attribute->getValue());

        //skus
        $this->assertCount(2, $product->getSkuDefinitions());

        //sku 1
        $sku = $product->getSkuDefinitions()[0];
        $this->assertTrue($sku instanceof PhysicalSkuDefinition);
        $this->assertEquals('123', $sku->getId());
        $this->assertEquals(5, $sku->getDimensions()->getWeight());
        $this->assertEquals(25, $sku->getDimensions()->getWidth());
        $this->assertEquals(25, $sku->getDimensions()->getHeight());
        $this->assertEquals(10, $sku->getDimensions()->getDepth());
        $supplier = $sku->getSuppliers()[0];
        $this->assertTrue($supplier instanceof EmbeddedSupplier);
        $this->assertEquals('Apple', $supplier->getName());
        $this->assertEquals('apple', $supplier->getSlug());

        $optionsMap = $sku->getOptionMap()[0];
        $optionsKey = array_keys($optionsMap);
        $this->assertEquals('storage', $optionsKey[0]);
        $this->assertEquals('128GB', $optionsMap['storage']);

        //sku 2
        $sku = $product->getSkuDefinitions()[1];
        $this->assertTrue($sku instanceof PhysicalSkuDefinition);
        $this->assertEquals('456', $sku->getId());
        $this->assertEquals(5, $sku->getDimensions()->getWeight());
        $this->assertEquals(25, $sku->getDimensions()->getWidth());
        $this->assertEquals(25, $sku->getDimensions()->getHeight());
        $this->assertEquals(10, $sku->getDimensions()->getDepth());
        $supplier = $sku->getSuppliers()[0];
        $this->assertTrue($supplier instanceof EmbeddedSupplier);
        $this->assertEquals('Apple', $supplier->getName());
        $this->assertEquals('apple', $supplier->getSlug());

        $optionsMap = $sku->getOptionMap()[0];
        $optionsKey = array_keys($optionsMap);
        $this->assertEquals('storage', $optionsKey[0]);
        $this->assertEquals('256GB', $optionsMap['storage']);
    }
}
