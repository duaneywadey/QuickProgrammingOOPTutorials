<?php 
require_once 'init.php';

// $data = Database::table('users');
// $data = Database::table('users')->select()->all();
// $data = User::action()->getAll();

$data = Candidate::action()->getByID(30);
echo "<pre>";
print_r($data);

?>