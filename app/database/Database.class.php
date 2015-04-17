<?php
	
	namespace App\database;

	use \PDO;

	class Database {

		private $db_name;
		private $db_user;
		private $db_pass;
		private $db_host;
		private $pdo;

		public function __construct($db_name, $db_user = 'root', $db_pass = '123456', $db_host = 'localhost') {
			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->db_host = $db_host;
		}

		private function getPDO(){
			if ($this->pdo === null) {
				$pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.'', $this->db_user, $this->db_pass);
				$this->pdo = $pdo;
			}
			return $this->pdo;
		}

		public function query($statement){
			if ($this->getPDO()->query($statement))
				return (1);
			return (0);
		}

		public function query_select($statement){
			$req = $this->getPDO()>query($statement);
			$data = $res->fetchAll(PDO::FECTH_OBJ);
			return $data;
		}

	}

?>