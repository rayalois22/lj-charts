<?php
	class resources{
		public function __construct(){
			//constants
			$lang = dirname(__FILE__) . DIRECTORY_SEPARATOR . '../lang/en.php';
			require_once $lang;
			$readers = dirname(__FILE__) . DIRECTORY_SEPARATOR . '../readers.php';
			require_once $readers;
		}
	}
?>