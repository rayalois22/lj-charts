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

								print 'Analyte options...';


								$FM = new ljcharts_forms();
								$FM->fm_new_analyte();

								break;
							case 'cm':
								print 'Control material options...';
								$FM = new ljcharts_forms();
								$MOD = new model();
								$analytes = $MOD->mod_get_all_analytes();
								$FM->body_open();
								$FM->fm_control_material($analytes);
								//$FM->body_open();
								###########################################################
								#TODO: Jude, find a way to instantiate the forms here#
								#Then we will hook the below actions into the form#
								###########################################################
								//$FM->fm_new_analyte();
								//avail options to create, update, and delete an
								$FM->fm_options('an');
								break;
							case 'cmlst':
								$MOD = new model();
								$FM = new ljcharts_forms();
								$FM->body_open();
								$materials = $MOD->mod_get_all_materials();
								$FM->fm_material_listing($materials);
								###########################################################
								#TODO: Jude, find a way to instantiate the forms here#
								#Then we will hook the below actions into the form#
								###########################################################
								//avail options to create, update, and delete cm
								$FM->fm_options('cm');
								break;
							case 'cmr':
								$FM = new ljcharts_forms();
								$FM->body_open();
								###########################################################
								#TODO: Jude, find a way to instantiate the forms here#
								#Then we will hook the below actions into the form#
								###########################################################
								//avail options to create, update, and delete cmr
								$FM->fm_options('cmr');
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
				if(isset($_POST[readers['material']['save']])){
					$MOD = new model();
					$an_id = isset($_POST[readers['material']['select']])?$_POST[readers['material']['select']]:"";
					$an_units = $MOD->mod_get_analyte_units($an_id);
					$cm_name = isset($_POST[readers['material']['desc']])?$_POST[readers['material']['desc']]:"";
					$cm_level = isset($_POST[readers['material']['level']])?$_POST[readers['material']['level']]:"";
					$lotno = isset($_POST[readers['material']['lotno']])?$_POST[readers['material']['lotno']]:"";
					$cvalue = isset($_POST[readers['material']['cvalue']])?$_POST[readers['material']['cvalue']]:"";
					$sd = isset($_POST[readers['material']['stddev']])?$_POST[readers['material']['stddev']]:"";
					
					$MOD->mod_insert_material($cm_name,$an_id,$an_units,$cm_level,$lotno,$cvalue, $sd);
				}
				
				if (isset($_POST[readers['material']['update']])){}
				$FM = new ljcharts_forms();
				$FM->body_close();
				$HEADER = new ljcharts_header();
				$HEADER->set_header();
			}
		}
}
?>