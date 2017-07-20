<?php
include "../db.php";
$access_token = $_POST["access_token"];
$status = $_POST["text"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($profile["id"])){
	$user_id = $profile["id"];
	mysql_query("UPDATE users SET status='$status' WHERE id='$user_id'");
	echo '{"response":1}';
}
else{
	echo '{"response":0}';
}
?>