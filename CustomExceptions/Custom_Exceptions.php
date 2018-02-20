<?php
class Custom_Exceptions extends Exception {
	public function __construct($message="") {
		parent::__construct($message);

	}

	public function __toString(){
		return $this->traceDescription();
	}

	protected function traceDescription() {
		return $this->message."<br>"."Dans le fichier: \"".$this->getFile()."\"<br> A la ligne: ".$this->getLine();;
	}

	//todo creation  d'une alerte box
	//todo création d'un template
}

