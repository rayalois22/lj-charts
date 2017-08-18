<?php
session_start();
?>
<!DOCTYPE html>
<html> 
	<link type = "text/css" rel = "stylesheet" href = "styles/bootstrap.min.css" />
	<link type = "text/css" rel = "stylesheet" href = "js/nyroModal/styles/nyroModal.css" />
	<script type = "text/javascript" src = "js/nyroModal/js/jquery-1.11.1.min.js" ></script>
	<script type = "text/javascript" src = "js/nyroModal/js/jquery.nyroModal.custom.js" ></script>
	<script type = "text/javascript" src = "js/ckeditor/ckeditor.js" ></script>
<head>
	
</head>
<body>
	<?php
		require_once "lang/en.php";
		require_once "classes/classesAutoload.php"
	?>
	<div class="table-responsive">
		<table class="table table bordered">
		<thead>
			<tr>
				<th><?php print ucwords($lang["materialDesc"]); ?></th>
				<th><?php print ucwords($lang["materialmean"]); ?></th>
				<th><?php print ucwords($lang["materiallevel"]); ?></th>
				<th><?php print ucwords($lang["materiallotno"]); ?></th>
				<th><?php print ucwords($lang["materialstd"]); ?></th>
			</tr>
		</thead>
		<?php
			$sql= "Select cm_id, cm_name, cm_level,cm_mean, cm_LotNumber, cm_sd from ControlMaterial";

			$select_material =$MYSQL->getResults($sql);

			if(is_array($select_material)){
	
				foreach($select_material AS $result_row){
		?>
			<tr>
				<td><?php print $result_row["cm_name"]; ?></td>
				<td><?php print $result_row["cm_mean"]; ?></td>
				<td><?php print $result_row["cm_level"]; ?></td>

				<td><?php print $result_row["cm_LotNumber"]; ?></td>
				
				<td><?php print $result_row["cm_sd"]; ?></td>
				<td>
			<a id = "listlinks" title = "More about <?php echo $result_row["cm_name"]; ?>" href = "dispatch.php?viewId=<?php echo $result_row["cm_id"]; ?>" class = "nyroModal" ><img src = "images/icons/details.png" width = "20px" height = "20px" /></a> | <a id = "listlinks" title = "Edit <?php echo $result_row["cm_name"]; ?>" href = "dispatch.php?editId=<?php echo $result_row["cm_id"]; ?>"><img src = "images/icons/edit.png" width = "15px" height = "15px" /></a> | <a id = "listlinks" title = "Delete <?php echo $result_row["cm_name"]; ?>" href = "index.php?delId=<?php echo $result_row["cm_id"]; ?>" onClick = "return confirm('Are you sure you want to delete <?php echo $result_row["cm_name"]; ?> from the database?')"><img src = "images/icons/del.png" width = "15px" height = "15px" /></a>
				</td>
			</tr>
			<?php }
				} ?>


	</table>
</body>

</html>