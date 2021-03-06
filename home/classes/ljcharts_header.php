<?php
/**
*
*LJCHARTS_HEADER
*
*Responsible for document type declaration, 
*stylesheet reference, javascript reference,
*and header display
*
*Comprises a number of methods:
*
*@set_header
*@get_home
*@get_navbar
*@get_user
*
*/
	class ljcharts_header{
/**
*
*set_header()
*
*/
		public function set_header(){
			$this->get_head();
			$this->get_home();
			$this->get_navbar();
			$this->get_user();
}#end@FUNCTION @set_header
/**
*
*get_head()
*
*/
		public function get_head(){
			?><!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" type="text/css" href="<?php echo site['main_css']; ?>"  />
				<script type="text/javascript" src="<?php echo site['json_parser']; ?>"></script>
				<script type="text/javascript" src="<?php echo site['main_js']; ?>"></script>
				<script type="text/javascript" src="<?php echo site['jquery_js']; ?>"></script>
				<script type="text/javascript" src="<?php echo site['custom_js']; ?>"></script>
			</head><body class="" id="body"><?php
}#end@FUNCTION @get_head
/**
*
*get_home()
*
*/
		public function get_home(){
			?><header class="" id="header">
			<section class="" id="h1">
				<div><a href="./">
					<img src="" alt="logo" width="60px" height="60px" /></a>
				</div><!--site_logo-->
			</section><?php
}#end@FUNCTION @get_home
/**
*
*get_navbar()
*
*
*/
		public function get_navbar(){
			?><section class="" id="h2"><?php 
				$MAINNAV = new main_navigation(); 
				$MAINNAV->set();
			?></section><?php
}#end@FUNCTION @get_navbar
/**
*
*get_user()
*
*/
		public function get_user(){
			?><section class="" id="h3">
				<div id="">
					<img src="" alt="profile picture" width="60px" height="60px" />
				</div><!--profile_image-->
			</section></header><?php
}#end@FUNCTION @get_user
}#end@CLASS
?>