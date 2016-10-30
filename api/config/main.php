<?php
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
	'defaultRoute' => 'site/index',
	'bootstrap' => ['log', 'debug'],
	'modules' => [
		'debug' => [
			'class' => 'yii\debug\Module',
			'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1', '118.70.124.143', '113.190.252.218', '183.81.9.171', '123.25.21.138'],                
		]
	],
     'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
//            'csrfParam' => '_csrf-api',
            'enableCookieValidation' => false,
            'cookieValidationKey' => 'xyctuyvibonp'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
       'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'suffix' => '',
                'rules' => [
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    'module/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                    'debug/<controller>/<action>' => 'debug/<controller>/<action>'
                ]
            ],

            'errorHandler' => [
                'errorAction' => 'site/error'
            ],


    ],
    'params' => $params,
];
