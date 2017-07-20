<?php
include "../db.php";
$name = urldecode($_POST["first_name"]);
$lastname = urldecode($_POST["last_name"]);
$access_token = $_POST["access_token"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($profile["id"])){
	mysql_query("UPDATE users SET name='$name', lastname='$lastname' WHERE token='$access_token'");
	echo '{"response":{"changed":1,"name_request":{"status":"success","first_name":"'.$name.'","last_name":"'.$lastname.'"}}}';
}
else{
	echo '{"response":{"changed":0,"name_request":{"status":"error","first_name":"'.$name.'","last_name":"'.$lastname.'"}}}';
}
?>