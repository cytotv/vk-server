<?php
include "../db.php";
$access_token = $_POST["access_token"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
$offset = $_POST["offset"];
if(!empty($offset)){$offset=0;}
$count = $_POST["count"];
$user_id = $_POST["peer_id"];
if(!empty($profile["id"])){
	$owner_id = $profile["id"];
	$msgs = mysql_query("SELECT * FROM messages WHERE user_id='$owner_id' AND from_id='$user_id' OR user_id='$user_id' AND from_id='$owner_id' ORDER BY date DESC");
	$mi = 0;
	while($msg = mysql_fetch_array($msgs)){
		$mi++;
		if($msg["user_id"]==$user_id){
			$messages = $messages.'{"id":'.$msg["id"].',"body":"'.$msg["body"].'","user_id":'.$user_id.',"from_id":'.$owner_id.',"date":'.$msg["date"].',"read_state":1,"out":1,"random_id":1024816486},';
		}
		else{
			$messages = $messages.'{"id":'.$msg["id"].',"body":"'.$msg["body"].'","user_id":'.$owner_id.',"from_id":'.$user_id.',"date":'.$msg["date"].',"read_state":1,"out":0,"random_id":1024816486},';
		}
	}
	$messages = substr($messages,0,-1);
	echo '{"response":{"count":'.$mi.',"items":['.$messages.']}}';
}
?>