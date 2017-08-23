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
			//login form
			if((!isset($_SESSION['user'])) && (!isset($_POST[readers['login']['lo']])) && (!isset($_GET[readers['login']['re']])) && (!isset($_POST[readers['register']['re']]))){
				//Avail the forms
				$FM = new ljcharts_forms();
				$FM->fm_login();
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
						if(isset($_POST[readers['login']['lo']])){
				$MOD = new model();
				$MOD->mod_login(addslashes($_POST[readers['login']['un']]), addslashes($_POST[readers['login']['pw']]));
			}
			if(isset($_POST[readers['main_navigation']['cm']])){
				$MOD = new model();

			}
			//dashboard
			if(isset($_SESSION['user'])){
				$get = [];
				for($i=0; $i<count(array_keys(site['main_navigation'])); $i++){
					if(isset($_GET[array_keys(site['main_navigation'])[$i]])){
						switch(array_keys(site['main_navigation'])[$i]){
							case 'logout':
								unset($_SESSION['user']);
								header('Location: ./');
								exit();
							case 'an':
								print 'Analyte options...';

								break;
							case 'cm':
								print 'Control material options...';
								$FM = new ljcharts_forms();
								
								$FM->fm_control_material();
								break;
							case 'cmr':
								print 'Control material result options...';
								break;
							default:
								break;
						}
					}
				}
				$HEADER = new ljcharts_header();
				$HEADER->set_header();
			}
		}
}
?>