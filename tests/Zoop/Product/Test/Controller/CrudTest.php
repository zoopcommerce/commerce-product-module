<?php

namespace Zoop\Product\Test\Controller;

use Zend\Http\Header\Origin;
use Zend\Http\Header\Host;
use Zoop\Product\Test\AbstractTest;
use Zoop\Test\Helper\DataHelper;
use Zoop\Product\DataModel\SingleProductInterface;
use Zoop\Product\DataModel\Option\DropdownOptionInterface;
use Zoop\Product\DataModel\Attribute\TextAttributeInterface;
use Zoop\Product\DataModel\PhysicalSkuDefinitionInterface;
use Zoop\Product\DataModel\EmbeddedSupplierInterface;

class CrudTest extends AbstractTest
{

    private static $endpoint = 'http://api.zoopcommerce.local/products';

    public function testNoAuthorizationCreate()
    {
        $data = [
            "type" => "SingleProduct",
            "slug" => "11-inch-macbook-air",
            "name" => "11-inch MacBook Air",
            "brand" => [
                "slug" => "apple",
                "name" => "Apple"
            ],
            "stores" => ["apple"],
        ];

        $request = $this->getRequest();
        $request->setContent(json_encode($data));

        $this->applyJsonRequest($request);

        $request->setMethod('POST')
                ->getHeaders()->addHeaders([
            Origin::fromString('Origin: http://api.zoopcommerce.local'),
            Host::fromString('Host: api.zoopcommerce.local')
        ]);

        $this->dispatch(self::$endpoint);
        $response = $this->getResponse();

        //we should change this to a 403
//        $this->assertResponseStatusCode(403);
        $this->assertResponseStatusCode(500);
    }

    public function testUnAuthorizedCreate()
    {
        //TODO: test unauthorized user. Perhaps a customer
    }

