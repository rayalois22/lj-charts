$(document).ready(function(){
	load_data();
	load_data_grid();
	function load_data(query){
		$.ajax({
			url:"list_fetch.php",
			method:"POST",
			data:{query:query},
			success:function(data){
				$('#result_list').html(data);
			}
		});
	}
	function load_data_grid(query){
		$.ajax({
			url:"grid_fetch.php",
			method:"POST",
			data:{query:query},
			success:function(data){
				$('#result_grid').html(data);
			}
		});
	}
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != ''){
			load_data(search);
			load_data_grid(search);
		} else {
			load_data();
			load_data_grid();
		}
	});
});