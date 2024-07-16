<?php  

class Product 
{
	private $price = 2;
	public $color = 'green';
	private $total = 0;

	public function calculateTotal() {
		$this->total = 10*20;
	}

	public function generateID() {
		return rand(0,9999);
	}

	public function read() {
		$this->calculateTotal();
		return $this->total;
	}
}

$productObj = new Product();
echo $productObj->calculateTotal(); 
echo $productObj->read(); 
?>