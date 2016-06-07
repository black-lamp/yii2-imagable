# yii2-imagable

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