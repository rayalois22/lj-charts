<?php 
	class config{
		public function __construct(){
			$this->db_params();
		}
		private function db_params(){
			$db_args = array("localhost", "root", "root", "lj_charts_db");
			$db_fields = array("HOST", "USER", "PASS", "DATABASE");
			$db_args = array_combine($db_fields, $db_args);
			define("DB_PARAMS", $db_args);
		}
	}
?>