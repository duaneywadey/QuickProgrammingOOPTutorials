<?php  

class Product 
{
	public static $price = 2;
	public $color = 'green';
	public $total = 100;

	function calculateTotal() {
		$newTotal = $this->total * 123;
		$this->total = $newTotal;
	}

	function returnTotal() {
		return $this->total;
	}

	function returnCalculateTotal() {
		return $this->calculateTotal();
	}

	function generateID() {
		return rand(0,9999);
	}
}

$productObj = new Product();
echo $productObj->calculateTotal(); 
echo $productObj->returnTotal(); 
?>