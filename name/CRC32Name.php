<?php

namespace bl\imagable\name;

/**
 * Description of CRC32Name
 *
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
class CRC32Name extends BaseName
{

    public function generate($baseName)
    {
        return uniqid(hash('crc32', $baseName));
    }

}
