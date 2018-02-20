<?php
/**
 * Created by PhpStorm.
 * User: donovan
 * Date: 19/02/2018
 * Time: 16:06
 */

require_once ('Custom_Exceptions.php');
class Router_Exception extends Custom_Exceptions {
	public function __toString(){
		return "Le router ne parvient pas à trouver la page; ".$this->traceDescription();
	}
}