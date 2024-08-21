<?php  

namespace App\School;
class Book {
	
	function __construct()
	{
		echo "from App\School\Book"  . "<br>";
	}
}

class BookTwo {
	
	function __construct()
	{
		echo "from App\School\BookTwo" . "<br>";
	}

}

class SchoolOne {
	function __construct()
	{
		echo "from AppSchoolOne"  . "<br>";
	}
}

namespace App\Cafe;
class CafeBook {
	
	function __construct()
	{
		echo "from App\Cafe\CafeBook"  . "<br>";
		
	}

}

class CafeFunction 
{
	
	function __construct()
	{
		echo "from App\Cafe\CafeFunction" . "<br>";
	}
}





?>