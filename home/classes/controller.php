<?php
/**
*
*LJCHARTS CONTROLLER
*
*Receives and redirects all requests for resources on ljcharts as needed
*
*/
	class controller{
		public function control(){
			//language options -- changes the language
			if(isset($_GET['lang'])){
				$RES = new resources();
				$RES->set_lang($_GET['lang']);
				$RES->get();
			}
			//login form
			if((!isset($_SESSION['user'])) && (!isset($_POST[readers['login']['lo']])) && (!isset($_GET[readers['login']['re']])) && (!isset($_POST[readers['register']['re']]))){
				//Avail the forms
				$FM = new ljcharts_forms();
				$FM->fm_login_new();
				exit();
			}
			//registration form
			if(isset($_GET[readers['login']['re']])){
				$FM = new ljcharts_forms();
				$FM->fm_register();
				exit();
			}
			//register new user
			if(isset($_POST[readers['register']['re']])){
				$MOD = new model();
				$MOD->mod_register(addslashes($_POST[readers['register']['fn']]), addslashes($_POST[readers['register']['ln']]), addslashes($_POST[readers['register']['un']]), addslashes($_POST[readers['register']['em']]), addslashes($_POST[readers['register']['ro']]), addslashes($_POST[readers['register']['pw']]), $_FILES[readers['register']['pi']]);
				header('Location: ./');
			}
			//login
			if(isset($_POST[readers['login']['lo']])){
				$MOD = new model();
				$MOD->mod_login(addslashes($_POST[readers['login']['un']]), addslashes($_POST[readers['login']['pw']]));
			}
			//dashboard
			if(isset($_SESSION['user'])){
				for($i=0; $i<count(array_keys(site['main_navigation'])); $i++){
					if(isset($_GET[array_keys(site['main_navigation'])[$i]])){
						switch(array_keys(site['main_navigation'])[$i]){
							case 'logout':
								unset($_SESSION['user']);
								unset($_SESSION['lang']);
								header('Location: ./?logout=true');
								exit;
							case 'an':
								$FM = new ljcharts_forms();
								$FM->fm_new_analyte();
								break;
							case 'cm':
								print 'Control material options...';
								break;
							case 'cmr':
								print 'Control material result options...';
								break;
							default:
								break;
						}
					}
				}
				if(isset($_POST[readers['an']['create']])){
					$MOD = new model();
					$MOD->mod_newan(addslashes($_POST[readers['an']['name']]), addslashes($_POST[readers['an']['units']]));
				}
				$HEADER = new ljcharts_header();
				$HEADER->set_header();
			}
		}
}
?>