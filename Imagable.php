<?php

namespace bl\imagable;

use yii\base\Component;

/**
 * Description of Imagable
 *
 * @author RuslanSaiko
 */
class Imagable extends Component
{

    public $imagableClass = 'Imagine\Imagick\Imagine';
    public $categories = [];
    public $imagesPath = '@webroot/images';
    public $baseTemplate = [];

    public function init()
    {
        return parent::init();
    }

    function createDirerctory($pathToDirectory, $chmod = 0777, $recursive = true)
    {
        if (!is_dir($pathToDirectory)) {
            mkdir($pathToDirectory, $chmod, $recursive);
            return true;
        }
        return false;
    }

}
