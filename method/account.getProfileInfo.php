<?php
include "../db.php";
$access_token = $_POST["access_token"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($profile["id"])){
	echo '{"response":{"first_name":"'.$profile["name"].'","last_name":"'.$profile["lastname"].'","screen_name":"'.$profile["login"].'","sex":'.$profile["sex"].',"relation":0,"bdate":"28.2.2002","bdate_visibility":1,"home_town":"","country":{"id":1,"title":"Россия"},"city":{"id":1,"title":""},"status":"'.$profile["status"].'","phone":"none"}}';
}
?>