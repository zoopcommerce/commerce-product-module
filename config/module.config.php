<?php

return [
    'zoop' => [
        'api' => [
            'endpoints' => [
                'products',
            ],
        ],
        'shard' => [
            'manifest' => [
                'commerce' => [
                    'models' => [
                        'Zoop\Product\DataModel' => __DIR__ . '/../src/Zoop/Product/DataModel'
                    ],
                ],
            ],
            'rest' => [
                'rest' => [
                    'products' => [
                        'manifest' => 'commerce',
                        'class' => 'Zoop\Product\DataModel\AbstractProduct',
                        'property' => 'id',
                        'listeners' => [
                            'create' => [],
                            'delete' => [
                                'zoop.shardmodule.listener.delete',
                                'zoop.api.listener.cors',
                                'zoop.shardmodule.listener.flush',
                                'zoop.shardmodule.listener.prepareviewmodel'
                            ],
                            'deleteList' => [],
                            'get' => [
                                'zoop.shardmodule.listener.get',
                                'zoop.api.listener.cors',
                                'zoop.shardmodule.listener.serialize',
                                'zoop.shardmodule.listener.prepareviewmodel'
                            ],
                            'getList' => [
                                'zoop.shardmodule.listener.getlist',
                                'zoop.api.listener.cors',
                                'zoop.shardmodule.listener.serialize',
                                'zoop.shardmodule.listener.prepareviewmodel'
                            ],
                            'patch' => [
                                'zoop.shardmodule.listener.unserialize',
                                'zoop.api.listener.cors',
                                'zoop.shardmodule.listener.idchange',
                                'zoop.shardmodule.listener.patch',
                                'zoop.shardmodule.listener.flush',
                                'zoop.shardmodule.listener.prepareviewmodel'
                            ],
                            'patchList' => [],
                            'update' => [
                                'zoop.shardmodule.listener.unserialize',
                                'zoop.api.listener.cors',
                                'zoop.shardmodule.listener.idchange',
                                'zoop.shardmodule.listener.update',
                                'zoop.shardmodule.listener.flush',
                                'zoop.shardmodule.listener.prepareviewmodel'
                            ],
                            'replaceList' => [],
                            'options' => [
                                'zoop.api.listener.options',
                                'zoop.shardmodule.listener.prepareviewmodel'
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],
];
