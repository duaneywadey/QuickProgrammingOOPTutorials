<?php  

$string = "\Lorem \ipsum \dolor, \sit \amet \consectetur 
		   \adipisicing elit. \Aspernatur 
		   \explicabo \soluta \enetur \excepturi \deleniti 
		   \quae \expedita \earum, \qui \praesenium 
		   \culpaquidem \quo \dolore \aut \quos nobis! Nemo 
		   at repellatotam!";

echo "NO STRIPSLASHES: ". $string . "<br><br>";

$stringStripSlashes = stripslashes($string) . "<br><br>";
echo "WITH STRIPSLASHES: ".  $stringStripSlashes;


?>