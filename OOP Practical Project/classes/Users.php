<?php 

class User 
{
	protected $instance;
	
	function __construct(argument)
	{
		// code...
	}

	public function action() {

		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getAll() {
		return DB::table('users')->select()->all();
	}

	public function getByID($id) {
		return DB::table('users')->select()->where("id = :id", ["id" => $id]);
	}
}


?>