<?php  

class Product 
{
	private $price = 2;
	public $color = 'green';
	public static $total = 1993;

	public function calculateTotal() {
		self::$total = 10*40;
	}

	public function generateID() {
		return rand(0,9999);
	}

	public function read() {
		self::calculateTotal();
		return self::$total;
	}
}

// Static Object
// echo Product::$total;

$productObj = new Product();
echo $productObj::$total;

?>