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
		"an"	=> "Analytes",
		"cm"	=> "Control materials",
		"cmr"	=> "Control material results",
		"logout"=> "Logout"
	],
	"main_js" => "home/js/main.js",
	"main_css" => "home/css/style.css"
]);
#readers
define("readers", [
	"login" => [
		"un" 	=> "username",
		"pw"	=> "password",
		"lo"	=> "submitlogin",
		"re"	=> "reqregister"
	],
	"register" => [
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
	],
	"an" => [
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
		"cancel" => "cancelreq"
	]
]);
?>