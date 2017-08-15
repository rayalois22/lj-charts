<?php
session_start();
	require_once "classes/classesAutoload.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>$lang["materialtitle"]</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" />

</head>
<body>
<table>
<tr>
<td style = "width: 50%">
	<fieldset style = "width: 50%;">
		<table border = "0" align = "center" style = "width: 100%;" >
			<form action = "controlmaterial.php" method = "POST" enctype = "multipart/form-data">
				<tr>
					<td style = "width: 100%;">
					<select class = "user_form" name="selec_analyte">
					<?php 
						$sql ="select an_id, an_name,an_nits from Analyte";
						$array_all_analyte = $MYSQL->getResults($sql);
						foreach($array_all_analyte as $array_analyte){?>
						<option value="<?php echo $array_analyte['an_id'] ?>"><?php echo $array_analyte['an_name']?></option>
						<?php
						}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<td style = "width: 100%;">
						<input class = "user_form" type = "text" name = "materialdesc" placeholder = "<?php echo $lang["materialDesc"];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["material"]; ?>" required <?php } ?> autofocus required />
					</td>
				</tr> 
				<tr>
					<td style = "width: 100%;">
						<input class = "user_form"  type = "radiobutton" name = "materialhigh" placeholder = "<?php echo $lang["materialhigh"];?>"<?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["matrialhigh"]; ?>"<?php } ?>  />
					</td>
				</tr>
				<tr>
					<td>
						<input class = "user_form" type = "text" name = "lotnumber" placeholder = "<?php echo $lang["materiallotno"];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["lotnumber"]; ?>"<?php } ?> required />
						</td>
					</tr>
					<tr>
					<td >
					<?php if(isset($_SESSION['editId'])){ ?>
						<input class = "user_form" type = "submit" name = "update_details" value = "<?php echo $lang["updatedetailsbutton"]; ?>" />
					
					<?php }else{ ?>
						<Button type = "submit" name = "save_details"> <?php echo $lang["savedetails"]; ?> </Button> 

					<Button class="cancelbtn" type = "Cancel" OnClick = "parent.location='./'"> <?php echo $lang["cancel"]; ?> </Button>					

					</td>
					<?php } ?>
					<td>
					</td>
					</tr>

		</form>
		</table>

</body>
</html>