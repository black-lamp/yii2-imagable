#Instalation
```
php composer.phar install black-lamp/yii2-imagable
```
or add

```json
"black-lamp/yii2-imagable": "*"
```
to the `require` section of your composer.json.
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
            'galery/more' => [
                'origin' => false,
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

###Create image
```php
$imageName = \Yii::$app->imagable->create('avatars', 'pathToImage');
```

###Get Image
```php
$fullPathToImage = \Yii::$app->imagable->get('avatars', 'big', $imageName);
```

###Delete Image
```php
$isDeleted = \Yii::$app->imagable->delete('avatars', $imageName);
```