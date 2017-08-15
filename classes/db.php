<?php
//session_start();
class Db{

	private $conn;

	public function __construct($DB_TYPE,$DB_HOST,$DB_NAME,$DB_USER,$DB_PASS,$DB_PORT) {
		$this->type     = $DB_TYPE;
		$this->host     = $DB_HOST;
		$this->dbname   = $DB_NAME;
		$this->user     = $DB_USER;
		$this->pass     = $DB_PASS;
		$this->port     = $DB_PORT;
		$this->getConnection();
		$_SESSION["dbconn"] = $this->conn;
	}

	/******************************************************************************************
	create connection to datbase
	******************************************************************************************/

	public function getConnection(){
		switch ($this->type) {
			case 'mysqli':
				if($this->port<>Null){
					$this->host.=":".$this->port;
				}
				$this->conn = new mysqli($this->host,$this->user,$this->pass, $this->dbname);
				if ($this->conn->connect_error) { return "Connection failed: " . $this->conn->connect_error; }
				break;
			case 'mysql':
				if($DB_PORT<>Null){
					$this->host.=":".$DB_PORT;
				}
				$this->conn = mysqli_connect($this->host,$this->user,$this->pass,$this->name);
				if (mysqli_connect_errno()){ return "Connection failed: " . mysqli_connect_error(); }
				break;
		}
	}

	/******************************************************************************************
	Query table in database to obtain results
	******************************************************************************************/
	public function getResults($sql){
		switch ($this->type) {
			case 'mysqli':
			    $result = $this->conn->query($sql);
			    if ($result) {

				 for ($res = array (); $row = $result->fetch_assoc(); $res[] = $row);
				 	
				}
				else{
    				throw new Exception("Database Error [{$this->conn->errno}] {$this->conn->error}");
				}

			    return $res;
			    break;
			case 'mysql':
			    $result = mysqli_query($this->conn,$sql);
			    $res    = mysqli_fetch_all($result,MYSQLI_ASSOC);
			    return $res;
			    break;
			}
	 }
	/******************************************************************************************
	Select Query From a DataBase
	******************************************************************************************/
	public function select($sql){
		switch ($this->type) {
			case 'mysqli':
				$result = $this->conn->query($sql);
				$res    = $result->fetch_assoc();
				return $res;
				break;
			case 'mysql':
				$result = mysqli_query($this->conn,$sql);
				$res    = mysqli_fetch_all($result,MYSQLI_ASSOC);
				return $res;
				break;
		}
        }

}


?>
