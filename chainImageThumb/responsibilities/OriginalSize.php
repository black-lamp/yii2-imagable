<?php

namespace bl\imagable\chainImageThumb\responsibilities;

use bl\imagable\chainImageThumb\ImageMakeThumb;
use bl\imagable\chainImageThumb\ImageSizeChain;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OriginalSize
 *
 * @author RuslanSaiko
 */
class OriginalSize extends ImageSizeChain
{

    protected $key = 'saveOrigin';


    protected function resize($imagePath)
    {
        // TODO: Implement resize() method.
    }
}
