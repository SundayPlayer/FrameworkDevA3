<?php
/**
 * Created by PhpStorm.
 * User: donovan
 * Date: 20/02/2018
 * Time: 10:13
 */
namespace FrameworkDevA3\CustomException;

class LayoutException extends CustomException
{
    public function __toString()
    {
        return "La vue n'existe pas; ".$this->traceDescription();
    }
}
