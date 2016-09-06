<?php

namespace bl\imagable\chainImageThumb;

use bl\imagable\interfaces\CreateImageInterface;
use yii\base\Object;

/**
 * Description of ImageMakeThumb
 *
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
abstract class ImageSizeChain extends Object
{

    /**
     *
     * @var CreateImageInterface
     */
    protected $imageCreator;

    public function __construct(CreateImageInterface $imageCreator,
            $config = [])
    {
        $this->imageCreator = $imageCreator;
        parent::__construct($config);
    }

    /**
     *
     * @var ImageMakeThumb
     */
    protected $next;

    public function setNext(ImageMakeThumb $thumb)
    {
        $this->next = $thumb;
        return $thumb;
    }

    protected abstract function resize($imagePath);

    public function save($imagePath) {
        if (!is_null($this->next)) {
            $this->next->resize($imagePath);
        }
    }

}
