<?php

namespace bl\imagable\instances;

use bl\imagable\helpers\FileHelper;
use bl\imagable\interfaces\CreateImageInterface;
use yii\base\BaseObject;
use yii\imagine\Image;

/**
 * Description of CreateImageImagine
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
class CreateImageImagine extends BaseObject implements CreateImageInterface
{

    private $imagine;

    /**
     *
     * @var \Imagine\Image\ManipulatorInterface
     */
    private $openImage = null;

    public function init()
    {
        $this->imagine = new \Imagine\Imagick\Imagine();
        return parent::init();
    }

    public function save($saveTo)
    {
        $this->openImage->save($saveTo);
    }

    public function thumbnail($pathToImage, $width, $height)
    {
        try {
            $this->openImage = $this->imagine->open(FileHelper::normalizePath($pathToImage))->thumbnail(new \Imagine\Image\Box($width,
                $height));
        } catch (\Exception $ex) {
            \Codeception\Util\Debug::debug($ex->getMessage());
        }
    }
}
