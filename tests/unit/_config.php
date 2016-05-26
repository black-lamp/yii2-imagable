<?php

return [
    'id' => 'app-console',
    'class' => 'yii\console\Application',
    'basePath' => \Yii::getAlias('@tests'),
    'runtimePath' => \Yii::getAlias('@tests/_output'),
    'bootstrap' => [],
    'components' => [
        'imagable' => [
            'class' => 'bl\imagable\Imagable'
        ],
        'db' => [
            'class' => '\yii\db\Connection',
            'dsn' => 'sqlite:' . \Yii::getAlias('@tests/_output/temp.db'),
            'username' => '',
            'password' => '',
        ]
    ]
];
