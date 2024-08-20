<?php  

abstract class Database {

	protected $var = 2;

	abstract function addNum($num1, $num2);
}

class Product extends Database {

	function addNum($a, $b) {
		echo $a + $b;
	}
}

$productObj = new Product();
$productObj->addNum(1,2);

?>