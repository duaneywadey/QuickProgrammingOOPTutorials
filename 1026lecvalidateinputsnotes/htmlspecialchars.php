<?php  

$string = "
		<!DOCTYPE html>
		<html lang='en'>
		<head>
			<meta charset='UTF-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>Document</title>
		</head>
		<body><h1>Lorem ipsum dolor sit amet, 
		 consectetur adipisicing elit.
		 Exercitationem quisquam iure modi 
		 inventore ratione, magni voluptate, 
		 natus distinctio perferendis porro 
		 atque expedita qui ad cupiditate! 
		 Facere autem in odit veritatis.></h1>
		</body>
		</html>
		";

echo "NO HTMLSPECIALS CHARS METHOD: " . $string . "<br><br>";

$stringHTMLSpecialChars = htmlspecialchars($string) . "<br><br>";
echo "WITH HTMLSPECIALCHARSMETHOD: " . $stringHTMLSpecialChars;

?>