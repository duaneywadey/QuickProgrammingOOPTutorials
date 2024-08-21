<?php  
require_once '9a_namespace_tutorial.php';


use App\School;
use App\Cafe;

$a = new School\Book();
$b = new School\BookTwo();
$c = new School\SchoolOne();

echo "Below are from App\Cafe" . "<br>";
$d = new Cafe\CafeBook();
$e = new Cafe\CafeFunction();

?>