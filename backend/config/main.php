<?php
use \yii\web\Response;
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'FixByte',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'app\modules\v1\Module'
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/help'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET' => 'help',
                    ],
                ],
                /*
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/campanhas','v1/categorias','v1/categoriaschild','v1/compras','v1/compraprodutos','v1/produtos','v1/produtoscampanha','v1/reparacoes','v1/users','v1/usersdata'],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET' => 'available',
                        'GET help' => 'help',
                        'GET {id}' => 'detail',
                    ]
                ],
                */
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/campanhas',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET' => 'available',
                        'GET help' => 'help',
                        'GET {id}' => 'detail',
                        'GET {id}/produtos' => 'produtos',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/categorias',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET' => 'available',
                        'GET help' => 'help',
                        'GET {id}' => 'detail',
                        'GET {id}/child' => 'child',
                        'GET {id}/produtos' => 'produtos',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/categoriaschild',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET' => 'available',
                        'GET help' => 'help',
                        'GET {id}' => 'detail',
                        'GET {id}/child' => 'child',
                        'GET {id}/produtos' => 'produtos',
                        'GET {id}/categoria' => 'categoria',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/compras',
                    'pluralize' => false,
                    'extraPatterns' => [
                        //todo: this!
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/compraprodutos',
                    'pluralize' => false,
                    'extraPatterns' => [
                        //todo: this!
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/produtos',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET {id}/campanha' => 'campanha',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/produtoscampanha',
                    'pluralize' => false,
                    'extraPatterns' => [
                        //todo: this!
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/reparacoes',
                    'pluralize' => false,
                    'extraPatterns' => [
                        //todo: this!
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/users',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST registo' => 'registo',
                        'PUT edit' => 'edit',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/usersdata',
                    'pluralize' => false,
                    'extraPatterns' => [
                        //todo: this!
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
