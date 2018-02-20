<?php
/**
 * Created by PhpStorm.
 * User: donovan
 * Date: 20/02/2018
 * Time: 10:13
 */

require_once ('Custom_Exceptions.php');
class Layout_Exception extends Custom_Exceptions {
	public function __toString(){
		return "La vue n'existe pas; ".$this->traceDescription();
	}
}