<?php
include_once("firstFriday.php");

if(!isset($_GET['page']) || $_GET['page'] == "" || preg_match("/\w*\W+\w*/",$_GET['page']))
{
	$page = "index";
} 
else 
{
	$page = $_GET['page'];
	$validPages = explode(' ', "bbs contact footer header index meetings projects");
	
	if(!in_array($page, $validPages))
	{
		$page = 'index';
	}
}

$fin = $NextFirstFri;
$fintit = $fin;

require("./content/header");

require("./content/".$page);

require("./content/footer");

?>
<!-- DEAR INTERNET I STILL GOT A KNIFE WHEEEEEEEE -->
