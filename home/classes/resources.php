<?php
	class resources{
		public function get(){
			if(!isset($_SESSION['lang'])){
				require_once "home/lang/en.php";
				$_SESSION['lang'] = $lang;
			}
			$readers = dirname(__FILE__) . DIRECTORY_SEPARATOR . '../readers.php';
			require_once $readers;
		}
		public function set_lang($lang){
			require_once 'home/lang/'.strtolower($lang).'.php';
			$_SESSION['lang'] = $lang;
		}
	}
?>