<?php

class Database  
{
	static public $number = 0;

	public function __construct() {
		self::$number+=10;
		echo "Database constructor <br>";
	}

	public function dbConnect() {
		echo "from dbConnect function <br>";
	}

	public function dbRead() {
		echo "from dbRead function <br>";
	}

	public function dbWrite() {
		echo "from dbWrite function <br>";
	}

}

class Product extends Database {
	
	public function __construct() {
		parent::__construct();
		self::$number+=10;
		echo "from product class function <br>";
	}

	public function newProduct() {
		echo "from product class function <br>";
	}
}

class User extends Product {
	
	public function __construct() {
		parent::__construct();
		self::$number += 10;
		echo "from user constructor <br>";
	}

	public function doStuff() {
		$this->dbRead();
	}

}

echo User::$number;

class DatabaseNotStatic
{
	public $numberNotStatic = 0;

	public function __construct($number) {
		$this->numberNotStatic += 10;
		echo "Database constructor <br>";
	}

	public function dbConnect() {
		echo "from dbConnect function <br>";
	}

	public function dbRead() {
		echo "from dbRead function <br>";
	}

	public function dbWrite() {
		echo "from dbWrite function <br>";
	}

}

class ProductNotStatic extends DatabaseNotStatic {
	
	public function __construct() {
		$this->numberNotStatic += 20;
		echo "from product class function <br>";
	}

	public function newProduct() {
		echo "from product class function <br>";
	}
}

class UserNotStatic extends ProductNotStatic {
	
	public function __construct() {
		$this->numberNotStatic += 30;
		echo "from usernotstatic constructor <br>";
	}

	public function doStuff() {
		$this->dbRead();
	}

}

$userNotStaticObj = new UserNotStatic();
echo $userNotStaticObj->doStuff();




?>