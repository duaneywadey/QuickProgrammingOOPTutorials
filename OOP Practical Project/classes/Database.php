<?php  

class Database {

	protected static $instance;
	protected static $conn;
	protected static $table;
	protected $query;
	protected $values = array();
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
		$this->query_type = "SELECT";
		$this->query = "SELECT * FROM " . self::$table . " ";
		return self::$instance;
	}

	protected function run($values = array()) {
		$stmt = self::$conn->prepare($this->query);
		$check = $stmt->execute($values);

		if ($check) {
			switch ($this->query_type) {
				case 'select':
					$data = $stmt->fetchAll();
					if (is_array($data) && count($data) > 0) {
						return $data;
					}
					break;

				case 'update':
					$values = array_merge($this->values, $values);
					$this->query .= " WHERE" . $where;
					return $this->run($values);
					break;

				case 'insert':
					return true;
					break;

				case 'delete':
					break;
				

				default:
					break;
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
		switch ($this->query_type) {
			case 'SELECT':
				$this->query .= " WHERE ". $where;
				return $this->run($values);
				break;

			case 'UPDATE':
				$values = array_merge($this->values, $values);
				$this->query .= " WHERE ". $where;
				return $this->run($values);
				break;
			
			default:
				// code...
				break;
		}
	}

	public function update(array $values) {
		$this->query_type = "UPDATE";
		$this->query = "UPDATE " . self::$table . " SET ";
		
		foreach ($values as $key => $value) {
			$this->query .= $key . "= :" . $key;
		}

		$this->query = trim($this->query, ",");
		$this->values = $values;
		return self::$instance;
	}
}
?>