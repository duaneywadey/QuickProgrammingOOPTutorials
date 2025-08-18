<?php  

class Product 
{
	public $price = 2;
	public $color = 'green';
	public $total = 0;

	function calculateTotal() {
		echo "From the function";
	}
}

$book = new Product();
echo "From book object" . $book->price;
echo "From book object" . $book->color;
$book->calculateTotal();

$phone = new Product();
$phone->calculateTotal();
?>


