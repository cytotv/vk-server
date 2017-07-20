<?php
include "../db.php";
$access_token = $_POST["access_token"];
$owner_id = $_POST["owner_id"];
$post_id = $_POST["post_id"];
$auser = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
$buser = mysql_fetch_array(mysql_query("SELECT * FROM users_posts WHERE owner_id='$owner_id' AND post_id='$post_id'"));
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$owner_id'"));
if($user["id"]==$auser["id"] || $auser["id"]==$buser["from_id"]){
	mysql_query("DELETE FROM users_posts WHERE owner_id='$owner_id' AND post_id='$post_id'");
	echo '{"response":1}';
}
else{
	echo '{"response":0}';
}
?>