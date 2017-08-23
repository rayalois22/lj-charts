<?php
/**
*
*LJCHARTS_FORMS
*
*GENERATES ALL FORMS USED ON LJCHARTS
*
*Comprises a number of methods (each method is a form)
*
*@fm_login
*@fm_register
*@fm_new_analyte
*@fm_new_control_material
*@fm_new_control_material_result
*
*/
	class ljcharts_forms{
/**
*
*fm_login()
*@@author:rayalois22
*@@author:julietwangari
*
*The login form
*
*/
		public function fm_login(){
?><div><form action="./" method="post">
<table>
	<thead>
		<tr>
			<th><?php echo forms['login']['ti']; ?></th>
		</tr>
	</thead><!-- title -->
	<tbody>
		<tr>
			<td><label><?php echo forms['login']['un']; ?></label></td>
			<td><input id="" type="Name" name="<?php echo readers['login']['un']; ?>" placeholder="" required autofocus /></td>
		</tr>
		<tr>
			<td><label for=""><?php echo forms['login']['pw']; ?></label></td>
			<td><input id="" type="password" name="<?php echo readers['login']['pw']; ?>" required /></td>
		</tr>
	</tbody><!-- body -->
	<tfoot>
		<tr>
			<td><input type="submit" name="<?php echo readers['login']['lo']; ?>" value="<?php echo forms['login']['lo']; ?>" /></td><td><a href="./?<?php echo readers['login']['re']; ?>"><?php echo forms['login']['re']; ?></a></td>
		</tr>
	</tfoot><!-- foot -->
</table>
</form></div><?php
}#end@FUNCTION @fm_login
/*
*
*fm_register()
*@@author:rayalois22
*
*User registration form
*
*/
		public function fm_register(){
?><div><form action="./" method="post" enctype="multipart/form-data">
<table>
	<thead>
		<tr><th><?php echo forms['register']['ti']; ?></th></tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table>
					<tr><td><?php echo forms['register']['fn']; ?></td></tr>
					<tr><td><?php echo forms['register']['ln']; ?></td></tr>
					<tr><td><?php echo forms['register']['un']; ?></td></tr>
					<tr><td><?php echo forms['register']['em']; ?></td></tr>
					<tr><td><?php echo forms['register']['ro']; ?></td></tr>
					<tr><td><?php echo forms['register']['pi']; ?></td></tr>
					<tr><td><?php echo forms['register']['pw']; ?></td></tr>
					<tr><td><?php echo forms['register']['cpw']; ?></td></tr>
				</table>
			</td>
			<td>
				<table>
					<tr><td><input type="name" name="<?php echo readers['register']['fn']; ?>" required autofocus /></td></tr>
					<tr><td><input type="name" name="<?php echo readers['register']['ln']; ?>" /></td></tr>
					<tr><td><input type="name" name="<?php echo readers['register']['un']; ?>" required /></td></tr>
					<tr><td><input type="email" name="<?php echo readers['register']['em']; ?>" required /></td></tr>
					<tr><td><select name="<?php echo readers['register']['ro']; ?>">
								<option><?php echo forms['register']['staff']; ?></option>
								<option><?php echo forms['register']['admin']; ?></option>
							</select></td>
					</tr>
					<tr><td><input type="file" name="<?php echo readers['register']['pi']; ?>" /></td></tr>
					<tr><td><input type="password" name="<?php echo readers['register']['pw']; ?>" required /></td></tr>
					<tr><td><input type="password" name="<?php echo readers['register']['cpw']; ?>" /></td></tr>
				</table>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr><th><input type="submit" name="<?php echo readers['register']['re']; ?>" value="<?php echo forms['register']['re']; ?>"/></th><th><input type="submit" name="<?php echo readers['register']['cancel']; ?>" value="<?php echo forms['register']['cancel']; ?>" /></th></tr>
	</tfoot>
</table>
</form></div><?php
}#end@FUNCTION @fm_register
/**
*
*@fm_new_control_material
*@@author:jkikuyu
*
*/
		public function fm_control_material(){
?><table style="margin-left:20%">
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
			<td></td>
		</tr>
</form>
</table><?php	
}#end@FUNCTION @fm_new_control_material
}#end@CLASS
?>