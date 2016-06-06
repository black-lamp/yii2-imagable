<?php

namespace bl\imagable\interfaces;

/**
 *
 * @author RuslanSaiko
 */
interface CreateImageInterface
{

    public function thumbnail($pathToImage, $width, $height);

    public function save($saveTo);

}
