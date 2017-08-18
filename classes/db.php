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
	Insert Query
	******************************************************************************************/

	public function insert($table,$data){
		switch ($this->type) {
		  case 'mysqli':
			  ksort($data);
			  $fieldDetails = NULL;
			  $fieldNames = implode('`, `',  array_keys($data));
			  $fieldValues = "" . implode("', '",  array_values($data));
			  $sth = "INSERT INTO $table (`$fieldNames`) VALUES ('$fieldValues')";
				if ($this->conn->query($sth) === TRUE) { return 'TRUE'; } else { return "Error: " . $sth . "<br />" . $this->conn->error; }
			  break;
		  case 'mysql':
			  ksort($data);
			  $fieldDetails = NULL;
			  $fieldNames = implode('`, `',  array_keys($data));
			  $fieldValues = "" . implode("', '",  array_values($data));
			  $sth = "INSERT INTO $table (`$fieldNames`) VALUES ('$fieldValues')";
			  if (mysqli_query($this->conn,$sth)) { return 'true'; }else{ return 'false';}
			  break;
		}
	}
	/******************************************************************************************
	Update Query
	******************************************************************************************/
	public function update($table,$data,$where){
		switch ($this->type) {
		  case 'mysqli':
			  $wer = '';
			  if(is_array($where)){
			    foreach ($where as $clave=>$valor){
			      $wer.= $clave."='".$valor."' AND ";
			    }
			    $wer   = substr($wer, 0, -4);
			    $where = $wer;
			  }
			  ksort($data);
			  $fieldDetails = NULL;
			  foreach ($data as $key => $values){
			      $fieldDetails .= "$key='$values',";
			  }
			  $fieldDetails = rtrim($fieldDetails,',');
			  if($where==NULL or $where==''){
			    $sth = "UPDATE $table SET $fieldDetails";
			  }else {
			    $sth = "UPDATE $table SET $fieldDetails WHERE $where";
			  }
				if ($this->conn->query($sth) === TRUE) { return 'TRUE'; } else { return "Error: " . $sth . "<br />" . $this->conn->error; }
			  break;
		  case 'mysql':
			  $wer = '';
			  if(is_array($where)){
			    foreach ($where as $clave=>$valor){
			      $wer.= $clave."='".$valor."' AND ";
			    }
			    $wer   = substr($wer, 0, -4);
			    $where = $wer;
			  }
			  ksort($data);
			  $fieldDetails = NULL;
			  foreach ($data as $key => $values){
			      $fieldDetails .= "$key='$values',";
			  }
			  $fieldDetails = rtrim($fieldDetails,',');
			  if($where==NULL or $where==''){
			    $sth = "UPDATE $table SET $fieldDetails";
			  }else {
			    $sth = "UPDATE $table SET $fieldDetails WHERE $where";
			  }
			  if (mysqli_query($this->conn,$sth)) { return 'true'; }else{ return 'false';}
			  break;
		}
	}
	/******************************************************************************************
	Delete Query
	******************************************************************************************/
	public function delete($table,$where){
		switch ($this->tipo) {
		  case 'mysqli':
			  $wer = '';
			  if(is_array($where)){
			    foreach ($where as $clave=>$valor){
			      $wer.= $clave."='".$valor."' and ";
			    }
			    $wer   = substr($wer, 0, -4);
			    $where = $wer;
			  }
			  if($where==NULL or $where==''){
			    $sth = "DELETE FROM $table";
			  }else{
			    $sth = "DELETE FROM $table WHERE $where";
			  }
				if ($this->connection->query($sth) === TRUE) { return 'TRUE'; } else { return "Error: " . $sth . "<br />" . $this->connection->error; }
			  break;
				case 'mysql':
			  $wer = '';
			  if(is_array($where)){
			    foreach ($where as $clave=>$valor){
			      $wer.= $clave."='".$valor."' and ";
			    }
			    $wer   = substr($wer, 0, -4);
			    $where = $wer;
			  }
			  if($where==NULL or $where==''){
			    $sth = "DELETE FROM $table";
			    if (mysqli_query($this->connection,$sth)) { return 'true'; }else{ return 'false';}
			  }else{
			    $sth = "DELETE FROM $table WHERE $where";
			    if (mysqli_query($this->connection,$sth)) { return 'true'; }else{ return 'false';}
			  }
			  break;
		}
	}


}


?>
