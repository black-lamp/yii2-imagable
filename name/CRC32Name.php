<?php

namespace bl\imagable\name;

/**
 * Description of CRC32Name
 *
 * @author RuslanSaiko
 */
class CRC32Name extends BaseName
{

    public function generate($baseName)
    {
        return hash('crc32', $baseName);
    }

}
