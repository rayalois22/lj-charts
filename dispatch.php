<?php
	session_start();
	require_once "classes/classesAutoload.php";

	if(isset($_GET["viewId"])){
		if(is_numeric($_GET["viewId"])){
			$viewId = $_GET["viewId"];
			list($editId, $arr_hobbies, $spot_pers_edit_row, $arr_spot_hobbies, $spot_hobbies_row) = $ObjProc->spot_edit_user($MYSQL);
			$ObjUdis->modal_fetch($spot_pers_edit_row);
		}
	}

	if(isset($_GET["editId"])){
		if(is_numeric($_GET["editId"])){
			$_SESSION["editId"] = $_GET["editId"];
			header("location: user_form.php");
			exit();
		}
	}
?>
