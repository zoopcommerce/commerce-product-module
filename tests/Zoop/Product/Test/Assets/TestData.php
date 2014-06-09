<?php

namespace Zoop\Product\Test\Assets;

use Zoop\Shard\Serializer\Unserializer;
use Zoop\Store\DataModel\Store;
use Zoop\Product\DataModel\SingleProduct;

class TestData
{
    const DOCUMENT_SINGLE_PRODUCT = 'Zoop\Product\DataModel\SingleProduct';
    const DOCUMENT_STORE = 'Zoop\Store\DataModel\Store';
    
    /**
     * @param Unserializer $unserializer
     * @return Store
     */
    public static function createStore(Unserializer $unserializer)
    {
        $data = self::getJson('Store');
        return $unserializer->fromJson($data, self::DOCUMENT_STORE);
    }
    
    /**
     * @param Unserializer $unserializer
     * @return SingleProduct
     */
    public static function createSingleProduct(Unserializer $unserializer)
    {
        $data = self::getJson('SingleProduct');
        return $unserializer->fromJson($data, self::DOCUMENT_SINGLE_PRODUCT);
    }

    protected static function getJson($fileName)
    {
        return file_get_contents(__DIR__ . '/' . $fileName . '.json');
    }
}
