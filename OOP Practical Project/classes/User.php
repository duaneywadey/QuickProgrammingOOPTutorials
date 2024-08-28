<?php 

class User 
{
	protected static $instance;
	
	public static function action() {

		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getAll() {
		return Database::table('users')->select()->all();
	}

	public function getByID($id) {
		return Database::table('users')->select()->where("id = :id", ["id" => $id]);
	}
}


?>