<?php
include "../db.php";
$access_token = $_POST["access_token"];
$message = $_POST["message"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
$owner_id = $_POST["peer_id"];
if(!empty($profile["id"])){
	$from_id = $profile["id"];
	$date = time();
	mysql_query("INSERT INTO messages (body, user_id, from_id, date) VALUES ('$message', $owner_id, $from_id, $date)");
	$check = mysql_fetch_array(mysql_query("SELECT * FROM messages_last WHERE user_id='$owner_id' AND from_id='$from_id' OR user_id='$from_id' AND from_id='$owner_id'"));
	if(empty($check["id"])){
		mysql_query("INSERT INTO messages_last (user_id, from_id, date, text) VALUES ('$owner_id', '$from_id', '$date', '$message')");
	}
	else{
		$cid = $check["id"];
		mysql_query("UPDATE messages_last SET date='$date', text='$message' WHERE id='$cid'");
	}
	echo '{"response": 1}';
}
?>