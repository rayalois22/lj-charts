<?php 
/**
*
*BLOWFISH
*
*RESPONSIBLE FOR THE ENCRYPTION/DECRYPTION OF SENSITIVE DATA/FILES
*
*/
	class blowfish{
		public function encrypt_password($password){if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){if(version_compare(PHP_VERSION, "5.5.0", ">=")){$enc = $this->the_bcrypt($password);return $enc;}else{function the_bcrypt($password, $cost = 7){$salt = "";$arr_salt_chars = array_merge( range('A','Z'), range('a','z'), range(0,9) );for($i=0; $i < 22; $i++){$salt .= $arr_salt_chars[array_rand($arr_salt_chars)];}if(version_compare(PHP_VERSION, "5.3.7", "<")){return crypt($password, sprintf('$2a$%02d$', $cost) . $salt);}else{return crypt($password, sprintf('$2y$%02d$', $cost) . $salt);}}$enc = the_bcrypt($password);return $enc;}}else{$enc = crypt($password);return $enc;}}
		public function isPassword($password, $password_hash){if(version_compare(PHP_VERSION, "5.5.0", ">=")){if(password_verify($password, $password_hash)){return true;}else{return false;}}else{if(crypt($password, $password_hash) == $password_hash){return true;}else{return false;}}}
		public function the_bcrypt($password, $rounds = 10){$crypt_params = array('cost' => $rounds);return password_hash($password, PASSWORD_BCRYPT, $crypt_params);}}
?>