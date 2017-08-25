<?php
/**
*
*LJCHARTS_FORMS
*
*GENERATES ALL $_SESSION['lang']['forms'] USED ON LJCHARTS
*
*Comprises a number of methods (each method is a form)
*
*@fm_login
*@fm_register
*@fm_new_analyte
*@fm_new_control_material
*@fm_new_control_material_result
*@fm_login_new
*
*/
	class ljcharts_forms{
/**
*
*body_open()
*body_close()
*
*To avoid problems with http headers, 
*@body_open should be called before outputting any content
*@body_close should be called when all output has been done
*
*/
		public function body_open(){
			?>
				<section class="main_content" id="main_content">	
			<?php
		}
		public function body_close(){
			?>
				</section>
			<?php
		}
/**
*
*fm_login()
*@@author:rayalois22
*@@author:julietwangari
*TODO: REMOVE THIS FORM...It has been replaced by @fm_login_new()
*
*The login form
*
*/
		public function fm_login(){
?><div><form action="./" method="post">
<fieldset>
	<legend><?php echo $_SESSION['lang']['forms']['login']['ti']; ?></legend>
	<table>
		<tbody>
			<tr>
				<td><label><?php echo $_SESSION['lang']['forms']['login']['un']; ?></label></td>
				<td><input id="" type="Name" name="<?php echo readers['login']['un']; ?>" placeholder="" required autofocus /></td>
			</tr>
			<tr>
				<td><label for=""><?php echo $_SESSION['lang']['forms']['login']['pw']; ?></label></td>
				<td><input id="" type="password" name="<?php echo readers['login']['pw']; ?>" required /></td>
			</tr>
		</tbody><!-- body -->
		<tfoot>
			<tr>
				<td><input type="submit" name="<?php echo readers['login']['lo']; ?>" value="<?php echo $_SESSION['lang']['forms']['login']['lo']; ?>" /></td><td><a href="./?<?php echo readers['login']['re']; ?>"><?php echo $_SESSION['lang']['forms']['login']['re']; ?></a></td>
			</tr>
		</tfoot><!-- foot -->
	</table>
</fieldset>
<fieldset>
	<legend>Language</legend>
	<ul>
		<li><a href="./?lang=en">English</a></li>
		<li><a href="./?lang=fr">French</a></li>
	</ul>
</fieldset>
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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo site['main_css']; ?>"  />
		<script type="text/javascript" src="<?php echo site['jquery_js']; ?>"></script>
		<script type="text/javascript" src="<?php echo site['login_js']; ?>"></script>
	</head><body class="align">
<div class="grid"><form action="./" method="post" enctype="multipart/form-data" class="form login">
<table>
	<thead>
		<tr><th><?php echo $_SESSION['lang']['forms']['register']['ti']; ?></th></tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table>
					<tr><td><input type="name" name="<?php echo readers['register']['fn']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['register']['fn']; ?>" required autofocus /></td></tr>
					<tr><td><input type="name" name="<?php echo readers['register']['ln']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['register']['ln']; ?>" /></td></tr>
					<tr><td><input type="name" name="<?php echo readers['register']['un']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['register']['un']; ?>" required /></td></tr>
					<tr><td><input type="email" name="<?php echo readers['register']['em']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['register']['em']; ?>" required /></td></tr>
					<tr>
						<table>
							<tr style="margin-top:1px;margin-bottom:1px;">
								<td><label><?php echo $_SESSION['lang']['forms']['register']['ro']; ?>:</label></td>
								<td><select name="<?php echo readers['register']['ro']; ?>">
								<option value="Staff"><?php echo $_SESSION['lang']['forms']['register']['staff']; ?></option>
								<option value="Admin"><?php echo $_SESSION['lang']['forms']['register']['admin']; ?></option></select></td>
							</tr>
							<tr style="margin-top:1px;margin-bottom:1px;">
								<td><label><?php echo $_SESSION['lang']['forms']['register']['pi']; ?>:</label></td>
								<td><input type="file" name="<?php echo readers['register']['pi']; ?>" /></td>
							</tr>
						</table>
					</tr>
					<tr><td><input type="password" name="<?php echo readers['register']['pw']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['register']['pw']; ?>" required /></td></tr>
					<tr><td><input type="password" name="<?php echo readers['register']['cpw']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['register']['cpw']; ?>" /></td></tr>
				</table>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr><th><input type="submit" name="<?php echo readers['register']['re']; ?>" value="<?php echo $_SESSION['lang']['forms']['register']['re']; ?>" /></th></tr>
	</tfoot>
</table>
</form></div><?php
}#end@FUNCTION @fm_register
/**
*
*@fm_new_analyte
*@@author:rayalois22
*
*/
		public function fm_new_analyte(){
?><div id="newan"><form action="./" method="post">
	<fieldset>
		<legend><?php echo $_SESSION['lang']['forms']['an']['ti']; ?></legend>
		<table>
			<tr>
				<td><label><?php echo $_SESSION['lang']['forms']['an']['an_name']; ?>:</label></td>
				<td><input type="name" name="<?php echo readers['an']['name']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['an']['p_name']; ?>" autofocus required /></td>
			</tr>
			<tr>
				<td><label><?php echo $_SESSION['lang']['forms']['an']['an_units']; ?>:</label></td>
				<td><input type="text" name="<?php echo readers['an']['units']; ?>" placeholder="<?php echo $_SESSION['lang']['forms']['an']['p_units']; ?>" required /></td>
			</tr>
			<tr>
				<td colspan="2"><div>
					<input type="submit" name="<?php echo readers['an']['create']; ?>" value="<?php echo $_SESSION['lang']['forms']['an']['create']; ?>" />&nbsp;&nbsp;
					<a href="./?<?php echo readers['universal']['cancel']; ?>"><?php echo $_SESSION['lang']['forms']['an']['cancel']; ?></a>
				</div></td>
			</tr>
		</table>
	</fieldset>
</form></div><?php
}#end@FUNCTION @fm_new_analyte
/**
*
*@fm_new_control_material
*@@author:jkikuyu
*
*/
public function fm_control_material($analytes){

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="<?php echo site['main_css']; ?>"  />
	<script type="text/javascript" src="<?php echo site['main_js']; ?>"></script>
				
</head>
<body>
<table style="margin-left:20%">
<tr>
<td style = "width: 50%">
	<form action = "./" method = "POST">
		<fieldset >
		<legend><?php echo $_SESSION['lang']['forms']['material']['cm_title'];?> </legend>
			<table border = "0" align = "center" style = "width: 100%;" >
				<tr>
					<td style = "width: 100%;">
					<select class = "user_form" name="<?php echo readers['material']['select'];?>">
					<?php 
						foreach($analytes as $array_analyte){?>
						<option value="<?php echo $array_analyte['an_id'] ?>"><?php echo $array_analyte['an_name']?></option>
						<?php
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td style = "width: 100%;">	
						<input class = "user_form" type = "text" name ="<?php echo readers['material']['desc'];?>"  placeholder = "<?php echo $_SESSION['lang']['forms']['material']['cm_description'];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["material"]; ?>" required <?php } ?> required />
					</td>
				</tr> 
				<tr>
					<td style = "width: 100%;">
					<div class = "user_form">
						 <label><input type="radio" name="<?php echo readers['material']['level'];?>" value="High" />High</label>
						 <label><input type="radio" name="<?php echo readers['material']['level'];?>" value="Medium" />Med</label>
						<label><input type="radio" name="<?php echo readers['material']['level'];?>" value="Low" />Low</label>
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
					<input class = "user_form" type = "text" name = "<?php echo readers['material']['lotno'];?>" placeholder = "<?php echo $_SESSION['lang']['forms']['material']['cm_lot_number'];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["lotnumber"]; ?>"<?php } ?>  />
				</td>
			</tr>
			<tr>
				<td>
					<input class = "user_form" type = "text" name = "<?php echo readers['material']['cvalue'];?>" placeholder = "<?php echo $_SESSION['lang']['forms']['material']['cm_mean'];?>" <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["controlvalue"]; ?>"<?php } ?> required />
				</td>
			</tr>
			<tr>
				<td>
					<input class = "user_form" type = "text" name = "<?php echo readers['material']['stddev']?>" placeholder = "<?php echo $_SESSION['lang']['forms']['material']['cm_sd'];?>"  <?php if(isset($_SESSION['editId'])){ ?> value = "<?php echo $pers_to_edit["cm_sd"]; ?>"<?php } ?>
				</td>
			</tr>
		</table>
		</fieldset>
		<tr>
			<td >
				<?php if(isset($_SESSION['editId'])){ ?>
					<input class = "user_form" type = "submit" name = "<?php echo readers['material']['update']?>" value = "<?php echo $_SESSION['lang']['forms']['material']['cm_sd'];?>" />
				<?php }else{ ?>
					<Button type = "submit" name = "<?php echo readers['material']['save']?>"> <?php echo $_SESSION['lang']['forms']['material']['savedetails'];?> </Button> 
				<Button class="cancelbtn" type = "Cancel" OnClick = "parent.location='./'"><?php echo $_SESSION['lang']['forms']['material']['cancel'];?>  </Button>
			</td>
			<?php } ?>
			<td></td>
		</tr>
</form>
</table>
</body>
</html>
<?php	

}#end@FUNCTION @fm_new_control_material
/**
*
*@fm_login_new
*@@author lenileiro
*@@author rayalois22
*
*/
		public function fm_login_new(){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo site['main_css']; ?>"  />
		<script type="text/javascript" src="<?php echo site['jquery_js']; ?>"></script>
		<script type="text/javascript" src="<?php echo site['login_js']; ?>"></script>
	</head><body class="align">
<div>
<div class="grid">
<form action="./" method="post" class="form login">
	<div class="form__field">
		<label for="login__username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden"><?php echo $_SESSION['lang']['forms']['login']['un']; ?></span></label>
		<input id="login__username" type="text" name="<?php echo readers['login']['un']; ?>" class="form__input" placeholder="<?php echo $_SESSION['lang']['forms']['login']['un']; ?>" required>
	</div>

	<div class="form__field">
		<label for="login__password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
		<input id="login__password" type="password" name="<?php echo readers['login']['pw']; ?>" class="form__input" placeholder="<?php echo $_SESSION['lang']['forms']['login']['pw']; ?>" required>
	</div>

	<div class="form__field">
		<input type="submit" name="<?php echo readers['login']['lo']; ?>" value="<?php echo $_SESSION['lang']['forms']['login']['lo']; ?>" />
	</div>
	<div class="form__field">
		<a href="./?<?php echo readers['login']['re']; ?>"><?php echo $_SESSION['lang']['forms']['login']['re']; ?></a>
	</div>
	<div class="form__field">
		<?php echo $_SESSION['lang']['forms']['login']['lang']; ?>: <select id="lang-select">
			<option value="en">---</option>
			<option value="en"><?php echo $_SESSION['lang']['forms']['login']['en']; ?></option>
			<option value="fr"><?php echo $_SESSION['lang']['forms']['login']['fr']; ?></option>
		</select>
	</div>
</form>
</div>
<svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>
</div></body>
<?php
}#end@FUNCTION @fm_login_new
/**
*
*fm_options()
*
*CRUD operations
*
*/
		public function fm_options($object){
			//create, read, update, delete	
?>
<div id="actionbar">
		<?php 
			foreach($_SESSION['lang']['actionbar'] as $key=>$value){
				print '<input type="submit" name="'.readers['actionbar'][$key].$object.'" value="'.$value.'" formaction="./" formmethod="post" />&nbsp;';
			}
		?>
</div>
<?php
}#end@FUNCTION @fm_options
}#end@CLASS
?>