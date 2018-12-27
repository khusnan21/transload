<?php
require_once("class.MyAnimeListAPI.php");
header("Content-Type: text/plain");
header("Access-Control-Allow-Origin: *");
if(isset($_GET["url"])){
	if($_GET["url"] != ""){
		$MyAnimeListAPI = new MyAnimeListAPI();
		$urlin = "https://myanimelist.net/anime/".$_GET["url"]."/Captain_Tsubasa_2018";
		$MAL_Data       = $MyAnimeListAPI->get_data($_GET["url"]);
		echo json_encode($MAL_Data);
	}
}
exit;
?>