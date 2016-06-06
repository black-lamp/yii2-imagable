<?php

namespace bl\imagable\chainImageThumb;

use bl\imagable\interfaces\CreateImageInterface;
use yii\base\Object;

/**
 * Description of ImageThunb
 *
 * @author RuslanSaiko
 */
class ImageThumb extends Object
{

    /**
     * @param $imagePath
     * @throws \yii\base\InvalidConfigException
     */
    public function create($imagePath)
    {
        /* @var ImageSizeChain */
        $original = \Yii::createObject('bl\imagable\chainImageThumb\responsibilities\OriginalSize');

        /* @var ImageSizeChain */
        $big = \Yii::createObject('bl\imagable\chainImageThumb\responsibilities\BigSize');

        /* @var ImageSizeChain */
        $small = \Yii::createObject('bl\imagable\chainImageThumb\responsibilities\SmallSize');

        /* @var ImageSizeChain */
        $thumb = \Yii::createObject('bl\imagable\chainImageThumb\responsibilities\ThumbSize');

        $original->setNext($big)->setNext($small)->setNext($thumb);
    }

}
