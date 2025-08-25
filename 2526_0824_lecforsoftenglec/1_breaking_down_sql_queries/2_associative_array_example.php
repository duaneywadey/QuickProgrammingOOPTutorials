<?php

// Printing key value pairs example
$premiumIceCream = [
    1 => 'Madagascar Vanilla',
    2 => 'Belgian Chocolate',
    3 => 'Strawberry Cheesecake',
    4 => 'Mint Chocolate Chip',
    5 => 'Coffee',
    6 => 'Salted Caramel',
    7 => 'Pistachio',
    8 => 'Cookies and Cream',
    9 => 'Rocky Road',
    10 => 'Butter Pecan',
];

foreach ($premiumIceCream as $key => $value) {
    echo "ID:" . $key . " , Flavor: " . $value . "<br>";
}


// Implode function example
$latinAmericanCities = [
    'São Paulo',
    'Mexico City',
    'Buenos Aires',
    'Lima',
    'Bogotá',
    'Santiago',
];
$toStrlatinAmericanCities = implode("," , $latinAmericanCities);
echo "CONVERTED FROM ARRAY TO STR: " . $toStrlatinAmericanCities;
?>