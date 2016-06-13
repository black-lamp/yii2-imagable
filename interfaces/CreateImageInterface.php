<?php

namespace bl\imagable\interfaces;


/**
 * Interface CreateImageInterface
 * @package bl\imagable\interfaces
 */
interface CreateImageInterface
{

    public function thumbnail($pathToImage, $width, $height);

    public function save($saveTo);
}