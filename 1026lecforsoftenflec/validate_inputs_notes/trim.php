<?php  

$string = "          Lorem ipsum dolor, sit amet consectetur 
		   adipisicing elit. Aspernatur explicabo soluta 
		   tenetur excepturi deleniti quae expedita earum, 
		   qui praesentium culpa quidem quo 
		   dolore aut quos nobis! Nemo 
		   at repellat, totam!";

echo "NO TRIM FUNC: " . $string . "<br><br>";

$stringWithTrimFunc = trim($string) . "<br><br>";
echo "WITH TRIM FUNC: " . $stringWithTrimFunc;


?>