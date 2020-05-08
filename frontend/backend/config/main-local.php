<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'r2FsdN8Tt2OoSsGPZKNhfCaaA2JpXuq0',
            'enableCsrfValidation' => false,
        ],
    ],
];

if (!YII_ENV_TEST) {
//     configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'prop';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
