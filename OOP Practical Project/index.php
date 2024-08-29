<?php 
require_once 'init.php';

// $data = Database::table('users');
// $data = Database::table('users')->select()->all();
// $data = User::action()->getAll();

$data = User::action()->getByID(26);
echo "<pre>";
print_r($data);

?>