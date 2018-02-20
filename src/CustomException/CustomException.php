<?php

namespace FrameworkDevA3\CustomException;
// appel du namespace log

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

    //fonction de description de l'erreur + envoie de l'exception au log
    protected function traceDescription()
    {
    	//sendLog($this->getTrace());
        return $this->message."<br>"."Dans le fichier: \"".$this->getFile()."\"<br> A la ligne: ".$this->getLine();
    }
}
