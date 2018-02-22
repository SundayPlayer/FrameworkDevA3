<?php
/**
 * Created by PhpStorm.
 * User: donovan
 * Date: 19/02/2018
 * Time: 16:06
 */
namespace FrameworkDevA3\CustomException;

class RouterException extends CustomException
{
    private static $customExceptionMessage="Le router ne parvient pas à trouver la page; ";

    public function __construct($message = "")
    {
        parent::__construct($message, self::$customExceptionMessage);
    }
}