    public function testCreateSuccess()
    {
        $name = "11-inch MacBook Air";
        $data = [
            "type" => "SingleProduct",
            "slug" => "11-inch-macbook-air",
            "stores" => [
                "apple"
            ],
            "name" => $name,
            "brand" => [
                "slug" => "apple",
                "name" => "Apple"
            ],
            "description" => "<p>1.4GHz dual-core Intel Core i5 processor</p>",
            "metaDescription" => "11-inch MacBook Air: 1.4GHz dual-core Intel "
                . "Core i5 processor, 4GB memory, 128GB PCIe-based flash storage",
            "url" => [
                "relative" => "product/11-inch-macbook-air",
                "absolute" => "http://apple.zoopcommerce.com/product/11-inch-macbook-air"
            ],
            "state" => "active",
            "hidden" => false,
            "price" => [
                "full" => 1099,
                "sale" => 1000,
                "wholesale" => 500
            ],
            "collections" => [],
            "options" => [
                [
                    "id" => "storage",
                    "type" => "Dropdown",
                    "name" => "Storage",
                    "values" => [
                        "128GB",
                        "256GB"
                    ]
                ]
            ],
            "attributes" => [
                [
                    "type" => "Text",
                    "label" => "Storage",
                    "value" => "128GB, 256GB"
                ]
            ],
            "notForIndividualSale" => false,
            "skuDefinitions" => [
                [
                    "id" => "123",
                    "type" => "Physical",
                    "legacyId" => 2,
                    "optionMap" => [
                        "storage" => "128GB"
                    ],
                    "shippingRates" => [],
                    "suppliers" => [
                        [
                            "name" => "Apple",
                            "slug" => "apple"
                        ]
                    ],
                    "dimensions" => [
                        "weight" => 5,
                        "width" => 25,
                        "height" => 25,
                        "depth" => 10
                    ]
                ],
                [
                    "id" => "456",
                    "type" => "Physical",
                    "legacyId" => 3,
                    "optionMap" => [
                        "storage" => "256GB"
                    ],
                    "shippingRates" => [],
                    "suppliers" => [
                        [
                            "name" => "Apple",
                            "slug" => "apple"
                        ]
                    ],
                    "dimensions" => [
                        "weight" => 5,
                        "width" => 25,
                        "height" => 25,
                        "depth" => 10
                    ]
                ]
            ]
        ];

        DataHelper::createStores(self::getNoAuthDocumentManager(), self::getDbName());
        DataHelper::createZoopUser(self::getNoAuthDocumentManager(), self::getDbName());

        $key = 'joshstuart';
        $secret = 'password1';

        $post = json_encode($data);
        $request = $this->getRequest();
        $request->setContent($post);

        $this->applyJsonRequest($request);
        $this->applyUserToRequest($request, $key, $secret);

        $request->setMethod('POST')
                ->getHeaders()->addHeaders([
            Origin::fromString('Origin: http://api.zoopcommerce.local'),
            Host::fromString('Host: api.zoopcommerce.local')
        ]);

        $this->dispatch(self::$endpoint);
        $response = $this->getResponse();

        $this->assertResponseStatusCode(201);

        $productId = str_replace(
            ['Location: ', '/products/'],
            '',
            $response->getHeaders()->get('Location')->toString()
        );

        $this->assertNotNull($productId);

        self::getNoAuthDocumentManager()->clear();

        $product = DataHelper::get(
            self::getNoAuthDocumentManager(),
            'Zoop\Product\DataModel\AbstractProduct',
            $productId
        );

        // General
        $this->assertTrue($product instanceof SingleProductInterface);
        $this->assertEquals($name, $product->getName());
        $this->assertEquals('Apple', $product->getBrand()->getName());
        $this->assertEquals('apple', $product->getBrand()->getSlug());
        $this->assertFalse($product->isHidden());
        $this->assertEquals('apple', $product->getStores()[0]);
        $this->assertEquals('product/11-inch-macbook-air', $product->getUrl()->getRelative());
        $this->assertEquals('active', $product->getState());
        $this->assertEquals(1099, $product->getPrice()->getFull());
        $this->assertEquals(1000, $product->getPrice()->getSale());
        $this->assertEquals(500, $product->getPrice()->getWholesale());
        $this->assertTrue($product->getPrice()->isSaleActive());
        $this->assertFalse($product->isNotForIndividualSale());

        // Options
        $this->assertCount(1, $product->getOptions());
        $option = $product->getOptions()[0];
        $this->assertTrue($option instanceof DropdownOptionInterface);
        $this->assertEquals('Storage', $option->getName());
        $this->assertCount(2, $option->getValues());
        $this->assertEquals('128GB', $option->getValues()[0]);
        $this->assertEquals('256GB', $option->getValues()[1]);

        // Attributes
        $this->assertCount(1, $product->getAttributes());
        $attribute = $product->getAttributes()[0];
        $this->assertTrue($attribute instanceof TextAttributeInterface);
        $this->assertEquals('Storage', $attribute->getLabel());
        $this->assertEquals('128GB, 256GB', $attribute->getValue());

        //skus
        $this->assertCount(2, $product->getSkuDefinitions());

        //sku 1
        $sku = $product->getSkuDefinitions()[0];
        $this->assertTrue($sku instanceof PhysicalSkuDefinitionInterface);
        $this->assertEquals('123', $sku->getId());
        $this->assertEquals(5, $sku->getDimensions()->getWeight());
        $this->assertEquals(25, $sku->getDimensions()->getWidth());
        $this->assertEquals(25, $sku->getDimensions()->getHeight());
        $this->assertEquals(10, $sku->getDimensions()->getDepth());
        $supplier = $sku->getSuppliers()[0];
        $this->assertTrue($supplier instanceof EmbeddedSupplierInterface);
        $this->assertEquals('Apple', $supplier->getName());
        $this->assertEquals('apple', $supplier->getSlug());

        $optionsMap = $sku->getOptionMap();
        $optionsKey = array_keys($optionsMap);
        $this->assertEquals('storage', $optionsKey[0]);
        $this->assertEquals('128GB', $optionsMap['storage']);

        //sku 2
        $sku = $product->getSkuDefinitions()[1];
        $this->assertTrue($sku instanceof PhysicalSkuDefinitionInterface);
        $this->assertEquals('456', $sku->getId());
        $this->assertEquals(5, $sku->getDimensions()->getWeight());
        $this->assertEquals(25, $sku->getDimensions()->getWidth());
        $this->assertEquals(25, $sku->getDimensions()->getHeight());
        $this->assertEquals(10, $sku->getDimensions()->getDepth());
        $supplier = $sku->getSuppliers()[0];
        $this->assertTrue($supplier instanceof EmbeddedSupplierInterface);
        $this->assertEquals('Apple', $supplier->getName());
        $this->assertEquals('apple', $supplier->getSlug());

        $optionsMap = $sku->getOptionMap();
        $optionsKey = array_keys($optionsMap);
        $this->assertEquals('storage', $optionsKey[0]);
        $this->assertEquals('256GB', $optionsMap['storage']);

        return $productId;
    }
//
//    /**
//     * @depends testCreateSuccess
//     */
//    public function testPatchSuccess($productId)
//    {
//        $data = [
//            "price" => [
//                "full" => 1099,
//                "sale" => 0,
//                "wholesale" => 500
//            ],
//        ];
//
//        $key = 'joshstuart';
//        $secret = 'password1';
//
//        $request = $this->getRequest();
//        $request->setContent(json_encode($data));
//
//        $this->applyJsonRequest($request);
//        $this->applyUserToRequest($request, $key, $secret);
//
//        $request->setMethod('PATCH')
//                ->getHeaders()->addHeaders([
//            Origin::fromString('Origin: http://api.zoopcommerce.local'),
//            Host::fromString('Host: api.zoopcommerce.local')
//        ]);
//
//        $this->dispatch(sprintf(self::$endpoint . '/%s', $productId));
//        $response = $this->getResponse();
//
//        $this->assertResponseStatusCode(204);
//
//        self::getNoAuthDocumentManager()->clear();
//
//        $product = DataHelper::get(
//            self::getNoAuthDocumentManager(),
//            'Zoop\Product\DataModel\AbstractProduct',
//            $productId
//        );
//
//        $this->assertTrue($product instanceof SingleProductInterface);
//        $this->assertEquals($name, $product->getName());
//    }

    /**
     * @depends testCreateSuccess
     */
    public function testDeleteSuccess($productId)
    {
        $key = 'joshstuart';
        $secret = 'password1';

        $request = $this->getRequest();

        $this->applyJsonRequest($request);
        $this->applyUserToRequest($request, $key, $secret);

        $request->setMethod('DELETE')
                ->getHeaders()->addHeaders([
            Origin::fromString('Origin: http://api.zoopcommerce.local'),
            Host::fromString('Host: api.zoopcommerce.local')
        ]);

        $this->dispatch(sprintf(self::$endpoint . '/%s', $productId));
        $response = $this->getResponse();

        $this->assertResponseStatusCode(204);

        //we need to just do a soft delete rather than a hard delete
        self::getNoAuthDocumentManager()->clear();
        $product = DataHelper::get(
            self::getNoAuthDocumentManager(),
            'Zoop\Product\DataModel\AbstractProduct',
            $productId
        );
        $this->assertEmpty($product);
    }
}
