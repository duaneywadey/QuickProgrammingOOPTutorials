<?php  

$string = "       Lorem ipsum dolor, sit amet 
		   consectetur adipisicing elit. 
		   Aspernatur explicabo soluta 
		   tenetur excepturi deleniti quae 
		   expedita earum, qui praesentium 
		   culpa quidem quo dolore aut 
		   quos nobis! Nemo at 
		   repellat, totam!";

$stringWithTrimFunc = trim($string);
$stringArray = array();
array_push($stringArray, $string);
array_push($stringArray, $stringWithTrimFunc);

echo "<pre>";
print_r($stringArray);
echo "<pre>";

?>
