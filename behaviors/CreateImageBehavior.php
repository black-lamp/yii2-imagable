<?php

namespace bl\imagable\behaviors;

use bl\imagable\BaseImagable;
use bl\imagable\helpers\FileHelper;
use bl\imagable\name\BaseName;
use bl\imagable\helpers\DirectoryHelper;
use bl\imagable\interfaces\CreateImageInterface;
use yii\base\Behavior;
use yii\base\Exception;

/**
 * Description of CreateImageBehavior
 *
 * @author RuslanSaiko
 */
class CreateImageBehavior extends Behavior
{
    /**
     * @var BaseHashName
     */
    private $name = null;

    /**
     * @var CreateImageInterface
     */
    private $imageCreator = null;

    /**
     * CreateImageBehavior constructor.
     * @param BaseName $name name generator
     * @param CreateImageInterface $imageCreator image resizer
     * @param array $config
     */
    public function __construct(BaseName $name, CreateImageInterface $imageCreator, $config = array())
    {
        parent::__construct($config);

        $this->name = $name;
        $this->imageCreator = $imageCreator;
    }

    /** @inheritdoc */
    public function attach($owner)
    {
        if (!is_subclass_of($owner, BaseImagable::className())) {
            throw new Exception("The owner must be inherited from " . BaseImagable::className());
        }
        parent::attach($owner);
    }

    /**
     * @param $category string category name
     * @param $path string path to image
     * @return string return image name
     */
    public function create($category, $path)
    {
        //path to image
        $saveImagePath = $this->owner->imagesPath;
        $categoriesParam = $this->owner->categories;
        $defaultCategoriesSize = $this->owner->baseTemplate;
        if (!array_key_exists($category, $categoriesParam['category'])) {
            throw new \UnexpectedValueException("$category not declare");
        }
        //new path to image
        $newPath = implode(DIRECTORY_SEPARATOR, [$saveImagePath, $category]);

        //new image name created with class BaseName
        $imageName = $this->name->getName(FileHelper::getFileName($path));
        DirectoryHelper::create($newPath, true);
        $image = '';
        //TODO:refactor here!
        foreach ($categoriesParam['category'] as $category) {
            if (isset($category['origin']) && $category['origin']) {
                $image = $imageName . "-origin." . FileHelper::getFileType($path);
                list($width, $height, $type, $attr) = getimagesize($path);

                $this->imageCreator->thumbnail($path, $width, $height);
                $this->imageCreator->save(implode(DIRECTORY_SEPARATOR, [$newPath, $image]));


            } elseif (isset($categoriesParam['origin']) && $categoriesParam['origin']) {
                $image = $imageName . "-origin." . FileHelper::getFileType($path);

                list($width, $height, $type, $attr) = getimagesize($path);

                $this->imageCreator->thumbnail($path, $width, $height);
                $this->imageCreator->save(implode(DIRECTORY_SEPARATOR, [$newPath, $image]));

            }

            $arr = isset($category['size']) ? $category['size'] : $defaultCategoriesSize;
            foreach ($arr as $sizeName => $size) {
                $image = "$imageName-$sizeName." . FileHelper::getFileType($path);
                $this->imageCreator->thumbnail($path, $size['width'], $size['height']);
                $this->imageCreator->save(implode(DIRECTORY_SEPARATOR, [$newPath, $image]));
            }
        }

        return $imageName;
    }

}
