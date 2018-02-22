<?php

namespace FrameworkDevA3\CustomException;

// appel du namespace log

use FrameworkDevA3\Log\Log;

class CustomException extends \Exception
{
    private $CustomExceptionMessage = "";

    public function __construct($CustomExceptionMessage, $message = "")
    {
        $this->CustomExceptionMessage=$CustomExceptionMessage;

        parent::__construct($message);
        Log::addLog($this->messageFacto(), $this->getLine(), $this->getFile());
    }

    public function __toString()
    {
        return $this->traceDescription();
    }

    // factoriser les messages
    private function messageFacto()
    {
        return $this->CustomExceptionMessage.$this->message;
    }
    //fonction de description de l'erreur
    protected function traceDescription()
    {
        return $this->messageFacto()."<br>"."Dans le fichier: \"".$this->getFile()."\"<br> A la ligne: ".$this->getLine();
    }
}
