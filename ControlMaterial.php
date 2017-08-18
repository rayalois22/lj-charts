<?php
session_start();
	require_once "classes/classesAutoload.php";
	require "lang/en.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php $lang["materialtitle"]?></title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
<!-- 	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css"/>
 -->
</head>
<body>
<table style="margin-left:20%">
<tr>
<td style = "width: 50%">
			<form action = "classes/process.php" method = "POST">

				<fieldset >
				<legend>Material Details</legend>

					<table border = "0" align = "center" style = "width: 100%;" >

						<tr>
							<td style = "width: 100%;">
							<select class = "user_form" name="select_analyte">
							<?php 
								$sql ="select an_id, an_name,an_nits, User_usr_id from Analyte";
								$array_all_analyte = $MYSQL->getResults($sql);
								$_SESSION["qry"]=$sql;
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
								<input class = "user_form" type = "text" name ="materialdesc" placeholder = "<?php echo $lang["materialDesc"];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["material"]; ?>" required <?php } ?> required />
							</td>
						</tr> 
						<tr>
							<td style = "width: 100%;">
							<div class = "user_form">
                       			 <label><input type="radio" name="controllevel" value="High" />High</label>
                       			 <label><input type="radio" name="controllevel" value="Medium" />Med</label>
                        		<label><input type="radio" name="controllevel" value="Loaw" />Low</label>
                        		</div>
                  

							</td>
						</tr>
						</table>
				</fieldset>
				<fieldset ">
				<legend>Optional</legend>
				<table>
					<tr>
						<td>
							<input class = "user_form" type = "text" name = "lotnumber" placeholder = "<?php echo $lang["materiallotno"];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["lotnumber"]; ?>"<?php } ?>  />
						</td>
					</tr>
					<tr>
						<td>
							<input class = "user_form" type = "text" name = "controlvalue" placeholder = "<?php echo $lang["materialmean"];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["controlvalue"]; ?>"<?php } ?> required />
						</td>
					</tr>

					<tr>
						<td>
							<input class = "user_form" type = "text" name = "stddeviation" placeholder = "<?php echo $lang["materialstd"];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["stddeviation"]; ?>"<?php } ?>  />
						</td>
					</tr>


				</table>
				</fieldset>
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