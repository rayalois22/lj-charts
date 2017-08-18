<?php
	session_start();
	require_once "classesAutoload.php";
	if(isset($_POST["save_details"]) || isset($_POST["update_details"])) {

		$materialdesc = (isset($_POST["materialdesc"])? addslashes($_POST["materialdesc"]):"");
		$controllevel = (isset($_POST["controllevel"])?strtolower($_POST["controllevel"]):"");
		$lotnumber = (isset($_POST["lotnumber"])?$_POST["lotnumber"]:"");
		$controlvalue = (isset($_POST["controlvalue"])? $_POST["controlvalue"]:"");
		$stddev = (isset($_POST["stddeviation"])?$_POST["stddeviation"]:"");
		$an_id = (isset($_POST["select_analyte"])?$_POST["select_analyte"]:"");

		if(isset($_SESSION["qry"])){ 
			$sql =$_SESSION["qry"]." where an_id=".$an_id;
		}
		echo $sql;
		$analyte = $MYSQL->getResults($sql);
		foreach($analyte AS $array_analyte){
			echo $array_analyte['an_nits'];
			$controlmaterial_data = ["cm_name"=>$materialdesc, "cm_units"=>$array_analyte['an_nits'],"cm_level"=>$controllevel,
			"User_usr_id"=>$array_analyte['User_usr_id'], "Analyte_User_usr_id"=>$array_analyte['User_usr_id'], 
			"Analyte_an_id"=>$array_analyte['an_id'], "cm_sd"=>$stddev,"cm_LotNumber"=>$lotnumber];
		}
		if(isset($_POST["save_details"])){

			$controlMaterial_insert = $MYSQL->insert("ControlMaterial", $controlmaterial_data);
						
			if($controlMaterial_insert == TRUE){
				header("Location: ../materiallist.php");
				

			} 
			else { 
				print "error inserting record";
			}
		}
		elseif(isset($_POST["update_details"])){

			$update_material = $MYSQL->update($_SESSION["table_name"], $user_data, $where);
			if($update_material == TRUE){
				if(isset($_SESSION["editId"])){ 
					unset($_SESSION["editId"]); 
					header("Location: ./"); 
					exit();
				}

				else { 
					print $update_material; 
				}
			}
		}
		else{
		}
	}

?>
