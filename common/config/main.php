<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	 'basePath' => dirname(__DIR__),
    'runtimePath' => dirname(__DIR__) . '/../../runtime',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
