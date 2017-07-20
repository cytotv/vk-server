<?php 
include "../db.php";
include "../config.php";

$audios_list = mysql_query("SELECT * FROM audio WHERE top='1'");
while($audio = mysql_fetch_array($audios_list)){
	$audios = $audios.'{"id":'.$audio["id"].',"owner_id":1,"artist":"'.$audio["artist"].'","title":"'.$audio["name"].'","duration":192,"date":'.$audio["date"].',"url":"'.$config["server"].'/audio/'.$audio["url"].'","lyrics_id":0,"genre_id":0,"is_licensed":true},';
}
$audios = substr($audios,0,-1);
echo '{"response":{"items":[{"id":1,"title":"'.$config["audio_title"].'","subtitle":"'.$config["audio_subtitle"].'","type":"audios_special","count":1,"source":"recommendation","audios":['.$audios.']}]}}';
?>