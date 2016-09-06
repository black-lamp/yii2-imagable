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
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
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
        // Path to image
        $saveImagePath = $this->owner->imagesPath;

        $categoryOptions = $this->owner->categories;

        $defaultCategoriesSize = $this->owner->baseTemplate;
        if (!array_key_exists($category, $categoryOptions['category'])) {
            throw new \UnexpectedValueException(" Category with name $category not specified.");
        }
        // New path to image
        $newPath = implode(DIRECTORY_SEPARATOR, [$saveImagePath, $category]);

        // Specifies the full path to the category, for the derived class from BaseName
        $this->name->pathToCatory = $newPath;

        // New image name created with class BaseName
        $imageName = $this->name->getName(FileHelper::getFileName($path));
        DirectoryHelper::create($newPath, true);
        $image = '';
        $categoryOption = $categoryOptions['category'][$category];
        
        $categorySizes = $categoryOption['size'];
        if(empty($categorySizes)) {
            $categorySizes = $defaultCategoriesSize;
        }
        if ((isset($categoryOption['origin']) && $categoryOption['origin'])
            || (isset($categoryOptions['origin']) && $categoryOptions['origin'])
        ) {
            list($width, $height) = getimagesize($path);
            $categorySizes['origin'] = [
                'width' => $width,
                'height' => $height,
            ];
        }

        foreach ($categorySizes as $sizeName => $size) {
            $image = "$imageName-$sizeName." . FileHelper::getFileType($path);
            $this->imageCreator->thumbnail($path, $size['width'], $size['height']);
            $this->imageCreator->save(implode(DIRECTORY_SEPARATOR, [$newPath, $image]));
        }

        return $imageName;
    }

}
