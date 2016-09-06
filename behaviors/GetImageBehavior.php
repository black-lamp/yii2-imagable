<?php

namespace bl\imagable\behaviors;

use bl\imagable\BaseImagable;
use bl\imagable\helpers\FileHelper;
use yii\base\Behavior;
use yii\base\Exception;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;

/**
 * Description of GetImageBehavior
 *
 * @author RuslanSaiko
 */
class GetImageBehavior extends Behavior
{
    /** @inheritdoc */
    public function attach($owner)
    {
        if(!is_subclass_of($owner, BaseImagable::className())) {
            throw new Exception("The owner must be inherited from ".BaseImagable::className());
        }
        parent::attach($owner);
    }

    /**
     * Get the image in a $type size.
     * @param $category string image category
     * @param $type string image type. Example 'thumb'
     * @param $name string image name
     * @return bool|string return name or false if image not exist
     */
    public function get($category, $type, $name)
    {
        /* Get the path to the folder with the images. */
        $directory = \Yii::getAlias($this->owner->imagesPath);
        $imagePath = implode(DIRECTORY_SEPARATOR, [$directory, $category]);
        $images = glob($imagePath . DIRECTORY_SEPARATOR . "$name-$type.*");
        if ($images === false) {
            return false;
        }
        /* Get the first matched file. */
        $image = $images[0];
        return FileHelper::normalizePath($image);
    }

    /**
     * Get the image in a thumb size.
     * @param $category string image category
     * @param $name string image name
     * @return bool|string return name or false if image not exist
     */
    public function getThumb($category, $name)
    {
        return $this->get($category, 'thumb', $name);
    }

    /**
     * Get the image in a small size.
     * @param $category string image category
     * @param $name string image name
     * @return bool|string return name or false if image not exist
     */
    public function getSmall($category, $name)
    {
        return $this->get($category, 'small', $name);
    }

    /**
     * Get the image in a big size.
     * @param $category string image category
     * @param $name string image name
     * @return bool|string return name or false if image not exist
     */
    public function getBig($category, $name)
    {
        return $this->get($category, 'big', $name);
    }

    /**
     * Get the image in a original size.
     * @param $category string image category
     * @param $name string image name
     * @param $imageContent string image contnent
     * @return bool|string return name or false if image not exist
     */
    public function getOriginal($category, $name)
    {
        return $this->get($category, 'origin', $name);
    }

}
