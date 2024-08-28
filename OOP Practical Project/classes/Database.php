<?php  

class Database {

	protected static $instance;
	protected static $conn;
	protected static $table;
	protected $query;
	protected $query_type;

	public static function table($table) {
		
		self::$table = $table;

		if (!self::$instance) {
			self::$instance = new self();
		}

		if (!self::$conn) {
			try {
				$dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
				self::$conn = new PDO($dsn, DBUSER, DBPASS);
			} catch (Exception $e) {
				echo $e->getMessage();
				die; 
			}
		}
		return self::$instance;
	}

	public function select() {
		$this->query = "SELECT * FROM " . self::$table . " ";
		return self::$instance;
	}

	protected function run($values = array()) {
		$stmt = self::$conn->prepare($this->query);
		$check = $stmt->execute($values);
		if ($check) {
			$data = $stmt->fetchAll();
			if (is_array($data) && count($data) > 0) {
				return $data;
			}
		}

	}

	public function all() {
		$stmt = self::$conn->prepare($this->query);
		$check = $stmt->execute();
		if ($check) {
			$data = $stmt->fetchAll();
			if (is_array($data) && count($data) > 0) {
				return $data;
			}
		}
	}

	public function where($where, $values=array()) {
		$this->query.= " WHERE " . $where;
		return $this->run($values);
	}

	public function update() {
		return self::$instance;
	}
}
?>