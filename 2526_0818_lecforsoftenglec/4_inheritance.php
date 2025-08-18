<?php  
class Database {
	public function dbConnect() {
		echo "from Database Class - dbConnect function<br>";
	}
	public function dbRead() {
		echo "from Database Class - dbRead function<br>";
	}
	public function dbWrite() {
		echo "from Database Class - dbWrite function<br>";
	}
}

class Product extends Database {

	public function fromProdClass()
	{
		echo "From prod class!";
	}

	public function newProduct() {
		$this->fromProdClass();
		$this->dbConnect();
	}
}

class User extends Database {
	public function doStuff() {
		$this->dbConnect();
	}
}

$userObj = new User();
$productObj = new Product();
echo $productObj->newProduct();
?>
