#Instalation
``` json 
php composer.phar install black-lamp/yii2-imagable
```

#Confiugation
After extension is installed you need to setup imagable application component:
```php
'imagable' => [
    'class' => 'bl\imagable\Imagable',
    'imageClass' => 'bl\imagable\instances\CreateImageImagine',
    'categories' => [
        'origin' => false,
        'category' => [
            'galery' => [
                'origin' => true,
            ],
            'avatars' => [
                'size' => [
                    'big' => [
                        'width' => 1000,
                        'height' => 500,
                    ]
                ]
            ]
        ]
    ]
    ...
```

#Usage
```php
$imageName = \Yii::$app->imagable->create('avatars', 'pathToImage');
/*
    your code
*/
\Yii::$app->imagable->get('avatars', 'big', $imageName);
```