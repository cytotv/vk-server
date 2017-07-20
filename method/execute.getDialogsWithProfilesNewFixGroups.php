<?php
include "../db.php";
$access_token = $_POST["access_token"];
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($user["id"])){
	$user_id = $user["id"];
	$msgs = mysql_query("SELECT * FROM messages_last WHERE user_id='$user_id' OR from_id='$user_id' ORDER BY date DESC");
	$i = 0;
	while($msg = mysql_fetch_array($msgs)){
		$i = $i + 1;
		if($msg["from_id"]!=$user_id){
			$uid = $msg["from_id"];
		}else{
			$uid = $msg["user_id"];
		}
		$u = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$uid'"));
		$peers = $peers.'{"id": '.$u["id"].',"first_name": "'.$u["name"].'","last_name": "'.$u["lastname"].'","sex": '.$u["sex"].',"photo_rec": "https://music-alpha.ru/vk/photos/50/'.$u["id"].'_1.jpg","photo_50": "https://music-alpha.ru/vk/photos/50/'.$u["id"].'_1.jpg","photo_medium_rec": "https://music-alpha.ru/vk/photos/100/'.$u["id"].'_1.jpg","photo_100": "https://music-alpha.ru/vk/photos/100/'.$u["id"].'_1.jpg","is_friend": 1,"online": 1},';
		$messages = $messages.'{"message":{"id": 1,"date":'.$msg["date"].',"out":0,"user_id":'.$u["id"].',"read_state":1,"title":"","body":"'.$msg["text"].'","random_id":0,"emoji":1},"in_read":0,"out_read":0},';
	}
	$peers = substr($peers,0,-1);
	$messages = substr($messages,0,-1);
	echo '{"response":{"a":{"count":'.$i.',"unread_dialogs":0,"items":['.$messages.']},"p":['.$peers.']}}';
}
?>