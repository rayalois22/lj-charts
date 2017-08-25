<?php
/**
*
*LJCHARTS MODEL
*
*Responseible for all the backend processing
*
*Comprises a number of methods:
*
*@mod_login
*@mod_register
*@mod_newan
*@mod_newcm
*@mod_newcmr
*
*/
	class model{
/**
*
*connection
*
*A private $connection
*
*/
		private $connection;
/**
*
*constructor
*
*This is the ljcharts_forms constructor
*It initializes a a single private connection object
*to allow any of its functions to connect to the
*database if necessary
*
*/
		public function __construct(){
			$connection = new db_connection();
			$this->connection = $connection->connect();
}#end@FUNCTION @constructor
/**
*
*mod_login()
*
*accepts:
*@param string $username
*@param string $password
*
*/
		public function mod_login($username, $password){
			$ObjCHK = new db_check();
			$BLOWFISH = new blowfish();
			//first, check if the user exists
			if($ObjCHK->is_user($username)){
				if($phash = $ObjCHK->get_phash($username)){
					if($phash){
						if($BLOWFISH->isPassword($password, $phash)){
							//success
							$user = $ObjCHK->get_user($username);
							if($user){
								$_SESSION['user'] = $user;
								header('Location: ./?login&success=true');
							}
						}else{header('Location: ./?invalid_login');}
					}else{header('Location: ./?invalid_login');}
				}else{header('Location: ./?invalid_login');}
			}else{header('Location: ./?invalid_login');}
}#end@FUNCTION @mod_login
/**
*
*mod_register()
*
*accepts:
*@param string $firstname
*@param string $lastname
*@param string $username
*@param string $emailaddress
*@param string $role
*@param string $password
*@param array $profilepicture
*
*/
public function mod_register($firstname, $lastname, $username, $emailaddress, $role, $password, $profilepicture){
	$ObjCHK = new db_check();
	$BLOWFISH = new blowfish();
	//check if the user exists already
	if(!$ObjCHK->is_user($username)){
		if(!empty($profilepicture)){
			$img = [
				$profilepicture['name'],
				$profilepicture['type'],
				$profilepicture['tmp_name'],
				$profilepicture['error'],
				$profilepicture['size']
			];
			$profilepicture = $ObjCHK->upload_profimage($image, $username);
		} else {
			$profilepicture = 'default.png';
		}
		if($ObjCHK->create_new_user($firstname, $lastname, $username, $emailaddress, $role, $BLOWFISH->encrypt_password($password), $profilepicture)){
			print 'Success';
		} else {print 'Error';}
	}
}#end@FUNCTION mod_register
/**
*
*mod_newan()
*
*/
		public function mod_newan($an_name, $an_units){
			$ObjCHK = new db_check();
			if($ObjCHK->create_new_analyte($an_name, $an_units, $_SESSION['user']['userid'])){
				print '<em>'.$an_name.'</em> has been created.';
			} else {
				print 'Error';
			}
}#end@FUNCTION @mod_newan

		public function mod_get_all_analytes(){
			$ObjCHK = new db_check();
			$analyte = $ObjCHK->get_all_analytes();
			return $analyte;

		}#end@FUNCTION @mod_get_all_analytes
		public function mod_get_analyte_units($an_id){
			$ObjCHK = new db_check();
			$an_units = $ObjCHK->get_analyte_units($an_id);
		return $an_units;
		}
		public function mod_insert_material($cm_name, $an_id, $an_units,  $cm_level, $lotno, $mean, $sd){
			$ObjCHK = new db_check();
			$isSuccess= $ObjCHK->insert_material($cm_name, $an_id,$an_units,$_SESSION['user']['userid'], $cm_level, $lotno, $mean, $sd);

			if($isSuccess){
				print '<em>'.$cm_name.'</em> has been created.';
			}
			else{
				print  "error creating ". "<em>". $cm_name. "</em>";
			}

		}
}#end@CLASS

?>