<?php
/**
*
*main_navigation
*
*Generates the main navigation links
*
*Comprises a number of methods:
*
*@set
*
*/
	class main_navigation{
/**
*
*@set()
*
*Sets the main_navigation links in the desired location
*
*/
		public function set(){
			print '<ul>';
			foreach(site['main_navigation'] as $key=>$value){
				print '<li><a href="./?'.$key.'">'.$value.'</a></li>';
			}#end@foreach
			print '</ul>';
}#end@FUNCTION
}#end@CLASS
?>