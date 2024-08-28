<?php 
require_once 'init.php';

// $data = Database::table('users');
// $data = Database::table('users')->select()->all();

$data = User::action()->getAll();
print_r($data);

?>