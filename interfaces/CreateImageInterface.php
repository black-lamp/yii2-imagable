<?php

namespace bl\imagable\interfaces;


/**
 * Interface CreateImageInterface
 * @package bl\imagable\interfaces
 *
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
interface CreateImageInterface
{
    public function thumbnail($pathToImage, $width, $height);

    public function save($saveTo);
}