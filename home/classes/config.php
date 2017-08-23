<?php 
	class config{
		public function __construct(){
			$this->db_params();
		}
		private function db_params(){
			//$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
			//$db_args = array($url["host"], $url["user"], $url["pass"], substr($url["path"], 1));
			$db_args = array("localhost", "root", "mysql", "lj_charts_db");
			$db_fields = array("HOST", "USER", "PASS", "DATABASE");
			$db_args = array_combine($db_fields, $db_args);
			define("DB_PARAMS", $db_args);
		}
	}

?>
