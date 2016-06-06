<?php

namespace imagable;

use bl\imagable\helpers\FileHelper;
use bl\imagable\name\CRC32Name;
use Faker\Provider\File;

class ImagableTest extends \yii\codeception\TestCase
{

    public $appConfig = '@tests/unit/_config.php';
    private $pathToOrigin = '@tests/_data/images/origin';
    private $path = '@tests/_data/images';

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $path = &$this->pathToOrigin;
        $path = \Yii::getAlias($path);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    protected function _after()
    {

    }

    public function testImagableCreate()
    {
        $imagable = \Yii::createObject([
            'class' => 'bl\imagable\Imagable',
            'imagesPath' => '@tests/_data/images',
//            'nameClass' => CRC32Name::className(),
            'categories' => [
                'origin' => true,
                'category' => [
                    'galery' => [
                        'origin' => true,
                        'size' => [
                            'big' => [
                                'width' => 400,
                                'height' => 400,
                            ]
                        ]
                    ]
                ]
            ],
            'imageClass' => 'bl\imagable\instances\CreateImageImagine',
        ]);
        $path = \Yii::getAlias($this->pathToOrigin);
        $path = implode(DIRECTORY_SEPARATOR, [$path, 'testImage.jpg']);
        $name = 'testImage';
        //return name
        $this->assertEquals($imagable->create('galery', $path), $name);

        $this->assertTrue(file_exists(\Yii::getAlias("@tests/_data/images/galery/$name-small.jpg")));
        $this->assertTrue(file_exists(\Yii::getAlias("@tests/_data/images/galery/$name-origin.jpg")));
        $this->assertTrue(file_exists(\Yii::getAlias("@tests/_data/images/galery/$name-big.jpg")));
        $this->assertTrue(file_exists(\Yii::getAlias("@tests/_data/images/galery/$name-thumb.jpg")));
    }

    public function testImagableGet()
    {
        $imagable = \Yii::createObject([
            'class' => 'bl\imagable\Imagable',
            'imagesPath' => '@tests/_data/images',
            //'nameClass' => CRC32Name::className(),
            'imageClass' => 'bl\imagable\instances\CreateImageImagine',
        ]);

        //image name
        $name = 'testImage';
        $path = &$this->path;
        $pathToGalery = implode(DIRECTORY_SEPARATOR, [$path, 'galery']);
        $pathToGalery = FileHelper::normalizePath(\Yii::getAlias($pathToGalery));
        //return full path. Example: /var/www/site/images/galery/5cc22de8-small.jpg
        $this->assertEquals($imagable->get('galery', 'small', $name),
            $pathToGalery . \DIRECTORY_SEPARATOR . $name . '-small.jpg');

        //return full path. Example: /var/www/site/images/galery/5cc22de8-small.jpg
        $this->assertEquals($imagable->getSmall('galery', $name),
            $pathToGalery . \DIRECTORY_SEPARATOR . $name . '-small.jpg');

        //return full path. Example: /var/www/site/images/galery/5cc22de8-big.jpg
        $this->assertEquals($imagable->getBig('galery', $name), $pathToGalery . \DIRECTORY_SEPARATOR . $name . '-big.jpg');
\Codeception\Util\Debug::debug($imagable->getOriginal('galery', $name));
        //return full path. Example: /var/www/site/images/galery/5cc22de8-original.jpg
        $this->assertEquals($imagable->getOriginal('galery', $name), $pathToGalery . \DIRECTORY_SEPARATOR . $name . '-origin.jpg');

        //return full path. Example: /var/www/site/images/galery/5cc22de8-thumb.jpg
        $this->assertEquals($imagable->getThumb('galery', $name), $pathToGalery . \DIRECTORY_SEPARATOR . $name . '-thumb.jpg');
    }

}
