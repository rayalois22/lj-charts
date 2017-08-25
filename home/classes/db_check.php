<?php 
	date_default_timezone_set("Africa/Nairobi");
/**
*
*DB_CHECK
* 
*RESPONSIBLE FOR DATABASE 'CRUD' OPERATIONS
*
*/
	class db_check{//@@author:rayalois22
		private $connection;
		public function __construct(){$db = new db_connection();$this->connection = $db->connect();}
		public function lastaccess($userid){if($statement = $this->connection->prepare("UPDATE `user` SET `usr_access_time` = ? WHERE `usr_id` = ?")){$accesstime = date("YmdHis", time());if($statement->bind_param("ss", $accesstime, $userid)){if($statement->execute()){if(!$this->connection->errno){return true;}else{return false;}}else{return false;}}else{return false;}}else{return false;}}
		public function is_user($username){if($statement = $this->connection->prepare("SELECT * FROM `user` WHERE `usr_username` = ?")){if($statement->bind_param("s", $username)){if($statement->execute()){$statement->store_result();if($statement->num_rows > 0){$statement->close();return true;}else{$statement->close();return false;}}else{return false;}}else{return false;}}else{return false;}}
		public function get_phash($username){if($statement = $this->connection->prepare("SELECT `usr_password` FROM `user` WHERE `usr_username` = ?")){if($statement->bind_param("s", $username)){if($statement->execute()){if($statement->bind_result($token1)){while($statement->fetch()){$password_hash = $token1;}$statement->close();return $password_hash;}else{return false;}}else{return false;}}else{return false;}}else{return false;}}
		public function get_user($username){if($statement = $this->connection->prepare("SELECT * FROM `user` WHERE `usr_username` = ?")){if($statement->bind_param("s", $username)){if($statement->execute()){if($statement->bind_result($token1, $token2, $token3, $token4, $token5, $token6, $token7, $token8, $token9, $token10)){if($statement->store_result()){if($statement->num_rows > 0){if($statement->fetch()){$user = ["userid"=> $token1,"firstname"=> $token2,"lastname"=> $token3,"username"=> $token4,"email"=> $token5,"role"=> $token6,"profileimage"=> $token8,"status"=> $token9,"accesstime"=> $token10];return $user;}else{return false;}}else{return false;}}else{return false;}}else{return false;}}else{return false;}}else{return false;}}else{return false;}}
		public function create_new_user($firstname, $lastname, $username, $emailaddress, $role, $password, $profilepicture){$accesstime = date('YmdHis', time());$userid = "";$userstatus = 1;if($statement = $this->connection->prepare("INSERT INTO `user`(`usr_id`, `usr_first_name`, `usr_last_name`, `usr_username`, `usr_email`, `usr_role`, `usr_password`, `usr_profile_image`, `usr_status`, `usr_access_time`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){if($statement->bind_param("ssssssssss", $userid, $firstname, $lastname, $username, $emailaddress, $role, $password, $profilepicture, $userstatus, $accesstime)){if($statement->execute()){$statement->close();if( $this->is_user($username) ){return true;}else{return false;}}else{return false;}}else{return false;}}else{return false;}}
		public function upload_profimage($image, $username){$str_file_name = $image[0];$arr_file_name = explode(".", $str_file_name);$profimage_ext = end($arr_file_name);$profimage_types = array("image/jpg", "image/JPG", "image/png", "image/PNG", "image/jpeg", "image/JPEG");$profimage_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . '../images/upload/profiles/';$profimage_name = mt_rand(10000, 99000) . '_' . $username . '_' . '.';$profimage_dest = $profimage_dir . $profimage_name . $profimage_ext;if( in_array($image[1], $profimage_types) ){if(isset($image[1])){if(move_uploaded_file($image[2], $profimage_dest)){$profimage = $profimage_name . $profimage_ext;}else{$profimage = "default.png";}}else{$profimage = "default.png";}}else{$profimage = "default.png";}return $profimage;}
		public function create_new_analyte($an_name, $an_units, $usr_id){if($statement = $this->connection->prepare("INSERT INTO `analyte`(`an_id`, `an_name`, `an_HighControl`, `an_NormalControl`, `an_LowControl`, `usr_id`, `an_units`, `an_created_on`) VALUES('',?,'','','',?,?,?)")){$an_created_on = date('YmdHis', time());if($statement->bind_param("ssss", $an_name, $usr_id, $an_units, $an_created_on)){if($statement->execute()){$statement->close();if($this->is_analyte($an_name, $usr_id)){return true;}else{return false;}}else{return false;}}else{return false;}}else{return false;}}
		public function is_analyte($an_name, $usr_id){if($statement = $this->connection->prepare("SELECT * FROM `analyte` WHERE `an_name` = ? AND `usr_id` = ?")){if($statement->bind_param("ss", $an_name, $usr_id)){if($statement->execute()){if($statement->store_result()){if($statement->num_rows > 0){$statement->close();return true;}else{$statement->close();return false;}}else{$statement->close();return false;}}else{$statement->close();return false;}}else{ $statement->close();return false;}}else{return false;}}
		
		public function get_all_analytes(){if($result = $this->connection->query("SELECT an_id, an_name, an_units  FROM `analyte`")){for ($res = array (); $row = $result->fetch_assoc(); $res[] = $row); return $res;}else{return false;}}
		
		public function get_analyte_units($an_id){ if($statement = $this->connection->prepare("SELECT an_units FROM `analyte` WHERE `an_id` = ?")) { if($statement->bind_param("i", $an_id)){ if($statement->execute()){ if($statement->bind_result($an_units)){ if($statement->store_result()){if($statement->num_rows > 0){ if($statement->fetch()){ return $an_units; } else{ return false;} } else{return false;} } else{return false;} } else{return false;} } else{return false;} } else{return false;} } else{return false;}}

		public function is_material($cm_name, $usr_id){if($statement = $this->connection->prepare("SELECT * FROM `controlmaterial` WHERE `cm_name` = ? AND `usr_id` = ?")){if($statement->bind_param("ss", $cm_name, $usr_id)){if($statement->execute()){if($statement->store_result()){if($statement->num_rows > 0){$statement->close();return true;}else{$statement->close();return false;}}else{$statement->close();return false;}}else{$statement->close();return false;}}else{ $statement->close();return false;}}else{return false;}}
		public function insert_material($cm_name, $an_id, $an_units, $usr_id, $cm_level, $lotno, $mean, $sd) {
			if($this->is_material($cm_name, $usr_id)){
				return false;
			}else{
				if($statement = $this->connection->prepare("INSERT INTO `controlmaterial`(`cm_name`,`an_id`,`cm_units`, `usr_id`,`cm_lot_number`,`cm_level`,`cm_mean`,`cm_sd`) VALUES(?,?,?,?,?,?,?,?)")){
					if($statement->bind_param("sdssssdd", $cm_name, $an_id, $an_units, $usr_id, $lotno, $cm_level,$mean, $sd)){
						if($statement->execute())	{
							$statement->close();
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}
				else{
					return false;
				}
			}
		}

}

?>