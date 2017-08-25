<?php
/**
*
*LJCHARTS READERS
*
*
*/
#site
define("site", [
	"main_navigation" => [
		"an"		=> "Analytes",
		"cm"		=> "Control materials",
		"cmr"		=> "Control material results",
		"logout"	=> "Logout"
	],
	"main_js" 		=> "home/js/main.js",
	"main_css" 		=> "home/css/style.css",
	"jquery_js" 	=> "home/js/jquery-v2.1.3.js",
	"custom_js" 	=> "home/js/custom.js",
	"login_js"	 	=> "home/js/login.js",
	"json_parser" 	=> "home/js/json2.js",
	"pi_path" 		=> "home/images/upload/profiles/",
	"ic_path" 		=> "home/images/icons/"
]);
#readers
define("readers", [
	"login" => [
		"un" 	=> "username",
		"pw"	=> "password",
		"lo"	=> "submitlogin",
		"re"	=> "reqregister"
	],"register" => [
		"fn" => "firstname",
		"ln" => "lastname",
		"un" => "username",
		"em" => "emailaddress",
		"ro" => "role",
		"pw" => "password",
		"cpw"=> "cpassword",
		"pi" => "profileimage",
		"re" 		=> "submitregister",
		"cancel" 	=> "cancel",
		"staff" 	=> "staff",
		"admin" 	=> "admin"
	],"an" => [
		"name"	 => "analytename",
		"units"	 => "analyteunits",
		"create" => "createnewanalyte"
	],
	"material"=>[
		"select"=>"selectanalyte",
		"desc" => "materialDesc",
		"level"=> "controllevel",
		"cvalue"=>"controlvalue",
		"stddev"=>"stddeviation",
		"lotno"=>"lotnumber",
		"mean" =>"mean",
		"update"=>"update_details",
		"save"=>"save_details"
	],
	"universal"	=> [
	],"actionbar" => [
		"create" => "create",
		"read"	 => "read",
		"update" => "update",
		"delete" => "delete"
	],"universal"	=> [
		"cancel" => "cancelreq"
]]);
?>