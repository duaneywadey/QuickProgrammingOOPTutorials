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

	public function updateById($values,$id) {
		return DB::table('users')->update($values)->where("id = :id", ["id"=>$id]);
	}

	public function getAll() {
		return Database::table('users')->select()->all();
	}

	public function getByID($user_id) {
		return Database::table('users')->select()->where("user_id = :user_id", ["user_id" => $user_id]);
	}
}


?>