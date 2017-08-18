<?php 
	//the connection class
	class db_connection{
		private $connection;
		public function connect(){
			$this->connection = new mysqli(DB_PARAMS["HOST"], DB_PARAMS["USER"], DB_PARAMS["PASS"], DB_PARAMS["DATABASE"]);
			if(!$this->connection->connect_errno){
				return $this->connection;
			} else {
				exit;
			}
		}
	}
?>