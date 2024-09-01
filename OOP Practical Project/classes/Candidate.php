<?php 

class Candidate 
{
	protected static $instance;
	
	public static function action() {

		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getAll() {
		return Database::table('candidates')->select()->all();
	}

	public function getByID($candidate_id) {
		return Database::table('candidates')->select()->where("candidate_id = :candidate_id", ["candidate_id" => $candidate_id]);
	}
}


?>