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
			foreach(site['main_navigation'] as $key=>$value){
				print '<a href="./?'.$key.'">'.$value.'</a>';
			}#end@foreach
}#end@FUNCTION
}#end@CLASS
?>