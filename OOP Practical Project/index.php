<?php 
require_once 'init.php';

// $data = Database::table('users');
$data = Database::table('users')->select()->all();
print_r($data);

?>