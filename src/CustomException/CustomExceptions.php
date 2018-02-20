<?php

namespace FrameworkDevA3\CustomException;

class CustomException extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

    public function __toString()
    {
        return $this->traceDescription();
    }

    protected function traceDescription()
    {
        return $this->message."<br>"."Dans le fichier: \"".$this->getFile()."\"<br> A la ligne: ".$this->getLine();
        ;
    }
}
