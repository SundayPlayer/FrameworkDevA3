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
    private static $customExceptionMessage="Cette vue n'existe pas; ";

    public function __construct($message = "")
    {
        parent::__construct($message, self::$customExceptionMessage);
    }
}
