<?php
/**
 * Created by PhpStorm.
 * User: donovan
 * Date: 19/02/2018
 * Time: 16:19
 */

require_once ('../Router_Exception.php');
function test($a) {
	if ($a>2){
		throw new Router_Exception("router exception");
};
	return $a;
}

try {
	test(1);
	test(3);
}
catch (Router_Exception $e) {
	//echo $e;
	echo $e;
}