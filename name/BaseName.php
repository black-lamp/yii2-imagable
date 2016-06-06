<?php

namespace bl\imagable\name;

/**
 * Description of BaseNameSignature
 *
 * @author RuslanSaiko
 */
abstract class BaseName extends \yii\base\Object
{
    abstract public function generate($baseName);
    
    public function getName($name)
    {
        return $this->generate($name);
    }
}
