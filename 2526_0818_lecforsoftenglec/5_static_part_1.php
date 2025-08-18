
<?php  
class Product 
{
	private $price = 2;
	public $color = 'green';
	public static $total = 1993;

	public static function calculateTotal() {
		self::$total = 10*40;
	}

	public static function calculateTotalPlus()
	{
		self::$total = 10*40*800;
	}

	public static function sayHi() {
		return "HI";
	}

	public static function generateID() {
		return rand(0,9999);
	}

	public static function read() {
		self::calculateTotalPlus();
		return self::$total;
	}
}
echo Product::read();
echo Product::sayHi();
?>