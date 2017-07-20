<?php
include "../db.php";
include "../config.php";
$access_token = $_POST["access_token"];
$owner_id = $_POST["owner_id"];
$offset = $_POST["audio_offset"];
$limit = $_POST["audio_count"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($profile["id"])){
	$audios = mysql_query("SELECT * FROM audio WHERE owner_id='$owner_id' LIMIT ".$limit." OFFSET ".$offset);
	$pls = mysql_query("SELECT * FROM playlists WHERE owner_id='$owner_id'");
	$pi = 0;
	$ai = 0;
	while($play = mysql_fetch_array($pls)){
		$pi++;
		$playlists = $playlists.'{"id":'.$play['id'].',"owner_id":'.$profile['id'].',"type":0,"title":"'.$play['name'].'","description":"'.$play['description'].'","genres":[],"artists":[],"count":22,"is_following":false,"followers":0,"plays":0,"create_time":'.$play['date'].',"update_time":1493963312},';
	}
	while($song = mysql_fetch_array($audios)){
		$ai++;
		$songs = $songs.'{"id":'.$song['id'].',"owner_id":'.$profile['id'].',"artist":"'.$song['artist'].'","title":"'.$song['name'].'","duration":25,"date":'.$song['date'].',"url":"'.$config["server"].'/audio/'.$song["url"].'"},';
	}
	$playlists = substr($playlists,0,-1);
	$songs = substr($songs,0,-1);
	echo '{"response":{"owner":{"id":'.$profile["id"].',"first_name":"'.$profile["name"].'","last_name":"'.$profile["lastname"].'"},"playlists":{"count":'.$pi.',"items":['.$playlists.']},"audios":{"count":'.$ai.',"items":['.$songs.']}}}';
}
?>