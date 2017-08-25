$("document").ready(function(){
	//change the language accross the site.
	$("#lang-select").on('change', function(){
		var lang = $(this).val();
		var flang = "index.php?lang=" + lang;
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if((xhr.readyState == 4) && (xhr.status == 200 || xhr.status == 304)){
				location.reload(true);
			}
		};
		xhr.open("GET", flang, true);
		xhr.send(null);
	});
});