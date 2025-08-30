<?php
// Names and their favorite ice cream flavor
$premiumIceCream = [
    'Alice' => 'Madagascar Vanilla', 'Brian' => 'Belgian Chocolate',
    'Chloe' => 'Strawberry Cheesecake', 'David' => 'Mint Chocolate Chip',
    'Emma' => 'Coffee', 'Finn' => 'Salted Caramel',
    'Grace' => 'Pistachio', 'Henry' => 'Cookies and Cream',
    'Isla' => 'Rocky Road', 'Jack' => 'Butter Pecan',
];

// Printing key value pairs example
foreach ($premiumIceCream as $key => $value) {
    echo "Name: " . $key . " , Favorite Flavor: " . $value . "<br>";
}


// Array keys example
echo "<pre>";
print_r(array_keys($premiumIceCream));
echo "<pre>";

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